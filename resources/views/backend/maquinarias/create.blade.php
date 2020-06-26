@extends('backend.layouts.app')

@section('title',  'Maquinaria | ' . __('labels.backend.access.permissions.create'))

@section('content')
<div class="ibox float-e-margins">
{{ html()->form('POST', route('admin.maquinarias.store'))->class('form-horizontal')->open() }}
    
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Administrador de Maquinarias
                                <small class="text-muted">Crear Maquinarias</small>
                            </h5>
                            
                        </div>
                        <div class="ibox-content">
                            <form class="form-horizontal">
                               <div class="row">
                                <div class="form-group col-md-5">
                                    {{ html()->label(__('validation.attributes.backend.access.permissions.name'))->for('name') }}
                                    {{ html()->text('nombre')
                                        ->class('form-control')
                                        ->placeholder(__('validation.attributes.backend.access.permissions.name'))
                                        ->attribute('maxlength', 100)
                                        ->required()
                                        ->autofocus() }}
                                    
                                </div>

                                <div class="form-group col-md-5 col-md-push-1">
                                    {{ html()->label('Valor Compra')->for('valor_compra') }}
                                    <input type="number" class="form-control" min="0" step="any" name="valor_compra">
                                </div><!--form-group-->
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-5">
                                        {{ html()->label('Tipo')->for('tipo') }}
                                        {{ html()->select('maquinaria_tipo_id', $tipoMaquinas,null)
                                        ->placeholder('Seleccione Tipo', false)
                                        ->class('form-control chosen-select')
                                        ->required()
                                        ->id('maquinaria_tipo_id') }}
                                    
                                    </div>

                                    <div class="form-group col-md-5 col-md-push-1">
                                        {{ html()->label('Marca')->for('marca') }}
                                        {{ html()->text('marca')
                                            ->class('form-control')
                                            ->placeholder('Marca')
                                            ->attribute('maxlength', 100)
                                            ->autofocus() }}
                                    </div><!--form-group-->
                                </div>
                                 <div class="row">
                                    <div class="form-group col-md-5">
                                        {{ html()->label('Modelo')->for('modelo') }}
                                        {{ html()->text('modelo')
                                            ->class('form-control')
                                            ->placeholder('Modelo')
                                            ->attribute('maxlength', 100)
                                            ->autofocus() }}
                                    
                                    </div>

                                    <div class="form-group col-md-5 col-md-push-1">
                                        {{ html()->label('Patente')->for('patente') }}
                                        {{ html()->text('patente')
                                            ->class('form-control')
                                            ->placeholder('Patente')
                                            ->attribute('maxlength', 20)
                                            ->autofocus() }}
                                    </div><!--form-group-->
                                </div>

                                <div class="row">
                                   <div class="form-group col-md-5">
                                        {{ html()->label('Fecha Compra')->for('fecha_compra') }}
                                        {{ html()->date('fecha_compra')
                                            ->class('form-control')
                                            ->placeholder('Fecha Compra')
                                            ->autofocus() }}
                                    
                                    </div>

                                    <div class="form-group col-md-5 col-md-push-1">
                                        {{ html()->label('Vencimiento Rev. Técnica')->for('venc_rev_tecnica') }}
                                        {{ html()->date('venc_rev_tecnica')
                                            ->class('form-control')
                                            ->placeholder('Vencimiento Rev. Técnica')
                                            ->autofocus() }}
                                        
                                    </div><!--form-group-->
                                </div>

                                <div class="row">
                                   <div class="form-group col-md-5">
                                        {{ html()->label('Fecha Inspección')->for('fecha_inspeccion') }}
                                        {{ html()->date('fecha_inspeccion')
                                            ->class('form-control')
                                            ->placeholder('Fecha Inspección')
                                            ->autofocus() }}
                                    
                                    </div>

                                    <div class="form-group col-md-5 col-md-push-1">
                                        {{ html()->label('Fecha Seguro')->for('fecha_seguro') }}
                                        {{ html()->date('fecha_seguro')
                                            ->class('form-control')
                                            ->placeholder('Fecha Seguro')
                                            ->autofocus() }}
                                    
                                    </div><!--form-group-->
                                </div>

                                <div class="row">
                                   <div class="form-group col-md-5">
                                        {{ html()->label('Número Roma')->for('numero_roma') }}
                                        {{ html()->text('numero_roma')
                                            ->class('form-control')
                                            ->placeholder('Número Roma')
                                            ->autofocus() }}
                                    
                                    </div>

                                    <div class="form-group col-md-5 col-md-push-1">
                                        {{ html()->label('Propietario')->for('propietario') }}
                                        {{ html()->select('propietario', $propietario,null)
                                        ->placeholder('Seleccione Propietario', false)
                                        ->class('form-control chosen-select')
                                        ->required()
                                        ->id('propietario') }}
                                    </div><!--form-group-->
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-12">
                                    {{ html()->label('Descripción')->for('name') }}
                                    <textarea class="summernote" id="descripcion" name="descripcion" title="Descripcion"></textarea>
                                    </div>
                                </div>

                                @if($logged_in_user->hasRole('administrator'))
                                    <div class="row">
                                        <div class="form-group col-md-5 ">
                                            {{ html()->label('Empresa')->for('empresa_id') }}
                                            {{ html()->select('empresa_id', $empresas,null)
                                                ->placeholder('Seleccione Empresa', false)
                                                ->class('form-control chosen-select')
                                                ->required()
                                                ->id('empresa_id') }}
                                        </div><!--form-group-->
                                    </div>
                               @endif

                            <div class="mail-body text-right tooltip-demo">
                                                        
                                <a class="btn btn-white btn-sm" href="{{route('admin.maquinarias.index')}}" >@lang('buttons.general.cancel')</a>
                                <button class="btn btn-sm btn-primary" type="submit">Guardar</button>
                                
                            </div>
                            
                                                               
                            </form>
                        </div>
                    </div>
                </div>


{{ html()->form()->close() }}
@endsection
@section('scripts')
<script>
    $('#descripcion').summernote({
        height: 150,
    });
   
</script>
@endsection

