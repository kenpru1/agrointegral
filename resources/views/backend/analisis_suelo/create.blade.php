@extends('backend.layouts.app')

@section('title', 'Análisis Suelo | Crear')

@section('content')
{{ html()->form('POST', route('admin.analisis_suelo.store'))->class('form-horizontal')->open() }}
   
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Administrador de Análisis de Suelo
                                <small class="text-muted">Crear Análisis</small>
                            </h5>
                            
                        </div>
                        <div class="ibox-content">
                            <form class="form-horizontal">

                                <div class="wrapper wrapper-content animated fadeInRight ecommerce">

            <div class="row">
                <div class="col-lg-12">
                    <div class="tabs-container">
                            <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#tab-general"> General</a></li>
                                <li class=""><a data-toggle="tab" href="#tab-fisicos"> Datos Físicos</a></li>
                                <li class=""><a data-toggle="tab" href="#tab-quimicos"> Datos Químicos</a></li>
                                                            
                            </ul>
                            <div class="tab-content">
                                <div id="tab-general" class="tab-pane active">
                                    <div class="panel-body">

                                        <fieldset class="form-horizontal">
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
                                        
                                <div class="row">
                                <div class="form-group col-md-5">
                                    {{ html()->label('Fecha')->for('fecha') }}
                                    <input type="date" class="form-control" name="fecha" value="{{isset($analisis->fecha)?$analisis->fecha->format('Y-m-d'):null}}" required>

                                    
                                </div>

                                <div class="form-group col-md-5 col-md-push-1">
                                    {{ html()->label('Unidad')->for('unidad_id') }}
                                     {{ html()->select('unidad_id', $unidades,null)
                                        ->placeholder('Seleccione Unidad', false)
                                        ->class('form-control chosen-select')
                                        ->required()
                                        ->id('unidad_id') }}
                                </div><!--form-group-->
                                                                     
                                </div>
                               
                               

                               <div class="row">
                                
                                <div class="form-group col-md-5">
                                     {{ html()->label('Campo')->for('campo_id') }}
                                     {{ html()->select('campo_id', $campos,null)
                                        ->placeholder('Seleccione Campo', false)
                                        ->class('form-control chosen-select')
                                        ->id('campo_id') }}
                                </div>
                                
                                <div class="form-group col-md-5 col-md-push-1">
                                     {{ html()->label('Profundidad Desde (Cm)')->for('prof_desde') }}
                                    <input type="number" min="0" step="any" class="form-control" name="prof_desde" required>
                                </div><!--form-group-->

                                </div>

                                <div class="row">
                                
                                    <div class="form-group col-md-5">
                                        {{ html()->label('Cuarteles')->for('cuartel_id') }}
                                         {{ html()->select('cuartel_id', null,null)
                                              ->placeholder('Seleccione Cuartel', false)
                                              ->class('form-control chosen-select')
                                              ->required()
                                              ->id('cuartel_id') }}
                                         
                                    </div>
                                
                                    <div class="form-group col-md-5 col-md-push-1">
                                        {{ html()->label('Profundidad Hasta (Cm)')->for('prof_hasta') }}
                                        <input type="number" min="0" step="any" class="form-control" name="prof_hasta" required>
                                    </div><!--form-group-->

                                </div>
                                 <div class="row">
                                
                                    <div class="form-group col-md-5">
                                        {{ html()->label('Sector')->for('sector') }}
                                        <input type="text" name="sector" class="form-control">
                                        
                                         
                                    </div>
                                
                                    <div class="form-group col-md-5 col-md-push-1">
                                        
                                    </div><!--form-group-->

                                </div>
                                <div class="row">
                                            <div class="form-group col-md-12">
                                                {{ html()->label('Observaciones')->for('observaciones') }}
                                                <textarea class="summernote" id="observaciones" name="observaciones" title="Observaciones"></textarea>
                                            </div>
                                        </div>
                                        </fieldset>

                                    </div>
                                </div>
                                <div id="tab-fisicos" class="tab-pane">
                                    <div class="panel-body">

                                        <fieldset class="form-horizontal">
                                              <div class="row">
                                
                                   
                                
                                    <div class="form-group col-md-5 col-md-push-1">
                                        <h3>Datos Físicos</h3>
                                    </div><!--form-group-->

                                </div>

                                <div class="row">
                                
                                    <div class="form-group col-md-5 col-md-push-1">
                                        {{ html()->label('Arcilla')->for('arcilla') }}
                                        <input type="text"  class="form-control" name="arcilla">
                                    </div><!--form-group-->
                                    <div class="form-group col-md-5 col-md-push-2">
                                        {{ html()->label('Arena')->for('arena') }}
                                        <input type="text"  class="form-control" name="arena">
                                        
                                    </div>
                                
                                    

                                </div>

                                <div class="row">
                                
                                    <div class="form-group col-md-5 col-md-push-1">
                                        {{ html()->label('Limo')->for('limo') }}
                                        <input type="text"  class="form-control" name="limo">
                                    </div><!--form-group-->
                                    <div class="form-group col-md-5 col-md-push-2">
                                        {{ html()->label('Cond. Eléctrica')->for('cod_electrica') }}
                                        <input type="text"  class="form-control" name="cond_electrica">
                                        
                                    </div>
                 
                                </div>

                                <div class="row">
                                
                                    <div class="form-group col-md-5 col-md-push-1">
                                        {{ html()->label('Humedad')->for('humedad') }}
                                        <input type="text"  class="form-control" name="humedad">
                                    </div><!--form-group-->
                                    <div class="form-group col-md-5">
                                       
                                    </div>
                                

                                </div>
                              </fieldset>


                                    </div>
                                </div>
                                

                 <!--Datos Quimicos -->

                                <div id="tab-quimicos" class="tab-pane">
                                    <div class="panel-body">
                                         <fieldset>
                                            <div class="row">
                                
                                    <div class="form-group col-md-5 col-md-push-1">
                                       <h3>Datos Químicos</h3>
                                         
                                    </div>
                             

                                </div>

                                <div class="row">
                                
                                    <div class="form-group col-md-5 col-md-push-1">
                                        {{ html()->label('Ph')->for('ph') }}
                                        <input type="number" min="0" step="any" class="form-control" name="ph">
                                         
                                         
                                    </div>
                                
                                    <div class="form-group col-md-5 col-md-push-2">
                                        {{ html()->label('N (ppm)')->for('n') }}
                                        <input type="number" min="0" step="any" class="form-control" name="n">
                                        
                                    </div><!--form-group-->

                                </div>

                                <div class="row">
                                
                                    <div class="form-group col-md-5 col-md-push-1">
                                        {{ html()->label('P (ppm)')->for('p') }}
                                        <input type="number" min="0" step="any" class="form-control" name="p">
                                         
                                         
                                    </div>
                                
                                    <div class="form-group col-md-5 col-md-push-2">
                                        {{ html()->label('K (ppm)')->for('k') }}
                                        <input type="number" min="0" step="any" class="form-control" name="k">
                                       
                                    </div><!--form-group-->

                                </div>

                                

                                <div class="row">
                                
                                    <div class="form-group col-md-5 col-md-push-1">
                                        {{ html()->label('S (ppm)')->for('s') }}
                                        <input type="number" min="0" step="any" class="form-control" name="s">
                                         
                                         
                                    </div>
                                
                                    <div class="form-group col-md-5 col-md-push-2">
                                        {{ html()->label('Mg')->for('mg') }}
                                        <input type="number" min="0" step="any" class="form-control" name="mg">
                                    </div><!--form-group-->

                                </div>

                                 <div class="row">
                                
                                    <div class="form-group col-md-5 col-md-push-1">
                                        {{ html()->label('Na')->for('na') }}
                                        <input type="number" min="0" step="any" class="form-control" name="na">
                                         
                                         
                                    </div>
                                
                                    <div class="form-group col-md-5 col-md-push-2">
                                        {{ html()->label('Ca')->for('ca') }}
                                        <input type="number" min="0" step="any" class="form-control" name="ca">
                                       
                                    </div><!--form-group-->

                                </div>

                                <div class="row">
                                
                                    <div class="form-group col-md-5 col-md-push-1">
                                        {{ html()->label('C')->for('c') }}
                                        <input type="number" min="0" step="any" class="form-control" name="c">
                                         
                                         
                                    </div>
                                
                                    <div class="form-group col-md-5 col-md-push-2">
                                        {{ html()->label('Nitrogéno Orgánico')->for('nitro_organico') }}
                                        <input type="number" min="0" step="any" class="form-control" name="nitro_organico">
                                       
                                    </div><!--form-group-->

                                </div>

                                <div class="row">
                                
                                    <div class="form-group col-md-5 col-md-push-1">
                                        {{ html()->label('NO3')->for('no3') }}
                                        <input type="number" min="0" step="any" class="form-control" name="no3">
                                         
                                         
                                    </div>
                                
                                    <div class="form-group col-md-5 col-md-push-2">
                                       {{ html()->label('Rel. C/N')->for('rel_cn') }}
                                        <input type="number" min="0" step="any" class="form-control" name="rel_cn">
                                    </div><!--form-group-->

                                </div>

                                <div class="row">
                                
                                    <div class="form-group col-md-5 col-md-push-1">
                                        {{ html()->label('Mat. Orgánica')->for('mat_organica') }}
                                        <input type="number" min="0" step="any" class="form-control" name="mat_organica">
                                         
                                         
                                    </div>
                                
                                    <div class="form-group col-md-5 col-md-push-1">
                                       
                                    </div><!--form-group-->

                                </div>
                                        </fieldset>
                                </div>
                                

                                </div>
                 <!--Datos Quimicos -->
                            
                                </div>
                              
                            </div>
                    </div>
                </div>
            </div>

        </div>
                             

                                 
                                                 

                                
                                <div class="mail-body text-right tooltip-demo">
                                    <a class="btn btn-white btn-sm" href="{{route('admin.analisis_suelo.index')}}" >@lang('buttons.general.cancel')</a>
                                    <button class="btn btn-sm btn-primary" type="submit">Guardar</button>
                                </div>



                                
                            </form>
                    


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
                $('#cuartel_id').trigger("chosen:updated");
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
