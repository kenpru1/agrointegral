<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Campo;
use App\Models\Cuartel;
use App\Models\Empresa;
use App\Models\Trabajador;
use App\Models\Bodega;
use Illuminate\Support\Facades\Auth;
use App\Models\Presupuesto;
use App\Models\Factura;
use Session;
/**
 * Class DashboardController.
 */
class DashboardController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        
        $empresaUser = Auth::user()->empresaUser();
        $dataLabels=null;
        $dataAmounts=null;
        $dataColors=null;
        $empresas=null;
        $cuarteles=array();

        if ($empresaUser != null) {


            $campos = Campo::where('empresa_id', $empresaUser->id)->orderBy('id', 'desc')->get();

            $trabajadores = Trabajador::where('empresa_id', $empresaUser->id)->count();
            $bodegas = Bodega::where('empresa_id', $empresaUser->id)->count();

            

            $count = 0;

            $camposConCuarteles = array();

           //GRAFICO DE CIRCULOS
            if ($campos != null) {

                foreach ($campos as $key => $campo) {

                    $cuarteles = Cuartel::where('campo_id', $campo->id)->get();

                    if (count($cuarteles) > 0) {
                        $dataLabels[$campo->nombre]  = array();
                        $dataAmounts[$campo->nombre] = array();
                        $dataColors[$campo->nombre]  = array();

                        foreach ($cuarteles as $key => $cuartel) {

                            if (isset($cuartel->tipoCultivo->nombre)) {
                                array_push($dataLabels[$campo->nombre], $cuartel->nombre . '-' . $cuartel->tipoCultivo->nombre);
                            } else {
                                array_push($dataLabels[$campo->nombre], $cuartel->nombre . '- Sin Cultivo');
                            }

                            array_push($dataAmounts[$campo->nombre], $cuartel->tamanno);
                            array_push($dataColors[$campo->nombre], $this->getRandomColor());
                        }

                        array_push($camposConCuarteles, $campo);

                    }
                }

                /*GRAFICO BARRAS*/
                $presupuestado = Presupuesto::where('empresa_id', $empresaUser->id)->sum('total');
                $facturado = Factura::where('empresa_id', $empresaUser->id)->where('estado_factura_id',1)->sum('total');
                $pagado = Factura::where('empresa_id', $empresaUser->id)->where('estado_factura_id',2)->sum('total');

                 /*GRAFICO BARRAS*/

                //*Busqueda de la empresa*/
               
               $empresas = Empresa::orderBy('id', 'desc')->get();

               //*Busqueda de la empresa*/
                if(count($campos)==0 ||count($cuarteles)==0 ){
                     Session::flash('flash_warning', 'Aun no ha creado campos y cuarteles para mostrar'); 
                }

                return view('backend.dashboard', compact('camposConCuarteles', 'dataLabels', 'dataAmounts', 'dataColors','empresas','campos','cuarteles','trabajadores','bodegas','presupuestado','facturado','pagado'));
            } else {
                //GRAFICO DE CIRCULOS
                return redirect()->route('admin.perfil_empresa')->withFlashDanger('Empresa sin campos');
            }


        } else {

            return redirect()->route('admin.perfil_empresa')->withFlashDanger('Usuario sin empresa registrada, por favor introduzca primero los datos de la empresa a la que representa');
        }

        //return view('backend.dashboard');
    }

    //Función agregar colores aleatorios a los circulos
    private function getRandomColor()
    {

        return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
    }
}
