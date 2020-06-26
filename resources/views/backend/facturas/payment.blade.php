@extends('backend.layouts.app')

@section('title', 'Factura | Pagar' )

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
                            <h4>Factura No. </h4>
                            <h4 class="text-navy">{{ $factura->numero }}</h4>
                            <span>Para:</span>
                            <address>
                                <strong>{{ $factura->cliente->rut }}</strong><br>
                                <strong>{{ $factura->cliente->nombre_razon }}</strong><br>
                                        {{ $factura->cliente->direccion }}<br>
                                <abbr title="Phone">Télefono: </abbr>{{ $factura->cliente->telefono }}
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
                                @foreach($factura->detalle_factura as $detalle)
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
                                <td>${{ number_format($factura->sub_total,2,'.','') }}</td>
                            </tr>
                            <tr>
                                <td><strong>IVA</strong></td>
                                <td>${{ number_format($factura->iva,2,'.','')  }}</td>
                            </tr>
                            <tr>
                                <td><strong>TOTAL :</strong></td>
                                <td>${{ number_format($factura->total,2,'.','')  }}</td>
                            </tr>
                        </tbody>
                    </table>
                            {{-- <div class="text-right">
                                <button class="btn btn-primary"><i class="fa fa-dollar"></i> Make A Payment</button>
                            </div>--}}

                    <div><strong>Nota Privada:</strong>
                            {{ $factura->nota_privada }}
                    </div>
                    
                    @if(count($pagosPrevs) > 0)
                        <br>
                        <hr>
                        <div class="row">
                            <div class="col-lg-6 col-md-push-3">
                                <center><h3>Historial de abonos a factura</h3></center>
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Fecha de pago</th>
                                            <th>Abonos</th>
                                            <th>Por Pagar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($pagosPrevs as $key => $pago)
                                            <tr>
                                                <td>{{ count($pagosPrevs) - $key }}</td>
                                                <td>{{ $pago->fecha }}</td>
                                                <td>${{ number_format($pago->abono, 2, '.','') }}</td>
                                                <td>${{ number_format($pago->deuda, 2, '.', '') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif

                    {{ html()->form('POST', route('admin.facturas.paystore'))->class('form-horizontal')->attribute('enctype', 'multipart/form-data')->open() }}
                        
                        <div id="pagos">
                            <div class="ibox-content">
                                <form class="form-horizontal">
                                    <div class="row">
                                        <div class="form-group col-md-5 col-md-push-3">
                                            {{ html()->label('Tipo de Pago')->for('tipo_pago_id') }}
                                            <chosen-select v-model="tipo_pagos" name="tipo_pago_id"  required>
                                                <option value="0" >Seleccione Operación</option>
                                                @foreach($tipoPagos as $key => $value)
                                                   <option value="{{ $key }}">{{ $value }}</option>
                                                @endforeach
                                            </chosen-select>
                                        </div><!--form-group-->
                                    </div>
                                    <div v-if="tipo_pagos!=0">
                                        <input type="hidden" name="factura_id" value="{{$factura->id}}">
                                        <input type="hidden" name="monto_total" value="{{$factura->total}}">
                                        <div class="row" v-if="tipo_pagos!=1">
                                            <div class="form-group col-md-5">
                                                {{ html()->label('Número')->for('numero') }}
                                                <input type="number" class="form-control" min="1" step="any" name="numero" required>
                                            </div>
                                            <div class="form-group col-md-5 col-md-push-1">
                                                {{ html()->label('Transmisor')->for('transmisor') }}
                                                <input type="text" class="form-control" placeholder="nombre y apellido" name="transmisor" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-5">
                                                {{ html()->label('¿Cómo desea pagar?')->for('pagar') }}
                                                <div><label><input type="radio" checked="" value="0" id="optionsRadios1" name="picked" v-model="picked">Monto Total.</label></div>
                                                <div><label><input type="radio" value="1" id="optionsRadios2" name="picked" v-model="picked">Abono de factura.</label></div>  
                                            </div>
                                            <div class="form-group col-md-5 col-md-push-1" v-if="picked==0">
                                                {{ html()->label('Pago')->for('pago') }}
                                                
                                                @if(isset($deudaRec))
                                                    <p>${{ number_format($deudaRec->deuda, 2, '.', '') }}</p>
                                                    <input type="hidden" name="deudaRec" value="{{$deudaRec->deuda}}">
                                                @else
                                                    <p>${{ number_format($factura->total,2,'.','') }}</p>
                                                    <input type="hidden" class="form-control" min="1.00" name="pago" value="{{$factura->total}}" required>
                                                @endif
                                            </div>
                                            <div class="form-group col-md-5 col-md-push-1" v-if="picked==1">
                                                {{ html()->label('Abono')->for('abono') }}
                                                <input type="text" class="form-control" min="1.00" name="abono" value="0.00" required>
                                                @if(isset($deudaRec))
                                                    <input type="hidden" name="deudaRec" value="{{$deudaRec->deuda}}">
                                                @endif    
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-5">
                                                {{ html()->label('Fecha')->for('fecha') }}
                                                <input type="date" class="form-control"  id="fecha" name="fecha" value="{{date('Y-m-d')}}" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-lg-12">
                                                {{ html()->label('Comentarios')->for('comentarios') }}
                                                <textarea class="summernote" id="descripcion_tab" name="descripcion_tab" title="Descripcion"></textarea>
                                            </div>
                                        </div>
                                    </div> 
                                </form>
                            </div>

                        {{ html()->form()->close() }}

                        <div class="row" v-if="tipo_pagos!=0">
                           
                            <div class="col-md-5 col-md-push-8">
                                <a class="btn btn-white btn-sm" href="{{route('admin.facturas.index')}}" >@lang('buttons.general.cancel')</a>    
                                <button class="btn btn-sm btn-primary" type="submit">Guardar</button>
                            </div>
                        </div>

                    </div>
                </div>
                     
            </div>
        </div>
@endsection

@section('scripts')

    <script>
        //var markupStr = $('#comentarios').summernote('code', 'comentarios');

        $('.summernote').summernote({
            height: 150,
        });

        Vue.component("chosen-select",{
          template:'<select class="form-control"><slot></slot></select>',
          mounted(){
            $(this.$el)
              .chosen()
              .on("change", () => this.$emit('input', $(this.$el).val()))
          }
        });


        var pago = new Vue({
            el:"#pagos",
            data: {
                tipo_pagos: "0",
                picked: "0",
            }
        });

    </script>

@endsection