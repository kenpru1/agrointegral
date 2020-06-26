@extends('backend.layouts.app')

@section('title',  'Actividad | Campos')

@section('content')
{{ html()->form('POST', route('admin.actividades_campos.store'))->class('form-horizontal')->open() }}
    <div>
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Administración de Actividades
                                <small class="text-muted">Crear</small>
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
                                        ->class('form-control')
                                        ->required()
                                        ->id('empresa_id') }}
                                </div>
                            </div>
                            @endif

                            <!-- *********CAMPOS***********-->
                                <div class="row">
                                <div class="form-group col-md-5 ">
                                    
                                    {{--{ html()->label('Campos')->for('campos') }}--}}
                                    {{ html()->select('campos', $campos,null)
                                        ->placeholder('Seleccione Campo', false)
                                        ->class('form-control chosen-select')
                                        ->id('campos') }}

                                </div>
                                <input type="hidden" id="campo_id" name="campo_id">

                                <div class="form-group col-md-5 col-md-push-1">
                                    
                                                             
                                </div>
                                </div>
                            <!-- *********CAMPOS***********-->

                            <!-- *********CUARTELES***********-->
                                <div class="row">
                                <div class="form-group col-md-5 ">
                                    <div class="input-group">
                                      {{--{{ html()->label('Tipo Actividades')->for('tipo_actividades') }}--}}
                                            {{ html()->select('cuarteles', null,null)
                                                ->placeholder('Seleccione Cuartel', false)
                                                ->class('form-control chosen-select')
                                                ->id('cuarteles') }}

                                    <span class="input-group-btn"><a onclick="agregar_cuartel()" class="btn btn-round btn-primary"  data-toggle="tooltip" title="Agregar Cuartel">Agregar</a></span> 
                                </div></div>

                                <div class="form-group col-md-5 col-md-push-1">
                                    <table id="cuarteles" class="table table-striped table-bordered table-hover">
                                        <tr>
                                            <th>Cuarteles</th>

                                        </tr>
                                    </table>
                                                             
                                </div>
                                </div>
                            <!-- *********CUARTELES***********-->



                            <!-- *********TIPO ACTIVIDADES***********-->
                                <div class="row">
                                <div class="form-group col-md-5 ">
                                    <div class="input-group">
                                      {{--{{ html()->label('Tipo Actividades')->for('tipo_actividades') }}--}}
                                            {{ html()->select('tipo_actividades', $tipoActividades,null)
                                                ->placeholder('Seleccione Tipo Actividad', false)
                                                ->class('form-control chosen-select')
                                                ->id('tipo_actividades') }}

                                    <span class="input-group-btn"><a onclick="agregar_tipo_actividad()" class="btn btn-round btn-primary"  data-toggle="tooltip" title="Agregar Trabajador">Agregar</a></span> 
                                </div></div>

                                <div class="form-group col-md-5 col-md-push-1">
                                    <table id="tipo_actividades" class="table table-striped table-bordered table-hover">
                                        <tr>
                                            <th>Tipo de Actividades</th>

                                        </tr>
                                    </table>
                                                             
                                </div>
                                </div>
                            <!-- *********TIPO ACTIVIDADES***********-->




                        <!-- *********TRABAJADORES***********-->
                               <div class="row">
                                <div class="form-group col-md-5">
                                      <div class="input-group">
                                     {{-- {{ html()->label('Trabajadores')->for('trabajador') }}--}}
                                            {{ html()->select('trabajador', $trabajadores,null)
                                                ->placeholder('Seleccione Trabajador', false)
                                                ->class('form-control chosen-select')
                                                ->id('trabajador') }}

                                    <span class="input-group-btn"><a onclick="agregar_trabajador()" class="btn btn-round btn-primary"  data-toggle="tooltip" title="Agregar Trabajador">Agregar</a> </span>
                                     </div>
                                </div>

                                <div class="form-group col-md-5 col-md-push-1">
                                    <table id="trabajadores" class="table table-striped table-bordered table-hover">
                                        <tr>
                                            <th>Trabajador</th>

                                        </tr>
                                    </table>
                                                             
                                </div><!--form-group-->
                                </div>
                        <!-- *********TRABAJADORES***********-->

                        <!-- *********MAQUINARIAS***********-->
                               <div class="row">
                                <div class="form-group col-md-5">
                                      <div class="input-group">
                                     {{-- {{ html()->label('Trabajadores')->for('trabajador') }}--}}
                                            {{ html()->select('maquinaria', $maquinarias,null)
                                                ->placeholder('Seleccione Maquinaria', false)
                                                ->class('form-control chosen-select')
                                                ->id('maquinaria') }}

                                    <span class="input-group-btn"><a onclick="agregar_maquinaria()" class="btn btn-round btn-primary"  data-toggle="tooltip" title="Agregar Maquinaria">Agregar</a> </span>
                                     </div>
                                </div>

                                <div class="form-group col-md-5 col-md-push-1">
                                    <table id="maquinarias" class="table table-striped table-bordered table-hover">
                                        <tr>
                                            <th>Maquinarias</th>

                                        </tr>
                                    </table>
                                                             
                                </div><!--form-group-->
                                </div>
                        <!-- *********MAQUINARIAS***********-->


                            <div class="row">
                                <div class="form-group col-md-5">
                                    {{ html()->label('Fecha')->for('tiempo') }}
                                     <input type="date" class="form-control"  id="fecha" name="fecha" value={{ date('Y-m-d') }} required>
                                </div>


                                <div class="form-group col-md-2 col-md-push-1">
                                      {{ html()->label('Tiempo  Horas')->for('tiempo') }}
                                     <input type="number" class="form-control col-md-3"  id="horas" name="horas" min="0" step="1">
                                     
                                </div>

                                <div class="form-group col-md-2 col-md-push-2">
                                    {{ html()->label('Tiempo  Minutos')->for('tiempo') }}
                                     <input type="number" class="form-control"  id="minutos" name="minutos" min="0" step="1">
                                </div>

                                
                            </div>

                        <div class="row">
                            <div class="form-group col-md-12">
                                {{ html()->label('Comentarios')->for('comentarios') }}
                                <textarea class="summernote" id="comentarios" name="comentarios" title="Comentarios"></textarea>
                            </div>
                        </div>

                                       

                            

                            <div class="mail-body text-right tooltip-demo">
                                                        
                                <a class="btn btn-white btn-sm" href="{{route('admin.actividades_campos.index')}}" >@lang('buttons.general.cancel')</a>
                                <button class="btn btn-sm btn-primary" type="submit">Guardar</button>
                                
                            </div>



                                
                            </form>
                        </div>
                    </div>
                </div>


