@extends('backend.layouts.app')

@section('title', __('labels.backend.access.presupuesto.management') . ' | Editar' )

@section('content')
<div class="row">
             <div class="col-lg-12">
                <div class="wrapper wrapper-content animated fadeInRight">
                    <div class="ibox-content p-xl">

                       <div class="row">
                           <div class="col-sm-3">
                               @if($empresa->logo!=null)
                                   <img alt="Logo de la Empresa"  src="{{ asset($empresa->logo) }}" height="50%" width="50%" />
                               @else
                                   <img alt="Empresa Sin Logo"  src="{{ asset('app/public/logos_empresas/nologo.png') }}" height="50%" width="50%" />
                               @endif
                          </div>
                      </div>


                <p></p>
                        <div class="row">
                          <div class="col-sm-6">
                                  <span>De:</span>
                                      <address>
                                        <strong>{{ $empresa->nombre }}</strong><br>
                                        {{ $empresa->direccion }}<br>
                                        {{ $empresa->comuna }}<br>
                                        {{ $empresa->ciudad }}
                                        {{ $empresa->codigo_postal }}
                                      </address>
                          </div>

                                <div class="col-sm-6 text-right">
                                    <h4>Cotización No. </h4>
                                    <h4 class="text-navy">{{ $presupuesto->numero }}</h4>
                                    <span>Para:</span>
                                    <address>
                                        <strong>{{ $presupuesto->cliente->rut }}</strong><br>
                                        <strong>{{ $presupuesto->cliente->nombre_razon }}</strong><br>
                                        {{ $presupuesto->cliente->direccion }}<br>
                                        <!-- <abbr title="Phone">Télefono: </abbr> -->

                                        <p>Teléfono : {{ $presupuesto->cliente->telefono }} <p>
                                    </address>
                                   
                                </div>
                        </div>

                            <div class="table-responsive m-t">
                                <table class="table ">
                                    <thead>
                                    <tr>
                                        <th scope="col">Tipo Muestras</th>
                                        <th scope="col">Especie/Fuentes</th>
                                        <th scope="col">Análisis</th>                              
                                        <th scope="col">Laboratorio</th>                                      
                                        <th scope="col">Nro. Muestras</th>
                                        <th scope="col">Precio Unitario</th>
                                        <th scope="col">Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    
                                    @foreach($presupuesto->detalle_presupuesto as $detalle)
                                    <tr>
                                        <td ><div>{{ $detalle->tipoMuestra->nombre}}</div></td>
                                        <td ><div>{{ $detalle->especieFuente->nombre}}</div></td>
                                        <td ><div>{{ $detalle->analisis->nombre}}</div></td>
                                        <td ><div>{{ $detalle->laboratorio->nombre}}</div></td>
                                        

                                        <td>{{ $detalle->cantidad }}</td>
                                        <td>{{ number_format($detalle->precio_venta,0,'.','') }}</td>
                                        <td>{{ number_format($detalle->total,0,'.','') }}</td>
                                    </tr>

                                    @endforeach

                                    </tbody>
                                </table>
                            </div><!-- /table-responsive -->

                            <table class="table invoice-total">
                                <tbody>
                                <tr>
                                    <td><strong>Sub Total :</strong></td>
                                    <td>${{ number_format($presupuesto->sub_total,0,'.','') }}</td>
                                </tr>
                                <tr>
                                    <td><strong>IVA</strong></td>
                                    <td>${{ number_format($presupuesto->iva,0,'.','')  }}</td>
                                </tr>
                                <tr>
                                    <td><strong>TOTAL :</strong></td>
                                    <td>${{ number_format($presupuesto->total,0,'.','')  }}</td>
                                </tr>
                                </tbody>
                            </table>
                            {{-- <div class="text-right">
                                <button class="btn btn-primary"><i class="fa fa-dollar"></i> Make A Payment</button>
                            </div>--}}

                            <div><strong>Nota Publica:</strong>
                                   {{ $presupuesto->nota_publica }}
                            </div>


                            <div><strong>Nota Privada:</strong>
                                   {{ $presupuesto->nota_privada }}
                            </div>
                        <div class="row">
                           
                            <div class="center col-md-10 col-md-push-6">
                             <a class="btn btn-white btn-sm" href="{{route('admin.presupuestos.index')}}" >@lang('buttons.general.cancel')</a>    
                                
                                @if($presupuesto->estado_presupuesto_id != 2)
                                <a href="{{ route('admin.presupuestos.edit', $presupuesto) }}"  class="btn btn-sm btn-white"><i class="fa fa-pencil"></i> Editar </a>
                                @endif
                                <a href="{{ route('admin.presupuestos.print', $presupuesto) }}"  target="_blank" class="btn btn-sm btn-primary"><i class="fa fa-print"></i> Imprimir</a>

                                @if($presupuesto->estado_presupuesto_id != 2)
                                <a href="{{route('admin.presupuestos.cambiar_status',array('presupuesto'=>$presupuesto,'estado'=>2))}}"  class="btn btn-sm btn-success"><i class="fa fa-check"></i> Aprobado</a>
                               
                                <a href="{{route('admin.presupuestos.cambiar_status',array('presupuesto'=>$presupuesto,'estado'=>3))}}"   class="btn btn-sm btn-danger"><i class="fa fa-ban"></i> Rechazado</a>
                                @endif
                            </div>
                        </div>
                </div>
                     
            </div>
        </div>
@endsection
