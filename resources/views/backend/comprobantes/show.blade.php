@extends('backend.layouts.app')

@section('title', 'Comprobante de Pago | Mostrar' )

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
                                    <h4>Comprobante No. </h4>
                                    <h4 class="text-navy">{{ $comprobante->numero }}</h4>
                                    <span>Para:</span>
                                    <address>
                                        <strong>{{ $comprobante->trabajador->rut }}</strong><br>
                                        <strong>{{ $comprobante->trabajador->nombre }}</strong><br>
                                        {{ $comprobante->trabajador->direccion }}<br>
                                        <abbr title="Phone">Télefono: </abbr>{{ $comprobante->trabajador->telefono }}
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
                                        <th>Trabajos Realizados</th>
                                        <th>Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    
                                    @foreach($comprobante->detalle_comprobante as $detalle)
                                        <tr>
                                            <td>{{ $detalle->trabajo_realizado }}</td>
                                            <td>${{ $detalle->total }}</td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div><!-- /table-responsive -->

                            <table class="table invoice-total">
                                <tbody>
                                <tr>
                                    <td><strong>TOTAL :</strong></td>
                                    <td>${{ number_format($comprobante->total,2,'.','')  }}</td>
                                </tr>
                                </tbody>
                            </table>
                        <div class="row">
                           
                            <div class="col-md-5 col-md-push-8">
                             <a class="btn btn-white btn-sm" href="{{route('admin.comprobantes.index')}}" >@lang('buttons.general.cancel')</a>    
                                <a href="{{ route('admin.comprobantes.edit', $comprobante) }}"  class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i> Editar </a>
                                <a href="{{ route('admin.comprobantes.print', $comprobante) }}"  target="_blank" class="btn btn-sm btn-info"><i class="fa fa-print"></i> Imprimir</a>

                            </div>
                        </div>
                </div>
                     
            </div>
        </div>
@endsection
