 <div class="form-group"><label class="col-sm-2 control-label">Año Fabricación:</label>
                                                <div class="col-sm-10"><input type="text" class="form-control" name="anno_fabricacion" placeholder="Año" value="{{isset($publicacion->anno_fabricacion) ? $publicacion->anno_fabricacion : null}}"></div>
                                            </div>
                                            <div class="form-group"><label class="col-sm-2 control-label">Modelo:</label>
                                                <div class="col-sm-10"><input type="text" name="modelo" class="form-control" value="{{isset($publicacion->modelo) ? $publicacion->modelo : null}}" placeholder="..."></div>
                                            </div>
                                            <div class="form-group"><label class="col-sm-2 control-label">Provincia:</label>
                                                <div class="col-sm-10">
                                                    {{ html()->select('provincia_id', $provincias,isset($publicacion->provincia_id) ? $publicacion->provincia_id : null)
                                                        ->placeholder('Seleccione Provincia', false)
                                                        ->class('form-control chosen-select')
                                                        ->id('provincia_id') }}

                                                </div>
                                            </div>
                                            <div class="form-group"><label class="col-sm-2 control-label">Comuna:</label>
                                                <div class="col-sm-10">
                                                   {{ html()->select('comuna_id',isset($comunas) ? $comunas : null,isset($publicacion->comuna_id) ? $publicacion->comuna_id : null)
                                                       ->placeholder('Seleccione Comuna', false)
                                                       ->class('form-control chosen-select')
                                                       ->id('comuna_id') }}
                                                </div>
                                            </div>
                                            <div class="form-group"><label class="col-sm-2 control-label">Cantidad:</label>
                                                <div class="col-sm-10"><input type="text" name="cantidad" class="form-control" placeholder="Cantidad" value="{{isset($publicacion->cantidad) ? $publicacion->cantidad : null}}"></div>
                                            </div>
                                            <div class="form-group"><label class="col-sm-2 control-label">Envio:</label>
                                                <div class="col-sm-10">
                                                    {{ html()->select('tipo_envio_id', $tipoEnvios,isset($publicacion->tipo_envio_id) ? $publicacion->tipo_envio_id : null)
                                                       ->placeholder('Seleccione Envio', false)
                                                       ->class('form-control chosen-select')
                                                       ->id('tipo_envio_id') }}

                                                </div>
                                            </div>
                                            <div class="form-group"><label class="col-sm-2 control-label">Orden Mínima:</label>
                                                <div class="col-sm-10"><input type="text" name="orden_minima" class="form-control" value="{{isset($publicacion->orden_minima) ? $publicacion->orden_minima : null}}" placeholder="..."></div>
                                            </div>
                                           
                                            <div class="form-group"><label class="col-sm-2 control-label">Estado:</label>
                                                <div class="col-sm-10">
                                                    
                                                @if($create==1)
                                                    <select name="estado_publicacion_id" class="form-control" >
                                                        <option value="1">Publicado</option>
                                                        
                                                    </select>
                                                @endif
                                                @if($create==0)
                                                    {{ html()->select('estado_publicacion_id', $edoPublicacion,isset($publicacion->estado_publicacion_id) ? $publicacion->estado_publicacion_id : null)
                                                       ->placeholder('Seleccione Estado', false)
                                                       ->class('form-control chosen-select')
                                                       ->id('estado_publicacion_id') }}
                                                @endif       
                                                </div>
                                            </div>