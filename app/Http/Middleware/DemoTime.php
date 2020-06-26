<?php

namespace App\Http\Middleware;

use App\Models\EmpresaPago;
use Carbon\Carbon;
use Closure;
use Illuminate\Support\Facades\Auth;
use Session;
class DemoTime
{
    /**
     * Maneja los tiempos de vencimineto para los usuarios
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $demoTime = config('app.periodo_prueba');
        $payTime  = config('app.periodo_pago');



        $empresaUser = Auth::user()->empresaUser();

        $dateReg  = Carbon::parse($empresaUser->created_at);
        $now      = Carbon::now();
        $nextMonth=Carbon::now()->addMonth(); 
        $diffDemo = $dateReg->diffInDays($now);

        $pagoPendiente = EmpresaPago::where('empresa_id', $empresaUser->id)
            ->where('estado', 'Pendiente')->get()->last();


        $pagoPagado = EmpresaPago::where('empresa_id', $empresaUser->id)
            ->where('estado', 'Pagada')->get()->last();

        $pagoHist = EmpresaPago::where('empresa_id', $empresaUser->id)->count();

        if ($pagoPagado != null) {
            $dateLastPago = Carbon::parse($pagoPagado->created_at);
            $diffPago     = $dateLastPago->diffInDays($now);
        } else {
            $diffPago = 0;
        }


        // No Pasaron los 15 días de prueba
        if ($diffDemo < $demoTime) {

            return $next($request);
        } else {

            if (!auth()->user()->hasRole('administrator')) {
                $montoIva=$empresaUser->plan->costo * config('app.iva') / 100;
                $total=($empresaUser->plan->costo * config('app.iva') / 100)+$empresaUser->plan->costo;

                //Si no existen pagos registrados genera un nuevo pago pendiente
                if ($pagoHist == 0) {
                    $newPago              = new EmpresaPago();
                    $newPago->descripcion = "Pago por concepto de uso de la App periodo ".$now->format('d-m-Y')." - ".$nextMonth->format('d-m-Y');
                    $newPago->estado      = "Pendiente";
                    $newPago->empresa_id  = $empresaUser->id;

                    if ($empresaUser->facturacion=='Si') {
                        $newPago->monto = $empresaUser->plan->costo;
                        $newPago->porc_iva = config('app.iva');
                        $newPago->monto_iva =number_format($montoIva,0,"","") ;
                        $newPago->total =number_format($total,0,"","");
                    }else{
                        $newPago->monto = $empresaUser->plan->costo;
                        $newPago->porc_iva = 0;
                        $newPago->monto_iva =0;
                        $newPago->total =$empresaUser->plan->costo;

                    }
                    $newPago->inicio_periodo=$now;
                    $newPago->fin_periodo=$nextMonth;  
                    $newPago->save();
                    return redirect()->route('admin.payment.index')->withFlashDanger('Su afiliación ha vencido');
                }

                // Si Pasaron los 15 días de prueba no hay pagos pendientes genera un nuevo pago
                if ($pagoPendiente == null && $diffPago > $payTime) {

                    $newPago              = new EmpresaPago();
                    $newPago->descripcion = "Pago por concepto de uso de la App periodo ".$now->format('d-m-Y')." - ".$nextMonth->format('d-m-Y');
                    $newPago->estado      = "Pendiente";
                    $newPago->empresa_id  = $empresaUser->id;

                    if ($empresaUser->facturacion=='Si') {
                        $newPago->monto = $empresaUser->plan->costo;
                        $newPago->porc_iva = config('app.iva');
                        $newPago->monto_iva =number_format($montoIva,0,"","") ;
                        $newPago->total =number_format($total,0,"","");
                    }else{
                        $newPago->monto = $empresaUser->plan->costo;
                        $newPago->porc_iva = 0;
                        $newPago->monto_iva =0;
                        $newPago->total =$empresaUser->plan->costo;

                    }
                    

                    $newPago->inicio_periodo=$now;
                    $newPago->fin_periodo=$nextMonth; 
                    $newPago->save();
                    return redirect()->route('admin.payment.index')->withFlashDanger('Su afiliación ha vencido');
                }

                // Si Pasaron los 15 días de prueba pero no tiene ningun pago registrado o pendiente
                if ($pagoPendiente == null && $diffPago <= $payTime) {

                    return $next($request);
                }

                // Si Pasaron los 15 días de prueba y tiene pagos pendientes
                if ($pagoPendiente != null) {
                    
                    $nextWeek=Carbon::parse($pagoPendiente->inicio_periodo)->addWeek();
                 
                    if($now<=$nextWeek){
                        Session::flash('flash_danger', 'Recuerde que tiene su facturación disponible para pago y vence el dia '. $nextWeek->format('d-m-Y') .' <a href="'.route('admin.payment.index').'">Puede pagar Aquí</a>'); 
                        return $next($request);
                    }else{

                    return redirect()->route('admin.payment.index')->withFlashDanger('Su afiliación ha vencido y tiene pagos pendiente');
                }
            }

            }

        }

        if (!auth()->user()->hasRole('administrator')) {
            return redirect()->route('admin.payment.index')->withFlashDanger('Su periodo de prueba ha finalizado');
        } else {
            return $next($request);
        }
    }
}