{{ html()->form()->close() }}
@endsection
@section('scripts')
<script type="text/javascript">
$('#comentarios').summernote({
        height: 150,
    });

$("#campos").change(function () {

  $("#campo_id").val($('#campos option:selected').val());
  $(".borrado").remove();      
});




function agregar_cuartel(){
        var lineId = Math.floor((Math.random() * 1000000) + 1);
        lineId = lineId + "_" + Math.floor((Math.random() * 1000000) + 1);
        if($('#cuarteles option:selected').text()!='Seleccione Cuartel' ){
            var cuartelId=$('#cuarteles option:selected').val();
            var cuartelName=$('#cuarteles option:selected').text();
            var html="";
            html+='<tr lineid='+lineId+' class="borrado">';
            html+='<td>'+($("#cuarteles option:selected").text())+'</td>';
            html+='<td> <a href="#" class="borrar_cuartel btn btn-danger" data-toggle="tooltip" cuartelName="'+cuartelName+'"  cuartelId="'+cuartelId+'" lineid="'+lineId+'" title="Eliminar"><i class="fa fa-minus"></i></a><input type="hidden"  value="'+($('#cuarteles option:selected').val())+'" name="cuarteles_array[] id="cuarteles_array"></td>';

            html+='</tr>';

            $("table#cuarteles").append(html);

            $('#cuarteles option[value="'+$('#cuarteles option:selected').val()+'"]').remove();
            $('#cuarteles').trigger("chosen:updated");

           /* $('#campos').attr('disabled', 'disabled');
            $('#campos').trigger("chosen:updated");

            $('#empresa_id').attr('disabled', 'disabled');
            $('#empresa_id').trigger("chosen:updated");*/


        }
}

$("body").on('click','.borrar_cuartel', function (e) {
  
        e.preventDefault();
        var id = $(this).attr("lineid");
        var valor = $(this).parents("tr").find('.value').val();

        var cuartelId = $(this).attr("cuartelId");
        var cuartelName = $(this).attr("cuartelName");

        $("[lineid=" + id + "]").remove();

        $('#cuarteles').append('<option value="'+cuartelId+'">'+cuartelName+'</option>');
        $('#cuarteles').trigger("chosen:updated");


        /*if ( $("#cuarteles_array").length==0 ) {
            $('#campos').removeAttr('disabled');
            $('#campos').trigger("chosen:updated");

            $('#empresa_id').removeAttr('disabled');
            $('#empresa_id').trigger("chosen:updated");
        }*/
       

    });




