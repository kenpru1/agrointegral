@extends('backend.layouts.app')

@section('title', 'Especies / Fuentes | ' . __('labels.backend.access.especie_fuente.create'))

@section('content')


{{ html()->form('POST', route('admin.especieFuente.store'))->class('form-horizontal')->open() }}

    <div>
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                                <h5>Administración de Especies / Fuentes
                                    <small class="text-muted">Crear</small>
                                </h5>

                            
                        </div>
                        <div class="ibox-content">
                            <form class="form-horizontal">
                               <div class="row">
                                <div class="form-group col-md-5">
                                    {{ html()->label('Especie / Fuente')
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

