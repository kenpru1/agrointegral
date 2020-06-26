<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\Lib\Config;
use App\Helpers\Lib\FlowApi;
use App\Http\Controllers\Controller;
use App\Models\EmpresaPago;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FlowController extends Controller
{

    public function index()
    {
        $nombrePlan     = Auth::user()->empresaUser()->plan->nombre;
        $rutDni         = Auth::user()->empresaUser()->rut_dni;
        $email          = Auth::user()->empresaUser()->email;
        $facturacion    = Auth::user()->empresaUser()->facturacion;
        $nrOrden        = $this->getNro();
        $pago           = EmpresaPago::where('id', $nrOrden)->first();
        $paymentMethods = [1 => 'Webpay', 2 => 'Servipag'];

        if ($nrOrden != false) {
            return view('backend.payment.index', compact('nrOrden', 'pago', 'paymentMethods', 'nombrePlan', 'facturacion', 'rutDni', 'email'));
        } else {
            return redirect()->route('admin.dashboard')->withFlashDanger('No posee pagos pendientes');
        }
    }

    public function orden(Request $request)
    {
        $orden = [
            'rut'              => $request->input('rut'),
            'orden_compra'     => $request->input('orden'),
            'monto'            => $request->input('monto'),
            'concepto'         => $request->input('concepto'),
            'email_pagador'    => $request->input('pagador'),
            'paymentMethodsId' => $request->input('paymentMethods'),
            'nombrePlan'       => $request->input('plan'),
            'facturacion'      => $request->input('facturacion'),
            'porc_iva'         => $request->input('porc_iva'),
            'monto_iva'        => $request->input('monto_iva'),
            'total'            => $request->input('total'),
            'inicio_periodo'   => $request->input('inicio_periodo'),
            'fin_periodo'      => $request->input('fin_periodo'),

        ];
        $paymentMethods = [1 => 'Webpay', 2 => 'Servipag'];

        // Genera una nueva Orden de Pago, Flow la firma y retorna un paquete de datos firmados
        //$orden['flow_pack'] = Flow::new_order($orden['orden_compra'], $orden['monto'], $orden['concepto'], $orden['email_pagador']);

        // Si desea enviar el medio de pago usar la siguiente línea
        //$orden['flow_pack'] = Flow::new_order($orden['orden_compra'], $orden['monto'], $orden['concepto'], $orden['email_pagador'], $orden['medio_pago']);

        return view('backend.payment.orden', compact('orden', 'paymentMethods'));
    }

    public function crear(Request $request)
    {

        //Para datos opcionales campo "optional" prepara un arreglo JSON
        $optional = array(
            "rut" => $request->input('rut'),
            //"otroDato" => "otroDato",
        );
        $optional = json_encode($optional);

//Prepara el arreglo de datos
        $params = array(
            "commerceOrder"   => $request->input('orden'),
            "subject"         => $request->input('concepto'),
            "currency"        => "CLP",
            "amount"          => $request->input('total'),
            "email"           => $request->input('pagador'),
            "paymentMethod"   => $request->input('paymentMethods'),
            "urlConfirmation" => Config::get("BASEURL") . "payment/result",
            "urlReturn"       => Config::get("BASEURL") . "payment/result",
            "optional"        => $optional,
        );
//Define el metodo a usar
        $serviceName = "payment/create";

        try {

            // Instancia la clase FlowApi
            $flowApi = new FlowApi;

            // Ejecuta el servicio
            $response = $flowApi->send($serviceName, $params, "POST");

            if (!isset($response['message_error']) || $response['message_error'] == null) {

                //Prepara url para redireccionar el browser del pagador
                $redirect = $response["url"] . "?token=" . $response["token"];
                ///header("location:$redirect");
                return redirect()->to($redirect)->send();
            } else {
                return redirect()->route('admin.payment.index')->withFlashDanger($response["message_error"]);
            }

        } catch (Exception $e) {

            return redirect()->route('admin.payment.index')->withFlashDanger($e->getCode() . " - " . $e->getMessage());
        }

    }

    public function confirm(Request $request)
    {

        try {
            if (!isset($_POST["token"])) {
                throw new Exception("No se recibio el token", 1);
            }
            $token  = filter_input(INPUT_POST, 'token');
            $params = array(
                "token" => $token,
            );
            $serviceName = "payment/getStatus";
            $flowApi     = new FlowApi();
            $response    = $flowApi->send($serviceName, $params, "GET");

            //Actualiza los datos en su sistema

            print_r($response);

        } catch (Exception $e) {
            //echo "Error: " . $e->getCode() . " - " . $e->getMessage();
            return redirect()->route('admin.payment.index')->withFlashDanger($e->getCode() . " - " . $e->getMessage());
        }
    }

    public function result(Request $request)
    {

        try {
            //Recibe el token enviado por Flow
            if (!isset($_POST["token"])) {
                throw new Exception("No se recibio el token", 1);
            }
            $token  = filter_input(INPUT_POST, 'token');
            $params = array(
                "token" => $token,
            );
            //Indica el servicio a utilizar
            $serviceName = "payment/getStatus";

            $flowApi  = new FlowApi();
            $response = $flowApi->send($serviceName, $params, "GET");

            $pago = EmpresaPago::where('id', $response['commerceOrder'])->first();

            if ($response['status'] == 2) {
                $pago->estado = "Pagada";
            } else {
                $pago->estado = "Pendiente";
            }

            $pago->order_number    = $response['flowOrder'];
            $pago->email_pagador   = $response['payer'];
            $pago->medio           = $response['paymentData']['media'];
            $pago->fee             = $response['paymentData']['fee'];
            $pago->taxes           = $response['paymentData']['taxes'];
            $pago->balance         = $response['paymentData']['balance'];
            $pago->fecha_solicitud = $response['requestDate'];
            $pago->fecha_pago      = $response['paymentData']['transferDate'];

            $pago->save();

            //print_r($response);
            if ($response['status'] == 2) {
                \Session::flash('flash_success', 'Su Pago ha sido Registrado Exitosamente!');
            } else {
                \Session::flash('flash_danger', 'Su Pago No pudo ser procesadoPor Favor Verifique');
            }

            return view('backend.payment.result', compact('response'));

        } catch (Exception $e) {
            return redirect()->route('admin.payment.index')->withFlashDanger($e->getCode() . " - " . $e->getMessage());
        }
    }

    public function getNro()
    {
        $empresaUser = Auth::user()->empresaUser();
        $nro         = EmpresaPago::where('empresa_id', $empresaUser->id)
            ->where('estado', 'Pendiente')->get()->last();

        //De no existir ningun pago se crea el primero para poder procesar
        if (!isset($nro->id)) {

            return false;

        }

        return $nro->id;
    }

}
