@extends('backend.layouts.app')

@section('title', 'Factura Recibida | Mostrar' )

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="ibox-content p-xl">

                    <div class="row">
                        <div class="col-sm-6">
                            <span>De:</span>
                            <address>
                                <strong>{{ $factura_recibida->cliente_proveedor->nombre_razon }}</strong><br>
                                        {{ $factura_recibida->cliente_proveedor->direccion }}<br>
                                        {{ $factura_recibida->cliente_proveedor->provincia->nombre }}<br>
                                        {{ $factura_recibida->cliente_proveedor->comuna->nombre }}<br>
                                        {{ $factura_recibida->cliente_proveedor->codigo_postal  }}<br>
                            </address>
                        </div>

                        <div class="col-sm-6 text-right">
                            <h4>Factura Recibida Ref. </h4>
                            <h4 class="text-navy">{{ $factura_recibida->ref }}</h4>
                            <span>Para:</span>
                            <address>
                                <strong>{{ $empresa->nombre }}</strong><br>
                                        {{ $empresa->direccion }}<br>
                                        {{ $empresa->comuna }}<br>
                                        {{ $empresa->ciudad }}
                                        {{ $empresa->codigo_postal }}
                            </address>
                        </div>
                    </div>

                    <table class="table invoice-total">
                        <tbody>
                            <tr>
                                <td><strong>TOTAL :</strong></td>
                                <td>${{ number_format($factura_recibida->monto_neto,2,'.','')  }}</td>
                            </tr>
                        </tbody>
                    </table>
                    
                    <div class="row">
                           
                            <div class="col-md-5 col-md-push-8">
                             <a class="btn btn-white btn-sm" href="{{route('admin.facturas.index')}}" >@lang('buttons.general.cancel')</a>    
                                <a href="{{ route('admin.facturas_recibidas.edit', $factura_recibida) }}"  class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i> Editar </a>
                            </div>
                        </div>
                </div>
                     
            </div>
        </div>
@endsection
