@extends('backend.layouts.app')

@section('title', 'Editar Cotización')

@section('content')
{{ html()->modelForm($presupuesto, 'PATCH', route('admin.presupuestos.update',$presupuesto))->class('form-horizontal')->attribute('enctype', 'multipart/form-data')->open() }}
    <div>
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Editar Cotización | Nro. :
                                <b> {{ $presupuesto->numero }}</b>
                            </h5>
                            
                        </div>
                        <div class="ibox-content">
                            <form class="form-horizontal">
                               
                                @if($logged_in_user->hasRole('administrator'))
                                    <div class="row">
                                        <div class="form-group col-md-5 ">
                                            {{ html()->label('Empresa')->for('empresa_id') }}
                                            {{ html()->select('empresa_id', $empresas,null)
                                                ->placeholder('Seleccione Empresa', false)
                                                ->class('form-control chosen-select')
                                                ->required()
                                                ->id('empresa_id') }}
                                        </div><!--form-group-->
                                    </div>
                               @endif

                              

                               <div class="row">
                                    <div class="form-group col-md-5">
                                        {{ html()->label('Fecha')->for('tiempo') }}
                                        <input type="date" class="form-control"  id="fecha" name="fecha" value={{ date('Y-m-d') }} required>
                           
                                    </div>

                                    <div class="form-group col-md-5 col-md-push-1">
                                        {{ html()->label('Fecha entrega')->for('fecha_entrega') }}
                                        <input type="date" class="form-control"  id="fecha_entrega" name="fecha_entrega" value={{ date('Y-m-d') }} required>
                                    </div><!--form-group-->


                               
                                </div>

                               <div class="row">

                                    <div class="form-group col-md-5 ">
                                        {{ html()->label('Cliente')->for('cliente_id') }}
                                        {{ html()->select('cliente_id', $clientes,null)
                                            ->placeholder('Seleccione Cliente', false)
                                            ->class('form-control chosen-select')
                                            ->required()
                                            ->id('cliente_id') }}
                                    </div><!--form-group-->


                                    <div class="form-group col-md-5 col-md-push-1">
                                        {{ html()->label('Contacto')->for('empresa_contacto_id') }}
                                        {{ html()->select('empresa_contacto_id', $contactos,null)
                                            ->placeholder('Seleccione Contacto', false)
                                            ->class('form-control chosen-select')
                                            ->required()
                                            ->id('empresa_contacto_id') }}
                                    </div><!--form-group-->
                               
                                </div>                                

                                <div class="row">
                                    <div class="form-group col-md-5">
                                        {{ html()->label('Tipo Pago')->for('tipo_pago_id') }}
                                        {{ html()->select('tipo_pago_id', $tipoPago,null)
                                            ->placeholder('Seleccione Tipo Pago', false)
                                            ->class('form-control chosen-select')
                                            ->required()
                                            ->id('tipo_pago_id') }}
                                    </div><!--form-group-->
                           
                                    
                                    <div class="form-group col-md-5 col-md-push-1">
                                        {{ html()->label('Condición Pago')->for('condicion_pago_id') }}
                                        {{ html()->select('condicion_pago_id', $condPago,null)
                                            ->placeholder('Seleccione Condición Pago', false)
                                            ->class('form-control chosen-select')
                                            ->required()
                                            ->id('condicion_pago_id') }}
                                    </div><!--form-group-->
                               
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-5">
                                        {{ html()->label('Fuente')->for('fuente_id') }}
                                        {{ html()->select('fuente_id', $fuentes,null)
                                            ->placeholder('Seleccione Fuente', false)
                                            ->class('form-control chosen-select')
                                            ->required()
                                            ->id('fuente_id') }}
                                    </div><!--form-group-->
                           
                                    <div class="form-group col-md-5 col-md-push-1">
                                        {{ html()->label('Validez en días')->for('validez') }}
                                        <input type="number" class="form-control" name="validez" min="0" step="1" value="15" required>
                                    </div>
                                    <div class="form-group col-md-5 col-md-push-1">
                                  
                                    </div>                                    
                               
                                </div>
                                <div class="row">                                
                                                            
                                    <div class="form-group col-md-5 ">
                                      {{ html()->label('Estado')->for('estado_presupuesto_id') }}
                                        {{ html()->select('estado_presupuesto_id', $estados,$presupuesto->estado_presupuesto->id)
                                            ->placeholder('Seleccione Estado', false)
                                            ->class('form-control chosen-select')
                                            ->required()
                                            ->id('estado_presupuesto_id') }}
                                  
                                    </div>
                                </div>

                                <div class="row">
                                
                                    <div class="form-group col-md-5 ">
                                        {{ html()->label('Nota Pública')->for('nota_publica') }}
                                        <input type="text" class="form-control" name="nota_publica" maxlength="100">
                                    </div>
                                <div class="form-group col-md-5 col-md-push-1">
                                    {{ html()->label('Nota Privada')->for('nota_privada') }}
                                        <input type="text" class="form-control" name="nota_privada" maxlength="100">
                                </div>

                                </div>


