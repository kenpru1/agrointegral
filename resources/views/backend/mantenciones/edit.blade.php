@extends('backend.layouts.app')

@section('title',  'Mantenciones | Editar' )

@section('content')
{{ html()->modelForm($mantencion, 'PATCH', route('admin.mantenciones.update',$mantencion))->class('form-horizontal')->open() }}
<div class="col-lg-12">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>
                Administrador de Mantenciones
                <small class="text-muted">
                    {{$mantencion->maquinaria->nombre}}
                </small>
            </h5>
        </div>
        <div class="ibox-content">
            <form class="form-horizontal">

                <div class="row">
                    <div class="form-group col-md-5">
                        {{ html()->label('Facturado')->for('facturado') }}
                        {{ html()->select('facturado', $facturado, $mantencion->factura_recibida_id!=null ? 1 : 2)
                            ->placeholder('Seleccione Facturado', false)
                            ->class('form-control chosen-select')
                            ->required()
                            ->id('facturado') }}
                    </div>
                    <div id="div_factura">
                    <div class="form-group col-md-5 col-md-push-1">
                        
                        {{ html()->label('Factura')->id('nro_factura_label')->for('nro_factura') }}
                        {{ html()->select('factura_recibida_id', $facturas, $mantencion->factura_recibida_id!=null ? $mantencion->factura_recibida_id : 0)
                            ->placeholder('Seleccione Factura', false)
                            ->class('form-control chosen-select')
                            ->required()
                            ->id('factura_recibida_id') }}
                        
                    </div>
                  
                    </div>
                    <!--form-group-->
                </div>





                <div class="row">
                    <div class="form-group col-md-5">
                        {{ html()->label('Descripción')
                                ->for('descripcion') }}
                                    {{ html()->text('descripcion')
                                        ->class('form-control')
                                        ->placeholder('Descripción')
                                        ->attribute('maxlength', 200)
                                        ->required()
                                        ->autofocus() }}
                    </div>
                    <div class="form-group col-md-5 col-md-push-1">
                        {{ html()->label('Neto')->for('costo') }}
                        <input class="form-control" id="costo" min="0" name="costo" readonly="" required="" step="1" type="number" value="{{ $mantencion->costo }}">
                        </input>
                    </div>
                    <!--form-group-->
                </div>
                <div class="row">
                    <div class="form-group col-md-5">
                        {{ html()->label('Fecha')->for('fecha') }}
                        <input class="form-control" name="fecha" type="date" value="{{isset($mantencion->fecha)?$mantencion->fecha->format('Y-m-d'):null}}">
                        </input>
                    </div>
                    <div class="form-group col-md-5 col-md-push-1">
                        {{ html()->label('IVA')->for('iva') }}
                        <input class="form-control" id="iva" min="0" name="iva" readonly="" required="" step="1" type="number" value="{{ $mantencion->iva }}">
                        </input>
                    </div>
                    <!--form-group-->
                </div>
                <div class="row">
                    <div class="form-group col-md-5 ">
                        {{ html()->label('Empresa de Servicio')->for('empresa_id') }}
                        <div id="div_empresa">
                        {{ html()->select('empresa_id', $clienProv, $mantencion->cliente_proveedor_id)
                            ->placeholder('Seleccione Proveedor', false)
                            ->class('form-control chosen-select')
                            ->required()
                            ->id('empresa_id') }}
                        </div>

                            <input class="form-control" id="nombre_razon"  name="nombre_razon" readonly type="text" value="{{$mantencion->cliente_proveedor_id!=null? $mantencion->cliente_proveedor->nombre_razon:'' }}">
                            <input type="hidden" class="form-control" id="cliente_proveedor_id"  name="cliente_proveedor_id" readonly  value="{{ $mantencion->cliente_proveedor_id }}">
                    </div>
                    <!--form-group-->
                    <div class="form-group col-md-5 col-md-push-1">
                        {{ html()->label('Total')->for('total_iva') }}
                        <input class="form-control" id="total_iva" min="0" name="total_iva" required="" step="1" type="number" value="{{ $mantencion->total_iva }}"  {{ $mantencion->factura_recibida_id!=null ? 'readonly' : '' }}>
                        </input>
                    </div>
                    <!--form-group-->
                </div>
                <div class="row">
                    <div class="form-group col-md-12">
                        {{ html()->label('Observaciones')
                                ->for('observaciones') }}
                        <textarea class="summernote" id="observaciones" name="observaciones" title="Observaciones">
                            {{ $mantencion->observaciones }}
                        </textarea>
                    </div>
                </div>
                <div class="mail-body text-right tooltip-demo">
                    <a class="btn btn-white btn-sm" href="{{route('admin.mantenciones.index',$mantencion->maquinaria->id)}}">
                        @lang('buttons.general.cancel')</a>
                    <button class="btn btn-sm btn-primary" type="submit">
                        Guardar
                    </button>
                </div>
                
            </form>
        </div>
    </div>
