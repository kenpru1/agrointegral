@extends('backend.layouts.app')

@section('title', 'Requerimientos' . ' | ' . 'Editar')

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
                        <div class="row">
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
                        </div>
                        <div class="row">
                            <div class="form-group col-md-5">
                                {{ html()->label('Fecha de muestreo')
                                    ->for('fecha_cierre') }}
                                      
                                <input type="date" class="form-control" name="fecha_cierre" value={{ $requerimiento->fecha_cierre }} required>            
                            </div>
                            <div class="form-group col-md-5 col-md-push-1">
                               {{ html()->label('Número Muestra')
                                    ->for('numero_muestra') }}
                                      
                                {{ html()->text('numero_muestra')
                                    ->class('form-control')
                                    ->placeholder('Número Muestra')
                                    ->attribute('maxlength', 100)
                                    ->required()
                                    ->autofocus() }}              
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
                            @if($requerimiento->presupuesto_id != null )
                            <div class="form-group col-md-5">
                                @if($requerimiento->orden_trabajo_id != null )
                                    <i class="text-success">Cotización Nro. {{ $requerimiento->presupuestos->numero}}</i>
                                @else
                                    <div class="btn-group">
                                        {{ html()->label('Nro. Cotización Asociada')
                                           ->for('boton') }}
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

                                @endif  

                            </div>
                            @else
                            <div class="form-group col-md-5">
                                <div class="btn-group">
                                    {{ html()->label('Asociar Cotización')
                                    ->for('boton') }}
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
                                  

                            </div>                            
                            @endif
                            @if( $requerimiento->presupuesto_id != null)  
                                <div class="form-group col-md-5 col-md-push-1">
                                    @if($requerimiento->orden_trabajo_id != null )                            
                                        <div class="btn-group">
                                            {{ html()->label('Ord. Trabajo Asociada')
                                                ->for('boton') }}
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
                                    @else
                                        <div class="btn-group">
                                            {{ html()->label('Asociar Ord. Trabajo')
                                                ->for('boton') }}
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

                                    @endif                                                                    
                                </div>
                            @endif
                            @if( $requerimiento->orden_trabajo_id != null)  
                                <div class="form-group col-md-5 ">
                                    @if($requerimiento->orden_laboratorio_id != null )                            

                                        <div class="btn-group">
                                            {{ html()->label('Ord. Laboratorio Asociada')
                                                ->for('boton') }}
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
                                    @else

                                        <div class="btn-group">
                                            {{ html()->label('Asociar Ord. Laboratorio')
                                            ->for('boton') }}
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
                                    @endif
                                </div>    
                            @endif                            

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