<!--                                <div class="row">
                                
                                    <div class="form-group col-md-5 ">
                                        {{ html()->label('Entrada Libre')->for('libre') }}
                                       <input type="checkbox" id="entrada_libre" name="entrada_libre" value="0" /> 
                                       <input type="text" id="desc_libre" name="desc_libre" class="form-control">

                                    </div>
                                    <div class="form-group col-md-5 col-md-push-1">
                                  
                                    </div>

                                </div>  -->

                                <div class="row">
                                <table id="table_productos" class="table table-striped table-bordered table-hover">
                                    <tbody>
                                        <tr>
                                            <td>
                                                {{ html()->label('Tipo Muestra')->for('muestra') }}
                                                {{ html()->select('muestras', $muestras,null)
                                                ->placeholder('Seleccione')
                                                ->class('form-control chosen-select')
                                                ->id('muestra') }}                      
                                                     
                                            </td>
                                            <td>

                                                {{ html()->label('Especie/Fuente')->for('especie') }}
                                                {{ html()->select('especies', $especies,null)
                                                ->placeholder('Seleccione')
                                                ->class('form-control chosen-select')
                                                ->id('especie') }}                                                                     
                                            </td>
                                            <td>

                                                {{ html()->label('Análisis')->for('analisis') }}
                                                {{ html()->select('analisis', $analisis,null)
                                                ->placeholder('Seleccione')
                                                ->class('form-control chosen-select')
                                                ->id('analisis') }}                                                                     
                                            </td>

                                            <td>

                                                {{ html()->label('Laboratorio')->for('laboratorio') }}
                                                {{ html()->select('laboratorios', $laboratorios,null)
                                                ->placeholder('Seleccione')
                                                ->class('form-control chosen-select')
                                                ->id('laboratorio') }}                                                                     
                                            </td>

                                        </tr>  
                                        <tr>

                                                                                                                                                                                                                        
                                            <td>
                                                {{ html()->label('Nro. Muestras')->for('cantidad') }}
                                                <input type="number" class="form-control" id="cantidad" name="cantidad" min="0" step="any">
                                                
                                            </td>
                                            <td>

                                                {{ html()->label('Valor Unitario')->for('precio_venta') }}
                                                <div class="input-group m-b"><span class="input-group-addon">$</span> 
                                                <input type="number" class="form-control" id="precio_venta" name="precio_venta" min="0" step="any" ></div>
                                                
                                                
                                            </td>
                                            <td>
                                                {{ html()->label('Valor Total')->for('total') }}
                                                <div class="input-group m-b"><span class="input-group-addon">$</span> 
                                                <input type="number" class="form-control" id="total" name="total" min="1" step="any" readonly></div>
                                                
                                            </td>
                                            <td>
                                                <a onclick="agregar_productos()" class="btn btn-primary" data-toggle="tooltip" title="Agregar producto">Agregar</a> 
                                            </td>

                                        @php $numero_productos=0; @endphp
                                        @foreach($presupuesto->detalle_presupuesto as $detalle)
                                           @php 
                                          
                                           $lineId=rand(1, 1000000);
                                           $numero_productos++; 

                                           @endphp 
                                            <input type="hidden" value="{{ $detalle->desc_libre }}" name="desc_libre_array[]">                                           

                                           <tr lineid="{{ $lineId }}">
                                           <td>
                                            {{ $detalle->tipoMuestra->nombre}}

                                            <input type="hidden" value="{{ $detalle->tipo_muestra_id }}" name="muestra_array[]">
                                           </td>

                                           <td>
                                            {{ $detalle->especieFuente->nombre}}

                                            <input type="hidden" value="{{ $detalle->especie_fuente_id }}" name="especie_array[]">
                                           </td>

                                           <td>
                                            {{ $detalle->analisis->nombre}}

                                            <input type="hidden" value="{{ $detalle->analisis_id }}" name="analisis_array[]">
                                           </td>

                                           <td>
                                            {{ $detalle->laboratorio->nombre}}

                                            <input type="hidden" value="{{ $detalle->laboratorio_id }}" name="laboratorio_array[]">
                                           </td>                                                                                                                                 

                                           <td>{{ $detalle->cantidad }}
                                           <input type="hidden"  value="{{ $detalle->cantidad }}" name="cantidad_array[]"></td>

                                           <td class="text-right">{{ $detalle->precio_venta }}</td>
                                           <input type="hidden"  value="{{ $detalle->precio_venta }}" name="precio_venta_array[]"></td>

                                           <td class="text-right"> <b>$ </b>{{ $detalle->total }}
                                           <input type="hidden" class="sum_productos" value="{{ $detalle->total }}" name="total_array[]"></td>
                                           <td> <a href="#" class="borrar_productos btn btn-success" data-toggle="tooltip" lineid="{{ $lineId }}" title="Eliminar"><i class="fa fa-minus"></i></a></td>
        
                                           </tr>
                                           



                                        @endforeach                                         <input type="hidden" name="numero_productos" value="{{ $numero_productos }}" id="numero_productos">    

                                        </tr>  
                                    </tbody>
                                </table>
                                </div>

                    <div class="row">
                        <div class="col-md-3"></div>

                        <div class="col-md-5">   
                            <table class="table table-striped table-bordered table-hover">
                                <tr>
                                    <td>
                                       {{ html()->label('Sub Total')->for('subtotal') }}
                                    </td>
                                    <td>
                                        <div class=" col-md-10 col-sm-10 col-xs-12">
                                            <div class="input-group m-b"><span class="input-group-addon">$</span> 
                                            <input class="form-control" type="number" name="sub_total" id="sub_total" value="{{number_format($presupuesto->sub_total,2,'.','')}}" readonly></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        {{ html()->label('Descuento (%)')->for('descuento') }}
                                    </td>
                                    <td>
                                        <div class=" col-md-10 col-sm-10 col-xs-12">
                                            <input type="number" class="form-control" id="porcentaje_descuento" name="porcentaje_descuento" value="{{number_format( $presupuesto->porcentaje_descuento,2,'.','') }}">
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
                                            <input type="number" class="form-control" id="iva" name="iva" readonly value="{{  number_format( $presupuesto->iva,2,'.','')}}">
                                            </div>
                                          
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        {{ html()->label('Descuento')->for('total_descuento') }}
                                    </td>
                                    <td>
                                        <div class="col-md-10 col-sm-10 col-xs-12">
                                            <div class="input-group m-b"><span class="input-group-addon">$</span> 
                                            <input type="number" class="form-control" id="descuento" name="descuento"  value="{{  number_format( $presupuesto->descuento,2,'.','') }}" readonly>
                                            </div>
                                           
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        {{ html()->label('Total')->for('total_presupuesto') }}
                                    </td>
                                    <td>
                                        <div class="col-md-10 col-sm-10 col-xs-12">
                                            <div class="input-group m-b"><span class="input-group-addon">$</span> 
                                            <input type="number" class="form-control" id="total_presupuesto" name="total_presupuesto" value="{{  number_format( $presupuesto->total,2,'.','') }}" readonly>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-3">

                            <input type="hidden" class="form-control" id="porc_iva" name="porc_iva" value="{{config('app.iva')/100}}" >
                         </div>
                    </div>
                                                            
                                                         

                                
                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-4"></div>
                        <div class="col-md-4 col-md-push-1">    
                        <a class="btn btn-white btn-sm" href="{{route('admin.presupuestos.index')}}" >@lang('buttons.general.cancel')</a>
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

    $("#cliente_id").change(function () {

        $.ajax({
            url: "{{ url('admin/getContactos') }}",
            type: 'get',
            dataType: 'json',
            data: {"cliente_proveedor_id": $("#cliente_id").val()},
            success: function (rta) {
                
                $('#coontacto_id').empty();
                $('#contacto_id').append("<option value='' disabled selected style='display:none;'>Seleccione Contacto</option>");
                $.each(rta, function (index, value) {
                    console.log('prueba');                
                    $('#contacto_id').append("<option value='" + value.id + "'>" + value.nombres + ' ' + value.apellidos + "</option>");
                });
                $('#contacto_id').trigger("chosen:updated");
            },
            error : function() 
            {
                alert('error...');
            },
        });
    });

