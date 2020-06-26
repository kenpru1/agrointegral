@extends('backend.layouts.app')

@section('title', 'Crear Orden de Trabajo')

@section('content')
{{ html()->form('POST', route('admin.ordenTrabajos.store'))->class('form-horizontal')->attribute('enctype', 'multipart/form-data')->open() }}
    <div>
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Crear Orden de Trabajo | Nro. Provisional:
                                <b> {{ $nroProv }}</b>
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
                                    <div class="form-group col-md-3">
                                        {{ html()->label('Generar a Partir de Cotización')->for('cotizacion') }}
                                        <div class="input-group">
                                        {{ html()->select('presupuesto', $presupuestos,null)
                                            ->placeholder('Seleccione Cotización', false)
                                            ->class('form-control chosen-select')
                                            ->id('presupuesto') }}
                                            <span class="input-group-btn"><a class="btn btn-primary link_cargar" href="#"   title="Generar" type="button">
                                                Generar
                                            </a></span></div>
                                    </div>

                                    <div class="form-group col-md-5 col-md-push-1">
                                      
                                    </div><!--form-group-->


                               
                                </div>

                              

                               <div class="row">
                                    <div class="form-group col-md-5">
                                        {{ html()->label('Fecha Muestreo')->for('tiempo') }}
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
                                        {{ html()->label('Contacto')->for('contacto_id') }}
                                        {{ html()->select('contacto_id', null,null)
                                            ->placeholder('Seleccione Contacto', false)
                                            ->class('form-control chosen-select')
                                            ->required()
                                            ->id('contacto_id') }}
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
                                        {{ html()->label('Validez en días')->for('validez') }}
                                        <input type="number" class="form-control" name="validez" min="0" step="1" value="15" required>
                                    </div><!--form-group-->
                           
                                    <div class="form-group col-md-5 col-md-push-1">

                                    </div>
                                    <div class="form-group col-md-5 col-md-push-1">
                                  
                                    </div>                                    
                               
                                </div>
                                                            

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

                                <div class="row">
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4 col-md-push-1">    
                                    <a class="btn btn-white btn-sm" href="{{route('admin.ordenTrabajos.index')}}" >@lang('buttons.general.cancel')</a>
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

