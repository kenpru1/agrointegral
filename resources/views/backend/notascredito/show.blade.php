@extends('backend.layouts.app')

@section('title', 'Nota de Crédito | Mostrar' )

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
                                    <h4>Nota de Crédito No. </h4>
                                    <h4 class="text-navy">{{ $nota->numero }}</h4>
                                    <span>Para:</span>
                                    <address>
                                        
                                       

                                            {{--@if(isset($factura->cliente->rut ))--}}
                                            <strong>{{ $nota->factura->cliente->rut }}</strong><br>
                                            <strong>{{ $nota->factura->cliente->nombre_razon}}</strong><br>
                                            {{ $nota->factura->cliente->direccion }}<br>
                                            <abbr title="Phone">Télefono: </abbr>{{ $nota->factura->cliente->telefono }}
                                            {{--@else
                                            <strong>{{ App\Models\ClienteProveedor::withTrashed()->find($factura->cliente_id)->rut}}</strong><br>
                                                <strong>{{ App\Models\ClienteProveedor::withTrashed()->find($factura->cliente_id)->nombre_razon}}</strong><br>
                                                {{ App\Models\ClienteProveedor::withTrashed()->find($factura->cliente_id)->direccion}}<br>
                                                {{ App\Models\ClienteProveedor::withTrashed()->find($factura->cliente_id)->telefono}}<br>
                                            @endif--}}


                                        
                                        
                                        
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
                                    
                                    @foreach($nota->factura->detalle_factura as $detalle)
                                    <tr>
                                        @if($detalle->producto_id==null)
                                            
                                            <td><div><strong>{{ $detalle->desc_libre}}</strong></div></td>
                                        @else
                                        <td><div><strong>
                                            @if(isset($detalle->producto->nombre))
                                                {{ $detalle->producto->nombre}}
                                            @else
                                                {{ App\Models\Producto::withTrashed()->find($detalle->producto_id)->nombre}}
                                            @endif

                                            </strong></div></td>
                                            
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
                                    <td>${{ number_format($nota->factura->sub_total,2,'.','') }}</td>
                                </tr>
                                <tr>
                                    <td><strong>IVA</strong></td>
                                    <td>${{ number_format($nota->factura->iva,2,'.','')  }}</td>
                                </tr>
                                <tr>
                                    <td><strong>TOTAL :</strong></td>
                                    <td>${{ number_format($nota->factura->total,2,'.','')  }}</td>
                                </tr>
                                </tbody>
                            </table>
                            {{-- <div class="text-right">
                                <button class="btn btn-primary"><i class="fa fa-dollar"></i> Make A Payment</button>
                            </div>--}}

                            <div><strong>Nota Privada:</strong>
                                   {{ $nota->factura->nota_privada }}
                            </div>
                        <div class="row">
                           
                            <div class="col-md-5 col-md-push-8">
                             <a class="btn btn-white btn-sm" href="{{route('admin.notascredito.index')}}" >@lang('buttons.general.cancel')</a>
                                <a href="{{ route('admin.notascredito.print', $nota) }}"  target="_blank" class="btn btn-sm btn-info"><i class="fa fa-print"></i> Imprimir</a>

                            </div>
                        </div>
                </div>
                     
            </div>
        </div>
@endsection