function sinDecimal(el) {
  return document.getElementById(el);
}

sinDecimal('precio_venta').addEventListener('input',function() {
  var val = this.value;
  this.value = val.replace(/\D|\-/,'');
});
sinDecimal('total').addEventListener('input',function() {
  var val = this.value;
  this.value = val.replace(/\D|\-/,'');
});
sinDecimal('sub_total').addEventListener('input',function() {
  var val = this.value;
  this.value = val.replace(/\D|\-/,'');
});



clean();

var numero_productos=$('#numero_productos').val();

function agregar_productos(){
        var lineId = Math.floor((Math.random() * 1000000) + 1);
        lineId = lineId + "_" + Math.floor((Math.random() * 1000000) + 1);
        numero_productos++;


  
  if($('#muestra option:selected').text()!='Seleccione'  && $('#especie option:selected').text()!='Seleccione'  && $('#analisis option:selected').text()!='Seleccione'  && $('#laboratorio option:selected').text()!='Seleccione' && $('#precio_compra').val()!='0'  && $('#cantidad').val()!='0' && $('#precio_compra').val()!=''  && $('#cantidad').val()!='' ){
      
        var html="";
        html+='<tr lineid='+lineId+'>';
       
      //if($('#entrada_libre').prop('checked')){
      //  html+='<td>'+($('#desc_libre').val());
      // }else{


      // }

        html+='<td>'+($("#muestra option:selected").text());
        html+='<input type="hidden" value="'+($('#muestra option:selected').val())+'" name="muestra_array[]">';
        html+='<td>'+($("#especie option:selected").text());        
        html+='<input type="hidden" value="'+($('#especie option:selected').val())+'" name="especie_array[]">';
        html+='<td>'+($("#analisis option:selected").text());        
        html+='<input type="hidden" value="'+($('#analisis option:selected').val())+'" name="analisis_array[]">';
        html+='<td>'+($("#laboratorio option:selected").text());        
        html+='<input type="hidden" value="'+($('#laboratorio option:selected').val())+'" name="laboratorio_array[]">';                     

        html+='<input type="hidden" value="'+($('#desc_libre').val())+'" name="desc_libre_array[]">'+'</td>';

        html+='<td>'+($('#cantidad').val());
        html+='<input type="hidden"  value="'+($('#cantidad').val())+'" name="cantidad_array[]">'+'</td>';

        html+='<td class="text-right"> <b>$ </b>'+($('#precio_venta').val())+'</td>';
        html+='<input type="hidden"  value="'+($('#precio_venta').val())+'" name="precio_venta_array[]">'+'</td>';

        html+='<td class="text-right"> <b>$ </b>'+($('#total').val());
        html+='<input type="hidden" class="sum_productos" value="'+($('#total').val())+'" name="total_array[]">'+'</td>';
        html+='<td> <a href="#" class="borrar_productos btn btn-success" data-toggle="tooltip" lineid="'+lineId+'" title="Eliminar"><i class="fa fa-minus"></i></a></td>';
        
        html+='</tr>';

        $("#table_productos").append(html);
        $("#numero_productos").val(numero_productos);
        
        console.log('agregar numero_productos');        
        console.log(numero_productos);
        
        clean();
        calcular();

    }else{
       alert('Debe Ingresar Tipo de Muestra, Especie/Fuente, Tipo de Análisis y Tipo de Laboratorio, Valor Unitario y Nro de Muestras');
    }

 }

