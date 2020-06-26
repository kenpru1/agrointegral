@extends('backend.layouts.app')

@section('title', 'Gastos')

@section('content')
{{ html()->form('POST', route('admin.actividades_campos.guardar_gasto',$actividad))->class('form-horizontal')->open() }}
<div id="gasto">
    {{ config('porcIva') }}
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>
                Administración de Gastos
                <small class="text-muted">
                    Crear
                </small>
            </h5>
        </div>
        <div class="ibox-content">
            <form class="form-horizontal">

                <div class="row">
                    <div class="form-group col-md-5 ">
                        {{ html()->label('Facturado')->for('facturado') }}
                        {{ html()->select('facturado', $facturado,null)
                            ->placeholder('Seleccione Facturado', false)
                            ->class('form-control chosen-select')
                            ->required()
                            ->id('facturado') }}
                    </div>
                    <div class="form-group col-md-5 col-md-push-1">
                        {{ html()->label('Comprobante')->id('nro_comprobante_label')->for('nro_comprobante') }}
                        {{ html()->text('nro_comprobante')
                            ->class('form-control')
                            ->placeholder('Comprobante')
                            ->attribute('maxlength', 50)
                            ->autofocus() }}
                    <div id="div_factura">
                        {{ html()->label('Factura')->id('nro_factura_label')->for('nro_factura') }}
                        {{ html()->select('nro_factura', $facturas,null)
                            ->placeholder('Seleccione Factura', false)
                            ->class('form-control chosen-select')
                            ->required()
                            ->id('nro_factura') }}
                    </div>                   
                    </div>
                    
                </div>

                <div class="row">
                    <div class="form-group col-md-5">
                        {{ html()->label('Proveedor')->for('cliente_proveedor_id') }}
                        {{ html()->select('cliente_proveedor_id', $proveedores,null)
                            ->placeholder('Seleccione Proveedor', false)
                            ->class('form-control chosen-select')
                            ->required()
                            ->id('cliente_proveedor_id') }}
                    </div>
                    

                    <div class="form-group col-md-5 col-md-push-1">
                        {{ html()->label('Rut')->for('rut') }}
                        <input class="form-control" type="text" id="rut" name="rut" readonly >
                    </div>

                </div>

                <div class="row">
                    <div class="form-group col-md-5">
                        {{ html()->label('Fecha')->for('fecha') }}
                        <input class="form-control" type="date" name="fecha" value="{{ date('Y-m-d') }}">
                    </div>
                    <div class="form-group col-md-5 col-md-push-1">
                        {{ html()->label('Periodo')->for('periodo') }}
                        <input class="form-control" type="month" name="periodo" value="{{ date('Y-m') }}">
                    </div>
                 <input type="hidden" class="form-control" id="porc_iva" name="porc_iva" value="{{ config('app.porcIva') }}"  required readonly>
                </div>

                <div class="row">
                    <table id="table_labores" class="table table-striped table-bordered table-hover">
                        <tbody>
                            <tr>
                                <td>
                                    {{ html()->label('Labor')->for('labor') }}
                                    <input type="text" class="form-control" id="labor" name="labor" ></div>
                                </td>
                                <td>
                                    {{ html()->label('Neto')->for('neto') }}
                                    <div class="input-group m-b"><span class="input-group-addon">$</span>
                                        <input type="number" class="form-control" id="neto" name="neto" min="0" step="any">
                                    </div>
                          
                                </td>
                                <td>
                                    {{ html()->label('Iva')->for('iva') }}
                                    <div class="input-group m-b"><span class="input-group-addon">$</span> 
                                        <input type="number" class="form-control" id="iva" name="iva" min="1" step="any" required readonly>

                                    </div>
                                </td>
                                <td>
                                    {{ html()->label('Total')->for('total') }}
                                    <div class="input-group m-b"><span class="input-group-addon">$</span> 
                                        <input type="number" class="form-control" id="total_tabla" name="total_tabla" min="1" step="any" readonly>
                                    </div>
                                </td>
                                <td>
                                   {{--<a type="button" class="btn btn-round btn-info" data-toggle="modal" data-target="#modal" title="Estado">Asociar</a>
                                   <div id="div_centro_costo"> 

                                   </div>--}}
                                    <div class="row">
                                      <div class="col-sm-8">
                                        <table id="table_modal" class="table table-striped table-bordered table-hover">
                                            <tr>
                                                <td>Nombre</td>
                                                <td>Has</td>
                                                <td>Seleccionar</td>
                                            </tr>
                                            @foreach($actividad->cuarteles as $cuartel)
                                               <tr>
                                                  <td>{{ $cuartel->nombre }}</td>
                                                  <td>{{ $cuartel->tamanno }}
                                                  
                                                  <input class="cuartel_tamanno" type="hidden" name="{{ $cuartel->nombre }}" min=0 value="{{ $cuartel->tamanno }}" >
                                                  </td>
                                                  
                                                  <td><input class="cuartel_input" type="number" min=0 maxlength="7"  value=0 name="{{ $cuartel->nombre }}" step="any" cuartelId="{{ $cuartel->id }}"  ></td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                    </div>
                              
                                </td>
                                <td>
                                    <a onclick="agregar_labores()" class="btn btn-primary" data-toggle="tooltip" title="Agregar producto">Agregar</a> 
                                </td>
                            </tr>    
                        </tbody>
                    </table>
                </div>

                {{--@include('backend.actividades_campos.includes.modal')--}}



                <div class="row">

                    <div class="form-group col-md-7">
                        {{ html()->label('Descripción')->for('name') }}
                        <textarea class="summernote" id="descripcion" name="descripcion" title="Descripcion"></textarea>
                    </div>
                    <div class="form-group col-md-4 col-md-push-1">
                         <br>
                        <table class="table table-striped table-bordered table-hover">
                                <tr>
                                    <td>
                                       {{ html()->label('Neto')->for('neto') }}
                                    </td>
                                    <td>
                                        <div class=" col-md-10 col-sm-10 col-xs-12">
                                            <div class="input-group m-b"><span class="input-group-addon">$</span> 
                                            <input class="form-control" type="number" name="neto_total" id="neto_total" value="0.00" readonly></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        {{ html()->label('IVA')->for('iva') }}
                                    </td>
                                    <td>
                                        <div class="col-md-10 col-sm-10 col-xs-12">
                                            <div class="input-group m-b"><span class="input-group-addon">$</span> 
                                            <input type="number" class="form-control" id="iva_total" name="iva_total" readonly value="0.00">
                                            </div>
                                          
                                        </div>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td>
                                        {{ html()->label('Total')->for('total_labor') }}
                                    </td>
                                    <td>
                                        <div class="col-md-10 col-sm-10 col-xs-12">
                                            <div class="input-group m-b"><span class="input-group-addon">$</span> 
                                            <input type="number" class="form-control" id="total_labores" name="total_labores" value="0.00" readonly>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        
                    </div>

                </div>


                <div class="mail-body text-right tooltip-demo">
                    <a class="btn btn-white btn-sm" href="{{route('admin.actividades_campos.index')}}">
                        @lang('buttons.general.cancel')
                    </a>
                    <button class="btn btn-sm btn-primary" type="submit">
                        Guardar
                    </button>
                    
                </div>

            </form>
      
