@extends('backend.layouts.app')

@section('title', 'Requerimientos' . ' | ' . 'Crear')

@section('content')
    {{ html()->form('POST', route('admin.requerimientos.store'))->class('form-horizontal')->attribute('enctype', 'multipart/form-data')->open() }}
        <div>
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Administración de Requerimientos
                        <small class="text-muted">Crear</small>
                    </h5>                               
                </div>
                <div class="ibox-content">
                    <form class="form-horizontal">
                        <div class="row">
                            <div class="form-group col-md-5">
                                {{ html()->label('Empresa')->for('cliente_proveedor_id') }}

                                {{ html()->select('cliente_proveedor_id', $cliProvs,null)
                                        ->placeholder('Seleccione Empresa', false)
                                        ->class('form-control chosen-select')
                                        ->required()
                                        ->id('cliente_proveedor_id') }}            
                            </div>

                            <div class="form-group col-md-5 col-md-push-1">
                                {{ html()->label('Contacto')
                                    ->for('empresa_contacto_id') }}

                                {{ html()->select('empresa_contacto_id', null,null)
                                          ->placeholder('Seleccione Contacto', false)
                                          ->class('form-control chosen-select')
                                          ->required()
                                          ->id('empresa_contacto_id') }}      
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-5">
                                {{ html()->label('Nombre Requerimiento')
                                    ->for('titulo') }}
                                      
                                {{ html()->text('titulo')
                                    ->class('form-control')
                                    ->placeholder('Nombre Requerimiento')
                                    ->attribute('maxlength', 100)
                                    ->required()
                                    ->autofocus() }}            
                            </div>

                        
                            <div class="form-group col-md-5 col-md-push-1">
                                {{ html()->label('Valor Aproximado')
                                    ->for('monto') }}
                                      
                                <input type="number" class="form-control" name="monto" value="1" min="1" required>            
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-5">
                                {{ html()->label('Fecha de muestreo')
                                    ->for('fecha_cierre') }}
                                      
                                 {{ html()->date('fecha_cierre')
                                    ->class('form-control')
                                    ->value(date('Y-m-d'))
                                    ->required()
                                    ->autofocus() }} 
                                    
                            </div>
                            <div class="form-group col-md-5 col-md-push-1">
                               {{--{{ html()->label('Número Muestra')
                                    ->for('numero_muestra') }}
                                      
                                {{ html()->text('numero_muestra')
                                    ->class('form-control')
                                    ->placeholder('Número Muestra')
                                    ->attribute('maxlength', 100)
                                    ->required()
                                    ->autofocus() }}     --}}         
                            </div>                            

                        </div>
                        {{--<div class="row">
                            <div class="form-group col-md-5">
                                {{ html()->label('Tipo Muestra')->for('tipo_muestra_id') }}

                                {{ html()->select('tipo_muestra_id', $tipoMuestras,null)
                                        ->placeholder('Seleccione ', false)
                                        ->class('form-control chosen-select')
                                        ->required()
                                        ->id('tipo_muestra_id') }}            
                            </div>

                            <div class="form-group col-md-5 col-md-push-1">
                                {{ html()->label('Análisis')
                                    ->for('analisis_id') }}

                                {{ html()->select('analisis_id', $analisis,null)
                                          ->placeholder('Seleccione ', false)
                                          ->class('form-control chosen-select')
                                          ->required()
                                          ->id('analisis_id') }}      
                            </div>
                        </div>--}}
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

                                            <td>

                                                {{ html()->label('Laboratorio')->for('laboratorio') }}
                                                {{ html()->select('laboratorios', $laboratorios,null)
                                                ->placeholder('Seleccione')
                                                ->class('form-control chosen-select')
                                                ->id('laboratorio') }}                                                                     
                                            </td>
                                            <td>
                                                {{ html()->label('Plazo de Entrega')
                                                  ->for('plazo') }}
                                      
                                                {{ html()->text('plazo')
                                                  ->class('form-control')
                                                  ->placeholder('Ṕlazo de Entrega')
                                                ->attribute('maxlength', 191)
                                                ->id('plazo')
                                                ->autofocus() }}   
                                            </td>
                                            <td>
                                                <a onclick="agregar_productos()" class="btn btn-primary" data-toggle="tooltip" title="Agregar producto">Agregar</a> 
                                            </td>                                            
                                        </tr>  

                                    </tbody>
                                </table>
                                <div class="col-md-3">
                                    <input type="hidden" name="numero_productos" id="numero_productos">

                                </div>                                                                
                                </div>                        
                        <hr>
                        <div class="row">
                            <div class="form-group col-md-12 ">
                                {{ html()->label('Etapa del Requerimiento:')->for('etapa_requerimiento_id') }}
                                <small>Registrada</small>
                                <div class="progress progress-bar-default">
                                    <div style="width: 10%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="10" role="progressbar" class="progress-bar">
                                        <span class="sr-only">10% Complete (success)</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mail-body text-right tooltip-demo">
                            <a class="btn btn-white btn-sm" href="{{route('admin.requerimientos.index')}}" >@lang('buttons.general.cancel')</a>
                            <button class="btn btn-sm btn-primary" type="submit">Guardar</button>
                        </div>  
                    </form>
                </div>
            </div>

    {{ html()->form()->close() }}
