@extends('backend.layouts.app')

@section('title', 'Editar Orden de Trabajo')

@section('content')
{{ html()->modelForm($ordenLaboratorio, 'PATCH', route('admin.ordenLaboratorios.update',$ordenLaboratorio))->class('form-horizontal')->attribute('enctype', 'multipart/form-data')->open() }}
    <div>
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Editar Orden de Laboratorio | Nro. :
                                <b> {{ $ordenLaboratorio->numero }}</b>
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
                                        {{ html()->label('Fecha Muestreo')->for('tiempo') }}
                                        <input type="date" class="form-control"  id="fecha" name="fecha" value={{ date('Y-m-d') }} required>
                           
                                    </div>

                                    <div class="form-group col-md-5 col-md-push-1">
                                        
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
                                        {{ html()->select('empresa_contacto_id',$contactos,null)
                                            ->placeholder('Seleccione Contacto', false)
                                            ->class('form-control chosen-select')
                                            ->required()
                                            ->id('empresa_contacto_id') }}
                                    </div><!--form-group-->
                               
                                </div>                                

                                <div class="row">


                                    <div class="form-group col-md-5 ">
                                        {{ html()->label('Trabajador')->for('trabajador_id') }}
                                        {{ html()->select('trabajador_id', $trabajadores,null)
                                            ->placeholder('Seleccione ', false)
                                            ->class('form-control chosen-select')
                                            ->required()
                                            ->id('trabajador_id') }}
                                    </div><!--form-group-->                                    
                                    <div class="form-group col-md-5 col-md-push-1">
                                        {{ html()->label('Laboratorio')->for('laboratorio') }}
                                                {{ html()->select('laboratorio_id', $laboratorios,null)
                                                ->placeholder('Seleccione')
                                                ->class('form-control chosen-select')
                                                ->required()
                                                ->id('laboratorio_id') }} 
                                       
                                    </div><!--form-group-->
                           
                                    <div class="form-group col-md-5 col-md-push-1">

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

                                                {{ html()->label('Especie/Fuente')->for('especie') }}
                                                {{ html()->select('especies', $especies,null)
                                                ->placeholder('Seleccione')
                                                ->class('form-control chosen-select')
                                                ->id('especie') }}                                                                     
                                            </td>
                                            <td>
                                                {{ html()->label('Variedad')
                                                  ->for('variedad') }}
                                      
                                                {{ html()->text('variedad')
                                                  ->class('form-control')
                                                  ->placeholder('Variedad')
                                                ->attribute('maxlength', 191)
                                                ->id('variedad')
                                                ->autofocus() }}   
                                            </td>
                                            <td>
                                                {{ html()->label('Predio/Parcela')->for('campo') }}
                                                {{ html()->select('campos', $campos,null)
                                                ->placeholder('Seleccione')
                                                ->class('form-control chosen-select')
                                                ->id('campo') }}                      
                                                     
                                            </td>
                                            <td>
                                                {{ html()->label('Nro. Cuartel')->for('cuartel') }}
                                                {{ html()->select('cuartel', null,null)
                                                 ->placeholder('Seleccione', false)
                                                 ->class('form-control chosen-select')
                                                 ->id('cuartel') }}
                                                     
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                {{ html()->label('Tipo Muestra')->for('muestra') }}
                                                {{ html()->select('muestas', $muestras,null)
                                                ->placeholder('Seleccione')
                                                ->class('form-control chosen-select')
                                                ->id('muestra') }}                      
                                                     
                                            </td>
                                            <td>
                                                {{ html()->label('Descripción')
                                                  ->for('descripcion') }}
                                      
                                                {{ html()->text('descripcion')
                                                  ->class('form-control')
                                                  ->placeholder('Descripción')
                                                ->attribute('maxlength', 191)
                                                ->id('descripcion')
                                                ->autofocus() }}   
                                            </td>
                                            <td>

                                                {{ html()->label('Análisis')->for('analisis') }}
                                                {{ html()->select('analisis', $analisis,null)
                                                ->placeholder('Seleccione')
                                                ->class('form-control chosen-select')
                                                ->id('analisis') }}                                                                     
                                            </td>
                                            <td></td>

                                            <td>
                                                <a onclick="agregar_productos()" class="btn btn-primary" data-toggle="tooltip" title="Agregar producto">Agregar</a> 
                                                                                                                    
                                            </td>
                                           
                                                                                       
                                        </tr>
                                       
                                        @php $numero_productos=0; @endphp
                                        @foreach($ordenLaboratorio->detalleOrdenLaboratorio as $detalle)
                                           @php 
                                          
                                           $lineId=rand(1, 1000000);
                                           $numero_productos++; 

                                           @endphp                      

                                        <tr lineid="{{ $lineId }}">

                                           <td>
                                            {{ $detalle->especieFuente->nombre}}

                                            <input type="hidden" value="{{ $detalle->especie_fuente_id }}" name="especie_array[]">
                                           </td>
                                           <td>
                                            {{ $detalle->variedad }}

                                            <input type="hidden" value="{{ $detalle->variedad }}" name="variedad_array[]">
                                           </td>         
                                           <td>
                                            {{ $detalle->campo->nombre }}

                                            <input type="hidden" value="{{ $detalle->campo_id }}" name="campo_array[]">
                                           </td>                                     
                                           <td>
                                            {{ $detalle->campo->cuarteles[0]['nombre'] }}

                                            <input type="hidden" value="{{ $detalle->campo->cuarteles[0]['id'] }}" name="cuartel_array[]">
                                           </td>           
                                           <td>
                                            {{ $detalle->tipoMuestra->nombre}}

                                            <input type="hidden" value="{{ $detalle->tipo_muestra_id }}" name="muestra_array[]">
                                           </td>

                                           <td>
                                            {{ $detalle->descripcion}}

                                            <input type="hidden" value="{{ $detalle->descripcion }}" name="descripcion_array[]">
                                           </td>

                                           <td>
                                            {{ $detalle->analisis->nombre}}

                                            <input type="hidden" value="{{ $detalle->analisis_id }}" name="analisis_array[]">
                                            
                                           </td>
                                                 
                                                                                                                       

                                           <td> <a href="#" class="borrar_productos btn btn-success" data-toggle="tooltip" lineid="{{ $lineId }}" title="Eliminar"><i class="fa fa-minus"></i></a>
                                           </td>
        
                                        </tr>
                                           



                                        @endforeach                                   
                                        <div class="col-md-3">
                                            <input type="hidden" name="numero_productos" value="{{ $numero_productos }}" id="numero_productos">

                                        </div>                                                                                                                 

                                    </tbody>
                                </table>

                 
                                </div>

                                <div class="row">
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4 col-md-push-1">    
                                    <a class="btn btn-white btn-sm" href="{{route('admin.ordenLaboratorios.index')}}" >@lang('buttons.general.cancel')</a>
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


