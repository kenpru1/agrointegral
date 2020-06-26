@extends('backend.layouts.app')

@section('title', 'Facturar Presupuesto')

@section('content')
{{ html()->modelForm($presupuesto, 'POST', route('admin.facturas.storeFactura'))->class('form-horizontal')->attribute('enctype', 'multipart/form-data')->open() }}
     <div>
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Facturar Presupuesto | Nro. :
                                <b> {{ $presupuesto->numero }}</b>
                            </h5>
                            <input type="hidden" name="presupuesto_id" value="{{ $presupuesto->id }}">
                            
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
                                        {{ html()->label('Cliente')->for('cliente_id') }}
                                        {{ html()->select('cliente_id', $clientes,null)
                                            ->placeholder('Seleccione Cliente', false)
                                            ->class('form-control chosen-select')
                                            ->required()
                                            ->id('cliente_id') }}
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
                                        {{ html()->label('Fecha entrega')->for('fecha_entrega') }}
                                        <input type="date" class="form-control"  id="fecha_entrega" name="fecha_entrega" value={{ date('Y-m-d') }} required>
                                    </div><!--form-group-->
                               
                                </div>
                                                            


                                <div class="row">
                                
                                    <div class="form-group col-md-5 ">
                                        {{ html()->label('Nota Pública')->for('nota_publica') }}
                                        <input type="text" class="form-control" name="nota_publica" value="{{$presupuesto->nota_publica  }}" maxlength="100">
                                    </div>
                                <div class="form-group col-md-5 col-md-push-1">
                                    {{ html()->label('Nota Privada')->for('nota_privada') }}
                                        <input type="text" class="form-control" name="nota_privada" value="{{$presupuesto->nota_privada  }}" maxlength="100">
                                </div>

                                </div>

                                <div class="row">
                                
                                    <div class="form-group col-md-5 ">
                                        {{ html()->label('Validez en días')->for('validez') }}
                                        <input type="number" class="form-control" name="validez" min="0" step="1" value="15" required>
                                    </div>
                                    <div class="form-group col-md-5 col-md-push-1">
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
                                        {{ html()->label('Entrada Libre')->for('libre') }}
                                       <input type="checkbox" id="entrada_libre" name="entrada_libre" value="0" /> 
                                       <input type="text" id="desc_libre" name="desc_libre" class="form-control">

                                    </div>
                                    <div class="form-group col-md-5 col-md-push-1">
                                  
                                    </div>

                                </div>

                                <div class="row">
                                <table id="table_productos" class="table table-striped table-bordered table-hover">
                                    <tbody>
                                        <tr>
                                            <td>
                                                {{ html()->label('Producto')->for('productos') }}
                                                {{ html()->select('productos', $productos,null)
                                                ->placeholder('Seleccione Producto')
                                                ->class('form-control chosen-select')
                                                ->id('productos') }}
                                                     
                                            </td>
                                            <td>
                                                {{ html()->label('Cantidad')->for('cantidad') }}
                                                <input type="number" class="form-control" id="cantidad" name="cantidad" min="0" step="any">
                                                
                                            </td>
                                            <td>

                                                {{ html()->label('Precio Unitario')->for('precio_venta') }}
                                                <div class="input-group m-b"><span class="input-group-addon">$</span> 
                                                <input type="number" class="form-control" id="precio_venta" name="precio_venta" min="1" step="any"></div>
                                                
                                                
                                            </td>
                                            <td>
                                                {{ html()->label('Total')->for('total') }}
                                                <div class="input-group m-b"><span class="input-group-addon">$</span> 
                                                <input type="number" class="form-control" id="total" name="total" min="1" step="any" readonly></div>
                                                
                                            </td>
                                            <td>
                                                <a onclick="agregar_productos()" class="btn btn-primary" data-toggle="tooltip" title="Agregar producto">Agregar</a> 
                                            </td>
                                        </tr>  
                                        @php $numero_productos=0; @endphp
                                        @foreach($presupuesto->detalle_presupuesto as $detalle)
                                           @php 
                                          
                                           $lineId=rand(1, 1000000);
                                           $numero_productos++; 

                                           @endphp 

                                           <tr lineid="{{ $lineId }}">
                                           <td>
                                            @if($detalle->producto_id==null)
                                               {{ $detalle->desc_libre}}
                                            @else
                                               {{ $detalle->producto->nombre}}
                                            @endif
                                            <input type="hidden" value="{{ $detalle->desc_libre }}" name="desc_libre_array[]">
                                           <input type="hidden" value="{{ $detalle->producto_id }}" name="productos_array[]"></td>

                                           <td>{{ $detalle->cantidad }}
                                           <input type="hidden"  value="{{ $detalle->cantidad }}" name="cantidad_array[]"></td>

                                           <td class="text-right">{{ $detalle->precio_venta }}</td>
                                           <input type="hidden"  value="{{ $detalle->precio_venta }}" name="precio_venta_array[]"></td>

                                           <td class="text-right"> <b>$ </b>{{ $detalle->total }}
                                           <input type="hidden" class="sum_productos" value="{{ $detalle->total }}" name="total_array[]"></td>
                                           <td> <a href="#" class="borrar_productos btn btn-success" data-toggle="tooltip" lineid="{{ $lineId }}" title="Eliminar"><i class="fa fa-minus"></i></a></td>
        
                                           </tr>
                                           



                                        @endforeach 
                                        <input type="hidden"  value="{{ $numero_productos }}" name="numero_productos" id="numero_productos">
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
                             <button class="btn btn-sm btn-primary" type="submit">Facturar Presupuesto</button>
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
$( '#entrada_libre' ).on('change', function() {
    
    if (this.checked) {
       $('#desc_libre').show();
       $("#precio_venta").prop('disabled', false);
       $("#productos").prop('disabled', true);
    } else {
       $('#desc_libre').hide();
       $("#precio_venta").prop('disabled', true);
       $("#productos").prop('disabled', false);
    }
    $("#productos").val($("#productos option:first").val());
    $('#productos').trigger("chosen:updated");

    $("#precio_venta").val(0);
    $("#total").val(0);


});

