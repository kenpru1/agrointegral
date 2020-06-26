@extends('backend.layouts.app')

@section('title', 'Orden | Mostrar' )

@section('content')
<div class="row">
             <div class="col-lg-12">
                <div class="wrapper wrapper-content animated fadeInRight">
                    <div class="ibox-content p-xl">

                       <div class="row">
                           <div class="col-sm-3">
                               @if($empresa->logo!=null)
                                   <img alt="Logo de la Empresa" src="{{ asset($empresa->logo) }}" height="50%" width="50%" />
                               @else
                                   <img alt="Empresa Sin Logo"  src="{{ asset('app/public/logos_empresas/nologo.png') }}" height="50%" width="50%" />
                               @endif
                          </div>
                      </div>


                
          <p></p>              <div class="row">
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
                                    <h4>Guía No. </h4>
                                    <h4 class="text-navy">{{ $orden->numero }}</h4>
                                    <span>Para:</span>
                                    <address>
                                        <strong>{{ $orden->cliente->rut }}</strong><br>
                                        <strong>{{ $orden->cliente->nombre_razon }}</strong><br>
                                        {{ $orden->cliente->direccion }}<br>
                                        <abbr title="Phone">Télefono: </abbr>{{ $orden->cliente->telefono }}
                                    </address>
                                    {{--<p>
                                        <span><strong>Invoice Date:</strong> Marh 18, 2014</span><br/>
                                        <span><strong>Due Date:</strong> March 24, 2014</span>
                                    </p>--}}
                                </div>
                        </div>

                            <div class="table-responsive m-t">
                                <table class="table invoice-table">
                                    <thead>
                                    <tr>
                                        <th>Productos</th>
                                        <th>Cantidad</th>
                                        <th>Precio Unitario</th>
                                        <th>Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    
                                    @foreach($orden->detalle_orden_compra as $detalle)
                                    <tr>
                                        @if($detalle->producto_id==null)
                                            
                                            <td><div><strong>{{ $detalle->desc_libre}}</strong></div></td>
                                        @else
                                        <td><div><strong>{{ $detalle->producto->nombre}}</strong></div></td>
                                            
                                        @endif
                                        
                                        

                                        <td>{{ $detalle->cantidad }}</td>
                                        <td>{{ number_format($detalle->precio_venta,2,'.','') }}</td>
                                        <td>{{ number_format($detalle->total,2,'.','') }}</td>
                                    </tr>

                                    @endforeach

                                    </tbody>
                                </table>
                            </div><!-- /table-responsive -->

                            <table class="table invoice-total">
                                <tbody>
                                <tr>
                                    <td><strong>Sub Total :</strong></td>
                                    <td>${{ number_format($orden->sub_total,2,'.','') }}</td>
                                </tr>
                                <tr>
                                    <td><strong>IVA</strong></td>
                                    <td>${{ number_format($orden->iva,2,'.','')  }}</td>
                                </tr>
                                <tr>
                                    <td><strong>TOTAL :</strong></td>
                                    <td>${{ number_format($orden->total,2,'.','')  }}</td>
                                </tr>
                                </tbody>
                            </table>
                            {{-- <div class="text-right">
                                <button class="btn btn-primary"><i class="fa fa-dollar"></i> Make A Payment</button>
                            </div>--}}

                            <div><strong>Nota Privada:</strong>
                                   {{ $orden->nota_privada }}
                            </div>
                        <div class="row">
                           
                            <div class="col-md-4 col-md-push-9">
                             <a class="btn btn-white btn-sm" href="{{route('admin.orden_compras.index')}}" >@lang('buttons.general.cancel')</a>    
                                <a href="{{ route('admin.orden_compras.edit', $orden) }}"  class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i> Editar </a>
                                <a href="{{ route('admin.orden_compras.print', $orden) }}"  target="_blank" class="btn btn-sm btn-info"><i class="fa fa-print"></i> Imprimir</a>
                            </div>
                        </div>
                </div>
                     
            </div>
        </div>
@endsection
