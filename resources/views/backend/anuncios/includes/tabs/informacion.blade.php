<div class="form-group"><label class="col-sm-2 control-label">Título:</label>
                                                <div class="col-sm-10"><input type="text" name="titulo" class="form-control" placeholder="Título" value="{{isset($publicacion->titulo) ? $publicacion->titulo : null}}" required></div>
                                            </div>
                                            <div class="form-group"><label class="col-sm-2 control-label">Precio:</label>
                                                <div class="col-sm-10"><input type="number" min="0" step="any" name="precio" class="form-control" placeholder="$0" value="{{isset($publicacion->precio) ? $publicacion->precio : null}}" required></div>
                                            </div>
                                            <div class="form-group"><label class="col-sm-2 control-label">Descripción:</label>
                                                <div class="col-sm-10">
                                                    <textarea class="summernote" id="descripcion_tab" name="descripcion_tab" title="Descripcion">
                                                        {{isset($publicacion->descripcion) ? $publicacion->descripcion : null}}
                                                    </textarea>
                                                </div>
                                            </div>
                                            <div class="form-group"><label class="col-sm-2 control-label">Clasificación:</label>
                                                <div class="col-sm-10">

                                                    {{ html()->select('clasificacion', $clasificacion,isset($publicacion->clasificacion) ? $publicacion->clasificacion : null )
                                                         ->placeholder('Seleccione Clasificación', false)
                                                         ->class('form-control chosen-select')
                                                         ->id('clasificacion') }}
                                             
                                                </div>
                                            </div>
                                            <div class="form-group productos"><label class="col-sm-2 control-label">Productos</label>
                                                <div class="col-sm-10">
                                                    
                                                    {{ html()->select('producto_id', $productos,isset($publicacion->producto_id) ? $publicacion->producto_id : null)
                                                         ->placeholder('Seleccione Productos', false)
                                                         ->class('form-control chosen-select')
                                                         ->id('producto_id') }}

                                                </div>
                                            </div>

                                            <div class="form-group servicios"><label class="col-sm-2 control-label">Servicios</label>
                                                <div class="col-sm-10">
                                                    
                                                    {{ html()->select('tipo_actividad_id', $servicios,isset($publicacion->tipo_actividad_id) ? $publicacion->tipo_actividad_id : null)
                                                         ->placeholder('Seleccione Servicio', false)
                                                         ->class('form-control chosen-select')
                                                         
                                                         ->id('servicio_id') }}

                                                </div>
                                            </div>

                                            <div class="form-group" id="otro"><label class="col-sm-2 control-label">Otros</label>
                                                <div class="col-sm-10"><input type="text" name="otro"  class="form-control" placeholder="Otros" value="{{isset($publicacion->otro) ? $publicacion->otro : null}}"></div>

                                            </div>
                                           
