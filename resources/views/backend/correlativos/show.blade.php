@extends('backend.layouts.app')

@section('title', __('labels.backend.access.permissions.management') . ' | Editar' )

@section('content')
{{ html()->modelForm($tipoCultivo, 'PATCH', route('admin.tipo_cultivos.update',$tipoCultivo))->class('form-horizontal')->open() }}
      <div>
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Administración de Tipo Cultivos
                                <small class="text-muted">Ver</small>
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

                                <div class="form-group col-md-5 col-md-push-1">
                                        <input type="checkbox" name="estado" value="1" {{isset($tipoCultivo->estado)&&$tipoCultivo->estado==1?'checked':''}}> Activo
                                       
                                </div><!--form-group-->
                               
                                </div>


                                @if($logged_in_user->hasRole('administrator'))
                                    <div class="row">
                                        <div class="form-group col-md-5 ">
                                            {{ html()->label('Tipo Sistema')->for('empresa_id') }}
                                            {{ html()->select('empresa_id', $empresas,null)
                                                ->placeholder('Tipo Sistema', false)
                                                ->class('form-control')
                                                ->id('empresa_id') }}
                                        </div><!--form-group-->
                                    </div>
                               @endif
                      
                                       

                                
                            <div class="mail-body text-right tooltip-demo">
                                                        
                                <a class="btn btn-white btn-sm" href="{{route('admin.tipo_cultivos.index')}}" >@lang('buttons.general.cancel')</a>
                               
                                
                            </div>



                                
                            </form>
                        </div>
                    </div>
                </div>

{{ html()->form()->close() }}
@endsection
