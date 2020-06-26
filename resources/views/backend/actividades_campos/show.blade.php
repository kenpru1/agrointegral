@extends('backend.layouts.app')

@section('title', app_name() . ' | Actividades Campos')

@section('content')

{{ html()->modelForm($actividad, 'PATCH', route('admin.actividades_campos.update',$actividad))->class('form-horizontal')->open() }}
    
      <div class="ibox float-e-margins">


        <div class="wrapper wrapper-content  animated fadeInRight">
            <div class="row">
                <div class="col-sm-12">
                    <div class="ibox">
                        <div class="ibox-content">
                            
                            
                            
                                <ul class="nav nav-tabs">
                                    <li class="active"><a data-toggle="tab" href="#tab-1"> Actividad</a></li>
                                    <li class=""><a data-toggle="tab" href="#tab-2"> Gastos</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div id="tab-1" class="tab-pane active">
                                        <div class="full-height-scroll">
                                            @include('backend.actividades_campos.includes.tabs.show')
                                        </div>
                                    </div>
                                    <div id="tab-2" class="tab-pane">
                                        <div class="full-height-scroll">
                                            @include('backend.actividades_campos.includes.tabs.gastos')
                                        </div>
                                    </div>
                                </div>
                            
                        </div>
                    </div>
                </div>
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






function agregar_cuartel(){
        var lineId = Math.floor((Math.random() * 1000000) + 1);
        lineId = lineId + "_" + Math.floor((Math.random() * 1000000) + 1);
        if($('#cuarteles option:selected').text()!='Seleccione Cuartel' ){
            var cuartelId=$('#cuarteles option:selected').val();
            var cuartelName=$('#cuarteles option:selected').text();
            var html="";
            html+='<tr lineid='+lineId+'>';
            html+='<td>'+($("#cuarteles option:selected").text())+'</td>';
            html+='<td> <a href="#" class="borrar_cuartel btn btn-danger" data-toggle="tooltip" cuartelName="'+cuartelName+'"  cuartelId="'+cuartelId+'" lineid="'+lineId+'" title="Eliminar"><i class="fa fa-minus"></i></a><input type="hidden"  value="'+($('#cuarteles option:selected').val())+'" name="cuarteles_array[] id="cuarteles_array"></td>';

            html+='</tr>';

            $("table#cuarteles").append(html);

            $('#cuarteles option[value="'+$('#cuarteles option:selected').val()+'"]').remove();
            $('#cuarteles').trigger("chosen:updated");

            

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


        if ( $("#cuarteles_array").length==0 ) {
            $('#campos').removeAttr('disabled');
            $('#campos').trigger("chosen:updated");
        }
       

    });




function agregar_maquinaria(){
        var lineId = Math.floor((Math.random() * 1000000) + 1);
        lineId = lineId + "_" + Math.floor((Math.random() * 1000000) + 1);
        if($('#maquinaria option:selected').text()!='Seleccione Maquinaria' ){
            var maquinariaId=$('#maquinaria option:selected').val();
            var maquinariaName=$('#maquinaria option:selected').text();
            var html="";
            html+='<tr lineid='+lineId+'>';
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
            html+='<tr lineid='+lineId+'>';
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
            html+='<tr lineid='+lineId+'>';
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


</script>
@endsection