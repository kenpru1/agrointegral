@extends('backend.layouts.app')

@section('title', 'Tipo Raciones | Editar' )

@section('content')
{{ html()->modelForm($tipoRacion, 'PATCH', route('admin.tipo_raciones.update',$tipoRacion))->class('form-horizontal')->open() }}
      <div>
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Administración de Tipo de Ración
                                <small class="text-muted">Editar</small>
                            </h5>
                            
                        </div>
                        <div class="ibox-content">
                            <form class="form-horizontal">
                               <div class="row">
                                <div class="form-group col-md-5">
                                    {{ html()->label('Descripción')->for('name') }}
                                    {{ html()->text('descripcion')
                                            ->class('form-control')
                                            ->placeholder('Descripción')
                                            ->attribute('maxlength', 100)
                                            ->required()
                                            ->autofocus() }}
                                    
                                </div>

                             
                               
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
                                                        
                                <a class="btn btn-white btn-sm" href="{{route('admin.tipo_raciones.index')}}" >@lang('buttons.general.cancel')</a>
                                <button class="btn btn-sm btn-primary" type="submit">Guardar</button>
                                
                            </div>



                                
                            </form>
                        </div>
                    </div>
                </div>

{{ html()->form()->close() }}
@endsection
