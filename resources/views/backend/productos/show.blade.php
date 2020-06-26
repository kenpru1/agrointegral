@extends('backend.layouts.app')

@section('title',  'Productos | Mostrar' )

@section('content')
{{ html()->modelForm($producto, 'PATCH', route('admin.productos.update',$producto))->class('form-horizontal')->attribute('enctype', 'multipart/form-data')->open() }}
      <div >
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Administración de Productos
                                <small class="text-muted">Crear</small>
                            </h5>
                            
                        </div>
                        <div class="ibox-content">
                            <form class="form-horizontal">
                               <div class="row">
                                <div class="form-group col-md-5">
                                    {{ html()->label(__('validation.attributes.backend.access.permissions.name'))
                                ->for('name') }}

                                  
                                        {{ html()->text('nombre')
                                            ->class('form-control')
                                            ->placeholder(__('validation.attributes.backend.access.permissions.name'))
                                            ->attribute('maxlength', 100)
                                            ->required()
                                            ->readonly()
                                           ->autofocus() }}
                           
                                </div>
                                <div class="form-group col-md-5 col-md-push-1">
                                     {{ html()->label('Unidad')->for('unidad_id') }}
                                     {{ html()->select('unidad_id', $unidades,null)
                                          ->placeholder('Seleccione Unidad', false)
                                          ->class('form-control chosen-select')
                                          ->required()
                                          ->attribute('disabled')
                                          ->id('unidad_id') }}
                                </div><!--form-group-->
                               

                                </div>
                               <div class="row">
                           

                                

                                <div class="form-group col-md-5">
                                    {{ html()->label('Composición')->for('composicion') }}

                                    {{ html()->text('composicion')
                                        ->class('form-control')
                                        ->placeholder('Composición')
                                        ->attribute('maxlength', 100)
                                        ->readonly()
                                        ->autofocus() }}
                                </div>
                                <div class="form-group col-md-5 col-md-push-1">
                                    {{ html()->label('Proveedor')->for('empresa_id') }}
                                    {{ html()->select('cliente_proveedor_id', $clienProv,null)
                                        ->placeholder('Seleccione Proveedor', false)
                                        ->class('form-control chosen-select')
                                        ->attribute('disabled')
                                        ->id('cliente_proveedor_id') }}
                                </div>

                               </div>

                              <div class="row">
                                  <div class="form-group col-md-5 ">
                                      {{ html()->label('Ficha Técnica')->for('ficha_tecnica') }}
                                    
                                      <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                          <div class="form-control" data-trigger="fileinput">
                                              <i class="glyphicon glyphicon-file fileinput-exists"></i>
                                                 <span class="fileinput-filename"></span>
                                          </div>
                                        <span class="input-group-addon btn btn-default btn-file">
                                            <span class="fileinput-new">Seleccione Archivo</span>
                                            <span class="fileinput-exists">Cambiar</span>
                                            <input type="file" name="ficha_tecnica"/>
                                        </span>
                                         <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Quitar</a>
                                      </div> 
                                      @if($producto->ficha_tecnica!=null)
                                   <div class="btn-group btn-group-sm">
                                        <a href="{{asset($producto->ficha_tecnica)}}" title="Descargar" class="btn btn-primary" target="_blank"><i class="fa fa-arrow-down"></i> </a>
                                    </div>
                                    @endif

                                </div>
                               
                                <div class="form-group col-md-5 col-md-push-1">
                                     {{ html()->label('Estado Venta')->for('estado_venta_id') }}
                                     {{ html()->select('estado_venta_id', $estadoVentas,null)
                                          ->placeholder('Seleccione Estado', false)
                                          ->class('form-control chosen-select')
                                          ->required()
                                          ->attribute('disabled')
                                          ->id('estado_venta_id') }}
                                </div><!--form-group-->

                                </div>


                                <div class="row">
                                
                                <div class="form-group col-md-5 ">
                                    {{ html()->label('Precio Venta')->for('precio_venta') }}
                                    <input type="number" class="form-control" name="precio_venta" min="0" step="any" value="{{$producto->precio_venta}}" readonly>
                                </div>
                                <div class="form-group col-md-5 col-md-push-1">
                                    {{ html()->label('Precio Compra')->for('precio_compra') }}
                                    <input type="number" class="form-control" name="precio_compra" min="0" step="any" value="{{$producto->precio_compra}}" readonly>
                                </div>

                                </div>

                                <div class="row">
                                <div class="form-group col-md-5">

                                    {{ html()->label('Tipo Producto')->for('tipoproducto_id') }}
                                    {{ html()->select('tipo_producto_id', $tipoProductos,null)
                                          ->placeholder('Seleccione Tipo Producto', false)
                                          ->class('form-control chosen-select')
                                          ->attribute('disabled')
                                          ->required()
                                          ->id('tipo_producto_id') }}
                                    
                           
                                </div>
                                <div class="form-group col-md-5 col-md-push-1">
                                     
                                </div><!--form-group-->
                               

                                </div>

                                @if($logged_in_user->hasRole('administrator'))
                                    <div class="row">
                                        <div class="form-group col-md-5 ">
                                            {{ html()->label('Empresa')->for('empresa_id') }}
                                            {{ html()->select('empresa_id', $empresas,null)
                                                ->placeholder('Seleccione Empresa', false)
                                                ->class('form-control chosen-select')
                                                ->required()
                                                ->attribute('disabled')
                                                ->id('empresa_id') }}
                                        </div><!--form-group-->
                                    </div>
                               @endif
                                                         

                                
                                <div class="mail-body text-right tooltip-demo">
                                                        
                                <a class="btn btn-white btn-sm" href="{{route('admin.productos.index')}}" >@lang('buttons.general.cancel')</a>
                             
                                
                            </div>



                                
                            </form>
                        </div>
                    </div>
                </div>

{{ html()->form()->close() }}
@endsection
