@extends('backend.layouts.app')

@section('title', 'Requerimientos' . ' | ' . 'Editar')

<style>
.ancho{
    width: 300px;
    text-align: left;
}
</style>
@section('content')
    {{ html()->modelForm($requerimiento, 'PATCH', route('admin.requerimientos.update', $requerimiento))->class('form-horizontal')->open() }}
        <div>
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Administración de Requerimientos 
                        <small class="text-muted">Editar</small>
                    </h5>                               
                </div>
                <div class="ibox-content">
                    <form class="form-horizontal">
                        <div class="row">
                            <div class="form-group col-md-5">
                                {{ html()->label('Empresa')->for('cliente_proveedor_id') }}

                                {{ html()->select('cliente_proveedor_id', $cliProvs, null)
                                    ->placeholder('Seleccione Empresa', false)
                                    ->class('form-control  chosen-select')
                                    ->required()
                                    ->id('cliente_proveedor_id') }}            
                            </div>


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
                                      
                                <input type="number" class="form-control" name="monto" value="{{$requerimiento->monto}}" min="0" required>            
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
                            <div class="form-group col-md-5">
                                {{ html()->label('Fecha de muestreo')
                                    ->for('fecha_cierre') }}
                                      
                                <input type="date" class="form-control" name="fecha_cierre" value={{ $requerimiento->fecha_cierre }} required>            
                            </div>
                            <div class="form-group col-md-5 col-md-push-1">
                              {{-- {{ html()->label('Número Muestra')
                                    ->for('numero_muestra') }}
                                      
                                {{ html()->text('numero_muestra')
                                    ->class('form-control')
                                    ->placeholder('Número Muestra')
                                    ->attribute('maxlength', 100)
                                    ->required()
                                    ->autofocus() }}--}}              
                            </div>                             

                        </div>
                        
                        <div class="row">
                            <div class="form-group col-md-5 ">
                                {{ html()->label('Etapa del requerimiento')->for('etapa_requerimiento_id') }}

                                {{ html()->select('etapa_requerimiento_id', $etapas, null)
                                    ->placeholder('Cambie la Etapa del requerimiento', false)
                                    ->class('form-control  chosen-select')
                                    ->required()
                                    ->id('etapa_requerimiento_id') }}            
                            </div>
                        </div>
                        <input type="hidden" name="requerimiento_id" value="{{$requerimiento->id}}" >
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


                                        @php $numero_productos=0; @endphp
                                        @foreach($requerimiento->detalleRequerimiento as $detalle)
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

                                           <td>
                                            {{ $detalle->laboratorio->nombre}}

                                            <input type="hidden" value="{{ $detalle->laboratorio_id }}" name="laboratorio_array[]">
                                           </td>        
                                           <td>
                                            {{ $detalle->plazo_entrega}}

                                            <input type="hidden" value="{{ $detalle->plazo_entrega }}" name="plazo_array[]">
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
                        <table >
                            <thead>
                            <tr>
                                <th class="ancho">Datos Cotización</th>
                                <th class="ancho">Datos Orden de Trabajo</th>
                                <th class="ancho">Datos Orden Laboratorio</th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            
                            @if($requerimiento->presupuesto_id != null )
                                @if($requerimiento->orden_trabajo_id != null )
                                    <td class="ancho">
                                        <button id='boton' class="btn btn-success btn-sm dropdown-toggle"type="button" data-toggle="dropdown" >Nro, Cotización {{ $requerimiento->presupuestos->numero}} <span class="caret"></span>
                                        </button>                                 
                                    </td>

                                    @if($requerimiento->orden_laboratorio_id != null )
                                    <td class="ancho">
                                        <button id='boton' class="btn btn-success btn-sm dropdown-toggle"type="button" data-toggle="dropdown" >Nro, Orden de Trabajo {{ $requerimiento->ordenTrabajos->numero}} <span class="caret"></span>
                                        </button>                                 
                                    </td>
                                        @if($requerimiento->etapa_requerimiento_id < 6)
                                            <td>
                                            <div class="btn-group">
                                            <button id='boton' class="btn btn-success btn-sm dropdown-toggle"type="button" data-toggle="dropdown" >Orden de Laboratorio Nro. {{ $requerimiento->ordenLaboratorios->numero}} <span class="caret"></span>
                                            </button> 
                                            <ul class="dropdown-menu">
                                                @if($requerimiento->etapa_requerimiento_id !=7)
                                                    @foreach($ordenLaboratorios as $key => $dato)
    
                                                        <li>
                                                            @php 
                                                            $valor1 = (['orden_laboratorio_id' => $key, 'requerimiento_id' => $requerimiento->id]);
                                                            @endphp
                                                            <a href="javascript:ordenLaboratorio( {{$valor1['orden_laboratorio_id'] }}, {{$valor1['requerimiento_id']}} )">{{ $dato }}  </a> 
                                                
                                                        </li>
                                                    @endforeach
                                                @endif

                                            </ul>
                                            </div>
                                            </td> 
                                        @else
                                            <td>
                                            <button id='boton' class="btn btn-success btn-sm dropdown-toggle"type="button" data-toggle="dropdown" >Nro, Orden de Trabajo {{ $requerimiento->ordenTrabajos->numero}} <span class="caret"></span>
                                            </button>                                 
                                            </td>
                                        @endif

                                    @else
                                    <td class="ancho">
                                        <div class="btn-group">

                                            <button id='boton' class="btn btn-success btn-sm dropdown-toggle"type="button" data-toggle="dropdown" >Orden de Trabajo Nro. {{ $requerimiento->ordenTrabajos->numero}} <span class="caret"></span>
                                            </button> 
                                            <ul class="dropdown-menu">
                                                    <li><a href="{{ route('admin.ordenTrabajos.create') }}">Crear Orden de Trabajo</a></li>
                                                    <li class="divider"></li>
                                            @foreach($ordenTrabajos as $key => $dato)
    
                                                <li>
                                                    @php 
                                                    $valor1 = (['orden_trabajo_id' => $key, 'requerimiento_id' => $requerimiento->id]);
                                                    @endphp
                                                    <a href="javascript:ordenTrabajo( {{$valor1['orden_trabajo_id'] }}, {{$valor1['requerimiento_id']}} )">{{ $dato }}  </a> 
                                                
                                                </li>

                                            @endforeach
                                            </ul>
                                        </div>                                 
                                    </td>
                                    <td class="ancho">
                                        <div class="btn-group">

                                            <button id='boton' class="btn btn-danger btn-sm dropdown-toggle"
                                                type="button" data-toggle="dropdown" class="text-danger">No tiene Asociado Orden de Laboratorio <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a href="{{ route('admin.ordenLaboratorios.create') }}">Crear Orden de Laboratorio</a></li>
                                                <li class="divider"></li>
                                                 @foreach($ordenLaboratorios as $key => $dato)
    
                                                    <li>
                                                        @php 
                                                        $valor1 = (['orden_laboratorio_id' => $key, 'requerimiento_id' => $requerimiento->id]);
                                                        @endphp
                                                        <a href="javascript:ordenLaboratorio( {{$valor1['orden_laboratorio_id'] }}, {{$valor1['requerimiento_id']}} )">{{ $dato }}  </a> 
                                                
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>                                       

                                    </td>
                                    @endif

                                @else
                                    @if($requerimiento->presupuesto_id != null )                                
                                    <td class="ancho">
                                    <div class="btn-group">
                                        <button id='boton' class="btn btn-success btn-sm dropdown-toggle"type="button" data-toggle="dropdown" >Nro, Cotización {{ $requerimiento->presupuestos->numero}} <span class="caret"></span>
                                        </button> 
                                        <ul class="dropdown-menu">
                                            <li><a href="{{ route('admin.presupuestos.create') }}">Crear Cotización</a></li>
                                            <li class="divider"></li>
  
                                            @foreach($presupuestos as $key => $dato)
    
                                                <li>
                                                    @php 
                                                    $valor1 = (['presupuesto_id' => $key, 'requerimiento_id' => $requerimiento->id]);
                                                    @endphp
                                                    <a href="javascript:cotiza( {{$valor1['presupuesto_id'] }}, {{$valor1['requerimiento_id']}} )">{{ $dato }}  </a> 
                                                
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    </td>
                                    <td class="ancho">
                                        <div class="btn-group">
                                                <button id='boton' class="btn btn-danger btn-sm dropdown-toggle"type="button" data-toggle="dropdown" class="text-danger">No tiene Asociada Orden de Trabajo <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a href="{{ route('admin.ordenTrabajos.create') }}">Crear Orden de Trabajo</a></li>
                                                    <li class="divider"></li>
                                                    @foreach($ordenTrabajos as $key => $dato)
    
                                                        <li>
                                                        @php 
                                                        $valor1 = (['orden_trabajo_id' => $key, 'requerimiento_id' => $requerimiento->id]);
                                                        @endphp
                                                        <a href="javascript:ordenTrabajo( {{$valor1['orden_trabajo_id'] }}, {{$valor1['requerimiento_id']}} )">{{ $dato }}  </a> 
                                                
                                                        </li>
                                                    @endforeach
                                                </ul>
                                        </div>                              
                                    </td>
                                    <td class="ancho">
                                        <button id='boton' class="btn btn-danger btn-sm dropdown-toggle"type="button" data-toggle="dropdown" >No tiene Orden de Laboratorio Asociada <span class="caret"></span>
                                        </button>                                 
                                    </td>   
                                    @endif                                                                     
                                @endif                                                                                                               

                            @else
                                <td class="ancho">
                                <div class="btn-group">

                                    <button id='cotiza' class="btn btn-danger btn-sm dropdown-toggle"
                                        type="button" data-toggle="dropdown" >
                                        No tiene Asociado Cotización <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a href="{{ route('admin.presupuestos.create') }}">Crear Cotización</a></li>
                                        <li class="divider"></li>
  
                                        @foreach($presupuestos as $key => $dato)
    
                                            <li>
                                                @php 
                                                $valor1 = (['presupuesto_id' => $key, 'requerimiento_id' => $requerimiento->id]);
                                                 @endphp
                                                <a href="javascript:cotiza( {{$valor1['presupuesto_id'] }}, {{$valor1['requerimiento_id']}} )">{{ $dato }}  </a> 
                                                
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                </td>
                                    <td class="ancho">
                                        <button id='boton' class="btn btn-danger btn-sm dropdown-toggle"type="button" data-toggle="dropdown" >No tiene Orden de Trabajo Asociada  <span class="caret"></span>
                                        </button>                                 
                                    </td>
                                    <td class="ancho">
                                        <button id='boton' class="btn btn-danger btn-sm dropdown-toggle"type="button" data-toggle="dropdown" >No tiene Orden de Laboratorio Asociada <span class="caret"></span>
                                        </button>                                 
                                    </td>                                                                           

                            @endif

                            </tr> 
                        </tbody>
                        </table>
                        

                        </div>
                        <hr>
                        <div class="row">
                            <div class="form-group col-md-12">
                                {{ html()->label('Etapa del requerimiento:')->for('etapa_requerimiento_id') }}
                                <small>{{$requerimiento->etaparequerimiento->nombre}}</small>
                                <div class="progress progress-bar-default">
                                    <div style="width: {{$requerimiento->etaparequerimiento->class}}%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="{{$requerimiento->etaparequerimiento->class}}" role="progressbar" class="progress-bar">
                                        <span class="sr-only">{{$requerimiento->etaparequerimiento->nombre}}</span>
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
                    $('#empresa_contacto_id').append("<option value='" + value.id +"'>" + value.nombres + ' ' + value.apellidos + "</option>");
                });
                $('#empresa_contacto_id').trigger("chosen:updated");
            }
        });
    });


    function cotiza(valor1, valor2) {
        $.ajax({
            url: "{{ url('admin/asociarCotizacion') }}",
            type: 'GET',
            dataType: 'json',
            data: {"presupuesto_id": valor1 , "requerimiento_id": valor2},
            success: function (data) {

                alert(data['message']);                
                //setTimeout(location.reload(),3000);
                //url = '{{ $_SERVER['PHP_SELF'] }}';
                url='{{Request::url()}}';
                window.location.replace(url);

            },
            error : function(error) {

                $.each(data.responseJSON, function(key,value) {
                    //$('.alert alert-danger').append('<div class="alert alert-danger">'+value+'</div');
                    console.log(key);
                    console.log(value);
                    alert(value);

                }); 
                //alert(mensaje);
                setTimeout(location.reload(),3000);
            },
        });
    };

    function ordenTrabajo(valor1, valor2) {
        $.ajax({
            url: "{{ url('admin/asociarOrdenTrabajo') }}",
            type: 'GET',
            dataType: 'json',
            data: {"orden_trabajo_id": valor1 , "requerimiento_id": valor2},
            success: function (data) {

                alert(data['message']);                
                //setTimeout(location.reload(),3000);
                //url = '{{ $_SERVER['PHP_SELF'] }}';
                url='{{Request::url()}}';
                alert(url);
                window.location.replace(url);

            },
            error : function(error) {

                $.each(data.responseJSON, function(key,value) {
                    //$('.alert alert-danger').append('<div class="alert alert-danger">'+value+'</div');
                    console.log(key);
                    console.log(value);
                    alert(value);

                }); 
                //alert(mensaje);
                setTimeout(location.reload(),3000);
            },
        });
    };

    function ordenLaboratorio(valor1, valor2) {
        $.ajax({
            url: "{{ url('admin/asociarOrdenLaboratorio') }}",
            type: 'GET',
            dataType: 'json',
            data: {"orden_laboratorio_id": valor1 , "requerimiento_id": valor2},
            success: function (data) {

                alert(data['message']);                
                //setTimeout(location.reload(),3000);
                //url = '{{ $_SERVER['PHP_SELF'] }}';
                url='{{Request::url()}}';
                window.location.replace(url);

            },
            error : function(error) {

                $.each(data.responseJSON, function(key,value) {
                    //$('.alert alert-danger').append('<div class="alert alert-danger">'+value+'</div');
                    console.log(key);
                    console.log(value);
                    alert(value);

                }); 
                //alert(mensaje);
                setTimeout(location.reload(),3000);
            },
        });
    };



    </script>
@endsection
