@extends('backend.layouts.app')

@section('title',  'Actividades | Editar'))

@section('content')

{{ html()->modelForm($actividad, 'PATCH', route('admin.actividades_campos.update',$actividad))->class('form-horizontal')->open() }}
    <div>
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Administración de Actividades
                                <small class="text-muted">Editar</small>
                            </h5>
                            
                        </div>
                        <div class="ibox-content">
                            <form class="form-horizontal">
                            @if($logged_in_user->hasRole('administrator'))
                            <div class="row">
                                <div class="form-group col-md-5 ">
                                    {{ html()->label('Empresa')->for('empresa_id') }}
                                    <input type="text" name="empresa" class="form-control" value="{{ $actividad->empresa->nombre }}" readonly>

                                    <input type="hidden" name="empresa_id" class="form-control" value="{{ $actividad->empresa->id }}" readonly>
                                </div>
                            </div>
                            @endif

                            <!-- *********CAMPOS***********-->
                                <div class="row">
                                <div class="form-group col-md-5 ">
                                    
                                    {{  html()->label('Campo')->for('campos') }}
                                    <input type="text" name="campos" class="form-control" value="{{ $actividad->campos()->first()->nombre }}" readonly>
                                   <input type="hidden" id="campo_id" name="campo_id" value="{{$actividad->campos()->first()->id }}">
                                  
                                    

                                </div>

                                <div class="form-group col-md-5 col-md-push-1">
                                    
                                                             
                                </div>
                                </div>
                            <!-- *********CAMPOS***********-->

                            <!-- *********CUARTELES***********-->
                                <div class="row">
                                <div class="form-group col-md-5 ">
                                    <div class="input-group">
                                        {{ html()->select('cuarteles', $cuarteles,null)
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
                                        @foreach($actividad->cuarteles as $cuartel)
                                           @php $lineId=rand(1, 1000000) @endphp
                                        <tr lineid="{{ $lineId }}" >
                                            <td>{{ $cuartel->nombre }}</td>
                                            <td> <a href="#" class="borrar_cuartel btn btn-danger" data-toggle="tooltip" cuartelName="{{ $cuartel->nombre }}"  cuartelId="{{ $cuartel->id }}" lineid="{{ $lineId }}" title="Eliminar"><i class="fa fa-minus"></i></a><input type="hidden"  value="{{ $cuartel->id }}" name="cuarteles_array[] id="cuarteles_array"></td>

                                        </tr>

                                        @endforeach
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
                                        @foreach($actividad->tipoActividades as $tipoActividad)
                                           @php $lineId=rand(1, 1000000) @endphp
                                        <tr lineid="{{ $lineId }}" >
                                            <td>{{ $tipoActividad->nombre }}</td>
                                            <td> <a href="#" class="borrar_tipo_actividad btn btn-danger" data-toggle="tooltip" tipoActividadName="{{ $tipoActividad->nombre }}"  tipoActividadId="{{ $tipoActividad->id }}" lineid="{{ $lineId }}" title="Eliminar"><i class="fa fa-minus"></i></a><input type="hidden"  value="{{ $tipoActividad->id }}" name="tipo_actividades_array[] id="tipo_actividades_array"></td>

                                        </tr>

                                        @endforeach
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
                                        @foreach($actividad->trabajadores as $trabajador)
                                           @php $lineId=rand(1, 1000000) @endphp
                                        <tr lineid="{{ $lineId }}" >
                                            <td>{{ $trabajador->nombre }}</td>
                                            <td> <a href="#" class="borrar_trabajador btn btn-danger" data-toggle="tooltip" trabajadorName="{{ $trabajador->nombre }}"  trabajadorId="{{ $trabajador->id }}" lineid="{{ $lineId }}" title="Eliminar"><i class="fa fa-minus"></i></a><input type="hidden"  value="{{ $trabajador->id }}" name="trabajadores_array[] id="trabajadores_array"></td>

                                        </tr>
                                        @endforeach
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
                                        @foreach($actividad->maquinarias as $maquinaria)
                                           @php $lineId=rand(1, 1000000) @endphp
                                        <tr lineid="{{ $lineId }}" >
                                            <td>{{ $maquinaria->nombre }}</td>
                                            <td> <a href="#" class="borrar_cuartel btn btn-danger" data-toggle="tooltip" cuartelName="{{ $maquinaria->nombre }}"  cuartelId="{{ $maquinaria->id }}" lineid="{{ $lineId }}" title="Eliminar"><i class="fa fa-minus"></i></a><input type="hidden"  value="{{ $maquinaria->id }}" name="maquinarias_array[] id="maquinarias_array"></td>

                                        </tr>
                                        @endforeach
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
                                     <input type="number" class="form-control col-md-3"  id="horas" name="horas" min="0" step="1" value="{{ $actividad->horas }}">
                                     
                                </div>

                                <div class="form-group col-md-2 col-md-push-2">
                                    {{ html()->label('Tiempo  Minutos')->for('tiempo') }}
                                     <input type="number" class="form-control"  id="minutos" name="minutos" min="0" step="1" value="{{ $actividad->minutos }}">
                                </div>

                                
                            </div>

                        <div class="row">
                            <div class="form-group col-md-12">
                                {{ html()->label('Comentarios')->for('comentarios') }}
                                <textarea class="summernote" id="comentarios" name="comentarios" title="Comentarios">
                                    {{ $actividad->comentarios }}
                                </textarea>
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