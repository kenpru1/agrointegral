@extends('backend.layouts.app')

@section('title', 'Oportunidades' . ' | ' . 'Ver')

@section('content')
    {{ html()->modelForm($oportunidad, 'PATCH', route('admin.oportunidades.update', $oportunidad))->class('form-horizontal')->attribute('enctype', 'multipart/form-data')->open() }}
        <div>
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Administración de Oportunidades
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
                                {{ html()->label('Título del trato')
                                    ->for('titulo') }}
                                      
                                {{ html()->text('titulo')
                                    ->class('form-control')
                                    ->placeholder('nombre del trato')
                                    ->attribute('maxlength', 100)
                                    ->required()
                                    ->readonly()
                                    ->autofocus() }}            
                            </div>

                        
                            <div class="form-group col-md-5 col-md-push-1">
                                {{ html()->label('Valor del trato')
                                    ->for('monto') }}
                                      
                                <input type="number" class="form-control" name="monto" value="{{$oportunidad->monto}}" min="1" required readonly>            
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-5">
                                {{ html()->label('Fecha de cierre')
                                    ->for('fecha_cierre') }}
                                      
                                <input type="date" class="form-control" name="fecha_cierre" value="{{ $oportunidad->fecha_cierre }}" required readonly>            
                            </div>

                            <div class="form-group col-md-5 col-md-push-1">
                                {{ html()->label('Estado de la Oportunidad')->for('estado_oportunidad_id') }}

                                {{ html()->select('estado_oportunidad_id', $estados, null)
                                    ->placeholder('Seleccione Estado de la Oportunidad', false)
                                    ->class('form-control  chosen-select')
                                    ->required()
                                    ->attribute('disabled')
                                    ->id('estado_oportunidad_id') }}            
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="form-group col-md-12">
                                {{ html()->label('Etapa de la Oportunidad:')->for('etapa_oportunidad_id') }}
                                <small>{{$oportunidad->etapaOportunidad->nombre}}</small>
                                <div class="progress progress-bar-default">
                                    <div style="width: {{$oportunidad->etapaOportunidad->class}}%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="{{$oportunidad->etapaOportunidad->class}}" role="progressbar" class="progress-bar">
                                        <span class="sr-only">{{$oportunidad->etapaOportunidad->nombre}}</span>
                                    </div>
                                </div>
                            </div>
                        </div> 
                         <div class="mail-body text-right tooltip-demo">
                            <a class="btn btn-white btn-sm" href="{{route('admin.oportunidades.index')}}" >@lang('buttons.general.cancel')</a>
                            
                        </div>  
                    </form>
                </div>
            </div>

    {{ html()->form()->close() }}
@endsection