function agregar_maquinaria(){
        var lineId = Math.floor((Math.random() * 1000000) + 1);
        lineId = lineId + "_" + Math.floor((Math.random() * 1000000) + 1);
        if($('#maquinaria option:selected').text()!='Seleccione Maquinaria' ){
            var maquinariaId=$('#maquinaria option:selected').val();
            var maquinariaName=$('#maquinaria option:selected').text();
            var html="";
            html+='<tr lineid='+lineId+' class="borrado">';
            html+='<td>'+($("#maquinaria option:selected").text())+'</td>';
            html+='<td> <a href="#" class="borrar_maquinaria btn btn-danger" data-toggle="tooltip" maquinariaName="'+maquinariaName+'"  maquinariaId="'+maquinariaId+'" lineid="'+lineId+'" title="Eliminar"><i class="fa fa-minus"></i></a><input type="hidden"  value="'+($('#maquinaria option:selected').val())+'" name="maquinarias_array[]"></td>';

            html+='</tr>';

            $("table#maquinarias").append(html);

            $('#maquinaria option[value="'+$('#maquinaria option:selected').val()+'"]').remove();
            $('#maquinaria').trigger("chosen:updated");

        }
}

$("body").on('click','.borrar_maquinaria', function (e) {
  
        e.preventDefault();
        var id = $(this).attr("lineid");
        var valor = $(this).parents("tr").find('.value').val();

        var maquinariaId = $(this).attr("maquinariaId");
        var maquinariaName = $(this).attr("maquinariaName");

        $("[lineid=" + id + "]").remove();

        $('#maquinaria').append('<option value="'+maquinariadId+'">'+maquinariaName+'</option>');
        $('#maquinaria').trigger("chosen:updated");
       

    });




function agregar_tipo_actividad(){
        var lineId = Math.floor((Math.random() * 1000000) + 1);
        lineId = lineId + "_" + Math.floor((Math.random() * 1000000) + 1);
        if($('#tipo_actividades option:selected').text()!='Seleccione Tipo Actividad' ){
            var tipoActividadId=$('#tipo_actividades option:selected').val();
            var tipoActividadName=$('#tipo_actividades option:selected').text();
            var html="";
            html+='<tr lineid='+lineId+' class="borrado">';
            html+='<td>'+($("#tipo_actividades option:selected").text())+'</td>';
            html+='<td> <a href="#" class="borrar_tipo_actividad btn btn-danger" data-toggle="tooltip" tipoActividadName="'+tipoActividadName+'"  tipoActividadId="'+tipoActividadId+'" lineid="'+lineId+'" title="Eliminar"><i class="fa fa-minus"></i></a><input type="hidden"  value="'+($('#tipo_actividades option:selected').val())+'" name="tipo_actividades_array[]"></td>';

            html+='</tr>';

            $("table#tipo_actividades").append(html);

            $('#tipo_actividades option[value="'+$('#tipo_actividades option:selected').val()+'"]').remove();
            $('#tipo_actividades').trigger("chosen:updated");

        }
}

$("body").on('click','.borrar_tipo_actividad', function (e) {
  
        e.preventDefault();
        var id = $(this).attr("lineid");
        var valor = $(this).parents("tr").find('.value').val();

        var tipoActividadId = $(this).attr("tipoActividadId");
        var tipoActividadName = $(this).attr("tipoActividadName");

        $("[lineid=" + id + "]").remove();

        $('#tipo_actividades').append('<option value="'+tipoActividadId+'">'+tipoActividadName+'</option>');
        $('#tipo_actividades').trigger("chosen:updated");
       

    });
    
