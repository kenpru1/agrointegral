@extends('backend.layouts.app')

@section('title', 'Contactos' . ' | ' . 'Crear')

@section('content')
    {{ html()->form('POST', route('admin.contactos.store'))->class('form-horizontal')->attribute('enctype', 'multipart/form-data')->open() }}
        <div>
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Administración de Contactos
                        <small class="text-muted">Crear</small>
                    </h5>                               
                </div>
                <div class="ibox-content">
                    <form class="form-horizontal">
                        <div class="row">
                            <div class="form-group col-md-5">
                                {{ html()->label('Nombres')
                                    ->for('name') }}
                                      
                                {{ html()->text('nombres')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.access.permissions.name'))
                                    ->attribute('maxlength', 191)
                                    ->required()
                                    ->autofocus() }}            
                            </div>

                            <div class="form-group col-md-5 col-md-push-1">
                                {{ html()->label('Apellidos')
                                    ->for('lastname') }}
                                      
                                {{ html()->text('apellidos')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.access.permissions.name'))
                                    ->attribute('maxlength', 191)
                                    ->required()
                                    ->autofocus() }}            
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-5">
                                {{ html()->label('Correo electrónico')
                                    ->for('email') }}
                                      
                                {{ html()->text('email')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.access.permissions.name'))
                                    ->attribute('maxlength', 191)
                                    ->required()
                                    ->autofocus() }}            
                            </div>

                        
                            <div class="form-group col-md-5 col-md-push-1">
                                {{ html()->label('Celular')
                                    ->for('celular') }}
                                      
                                {{ html()->text('celular')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.access.permissions.name'))
                                    ->attribute('maxlength', 191)
                                    ->autofocus() }}            
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-5">
                                {{ html()->label('Cliente')->for('cliente_proveedor_id') }}

                                {{ html()->select('cliente_proveedor_id', $clienteProveedores, null)
                                    ->placeholder('Seleccione Cliente', false)
                                    ->class('form-control  chosen-select')
                                    ->id('cliente_proveedor_id') }}            
                            </div>

                            <div class="form-group col-md-5 col-md-push-1">
                                {{ html()->label('Foto')
                                    ->for('foto') }}
                                      
                                <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                    <div class="form-control" data-trigger="fileinput">
                                        <i class="glyphicon glyphicon-file fileinput-exists"></i>
                                    <span class="fileinput-filename"></span>
                                    </div>
                                    <span class="input-group-addon btn btn-default btn-file">
                                        <span class="fileinput-new">Seleccione Foto</span>
                                        <span class="fileinput-exists">Cambiar</span>
                                        <input type="file" name="foto"/>
                                    </span>
                                    <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Quitar</a>
                                </div>            
                            </div>
                        </div>

                        <div class="mail-body text-right tooltip-demo">
                            <a class="btn btn-white btn-sm" href="{{route('admin.contactos.index')}}" >@lang('buttons.general.cancel')</a>
                            <button class="btn btn-sm btn-primary" type="submit">Guardar</button>
                        </div>  
                    </form>
                </div>
            </div>

    {{ html()->form()->close() }}
@endsection
