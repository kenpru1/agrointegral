@extends('backend.layouts.app')

@section('title', 'Requerimientos' . ' | ' . 'Cambiar Etapa Enviada Laboratorio')

@section('content')
    {{ html()->modelForm($requerimiento, 'GET', route('admin.requerimientos.asociarOrdenLaboratorio', $requerimiento))->class('form-horizontal')->attribute('enctype', 'multipart/form-data')->open() }}
        <div>
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Administración de Requerimientos
                        <small class="text-muted">Cambiar Etapa Enviada Laboratorio</small>
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
                                {{ html()->label('Título del trato')
                                    ->for('titulo') }}
                                      
                                {{ html()->text('titulo')
                                    ->class('form-control')
                                    ->placeholder('nombre del trato')
                                    ->attribute('maxlength', 100)
                                    ->required()
                                    ->attribute('disabled')                             
                                    ->readonly()
                                    ->autofocus() }}            
                            </div>

                        
                            <div class="form-group col-md-5 col-md-push-1">
                                {{ html()->label('Valor del trato')
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
                                {{ html()->label('Seleccionar Orden Laboratorio')
                                    ->for('orden_laboratorio_id') }}
                                @if($requerimiento->orden_laboratorio_id != null)
                                    {{ html()->select('orden_laboratorio_id', $ordenLaboratorios, null)
                                    ->placeholder('Anular Asociación', null)
                                    ->class('form-control  chosen-select')
                                    ->id('orden_laboratorio_id')
                                     }}
                                @else
                                    {{ html()->select('orden_laboratorio_id', $ordenLaboratorios, null)
                                    ->placeholder('Seleccione Nro. Orden de Laboratorio', null)
                                    ->class('form-control  chosen-select')
                                    ->required()
                                    ->id('orden_laboratorio_id')
                                     }}
                                @endif                                

                            </div>
                            <div class="form-group col-md-5 col-md-push-1">
                                <a href="{{ route('admin.ordenLaboratorios.create') }}" class="pull-center btn btn-xs btn-blue">Crear Orden de Laboratorio</a> 
                                <br> 

                                <i class="text-success">Cotización asociada Nro. {{ $requerimiento->presupuestos->numero}}</i>
                                <br>                                
                                <i class="text-success">Orden de Trabajo asociada Nro. {{ $requerimiento->ordenTrabajos->numero}}</i>
                            </div>    

                        </div>                   
                        <input type="hidden" name="requerimiento_id" value="{{ $requerimiento->id }}" id="requerimiento_id"
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
                            <a class="btn btn-white btn-sm" href="{{route('admin.requerimientos.tablero')}}" >@lang('buttons.general.cancel')</a>
                            {{ form_submit(__('buttons.general.save'))
                              ->class('btn btn-enter')   }}                          
                        </div>  
                    </form>
                </div>
            </div>

    {{ html()->form()->close() }}
@endsection