clean();
var numero_productos=$('#numero_productos').val();


function agregar_productos(){
        var lineId = Math.floor((Math.random() * 1000000) + 1);
        lineId = lineId + "_" + Math.floor((Math.random() * 1000000) + 1);
        numero_productos++;



    if(($('#productos option:selected').text()!='Seleccione Producto' || $('#entrada_libre').prop('checked') ) && $('#precio_compra').val()!='0'  && $('#cantidad').val()!='0' && $('#precio_compra').val()!=''  && $('#cantidad').val()!='' ){
      
        var html="";
        html+='<tr lineid='+lineId+'>';
       
      if($('#entrada_libre').prop('checked')){
        html+='<td>'+($('#desc_libre').val());
       }else{
        html+='<td>'+($("#productos option:selected").text());

       }

        html+='<input type="hidden" value="'+($('#productos option:selected').val())+'" name="productos_array[]">';
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
        
        clean();
        calcular();

    }else{
       alert('Debe Ingresar Producto, Precio Compra y Cantidad');
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


    $("#sub_total").val(sumaProductos.toFixed(2));
    $("#descuento").val(descuento.toFixed(2));
    $("#iva").val(iva.toFixed(2));
    $("#total_presupuesto").val(totPres.toFixed(2));
 }

 function clean() {
    $("#productos").val($("#productos option:first").val());
    $("#cantidad").val(0);
    $("#precio_venta").val(0);
    $("#total").val(0);
    $("#desc_libre").val("");
 
    $("#desc_libre").hide();
    $("#precio_venta").prop('disabled', true);

    $("#productos").prop('disabled', false);
    $('#productos').trigger("chosen:updated");

    $("#entrada_libre").prop('checked', false);
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
    $( 'select#productos' ).on( 'change', function() {
        
        var id=$(this).val();
        $.ajax({
                'url':"{{route('admin.presupuestos.getProductos')}}",
                'type': "GET",
                'data':{producto_id:id},
                success: function (resp) {
                    var precio=parseFloat(resp['precio_venta']);
                    $('#precio_venta').val(precio.toFixed(2));
                                     
                }

            });
   });

    function calcular_precio(){
    var cantidad=$('#cantidad').val();
    var precio_venta=$('#precio_venta').val();
    var total;

    total=cantidad*precio_venta;

    $('#total').val(total.toFixed(2));

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

