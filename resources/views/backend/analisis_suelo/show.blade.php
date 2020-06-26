@extends('backend.layouts.app')

@section('title', __('labels.backend.access.permissions.management') . ' | Editar' )

@section('content')

{{ html()->modelForm($analisis, 'PATCH', route('admin.analisis_suelo.update',$analisis))->class('form-horizontal')->open() }}
<div>
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Administrador de Análisis de Suelo
                                <small class="text-muted">Crear Análisis</small>
                            </h5>
                            
                        </div>
                        <div class="ibox-content">
                            <form class="form-horizontal">
                                @if($logged_in_user->hasRole('administrator'))
                                    <div class="row">
                                        <div class="form-group col-md-5 ">
                                            {{ html()->label('Empresa')->for('empresa_id') }}
                                            {{ html()->select('empresa_id', $empresas,null)
                                                ->placeholder('Seleccione Empresa', false)
                                                ->class('form-control')
                                                ->required()
                                                ->attribute('disabled')
                                                ->id('empresa_id') }}
                                        </div><!--form-group-->
                                    </div>
                               @endif
                                        
                                <div class="row">
                                <div class="form-group col-md-5">
                                    {{ html()->label('Fecha')->for('fecha') }}
                                    <input type="date" class="form-control" name="fecha" value="{{isset($analisis->fecha)?$analisis->fecha->format('Y-m-d'):null}}" required readonly>

                                    
                                </div>

                                <div class="form-group col-md-5 col-md-push-1">
                                    {{ html()->label('Unidad')->for('unidad_id') }}
                                     {{ html()->select('unidad_id', $unidades,null)
                                        ->placeholder('Seleccione Unidad', false)
                                        ->class('form-control')
                                        ->required()
                                        ->attribute('disabled')
                                        ->id('unidad_id') }}
                                </div><!--form-group-->
                                                                     
                                </div>
                               
                               

                               <div class="row">
                                
                                <div class="form-group col-md-5">
                                     {{ html()->label('Campo')->for('campo_id') }}
                                     {{ html()->select('campo_id', $campos,$analisis->cuartel->campo_id)
                                        ->placeholder('Seleccione Campo', false)
                                        ->class('form-control')
                                        ->attribute('disabled')
                                        ->id('campo_id') }}
                                </div>
                                
                                <div class="form-group col-md-5 col-md-push-1">
                                     {{ html()->label('Profundidad Desde (Cm)')->for('prof_desde') }}
                                    <input type="number" min="0" step="any" class="form-control" name="prof_desde" value="{{ $analisis->prof_desde }}" required readonly>
                                </div><!--form-group-->

                                </div>

                                <div class="row">
                                
                                    <div class="form-group col-md-5">
                                        {{ html()->label('Cuarteles')->for('cuartel_id') }}
                                         {{ html()->select('cuartel_id', $cuarteles,$analisis->cuartel_id)
                                              ->placeholder('Seleccione Cuartel', false)
                                              ->class('form-control')
                                              ->required()
                                              ->attribute('disabled')
                                              ->id('cuartel_id') }}
                                         
                                    </div>
                                
                                    <div class="form-group col-md-5 col-md-push-1">
                                        {{ html()->label('Profundidad Hasta (Cm)')->for('prof_hasta') }}
                                        <input type="number" min="0" step="any" class="form-control" name="prof_hasta" value="{{ $analisis->prof_desde }}" required readonly>
                                    </div><!--form-group-->

                                </div>


                                <div class="row">
                                
                                    <div class="form-group col-md-5">
                                        {{ html()->label('Sector')->for('sector') }}
                                        <input type="text" name="sector" class="form-control" value="{{ $analisis->sector }}" readonly>
                                        
                                         
                                    </div>
                                
                                    <div class="form-group col-md-5 col-md-push-1">
                                        
                                    </div><!--form-group-->

                                </div>

                                <div class="row">
                                
                                    <div class="form-group col-md-5">
                                       <h3>Datos Químicos</h3>
                                         
                                    </div>
                                
                                    <div class="form-group col-md-5 col-md-push-1">
                                        <h3>Datos Físicos</h3>
                                    </div><!--form-group-->

                                </div>

                                <div class="row">
                                
                                    <div class="form-group col-md-5">
                                        {{ html()->label('Ph')->for('ph') }}
                                        <input type="number" min="0" step="any" class="form-control" name="ph" value="{{ $analisis->ph }}" readonly>
                                         
                                         
                                    </div>
                                
                                    <div class="form-group col-md-5 col-md-push-1">
                                        {{ html()->label('Arcilla')->for('arcilla') }}
                                        <input type="text"  class="form-control" name="arcilla" value="{{ $analisis->arcilla }}" readonly>
                                    </div><!--form-group-->

                                </div>

                                <div class="row">
                                
                                    <div class="form-group col-md-5">
                                        {{ html()->label('N (ppm)')->for('n') }}
                                        <input type="number" min="0" step="any" class="form-control" name="n" value="{{ $analisis->n }}" readonly>
                                         
                                         
                                    </div>
                                
                                    <div class="form-group col-md-5 col-md-push-1">
                                        {{ html()->label('Arena')->for('arena') }}
                                        <input type="text"  class="form-control" name="arena" value="{{ $analisis->arena }}" readonly>
                                    </div><!--form-group-->

                                </div>

                                <div class="row">
                                
                                    <div class="form-group col-md-5">
                                        {{ html()->label('P (ppm)')->for('p') }}
                                        <input type="number" min="0" step="any" class="form-control" name="p" value="{{ $analisis->p }}" readonly>
                                         
                                         
                                    </div>
                                
                                    <div class="form-group col-md-5 col-md-push-1">
                                        {{ html()->label('Limo')->for('limo') }}
                                        <input type="text"  class="form-control" name="limo" value="{{ $analisis->limo }}" readonly>
                                    </div><!--form-group-->

                                </div>

                                <div class="row">
                                
                                    <div class="form-group col-md-5">
                                        {{ html()->label('K (ppm)')->for('k') }}
                                        <input type="number" min="0" step="any" class="form-control" name="k" value="{{ $analisis->k }}" readonly>
                                         
                                         
                                    </div>
                                
                                    <div class="form-group col-md-5 col-md-push-1">
                                        {{ html()->label('Cond. Eléctrica')->for('cod_electrica') }}
                                        <input type="text"  class="form-control" name="cond_electrica" value="{{ $analisis->cond_electrica }}" readonly>
                                    </div><!--form-group-->

                                </div>

                                <div class="row">
                                
                                    <div class="form-group col-md-5">
                                        {{ html()->label('S (ppm)')->for('s') }}
                                        <input type="number" min="0" step="any" class="form-control" name="s" value="{{ $analisis->s }}" readonly>
                                         
                                         
                                    </div>
                                
                                    <div class="form-group col-md-5 col-md-push-1">
                                        {{ html()->label('Humedad')->for('humedad') }}
                                        <input type="text"  class="form-control" name="humedad" value="{{ $analisis->humedad }}" readonly>
                                    </div><!--form-group-->

                                </div>

                                <div class="row">
                                
                                    <div class="form-group col-md-5">
                                        {{ html()->label('Mg')->for('mg') }}
                                        <input type="number" min="0" step="any" class="form-control" name="mg" value="{{ $analisis->mg }}" readonly>
                                         
                                         
                                    </div>
                                
                                    <div class="form-group col-md-5 col-md-push-1">
                                       
                                    </div><!--form-group-->

                                </div>

                                 <div class="row">
                                
                                    <div class="form-group col-md-5">
                                        {{ html()->label('Na')->for('na') }}
                                        <input type="number" min="0" step="any" class="form-control" name="na" value="{{ $analisis->na }}" readonly>
                                         
                                         
                                    </div>
                                
                                    <div class="form-group col-md-5 col-md-push-1">
                                       
                                    </div><!--form-group-->

                                </div>

                                <div class="row">
                                
                                    <div class="form-group col-md-5">
                                        {{ html()->label('Ca')->for('ca') }}
                                        <input type="number" min="0" step="any" class="form-control" name="ca" value="{{ $analisis->ca }}" readonly>
                                         
                                         
                                    </div>
                                
                                    <div class="form-group col-md-5 col-md-push-1">
                                       
                                    </div><!--form-group-->

                                </div>

                                <div class="row">
                                
                                    <div class="form-group col-md-5">
                                        {{ html()->label('C')->for('c') }}
                                        <input type="number" min="0" step="any" class="form-control" name="c" value="{{ $analisis->c }}" readonly>
                                         
                                         
                                    </div>
                                
                                    <div class="form-group col-md-5 col-md-push-1">
                                       
                                    </div><!--form-group-->

                                </div>

                                <div class="row">
                                
                                    <div class="form-group col-md-5">
                                        {{ html()->label('Nitrogéno Orgánico')->for('nitro_organico') }}
                                        <input type="number" min="0" step="any" class="form-control" name="nitro_organico" value="{{ $analisis->nitro_organico }}" readonly>
                                         
                                         
                                    </div>
                                
                                    <div class="form-group col-md-5 col-md-push-1">
                                       
                                    </div><!--form-group-->

                                </div>

                                <div class="row">
                                
                                    <div class="form-group col-md-5">
                                        {{ html()->label('NO3')->for('no3') }}
                                        <input type="number" min="0" step="any" class="form-control" name="no3" value="{{ $analisis->no3 }}" readonly>
                                         
                                         
                                    </div>
                                
                                    <div class="form-group col-md-5 col-md-push-1">
                                       
                                    </div><!--form-group-->

                                </div>


                                <div class="row">
                                
                                    <div class="form-group col-md-5">
                                        {{ html()->label('Rel. C/N')->for('rel_cn') }}
                                        <input type="number" min="0" step="any" class="form-control" name="rel_cn" readonly value="{{ $analisis->rel_cn }}" >
                                         
                                         
                                    </div>
                                
                                    <div class="form-group col-md-5 col-md-push-1">
                                       
                                    </div><!--form-group-->

                                </div>

                                <div class="row">
                                
                                    <div class="form-group col-md-5">
                                        {{ html()->label('Mat. Orgánica')->for('mat_organica') }}
                                        <input type="number" min="0" step="any" class="form-control" name="mat_organica" readonly value="{{ $analisis->mat_organica }}" >
                                         
                                         
                                    </div>
                                
                                    <div class="form-group col-md-5 col-md-push-1">
                                       
                                    </div><!--form-group-->

                                </div>


                                <div class="row">
                                    <div class="form-group col-md-12">
                                        {{ html()->label('Observaciones')->for('observaciones') }}
                                        <textarea class="summernote" id="observaciones" name="observaciones" title="Observaciones">{{ $analisis->observaciones }}</textarea>
                                    </div>
                                </div>


                                 
                                                 

                                
                                <div class="mail-body text-right tooltip-demo">
                                                        
                                <a class="btn btn-white btn-sm" href="{{route('admin.analisis_suelo.index')}}" >@lang('buttons.general.cancel')</a>
                                
                                
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
    
     $("#campo_id").change(function () {

        $.ajax({
            url: "{{ url('admin/analisis_suelo/getCuarteles') }}",
            type: 'get',
            dataType: 'json',
            data: {"campo_id": $("#campo_id").val()},
            success: function (rta) {
                $('#cuartel_id').empty();
                $('#cuartel_id').append("<option value='' disabled selected style='display:none;'>Seleccione Cuartel</option>");
                $.each(rta, function (index, value) {
                    $('#cuartel_id').append("<option value='" + value.id + "'>" + value.nombre + "</option>");
                });
            }
        });
    });

     $("#empresa_id").change(function () {

        $.ajax({
            url: "{{ url('admin/analisis_suelo/getCampos') }}",
            type: 'get',
            dataType: 'json',
            data: {"empresa_id": $("#empresa_id").val()},
            success: function (rta) {
                
                $('#cuartel_id').empty();
                $('#cuartel_id').append("<option value='' disabled selected style='display:none;'>Seleccione Cuartel</option>");


                $('#campo_id').empty();
                $('#campo_id').append("<option value='' disabled selected style='display:none;'>Seleccione Campo</option>");
                $.each(rta, function (index, value) {
                    $('#campo_id').append("<option value='" + value.id + "'>" + value.nombre + "</option>");
                });
            }
        });
    });


</script>
@endsection