{{ html()->form()->close() }}
@endsection

@section('scripts')
<script>
var numero_labores=0;








//Elimina 1 linea de los rubros
$("body").on('click','.borrar_labores', function (e) {
    numero_labores--;
    $("#numero_labores").val(numero_labores);
        e.preventDefault();
        var id = $(this).attr("lineid");
        var valor = $(this).parents("tr").find('.value').val();
        
       
       $("[lineid=" + id + "]").remove();

       calcular();

});
//Elimina 1 linea de los rubros

function clean(){
    $("#labor").val("");
    $("#neto").val("");
    $("#iva").val("");
    $("#total_tabla").val("");
}


//Calcular total e iva del nueo item
$( '#neto' ).on('keyup', function() {
         calcular_precio()
    
});

$( '#neto' ).on('change', function() {
         calcular_precio()
    
});


//fuńción para calcular el precio final de todos los items
function calcular_precio(){
    var neto=$('#neto').val();
    var iva=parseFloat(neto) * {{ config('app.porcIva') }};
    var total;

    total=parseFloat(neto) + parseFloat(iva);

   
    $('#iva').val(iva.toFixed(2));
    $('#total_tabla').val(total.toFixed(2));

}
//Calcular total e iva del nueo item


$("body").on('click','#confirmar', function (e) {

    
 $("#table_modal").clone().appendTo("#div_centro_costo");         


});



