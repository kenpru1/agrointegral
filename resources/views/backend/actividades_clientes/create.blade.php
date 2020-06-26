@extends('backend.layouts.app')

@section('title',  'Actividades | ' . __('labels.backend.access.permissions.create'))

@section('content')
{{ html()->form('POST', route('admin.actividades_clientes.store'))->class('form-horizontal')->open() }}
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


                             <!-- *********CLIENTES***********-->
                                <div class="row">
                                <div class="form-group col-md-5 ">
                                    <div class="input-group">
                                        {{ html()->select('clientes', $clientes,null)
                                                ->placeholder('Seleccione Cliente', false)
                                                ->class('form-control chosen-select')
                                                ->id('clientes') }}

                                    <span class="input-group-btn"><a onclick="agregar_cliente()" class="btn btn-round btn-primary"  data-toggle="tooltip" title="Agregar Cliente">Agregar</a></span> 
                                </div></div>

                                <div class="form-group col-md-5 col-md-push-1">
                                    <table id="clientes" class="table table-striped table-bordered table-hover">
                                        <tr>
                                            <th>Clientes</th>

                                        </tr>
                                    </table>
                                                             
                                </div>
                                </div>
                            <!-- *********CLIENTES***********-->

                          


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
                                                        
                                <a class="btn btn-white btn-sm" href="{{route('admin.actividades_clientes.index')}}" >@lang('buttons.general.cancel')</a>
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



function agregar_cliente(){
        var lineId = Math.floor((Math.random() * 1000000) + 1);
        lineId = lineId + "_" + Math.floor((Math.random() * 1000000) + 1);
        if($('#clientes option:selected').text()!='Seleccione Cliente' ){
            var clienteId=$('#clientes option:selected').val();
            var clienteName=$('#clientes option:selected').text();
            var html="";
            html+='<tr lineid='+lineId+' class="borrado">';
            html+='<td>'+($("#clientes option:selected").text())+'</td>';
            html+='<td> <a href="#" class="borrar_cliente btn btn-danger" data-toggle="tooltip" clienteName="'+clienteName+'"  clientedId="'+clienteId+'" lineid="'+lineId+'" title="Eliminar"><i class="fa fa-minus"></i></a><input type="hidden"  value="'+($('#clientes option:selected').val())+'" name="clientes_array[]"></td>';

            html+='</tr>';

            $("table#clientes").append(html);

            $('#clientes option[value="'+$('#clientes option:selected').val()+'"]').remove();
            $('#clientes').trigger("chosen:updated");

        }
}

$("body").on('click','.borrar_cliente', function (e) {
  
        e.preventDefault();
        var id = $(this).attr("lineid");
        var valor = $(this).parents("tr").find('.value').val();

        var clienteId = $(this).attr("clienteId");
        var clienteName = $(this).attr("clienteName");

        $("[lineid=" + id + "]").remove();

        $('#clientes').append('<option value="'+clienteId+'">'+clienteName+'</option>');
        $('#clientes').trigger("chosen:updated");
       

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



$("#empresa_id").change(function () {
    $(".borrado").remove();
       $.ajax({
            url: "{{ url('admin/actividades_clientes/getClientes') }}",
            type: 'get',
            dataType: 'json',
            data: {"empresa_id": $("#empresa_id").val()},
        success: function (rta) {
            $('#clientes').empty();
            $('#clientes').append("<option value='' disabled selected style='display:none;'>Seleccione Cliente</option>");
            $.each(rta, function (index, value) {
               $('#clientes').append("<option value='" + value.id + "'>" + value.nombre_razon + "</option>");
            });
            $('#clientes').trigger("chosen:updated");
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