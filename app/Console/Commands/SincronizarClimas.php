<?php

namespace App\Console\Commands;

use App\Models\Campo;
use App\Models\Clima;
use App\Models\ClimaPrediccion;
use DB;
use Illuminate\Console\Command;

class SincronizarClimas extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sinc:sinclima';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Actualización del clima de cada campo obteniendo los datos desde la API youtube Wheather a partir de las coordenadas de los cuarteles que poseen';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $succes = array();
        $errors = array();

        DB::table('climas')->where('id', '>', 0)->delete();
        DB::table('climas_predicciones')->where('id', '>', 0)->delete();

        $campos = Campo::orderBy('id')->get();

        foreach ($campos as $campo) {

            try {
                DB::beginTransaction();
                if (isset($campo->cuarteles->first()->ubiq_lat) && isset($campo->cuarteles->first()->ubiq_lng)) {
                    $lat = number_format($campo->cuarteles->first()->ubiq_lat, 4, '.', '');
                    $lon = number_format($campo->cuarteles->first()->ubiq_lng, 4, '.', '');

                    $url             = 'https://weather-ydn-yql.media.yahoo.com/forecastrss';
                    $app_id          = 'Si5YeR74';
                    $consumer_key    = 'dj0yJmk9REFwOGZ2ejZvTDY2JmQ9WVdrOVUyazFXV1ZTTnpRbWNHbzlNQS0tJnM9Y29uc3VtZXJzZWNyZXQmc3Y9MCZ4PTA3';
                    $consumer_secret = '52899e59f4061785312e2de9ac2f55205e478609';
                    $query           = array(
                        //'location' => 'sunnyvale,ca',
                        'lat'    => $lat,
                        'lon'    => $lon,
                        'format' => 'json',
                        'u'      => 'c',
                    );
                    $oauth = array(
                        'oauth_consumer_key'     => $consumer_key,
                        'oauth_nonce'            => uniqid(mt_rand(1, 1000)),
                        'oauth_signature_method' => 'HMAC-SHA1',
                        'oauth_timestamp'        => time(),
                        'oauth_version'          => '1.0',
                    );
                    $base_info                = $this->buildBaseString($url, 'GET', array_merge($query, $oauth));
                    $composite_key            = rawurlencode($consumer_secret) . '&';
                    $oauth_signature          = base64_encode(hash_hmac('sha1', $base_info, $composite_key, true));
                    $oauth['oauth_signature'] = $oauth_signature;
                    $header                   = array(
                        $this->buildAuthorizationHeader($oauth),
                        'X-Yahoo-App-Id: ' . $app_id,
                    );
                    $options = array(
                        CURLOPT_HTTPHEADER     => $header,
                        CURLOPT_HEADER         => false,
                        CURLOPT_URL            => $url . '?' . http_build_query($query),
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_SSL_VERIFYPEER => false,
                    );
                    $ch = curl_init();
                    curl_setopt_array($ch, $options);
                    $response = curl_exec($ch);
                    curl_close($ch);

                    $return_data = json_decode($response);

                    $clima = new Clima();
                    /**Location**/
                    // $clima->location_city        = $return_data->location->city;
                    $clima->location_city = null;
                    //$clima->location_region      = $return_data->location->region;
                    $clima->location_region = null;

                    if (isset($return_data->location->country)) {
                        $clima->location_country = $return_data->location->country;
                    }
                    $clima->location_lat         = $return_data->location->lat;
                    $clima->location_long        = $return_data->location->long;
                    $clima->location_timezone_id = $return_data->location->timezone_id;

                    /**Current_Observation->wind**/
                    $clima->wind_chill     = $return_data->current_observation->wind->chill;
                    $clima->wind_direction = $return_data->current_observation->wind->direction;
                    $clima->wind_speed     = $return_data->current_observation->wind->speed;

                    /**Current_Observation->atmosphere**/
                    $clima->atmosphere_humidity   = $return_data->current_observation->atmosphere->humidity;
                    $clima->atmosphere_visibility = $return_data->current_observation->atmosphere->visibility;
                    $clima->atmosphere_pressure   = $return_data->current_observation->atmosphere->pressure;

                    /**Current_Observation->astronomy**/
                    $clima->astronomy_sunrise = $return_data->current_observation->astronomy->sunrise;
                    $clima->astronomy_sunset  = $return_data->current_observation->astronomy->sunset;

                    /**Current_Observation->condition**/
                    $clima->condition_text        = $return_data->current_observation->condition->text;
                    $clima->condition_code        = $return_data->current_observation->condition->code;
                    $clima->condition_temperature = $return_data->current_observation->condition->temperature;

                    $clima->pubDate = $return_data->current_observation->pubDate;

                    $clima->campo_id = $campo->id;

                    $clima->save();

                    foreach ($return_data->forecasts as $forecast) {
                        $pred           = new ClimaPrediccion();
                        $pred->day      = $this->translateDay($forecast->day);
                        $pred->date     = $forecast->date;
                        $pred->low      = $forecast->low;
                        $pred->high     = $forecast->high;
                        $pred->text     = $forecast->text;
                        $pred->code     = $forecast->code;
                        $pred->clima_id = $clima->id;
                        $pred->save();
                    }

                    $succes = array_add($succes, $campo->nombre, 'Actualizado');

                }
                DB::commit();
                var_dump($succes);

            } catch (\Exception $e) {
                report($e);
                //dd($e);
                $errors = array_add($errors, $campo->nombre, 'Error');
                DB::rollback();
                var_dump($errors);

            }
        }

        die;
    }

    public function buildBaseString($baseURI, $method, $params)
    {
        $r = array();
        ksort($params);
        foreach ($params as $key => $value) {
            $r[] = "$key=" . rawurlencode($value);
        }
        return $method . "&" . rawurlencode($baseURI) . '&' . rawurlencode(implode('&', $r));
    }

    public function buildAuthorizationHeader($oauth)
    {
        $r      = 'Authorization: OAuth ';
        $values = array();
        foreach ($oauth as $key => $value) {
            $values[] = "$key=\"" . rawurlencode($value) . "\"";
        }
        $r .= implode(', ', $values);
        return $r;
    }

    public function translateDay($day)
    {
        if ($day == 'Sun') {
            return 'Dom';
        }

        if ($day == 'Mon') {
            return 'Lun';
        }
        if ($day == 'Tue') {
            return 'Mar';
        }
        if ($day == 'Wed') {
            return 'Mie';
        }
        if ($day == 'Thu') {
            return 'Jue';
        }
        if ($day == 'Fri') {
            return 'Vie';
        }
        if ($day == 'Sat') {
            return 'Sab';
        }

    }
}