//Agregar linea a los rubros
function agregar_labores(){
        var lineId = Math.floor((Math.random() * 1000000) + 1);
        lineId = lineId + "_" + Math.floor((Math.random() * 1000000) + 1);
        numero_labores++;

        var cuarHtml="";
        var nomb="";


//validación que no existan mas hectares de las existentes en cada cuartel
var cuartam = $(".cuartel_tamanno").toArray();
var cuarInp = $(".cuartel_input").toArray();
var error=0;
for(x in cuartam){
   if(parseFloat(cuartam[x].value) < parseFloat(cuarInp[x].value)){
      error=1;
      alert('Error se ha intentado registrar más héctareas de las que posee el cuartel  '+cuartam[x].name)
   } 


}
//validación que no existan mas hectares de las existentes en cada cuartel




if(($('#labor').val()!='0'  && $('#neto').val()!='0' && $('#iva').val()!=''  && $('#total').val()!='' && error==0)){
      

    $('.cuartel_input').each(function (index, element) {
        nomb=numero_labores +'-'+$(element).attr('cuartelId');
        cuarHtml=cuarHtml+'<strong> Cuartel:  </strong>'+ $(element).attr('name') + '-  <strong>Ha:</strong>  '+$(element).val()+'<input type="hidden" name="'+nomb+'" value="'+$(element).val() +'"><br>';
        nomb="";
    });


        var html="";
        html+='<tr lineid='+lineId+'>';
       
        html+='<td>'+($('#labor').val());
        html+='<input type="hidden" name="numero_labores" value="'+numero_labores+'"><input type="hidden"  value="'+($('#labor').val())+'" name="labor_array[]"></td>';
        html+='<td>'+($('#neto').val());
        html+='<input type="hidden" class="sum_neto"  value="'+($('#neto').val())+'" name="neto_array[]">'+'</td>';

        html+='<td class="text-right"> <b>$ </b>'+($('#iva').val());
        html+='<input type="hidden" class="sum_iva"  value="'+($('#iva').val())+'" name="iva_array[]">'+'</td>';

        html+='<td class="text-right"> <b>$ </b>'+($('#total_tabla').val());
        html+='<input type="hidden" class="sum_labores" value="'+($('#total_tabla').val())+'" name="total_tabla_array[]">'+'</td>';
         
        html+='<td>'+cuarHtml+'</td>';


        html+='<td> <a href="#" class="borrar_labores btn btn-success" data-toggle="tooltip" lineid="'+lineId+'" title="Eliminar"><i class="fa fa-minus"></i></a></td>';
        
        html+='</tr>';

        $("#table_labores").append(html);
        $("#numero_labores").val(numero_labores);
        
        clean();
        calcular();

    }else{
       alert('Debe Ingresar Labor y neto, y que no existan más hectareas registradas que el máximo de cada cuartel');
    }

 }
//Agregar linea a los rubros


//Calcular el total de los campos
 function calcular(){
    var sumaLabores=0;
    var sumaIva=0;
    var sumaNeto=0;
    
    $('.sum_labores').each(function (index, element) {
        sumaLabores = parseFloat(sumaLabores) + parseFloat($(element).val());
    });

    $('.sum_iva').each(function (index, element) {
        sumaIva = parseFloat(sumaIva) + parseFloat($(element).val());
    });

    $('.sum_neto').each(function (index, element) {
        sumaNeto = parseFloat(sumaNeto) + parseFloat($(element).val());
    });
    
        

    $("#total_labores").val(sumaLabores.toFixed(2));
    $("#iva_total").val(sumaIva.toFixed(2));
    $("#neto_total").val(sumaNeto.toFixed(2));
    
 }
 //Calcular el total de los campos

$('#nro_comprobante_label').hide();
$('#nro_comprobante').hide();
//$('#nro_factura_label').hide();


$('#div_factura').hide();



//Ocultar factura o comprobante 
$('#facturado').change(function(){
   
   var facturado=$('#facturado').val();
   

   if(facturado==1){
       $('#nro_comprobante_label').hide();
       $('#nro_comprobante').removeAttr("required");
       $('#nro_comprobante').hide();


       $('#nro_factura_label').show();
       $('#nro_factura').prop("required", true);
       $('#div_factura').show();

    }

    if(facturado==0){
       $('#nro_comprobante_label').show();
       $('#nro_comprobante').prop("required", true);
       $('#nro_comprobante').show();


       $('#nro_factura_label').hide();
       $('#nro_factura').removeAttr("required");
       $('#div_factura').hide();

    }
$('#nro_factura').trigger("chosen:updated");

});

    $('#descripcion').summernote({
        height: 150,
    });


//obtener rut del proveedor
    $("#cliente_proveedor_id").change(function () {
        $.ajax({
            url: "{{ url('admin/actividades_campos/getRut')  }}",
            type: 'get',
            dataType: 'json',
            data: {"cliente_proveedor_id": $("#cliente_proveedor_id").val()},
            success: function (rta) {
                $('#rut').val(rta.rut);
                
            }
        });
    });



</script>
@endsection
