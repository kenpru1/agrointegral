@extends('backend.layouts.app')

@section('title', 'Crear Factura Recibida')

@section('content')

    {{ html()->form('POST', route('admin.facturas_recibidas.store'))->class('form-horizontal')->attribute('enctype', 'multipart/form-data')->open() }}
        <div>
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Crear Factura Recibida</h5>
                                
                </div>
                <div class="ibox-content">
                    <form class="form-horizontal">
                        <div class="row">
                            <div class="form-group col-md-5">
                                {{ html()->label('Ref.')->for('ref') }}

                                <input type="text" class="form-control" name="ref" maxlength="50" required>
                           
                            </div>

                            <div class="form-group col-md-5 col-md-push-1">
                                {{ html()->label('Ref. Vendedor')->for('ref_vendedor') }}

                                <input type="text" class="form-control" name="ref_vendedor" maxlength="50" required>
                           
                            </div><!--form-group-->
                               
                        </div>

                        <div class="row">
                            <div class="form-group col-md-5">
                                {{ html()->label('Tercero')->for('cliente_proveedor_id') }}
                                
                                {{ html()->select('cliente_proveedor_id', $tercero,null)
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
                                
                                <input type="date" class="form-control"  id="fecha_vence" name="fecha_vence" value={{ date('Y-m-d') }} required>
                            </div>

                            <div class="form-group col-md-5 col-md-push-1">
                                {{ html()->label('Fecha de Emisión')->for('fecha_emision') }}

                                <input type="date" class="form-control"  id="fecha_emision" name="fecha_emision" value={{ date('Y-m-d') }} required>
                                        
                            </div><!--form-group-->                              
                        </div>
                                                            


                        <div class="row">
                           
                            <div class="form-group col-md-5">
                                {{ html()->label('Código Postal')->for('codigo_postal') }}
                                
                                <input type="text" class="form-control" name="codigo_postal" maxlength="50">
                            </div>
                                
                            <div class="form-group col-md-5 col-md-push-1 ">
                                {{ html()->label('Comunas')->for('comuna_id') }}
                                {{ html()->select('comuna_id', $comunas,null)
                                         ->placeholder('Seleccione Comuna', false)
                                         ->class('form-control chosen-select')
                                         ->id('comuna_id') }}
                            </div>
                        </div>

                        <div class="row">
                             <div class="form-group col-md-5">
                                {{ html()->label('Neto')->for('monto_neto') }}
                                <div class="input-group m-b"><span class="input-group-addon">$</span> 
                                    <input type="number" class="form-control" value="0" id="monto_neto" name="monto_neto" step="1" min="1" required>
                                </div>

                            </div>
                            
                        </div>
                        <div class="row">
                             <div class="form-group col-md-5">
                                {{ html()->label('Iva')->for('iva') }}
                                <small>{{config('app.iva')}}%</small>
                                <div class="input-group m-b"><span class="input-group-addon">$</span> 
                                    <input type="text" class="form-control" value="0" id="iva" name="iva" step="1" min="1" readonly required>
                                </div>



                            </div>
                            <br>
                            <div class="form-group col-md-2 col-md-push-1">
                                <input type="checkbox" id="excenta" name="excenta"  value="1"/> Excenta
                            </div>



                        </div>

                        <div class="row">
                             <div class="form-group col-md-5">
                                {{ html()->label('Total')->for('total') }}
                                <div class="input-group m-b"><span class="input-group-addon">$</span> 
                                    <input type="text" class="form-control" value="0" id="total" name="total" step="1" min="1" required readonly>
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