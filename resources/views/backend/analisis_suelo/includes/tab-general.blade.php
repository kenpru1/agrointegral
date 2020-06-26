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