var numero_productos=$('#numero_productos').val();

clean();

    $("#cliente_id").change(function () {

        $.ajax({
            url: "{{ url('admin/getContactos') }}",
            type: 'get',
            dataType: 'json',
            data: {"cliente_proveedor_id": $("#cliente_id").val()},
            success: function (rta) {
                
                $('#contacto_id').empty();
                $('#contacto_id').append("<option value='' disabled selected style='display:none;'>Seleccione Contacto</option>");
                $.each(rta, function (index, value) {
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

    $("#campo").change(function () {

        $.ajax({
            url: "{{ url('admin/getCuarteles') }}",
            type: 'get',
            dataType: 'json',
            data: {"campo": $("#campo").val()},
            success: function (rta) {
                
                $('#cuartel').empty();
                $('#cuartel').append("<option value='' disabled selected style='display:none;'>Seleccione Cuartel</option>");
                $.each(rta, function (index, value) {

                    $('#cuartel').append("<option value='" + value.id + "'>" + value.nombre + "</option>");
                });
                $('#cuartel').trigger("chosen:updated");
            },
            error : function() 
            {
                alert('error...');
            },
        });
    });

      $("#provincia_id").change(function () {

        $.ajax({
            url: "{{ url('admin/getComunas')  }}",
            type: 'get',
            dataType: 'json',
            data: {"provincia_id": $("#provincia_id").val()},
            success: function (rta) {
                $('#comuna_id').empty();
                $('#comuna_id').append("<option value='' disabled selected style='display:none;'>Seleccione Comuna</option>");
                $.each(rta, function (index, value) {
                    $('#comuna_id').append("<option value='" + value.id + "'>" + value.nombre + "</option>");
                });
                $('#comuna_id').trigger("chosen:updated");
            }
        });
    });



function agregar_productos(){

        var lineId = Math.floor((Math.random() * 1000000) + 1);
        lineId = lineId + "_" + Math.floor((Math.random() * 1000000) + 1);
        numero_productos++;


  
 if($('#campo option:selected').text()!='Seleccione'  && $('#cuartel option:selected').text()!='Seleccione'  && $('#muestra option:selected').text()!='Seleccione'  && $('#especie option:selected').text()!='Seleccione'  && $('#analisis option:selected').text()!='Seleccione'  && $('#laboratorio option:selected').text()!='Seleccione' && $('#variedad').val()!=''  && $('#descripcion').val()!='' && $('#provincia_id option:selected').text()!='Seleccione' && $('#comuna_id option:selected').text()!='Seleccione' ){
      
        var html="";
        html+='<tr lineid='+lineId+'>';
       
      //if($('#entrada_libre').prop('checked')){
      //  html+='<td>'+($('#desc_libre').val());
      // }else{


      // }


        html+='<td>'+($("#especie option:selected").text());        
        html+='<input type="hidden" value="'+($('#especie option:selected').val())+'" name="especie_array[]">';

        html+='<input type="hidden" value="'+($('#variedad').val())+'" name="variedad_array[]">'+'</td>';

                html+='<td>'+($("#campo option:selected").text());
        html+='<input type="hidden" value="'+($('#campo option:selected').val())+'" name="campo_array[]">';        
        html+='<td>'+($("#cuartel option:selected").text());
        html+='<input type="hidden" value="'+($('#cuartel option:selected').val())+'" name="cuartel_array[]">';

        html+='<td>'+($("#muestra option:selected").text());
        html+='<input type="hidden" value="'+($('#muestra option:selected').val())+'" name="muestra_array[]">';        
        html+='<input type="hidden" value="'+($('#descripcion').val())+'" name="descripcion_array[]">'+'</td>';

        html+='<td>'+($("#analisis option:selected").text());        
        html+='<input type="hidden" value="'+($('#analisis option:selected').val())+'" name="analisis_array[]">';
        html+='<td>'+($("#laboratorio option:selected").text());        
        html+='<input type="hidden" value="'+($('#laboratorio option:selected').val())+'" name="laboratorio_array[]">'+'</td>';
                     

        html+='<td> <a href="#" class="borrar_productos btn btn-success" data-toggle="tooltip" lineid="'+lineId+'" title="Eliminar"><i class="fa fa-minus"></i></a></td>';
        
        html+='</tr>';

        $("#table_productos").append(html);
        $("#numero_productos").val(numero_productos);

        clean();
        calcular();

    }else{
       alert('Debe Ingresar toda la información que se solicita para generar la Orden de Trabajo');
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
    
 }

 function clean() {
    $("#muestra").val($("#muestra option:first").val());
    $("#especie").val($("#especie option:first").val());
    $("#analisis").val($("#analisis option:first").val());
    $("#laboratorio").val($("#laboratorio option:first").val());            
    $("#campo").val($("#campo option:first").val());
    $("#cuartel").val($("#cuartel option:first").val());        
    $("#variedad").val('');
    $("#ecripcion").val('');
    $("#plazo").val('');


    $("#muestra").prop('disabled', false);
    $('#muestra').trigger("chosen:updated");

    $("#especie").prop('disabled', false);
    $('#especie').trigger("chosen:updated");

    $("#analisis").prop('disabled', false);
    $('#analisis').trigger("chosen:updated");

    $("#laboratorio").prop('disabled', false);
    $('#laboratorio').trigger("chosen:updated");        

    $("#campo").prop('disabled', false);
    $('#campo').trigger("chosen:updated");        

    $("#cuartel").prop('disabled', false);
    $('#cuartel').trigger("chosen:updated");                


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



</script>


@endsection

