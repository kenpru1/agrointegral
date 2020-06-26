@extends('backend.layouts.app')

@section('title', 'Animales | Crear')

@section('content')
{{ html()->form('POST', route('admin.animales.store'))->class('form-horizontal')->open() }}
    <div>
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Administración de Animales
                                <small class="text-muted">Crear</small>
                            </h5>

                        </div>
                        <div class="ibox-content">
                            <form class="form-horizontal">
                            <div class="row">
                                <div class="form-group col-md-5">
                                    {{ html()->label('Caravana')->for('caravana') }}
                                        <input type="text" class="form-control" id="caravana" name="caravana" required placeholder="Caravana" maxlength="20">
                                </div>
                                <div class="form-group col-md-5 col-md-push-1">
                                     {{ html()->label(__('validation.attributes.backend.access.permissions.name'))->for('name') }}
                                    {{ html()->text('nombre')
                                        ->class('form-control')
                                        ->placeholder(__('validation.attributes.backend.access.permissions.name'))
                                        ->attribute('maxlength', 50)
                                        ->required()
                                        ->autofocus() }}
                                </div><!--form-group-->
                            </div>

                            <div class="row">
                                <div class="form-group col-md-5">
                                    {{ html()->label('Especies')->for('especie_id') }}
                                    {{ html()->select('especie_id', $especies,null)
                                        ->placeholder('Seleccione Especie', false)
                                        ->class('form-control chosen-select')
                                        ->id('especie_id') }}
                                </div>
                                <div class="form-group col-md-5 col-md-push-1">
                                    {{ html()->label('Raza')->for('raza') }}
                                        <input type="text" class="form-control" id="raza" name="raza"  placeholder="Raza" maxlength="100">
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-5">
                                    {{ html()->label('Categoría Pedigree')->for('categoria_pedigree') }}
                                        <input type="text" class="form-control" id="categoria_pedigree" name="categoria_pedigree"  placeholder="Categoría Pedigree" maxlength="100">
                                    
                                </div>
                                <div class="form-group col-md-5 col-md-push-1">
                                    {{ html()->label('Sexos')->for('sexo_id') }}
                                    {{ html()->select('sexo_id', $sexos,null)
                                        ->placeholder('Seleccione Sexo', false)
                                        ->class('form-control chosen-select')
                                        ->id('sexo_id') }}
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-5">
                                    {{ html()->label('Fecha Nacimiento')->for('fecha_nacimiento') }}
                                        <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" >
                                    
                                </div>
                                <div class="form-group col-md-5 col-md-push-1">
                                    {{ html()->label('Peso Nacimiento')->for('peso_nacer') }}
                                    <input type="number" min="0" step="any" class="form-control" id="peso_nacer" name="peso_nacer" value="0">
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-5">
                                    {{ html()->label('Caravana Madre')->for('caravana_madre') }}
                                        <input type="text" class="form-control" id="caravana_madre" name="caravana_madre" maxlength="20" >
                                    
                                </div>
                                <div class="form-group col-md-5 col-md-push-1">
                                    {{ html()->label('Nombre Madre')->for('nombre_madre') }}
                                    <input type="text" class="form-control" id="nombre_madre" name="nombre_madre" maxlength="50" >
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-5">
                                    {{ html()->label('Caravana Progenitor')->for('caravana_mprogenitor') }}
                                        <input type="text" class="form-control" id="caravana_progenitor" name="caravana_progenitor" maxlength="20" >
                                    
                                </div>
                                <div class="form-group col-md-5 col-md-push-1">
                                    {{ html()->label('Nombre Progenitor')->for('nombre_progenitor') }}
                                    <input type="text" class="form-control" id="nombre_progenitor" name="nombre_progenitor" maxlength="50" >
                                </div>
                            </div>

                             <div class="row">
                                <div class="form-group col-md-5">
                                    {{ html()->label('Indice Coporal')->for('indice_corporal') }}
                                        <input type="number" class="form-control" id="indice_corporal" name="indice_corporal"  placeholder="Indice Corporal" min="0" step="any" value="0">
                                    
                                </div>
                                <div class="form-group col-md-5 col-md-push-1">
                                    {{ html()->label('Rodeo')->for('rodeo_id') }}
                                    {{ html()->select('rodeo_id', $rodeos,null)
                                        ->placeholder('Seleccione Rodeo', false)
                                        ->class('form-control chosen-select')
                                        ->id('rodeo_id') }}
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-5">
                                    {{ html()->label('Fecha Muerte')->for('fecha_muerte') }}
                                        <input type="date" class="form-control" id="fecha_muerte" name="fecha_muerte" >
                                    
                                </div>
                                <div class="form-group col-md-5 col-md-push-1">
                                    {{ html()->label('Código RIFD')->for('codigo_rfid') }}
                                    <input type="text"  class="form-control" id="codigo_rfid" name="codigo_rfid" maxlength="20">
                                </div>
                            </div>

                                <div class="row">
                                    <div class="form-group col-md-12">
                                        {{ html()->label('Observaciones')->for('observaciones') }}
                                        <textarea class="summernote" id="observaciones" name="observaciones" title="Comentarios"></textarea>
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
                                                        
                                    <a class="btn btn-white btn-sm" href="{{route('admin.animales.index')}}" >@lang('buttons.general.cancel')</a>
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
    $('#observaciones').summernote({
        height: 150,
    });
    


</script>
@endsection
