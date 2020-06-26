@extends('backend.layouts.app')


@section('title', __('labels.backend.access.analisis.management') . ' | Editar' )

@section('content')

    {{ html()->modelForm($analisis, 'PATCH', route('admin.analisis.update',$analisis))->class('form-horizontal')->open() }}

      <div>
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">

                                <h5>Administración de Análisis
                                    <small class="text-muted">Editar</small>
                                </h5>

                            
                        </div>
                        <div class="ibox-content">
                            <form class="form-horizontal">
                               <div class="row">
                                <div class="form-group col-md-5">
                                    {{ html()->label('Nombre')
                                ->for('nombre') }}
                             
                                        {{ html()->text('nombre')
                                            ->class('form-control')
                                            ->placeholder('Nombre')
                                            ->attribute('maxlength', 191)
                                            ->required()
                                            ->autofocus() }}
                                    
                                </div>


                              
                                </div>
                                                         

                                

                            <div class="mail-body text-right tooltip-demo">
                                                        
                                <a class="btn btn-white btn-sm" href="{{route('admin.analisis.index')}}" >@lang('buttons.general.cancel')</a>
                                <button class="btn btn-sm btn-primary" type="submit">Guardar</button>
                                
                            </div>



                                
                            </form>
                        </div>
                    </div>
                </div>



{{ html()->form()->close() }}
@endsection