function calcular(){
    var sumaProductos=0;
    var iva=0;
    var porcIva=0;
    var totPres=0;
    var porcDesc=0;
    var descuento=0;

    $('.sum_productos').each(function (index, element) {
        sumaProductos = parseFloat(sumaProductos) + parseFloat($(element).val());
    });
    
    porcDesc=$('#porcentaje_descuento').val()/100;

    descuento=parseFloat(sumaProductos)*parseFloat(porcDesc);

    if(descuento>0){
        sumaProductos=parseFloat(sumaProductos)-parseFloat(descuento);
    }

    porcIva=$('#porc_iva').val();
    iva=parseFloat(sumaProductos)*parseFloat(porcIva);

    totPres=(parseFloat(sumaProductos)+parseFloat(iva));


    $("#sub_total").val(sumaProductos.toFixed(0));
    $("#descuento").val(descuento.toFixed(0));
    $("#iva").val(iva.toFixed(0));
    $("#total_presupuesto").val(totPres.toFixed(0));
 }

 function clean() {
    $("#muestra").val($("#muestra option:first").val());
    $("#especie").val($("#especie option:first").val());
    $("#analisis").val($("#analisis option:first").val());
    $("#laboratorio").val($("#laboratorio option:first").val());            
    $("#cantidad").val(0);
    $("#precio_venta").val(0);
    $("#total").val(0);
    $("#desc_libre").val("");
 
    $("#desc_libre").hide();
    $("#precio_venta").prop('disabled', false);

    $("#muestra").prop('disabled', false);
    $('#muestra').trigger("chosen:updated");

    $("#especie").prop('disabled', false);
    $('#especie').trigger("chosen:updated");

    $("#analisis").prop('disabled', false);
    $('#analisis').trigger("chosen:updated");

    $("#laboratorio").prop('disabled', false);
    $('#laboratorio').trigger("chosen:updated");        


    //$("#entrada_libre").prop('checked', false);
 }

  

 $("body").on('click','.borrar_productos', function (e) {


    numero_productos--;
    $("#numero_productos").val(numero_productos);
        e.preventDefault();
        var id = $(this).attr("lineid");
        var valor = $(this).parents("tr").find('.value').val();
        
       
       $("[lineid=" + id + "]").remove();

       calcular();

    });


function calcular_precio(){
    var cantidad=$('#cantidad').val();
    var precio_venta=$('#precio_venta').val();
    var total;

    total=cantidad*precio_venta;

    $('#total').val(total.toFixed(0));

}



    $( '#cantidad' ).on('keyup', function() {
         calcular_precio()
    
    });

    $( '#cantidad' ).on('change', function() {
         calcular_precio()
    
    });


     $( '#precio_venta' ).on('keyup', function() {
         calcular_precio()
    
    });

    $( '#precio_venta' ).on('change', function() {
         calcular_precio()
    
    });

    $('#porcentaje_descuento').on('change', function() {
         calcular();
    });
</script>


@endsection



