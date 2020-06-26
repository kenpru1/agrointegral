<?php

namespace App\Console\Commands;

use App\Models\Planes;
use DB;
use Illuminate\Console\Command;

class UfUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:UfUpdate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Actualizacion del valor del plana traves de la Unidad de Fomento';

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
        try {
            DB::beginTransaction();

            //$plan = Planes::where('id', 1)->first();

            $planes = Planes::orderBy('id', 'desc')->get();

            $client = new \GuzzleHttp\Client();

            $request = $client->get('https://api.sbif.cl/api-sbifv3/recursos_api/uf?apikey=3f07ce0f4bdef0fc4c1b6fe58bd42c4b8a585780&formato=json');

            $response = $request->getBody()->getContents();
            $res      = json_decode($response, true);
            $valor    = $res['UFs'][0]['Valor'];
            if (isset($valor) && $valor > 0) {
            $uf=number_format(str_replace(",", ".", str_replace(".", "", $valor)), 0, '.', '');

                foreach ($planes as $plan) {
                        
                    $plan->valor_uf = $uf;
                    $plan->costo= ($plan->cantidad_uf * $uf);
                    $plan->save();

                    print_r("Valor Actualizado correctamente");
                    DB::commit();
                }
            }
            die();
        } catch (\Exception $e) {
            report($e);

            DB::rollback();
            var_dump($e);

        }

    }
}
