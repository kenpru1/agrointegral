@extends('backend.layouts.app')

@section('title', 'Editar Factura Recibida')

@section('content')

    {{ html()->modelForm($factura_recibida, 'PATCH', route('admin.facturas_recibidas.update', $factura_recibida->id))->class('form-horizontal')->attribute('enctype', 'multipart/form-data')->open() }}
        <div>
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Editar Factura Recibida</h5>
                                
                </div>
                <div class="ibox-content">
                    <form class="form-horizontal">
                        <div class="row">
                            <div class="form-group col-md-5">
                                {{ html()->label('Ref.')->for('ref') }}

                                <input type="text" class="form-control" name="ref" value="{{$factura_recibida->ref}}" maxlength="50" required>
                           
                            </div>

                            <div class="form-group col-md-5 col-md-push-1">
                                {{ html()->label('Ref. Vendedor')->for('ref_vendedor') }}

                                <input type="text" class="form-control" name="ref_vendedor" value="{{$factura_recibida->ref_vendedor}}" maxlength="50" required>
                           
                            </div><!--form-group-->
                               
                        </div>

                        <div class="row">
                            <div class="form-group col-md-5">
                                {{ html()->label('Tercero')->for('cliente_proveedor_id') }}
                                
                                {{ html()->select('cliente_proveedor_id', $tercero,$factura_recibida->cliente_proveedor_id)
                                        ->placeholder('Seleccione Tercero', false)
                                        ->class('form-control chosen-select')
                                        ->required()
                                        ->id('cliente_proveedor_id') }}
                            </div><!--form-group-->

                            <div class="form-group col-md-5 col-md-push-1">
                                {{ html()->label('Tipo Pago')->for('tipo_pago_id') }}
                                
                                {{ html()->select('tipo_pago_id', $tipoPago,null)
                                        ->placeholder('Seleccione Tipo Pago', false)
                                        ->class('form-control chosen-select')
                                        ->required()
                                        ->id('tipo_pago_id') }}
                            </div><!--form-group-->
                               
                        </div>

                        <div class="row">
                            <div class="form-group col-md-5">
                                {{ html()->label('Fecha de Vencimiento')->for('fecha_vence') }}
                                
                                <input type="date" class="form-control"  id="fecha_vence" name="fecha_vence" value={{$factura_recibida->fecha_vence}} required>
                            </div>
                            

                            <div class="form-group col-md-5 col-md-push-1">
                                {{ html()->label('Fecha de Emisión')->for('fecha_emision') }}

                                <input type="date" class="form-control"  id="fecha_emision" name="fecha_emision" value={{$factura_recibida->fecha_emision}} required>
                                        
                            </div><!--form-group-->                              
                        </div>
                                                            


                        <div class="row">
                            <div class="form-group col-md-5">
                                {{ html()->label('Código Postal')->for('codigo_postal') }}
                                
                                <input type="text" class="form-control" name="codigo_postal" value="{{$factura_recibida->codigo_postal}}" maxlength="50">
                            </div>
                            
                                
                            <div class="form-group col-md-5 col-md-push-1 ">
                                {{ html()->label('Comunas')->for('comuna_id') }}
                                {{ html()->select('comuna_id', $comunas,isset($factura_recibida->comuna_id)?$factura_recibida->comuna_id:null)
                                         ->placeholder('Seleccione Comuna', false)
                                         ->class('form-control chosen-select')
                                         ->id('comuna_id') }}
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-5">
                                {{ html()->label('Neto')->for('monto_neto') }}
                                
                                <div class="input-group m-b"><span class="input-group-addon">$</span> 
                                    <input type="number" class="form-control" id="monto_neto" name="monto_neto" value="{{$factura_recibida->monto_neto}}" min="1" required>
                                </div>

                        </div>

                            

                            <div class="form-group col-md-5 col-md-push-1">
                                {{ html()->label('Estado')->for('estado_factura_id') }}
                                
                                {{ html()->select('estado_factura_id', $estados, $factura_recibida->estado_factura->id)
                                        ->placeholder('Seleccione Estado', false)
                                        ->class('form-control chosen-select')
                                        ->required()
                                        ->id('estado_factura_id') }}
                                  
                            </div>
                        </div>
                        <div class="row">
                             <div class="form-group col-md-5">
                                {{ html()->label('Iva')->for('iva') }}
                                <small>{{config('app.iva')}}%</small>
                                <div class="input-group m-b"><span class="input-group-addon">$</span> 
                                    <input type="text" class="form-control" value="{{$factura_recibida->iva}}" id="iva" name="iva" step="1" min="1" readonly required>
                                </div>

                            </div>
                            <br>
                            <div class="form-group col-md-2 col-md-push-1">
                                <input type="checkbox" id="excenta" name="excenta"  value="1" {{isset($factura_recibida->excenta) && $factura_recibida->excenta==1?'checked':''}}/> Excenta
                            </div>
                            
                        </div>

                        <div class="row">
                             <div class="form-group col-md-5">
                                {{ html()->label('Total')->for('total') }}
                                <div class="input-group m-b"><span class="input-group-addon">$</span> 
                                    <input type="text" class="form-control" value="{{$factura_recibida->total}}" id="total" name="total" step="1" min="1" required readonly>
                                </div>

                            </div>
                            
                        </div>
                         <input type="hidden" class="form-control" id="porc_iva" name="porc_iva" value="{{config('app.iva')/100}}" > 
                        <div class="row">
                            <div class="col-md-4"></div>
                            <div class="col-md-4"></div>
                            <div class="col-md-4 col-md-push-1">    
                                <a class="btn btn-white btn-sm" href="{{route('admin.facturas.index')}}" >@lang('buttons.general.cancel')</a>
                                <button class="btn btn-sm btn-primary" type="submit">Guardar</button>
                            </div>
                        </div>
                                        
                    </form>
                </div>
            </div>
        </div>

    {{ html()->form()->close() }}

@endsection
@section('scripts')
<script>

    $( '#excenta' ).on('change', function() {
        calcular_precio()
    
    });
    
    $( '#monto_neto' ).on('change', function() {
         calcular_precio()
    
    });

    $( '#monto_neto' ).on('keyup', function() {
         calcular_precio()
    
    });

    function calcular_precio(){
    var porcIva=$('#porc_iva').val();
    var montoNeto=$('#monto_neto').val();
    var iva;
    var total;

    iva=parseFloat(montoNeto) * parseFloat(porcIva);

    if( $('#excenta').prop('checked') ) {
        iva=0;
    }

    total=parseFloat(iva) + parseFloat(montoNeto);

    $('#iva').val(iva.toFixed(0));

    $('#total').val(total.toFixed(0));

}

</script>

@endsection