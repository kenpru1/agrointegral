@extends('backend.layouts.app')

@section('title', __('labels.backend.access.ordenTrabajo.management') . ' | Ver' )

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
                                    <h4>Orden de Trbajo No. </h4>
                                    <h4 class="text-navy">{{ $ordenTrabajo->numero }}</h4>
                                    <span>Para:</span>
                                    <address>
                                        <strong>{{ $ordenTrabajo->cliente->rut }}</strong><br>
                                        <strong>{{ $ordenTrabajo->cliente->nombre_razon }}</strong><br>
                                        {{ $ordenTrabajo->cliente->direccion }}<br>
                                        <p>Télefono: {{ $ordenTrabajo->cliente->telefono }} </p>
                                    </address>
                                    {{--<p>
                                        <span><strong>Invoice Date:</strong> Marh 18, 2014</span><br/>
                                        <span><strong>Due Date:</strong> March 24, 2014</span>
                                    </p>--}}
                                </div>
                        </div>

                            <div class="table-responsive m-t">
                                <table class="table ">
                                    <thead>
                                    <tr>
                                        <th scope="col">Especie/Fuentes</th>
                                        <th scope="col">Variedad</th>                
                                        
                                        <th scope="col">Predio/Parcela</th>
                                        <th scope="col">Nro. Cuartel</th>
                                                                                                                                                                                       
                                        <th scope="col">Tipo Muestras</th>
                                        <th scope="col">Descripción</th>

                                        <th scope="col">Análisis</th>                              
                                        <th scope="col">Laboratorio</th>                                      
                                        <th scope="col">Plazo de Entrega</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    
                                    @foreach($ordenTrabajo->detalleOrdenTrabajo as $detalle)
                                    <tr>

                                        <td ><div>{{ $detalle->especieFuente->nombre}}</div></td>                                    
                                        <td ><div>{{ $detalle->variedad}}</div></td>

                                        <td ><div>{{ $detalle->campo->nombre}}</div></td>
                                        <td ><div>{{ $detalle->campo->cuarteles[0]['nombre']}}</div></td>                                                                                                                        
                                        <td ><div>{{ $detalle->tipoMuestra->nombre}}</div></td>
                                        <td ><div>{{ $detalle->descripcion}}</div></td>                                        

                                        <td ><div>{{ $detalle->analisis->nombre}}</div></td>
                                        <td ><div>{{ $detalle->laboratorio->nombre}}</div></td>
                                        

                                        <td>{{ $detalle->plazo_entrega }}</td>

                                    </tr>

                                    @endforeach

                                    </tbody>
                                </table>
                            </div><!-- /table-responsive -->

                            {{-- <div class="text-right">
                                <button class="btn btn-primary"><i class="fa fa-dollar"></i> Make A Payment</button>
                            </div>--}}


                </div>
                     
            </div>
        </div>
@endsection
