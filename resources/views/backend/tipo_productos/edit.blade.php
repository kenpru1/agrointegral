@extends('backend.layouts.app')

@section('title', 'Tipo Productos | Editar' )

@section('content')
{{ html()->modelForm($tipoProducto, 'PATCH', route('admin.tipo_productos.update',$tipoProducto))->class('form-horizontal')->open() }}
      <div>
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Administración de Tipo Productos
                                <small class="text-muted">Editar</small>
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
                                            ->attribute('maxlength', 191)
                                            ->required()
                                            ->autofocus() }}
                                    
                                </div>

                               </div>

                             
                                <div class="mail-body text-right tooltip-demo">
                                                        
                                    <a class="btn btn-white btn-sm" href="{{route('admin.tipo_productos.index')}}" >@lang('buttons.general.cancel')</a>
                                    <button class="btn btn-sm btn-primary" type="submit">Editar Tipo Producto</button>
                                
                                </div>



                                
                            </form>
                        </div>
                    </div>
                </div>
{{ html()->form()->close() }}
@endsection
