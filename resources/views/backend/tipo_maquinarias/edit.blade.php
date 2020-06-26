@extends('backend.layouts.app')

@section('title',  'Tipo Maquinaria | Editar' )

@section('content')
{{ html()->modelForm($tipoMaquinaria, 'PATCH', route('admin.tipo_maquinarias.update',$tipoMaquinaria))->class('form-horizontal')->open() }}
    <div>
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Administración de Tipo Maquinarias
                                <small class="text-muted">Editar</small>
                            </h5>
                            
                        </div>
                        <div class="ibox-content">
                            <form class="form-horizontal">
                               <div class="row">
                                <div class="form-group col-md-5">
                                    {{ html()->label(__('validation.attributes.backend.access.permissions.name'))
                                ->for('name') }}

                                  
                                        {{ html()->text('nombre')
                                            ->class('form-control')
                                            ->placeholder(__('validation.attributes.backend.access.permissions.name'))
                                            ->attribute('maxlength', 191)
                                            ->required()
                                            ->autofocus() }}
                                    
                                </div>

                                  @if($logged_in_user->hasRole('administrator'))
                               
                                <div class="form-group col-md-5 col-md-push-1">
                                     {{ html()->label('Empresa')->for('empresa_id') }}
                                     {{ html()->select('empresa_id', $empresas,null)
                                        ->placeholder('Seleccione Empresa', false)
                                        ->class('form-control')
                                        ->id('empresa_id') }}
                                </div><!--form-group-->
                              
                               @endif
                      


                                {{--<div class="form-group col-md-5 col-md-push-1">
                                    @if($logged_in_user->hasRole('administrator'))
                                        <input type="checkbox" name="sistema" value="1" {{isset($tipoMaquinaria->sistema)&&$tipoMaquinaria->sistema==1?'checked':''}}> Por Defecto
                                    @endif
                                </div><!--form-group-->--}}
                                </div>

                              
                                       

                                
                            <div class="mail-body text-right tooltip-demo">
                                                        
                                <a class="btn btn-white btn-sm" href="{{route('admin.tipo_maquinarias.index')}}" >@lang('buttons.general.cancel')</a>
                                <button class="btn btn-sm btn-primary" type="submit">Guardar</button>
                                
                            </div>



                                
                            </form>
                        </div>
                    </div>
                </div>

{{ html()->form()->close() }}
@endsection
