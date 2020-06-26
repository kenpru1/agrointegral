@extends('backend.layouts.app')

@section('title', 'Requerimientos' . ' | ' . 'Ver')

@section('content')
    {{ html()->modelForm($requerimiento, 'PATCH', route('admin.requerimientos.update', $requerimiento))->class('form-horizontal')->attribute('enctype', 'multipart/form-data')->open() }}
        <div>
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Administración de Requerimientos
                        <small class="text-muted">Ver</small>
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
                                    ->attribute('disabled')
                                    ->id('cliente_proveedor_id') }}            
                            </div>

                            <div class="form-group col-md-5 col-md-push-1">
                                {{ html()->label('Contacto')
                                    ->for('empresa_contacto_id') }}

                                {{ html()->select('empresa_contacto_id', $contactos, null)
                                    ->placeholder('Seleccione Contacto', false)
                                    ->class('form-control  chosen-select')
                                    ->required()
                                    ->attribute('disabled')
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
                                    ->readonly()
                                    ->autofocus() }}            
                            </div>

                        
                            <div class="form-group col-md-5 col-md-push-1">
                                {{ html()->label('Valor Aproximado')
                                    ->for('monto') }}

                                <input type="number" class="form-control" name="monto" value="{{$requerimiento->monto}}" min="1" required readonly>            
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-5">
                                {{ html()->label('Tipo Muestra')->for('tipo_muestra_id') }}

                                {{ html()->select('tipo_muestra_id', $tipoMuestras,null)
                                        ->placeholder('Seleccione ', false)
                                        ->class('form-control chosen-select')
                                        ->attribute('disabled')
                                        ->id('tipo_muestra_id') }}            
                            </div>

                            <div class="form-group col-md-5 col-md-push-1">
                                {{ html()->label('Análisis')
                                    ->for('analisis_id') }}

                                {{ html()->select('analisis_id', $analisis,null)
                                          ->placeholder('Seleccione ', false)
                                          ->class('form-control chosen-select')
                                          ->attribute('disabled')
                                          ->id('analisis_id') }}      
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-5">
                                {{ html()->label('Fecha de muestreo')
                                    ->for('fecha_cierre') }}
                                      
                                <input type="date" class="form-control" name="fecha_cierre" value={{ $requerimiento->fecha_cierre }} disabled>            
                            </div>
                            <div class="form-group col-md-5 col-md-push-1">
                               {{ html()->label('Número Muestra')
                                    ->for('numero_muestra') }}
                                      
                                {{ html()->text('numero_muestra')
                                    ->class('form-control')
                                    ->placeholder('Número Muestra')
                                    ->attribute('disabled')
                                    ->required()
                                    ->autofocus() }}              
                            </div>                             

                        </div>

                        <div class="row">
                            <div class="form-group col-md-5">

                                {{ html()->label('Etapa del Requerimiento')->for('etapa_requerimiento_id') }}

                                {{ html()->select('etapa_requerimiento_id', $etapas, null)
                                    ->placeholder('Seleccione Etapa del Requerimiento', false)
                                    ->class('form-control  chosen-select')
                                    ->required()
                                    ->attribute('disabled')
                                    ->id('etapa_requerimiento_id') }}            
                            </div>
                        </div>
                        <div class="row">
                            @if($requerimiento->presupuesto_id != null )
                            <div class="form-group col-md-5">
                                <i class="text-success">Cotización Nro. {{ $requerimiento->presupuestos->numero}}</i>


                            </div>
                            @else
                            <div class="form-group col-md-5">
                                <i class="text-danger " >No tiene Asociado Cotización</i>  
                                <a href="{{ route('admin.presupuestos.create', $requerimiento->id) }}" class="pull-center btn btn-xs btn-blue">Crear Cotización</a>  

                            </div>                            
                            @endif
                            @if( $requerimiento->presupuesto_id != null)  
                                @if($requerimiento->orden_trabajo_id != null )                            
                                    <div class="form-group col-md-5 col-md-push-1">
                                        <i class="text-success">Orden de Trabajo Nro. {{ $requerimiento->ordenTrabajos->numero}}</i>
                                    </div>
                                @else
                                    <div class="form-group col-md-5 col-md-push-1">
                                        <i class="text-danger ">No tiene Asociado Orden de Trabajo</i><a href="{{ route('admin.ordenTrabajos.create', $requerimiento->id) }}" class="pull-center btn btn-xs btn-blue">Crear Orden de Trabajo</a> 

                                    </div>
                                @endif
                            @endif

                        </div>                                           
                        <hr>
                        <div class="row">
                            <div class="form-group col-md-12">
                                {{ html()->label('Etapa del Requerimiento:')->for('etapa_requerimiento_id') }}
                                <small>{{$requerimiento->etapaRequerimiento->nombre}}</small>
                                <div class="progress progress-bar-default">
                                    <div style="width: {{$requerimiento->etapaRequerimiento->class}}%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="{{$requerimiento->etapaRequerimiento->class}}" role="progressbar" class="progress-bar">
                                        <span class="sr-only">{{$requerimiento->etapaRequerimiento->nombre}}</span>
                                    </div>
                                </div>
                            </div>
                        </div> 
                         <div class="mail-body text-right tooltip-demo">
                            <a class="btn btn-white btn-sm" href="{{route('admin.requerimientos.index')}}" >@lang('buttons.general.cancel')</a>
                            
                        </div>  
                    </form>
                </div>
            </div>

    {{ html()->form()->close() }}
@endsection