</div>
{{ html()->form()->close() }}
@endsection
@section('scripts')
<script>

//asignar al campo text el valor del select de los proveedores
 $("#empresa_id").change(function () {
    $("#cliente_proveedor_id").val($("#empresa_id").val());
 });


    //obtener rut y datos d del proveedor
    $("#factura_recibida_id").change(function () {
      
        $.ajax({
            url: "{{ url('admin/mantenciones/getFacturaDetalles')  }}",
            type: 'get',
            dataType: 'json',
            data: {"factura_recibida_id": $("#factura_recibida_id").val()},
            success: function (rta) {

         
                $('#costo').val(rta.monto_neto);
                $('#iva').val(rta.iva);
                $('#total_iva').val(rta.total);
                $('#cliente_proveedor_id').val(rta.cliente_proveedor_id);
                $('#nombre_razon').val(rta.nombre_razon);
               
                $('#empresa_id').trigger("chosen:updated");
            }
        });
    });

/*Mostrar Ocultar Facturas en la carga inicial*/
@if($mantencion->factura_recibida_id==null)
    $('#div_factura').hide();
    $('#nombre_razon').hide();
    $('#factura_recibida_id').val(null);
    $('#factura_recibida_id').removeAttr("required");
@endif

//deshabilita empresa si exite factura
@if($mantencion->factura_recibida_id!=null)
    $('#empresa_id').prop("disabled",true);
    $('#div_empresa').hide();
    $('#empresa_id').trigger("chosen:updated");
@endif


//cambios al seleccionar si es facturada o no
$('#facturado').change(function(){
   
   var facturado=$('#facturado').val();
   
//con factura
   if(facturado==1){
    $('#factura_recibida_id').prop("required", true);
    $('#empresa_id').prop("required", true);

    $('#empresa_id').prop("disabled", true);
    $('#div_empresa').hide();
    $('#nombre_razon').show();
       

    $('#total_iva').prop("readonly",true);
    $('#div_factura').show();

    }
//sin factura
    if(facturado==2){
       $('#factura_recibida_id').val("0");
       $('#factura_recibida_id').removeAttr("required");
       $('#div_factura').hide();

       $('#empresa_id').removeAttr("disabled");
       $('#div_empresa').show();
       $('#nombre_razon').hide();
       $('#cliente_proveedor_id').val(null);
       $('#empresa_id').trigger("chosen:updated");
       
       
       $('#total_iva').removeAttr("readonly");


       $('#costo').val(0);
       $('#iva').val(0);
       $('#total_iva').val(0);
       $('#empresa_id').val(0);
               
                
       

    }


$('#empresa_id').trigger("chosen:updated");
$('#factura_recibida_id').trigger("chosen:updated");

});
/*Mostrar Ocultar Facturas*/




    $('#observaciones').summernote({
        height: 150,
    });


   $( '#total_iva' ).on( 'change', function() {

        var total_iva=$('#total_iva').val();
        var neto=total_iva;
        var iva=0;
        //var neto=total_iva / (({{config('app.iva')}} / 100)+1);
        //var iva=parseFloat(total_iva)-parseFloat(neto);
        $('#iva').val(iva.toFixed(0));
        $('#costo').val(neto);
   
   });

   $( '#total_iva' ).on( 'keyup', function() {
        
        var total_iva=$('#total_iva').val();
        var neto=$('#total_iva').val();
        var iva=0;
        //var total_iva=$('#total_iva').val();
        //var neto=total_iva/(({{config('app.iva')}}/100)+1);
        //var iva=parseFloat(total_iva)-parseFloat(neto);
        $('#iva').val(iva.toFixed(0));
        $('#costo').val(neto);
   });
</script>
@endsection
