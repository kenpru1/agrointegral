<?php
namespace App\Helpers\Lib;

use \Exception;

/**
 * Clase para Configurar el cliente
 * @Filename: Config.class.php
 * @version: 2.0
 * @Author: flow.cl
 * @Email: csepulveda@tuxpan.com
 * @Date: 28-04-2017 11:32
 * @Last Modified by: Carlos Sepulveda
 * @Last Modified time: 28-04-2017 11:32
 */

/*$COMMERCE_CONFIG = array(
"APIKEY" => "mi apiKey", // Registre aquí su apiKey
"SECRETKEY" => "mi secretKey", // Registre aquí su secretKey
"APIURL" => "https://www.flow.cl/api", // Producción EndPoint o Sandbox EndPoint
"BASEURL" => "https://www.micomercio.cl/apiFlow" //Registre aquí la URL base en su página donde instalará el cliente
);

$COMMERCE_CONFIG = array(
"APIKEY" => "mi apiKey", // Registre aquí su apiKey
"SECRETKEY" => "mi secretKey", // Registre aquí su secretKey
"APIURL" => "https://www.flow.cl/api", // Producción EndPoint o Sandbox EndPoint
"BASEURL" => "https://www.micomercio.cl/apiFlow" //Registre aquí la URL base en su página donde instalará el cliente
);*/

class Config
{

    public static function get($name)
    {

        $commerce_config = array(
            "APIKEY"    => "2AF07D27-88F2-4312-A280-2BL488702357", // Registre aquí su apiKey
            "SECRETKEY" => "53c76621b06f5c3cb848ac306850f501c165fde4", // Registre aquí su secretKey
            "APIURL"    => "https://sandbox.flow.cl/api", // Producción EndPoint o Sandbox EndPoint
            "BASEURL"   => "http://proterra.local/admin/", //Registre aquí la URL base en su página donde instalará el cliente
        );

        if (!isset($commerce_config[$name])) {
            throw new \Exception("The configuration element thas not exist", 1);
        }
        return $commerce_config[$name];
    }
}