@endsection

@section('scripts')
    <script>

$(".link_cargar").click(function () {

    var id=$("#presupuesto").val();
  if(!isNaN(id) && id>0){
    location.href='/admin/ordenTrabajos/'+id+'/cargar';
  }else{
    alert("Por Favor Seleccione una Orden de Trabajo para Ejecutar esta Acción");
  }
});


var numero_productos = 0;


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
                $('#cuartel').append("<option value='' disabled selected style='display:none;'>Seleccione</option>");
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



function agregar_productos(){

        var lineId = Math.floor((Math.random() * 1000000) + 1);
        lineId = lineId + "_" + Math.floor((Math.random() * 1000000) + 1);
        numero_productos++;


  
  if($('#campo option:selected').text()!='Seleccione'  && $('#cuartel option:selected').text()!='Seleccione'  && $('#muestra option:selected').text()!='Seleccione'  && $('#especie option:selected').text()!='Seleccione'  && $('#analisis option:selected').text()!='Seleccione'  && $('#laboratorio option:selected').text()!='Seleccione' && $('#variedad').val()!=''  && $('#descripcion').val()!='' && $('#plazo').val()!='' ){
      
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
        html+='<input type="hidden" value="'+($('#laboratorio option:selected').val())+'" name="laboratorio_array[]">';                     

        html+='<input type="hidden" value="'+($('#plazo').val())+'" name="plazo_array[]">'+'</td>';                

        html+='<td> <a href="#" class="borrar_productos btn btn-success" data-toggle="tooltip" lineid="'+lineId+'" title="Eliminar"><i class="fa fa-minus"></i></a></td>';
        
        html+='</tr>';

        $("#table_productos").append(html);
        $("#numero_productos").val(numero_productos);

        clean();
        calcular();

    }else{
        alert('Debe Ingresar toda la información que se solicita para generar el Requerimiento');
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
    $("#descripcion").val('');
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








        $("#cliente_proveedor_id").change(function () {

        $.ajax({
            url: "{{ url('admin/getContactos')  }}",
            type: 'get',
            dataType: 'json',
            data: {"cliente_proveedor_id": $("#cliente_proveedor_id").val()},

            success: function (rta) {
                $('#empresa_contacto_id').empty();
                $('#empresa_contacto_id').append("<option value='' disabled selected style='display:none;'>Seleccione Contacto</option>");
                $.each(rta, function (index, value) {
                    $('#empresa_contacto_id').append("<option value='" + value.id + "'>" + value.nombres + ' ' + value.apellidos + "</option>");
                });
                $('#empresa_contacto_id').trigger("chosen:updated");
            }
        });
    });
    </script>
@endsection