function agregar_trabajador(){
        var lineId = Math.floor((Math.random() * 1000000) + 1);
        lineId = lineId + "_" + Math.floor((Math.random() * 1000000) + 1);
        if($('#trabajador option:selected').text()!='Seleccione Trabajador' ){
            var trabajadorId=$('#trabajador option:selected').val();
            var trabajadorName=$('#trabajador option:selected').text();
            var html="";
            html+='<tr lineid='+lineId+' class="borrado">';
            html+='<td>'+($("#trabajador option:selected").text())+'</td>';
            html+='<td> <a href="#" class="borrar_trabajador btn btn-danger" data-toggle="tooltip" trabajadorName="'+trabajadorName+'"  trabajadorId="'+trabajadorId+'" lineid="'+lineId+'" title="Eliminar"><i class="fa fa-minus"></i></a><input type="hidden"  value="'+($('#trabajador option:selected').val())+'" name="trabajadores_array[]"></td>';

            html+='</tr>';

            $("table#trabajadores").append(html);

            $('#trabajador option[value="'+$('#trabajador option:selected').val()+'"]').remove();
            $('#trabajador').trigger("chosen:updated");

        }
}

$("body").on('click','.borrar_trabajador', function (e) {
  
        e.preventDefault();
        var id = $(this).attr("lineid");
        var valor = $(this).parents("tr").find('.value').val();

        var trabajadorId = $(this).attr("trabajadorId");
        var trabajadorName = $(this).attr("trabajadorName");

        $("[lineid=" + id + "]").remove();

        $('#trabajador').append('<option value="'+trabajadorId+'">'+trabajadorName+'</option>');
        $('#trabajador').trigger("chosen:updated");
       

    });


$("#campos").change(function () {

        $.ajax({
            url: "{{ url('admin/actividades_campos/getCuarteles') }}",
            type: 'get',
            dataType: 'json',
            data: {"campo_id": $("#campos").val()},
            success: function (rta) {
                $('#cuarteles').empty();
                $('#cuarteles').append("<option value='' disabled selected style='display:none;'>Seleccione Cuartel</option>");
                $.each(rta, function (index, value) {
                    $('#cuarteles').append("<option value='" + value.id + "'>" + value.nombre + "</option>");
                });
                $('#cuarteles').trigger("chosen:updated");
            }
        });
    });


$("#empresa_id").change(function () {
    $(".borrado").remove();
    $('#cuarteles').empty();
    $('#cuarteles').trigger("chosen:updated");

        $.ajax({
            url: "{{ url('admin/actividades_campos/getCampos') }}",
            type: 'get',
            dataType: 'json',
            data: {"empresa_id": $("#empresa_id").val()},
        success: function (rta) {
            $('#campos').empty();
            $('#campos').append("<option value='' disabled selected style='display:none;'>Seleccione Campo</option>");
            $.each(rta, function (index, value) {
               $('#campos').append("<option value='" + value.id + "'>" + value.nombre + "</option>");
            });
            $('#campos').trigger("chosen:updated");
        }
    });
});


$("#empresa_id").change(function () {
       $.ajax({
            url: "{{ url('admin/actividades_clientes/getTipoActividades') }}",
            type: 'get',
            dataType: 'json',
            data: {"empresa_id": $("#empresa_id").val()},
        success: function (rta) {
            $('#tipo_actividades').empty();
            $('#tipo_actividades').append("<option value='' disabled selected style='display:none;'>Seleccione Tipo Actividad</option>");
            $.each(rta, function (index, value) {
               $('#tipo_actividades').append("<option value='" + value.id + "'>" + value.nombre + "</option>");
            });
            $('#tipo_actividades').trigger("chosen:updated");
        }
    });
});


$("#empresa_id").change(function () {
       $.ajax({
            url: "{{ url('admin/actividades_clientes/getTrabajadores') }}",
            type: 'get',
            dataType: 'json',
            data: {"empresa_id": $("#empresa_id").val()},
        success: function (rta) {
            $('#trabajador').empty();
            $('#trabajador').append("<option value='' disabled selected style='display:none;'>Seleccione Trabajador</option>");
            $.each(rta, function (index, value) {
               $('#trabajador').append("<option value='" + value.id + "'>" + value.nombre + "</option>");
            });
            $('#trabajador').trigger("chosen:updated");
        }
    });
});


$("#empresa_id").change(function () {
       $.ajax({
            url: "{{ url('admin/actividades_clientes/getMaquinarias') }}",
            type: 'get',
            dataType: 'json',
            data: {"empresa_id": $("#empresa_id").val()},
        success: function (rta) {
            $('#maquinaria').empty();
            $('#maquinaria').append("<option value='' disabled selected style='display:none;'>Seleccione Maquinaria</option>");
            $.each(rta, function (index, value) {
               $('#maquinaria').append("<option value='" + value.id + "'>" + value.nombre + "</option>");
            });
            $('#maquinaria').trigger("chosen:updated");
        }
    });
});



</script>
@endsection