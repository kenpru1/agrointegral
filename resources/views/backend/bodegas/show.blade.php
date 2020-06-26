@extends('backend.layouts.app')

@section('title', __('labels.backend.access.permissions.management') . ' | Editar' )

@section('content')
{{ html()->modelForm($bodega, 'PATCH', route('admin.bodegas.update',$bodega))->class('form-horizontal')->open() }}
<div>
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Administrador de Bodegas
                                <small class="text-muted">Ver Bodegas</small>
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
                                            ->readonly()
                                            ->autofocus() }}
                                    
                                </div>

                                <div class="form-group col-md-5 col-md-push-1">
                                   {{ html()->label('Dirección')->for('name') }}
                                    <input type="text" class="form-control" name="direccion" maxlength="190" value="{{ $bodega->direccion }}" readonly>
                                    
                                </div>
                               
                                </div>

                               <div class="row">
                                
                                <div class="form-group col-md-5">
                                     {{ html()->label('Campo')->for('campo_id') }}
                                     {{ html()->select('campo_id', $campos,null)
                                        ->placeholder('Seleccione Campo', false)
                                        ->class('form-control')
                                        ->attribute('disabled')
                                        ->id('campo_id') }}
                                </div><!--form-group-->

                                <div class="form-group col-md-5 col-md-push-1">
                                     {{ html()->label('Provincias')->for('provincia_id') }}
                                     {{ html()->select('provincia_id', $provincias,null)
                                        ->placeholder('Seleccione Provincia', false)
                                        ->class('form-control')
                                        ->required()
                                        ->attribute('disabled')
                                        ->id('provincia_id') }}
                                </div><!--form-group-->

                               
                                </div>
                               <div class="row">
                                
                                <div class="form-group col-md-5">
                                     {{ html()->label('Comunas')->for('comuna_id') }}
                                     {{ html()->select('comuna_id', $comuna,null)
                                          ->placeholder('Seleccione Comuna', false)
                                          ->class('form-control')
                                          ->required()
                                          ->attribute('disabled')
                                          ->id('comuna_id') }}
                                </div><!--form-group-->

                                <div class="form-group col-md-5 col-md-push-1">
                                     {{ html()->label('Propiedad')->for('propio') }}
                                     {{ html()->select('propio', $propiedad,null)
                                          ->placeholder('Seleccione Propiedad', false)
                                          ->class('form-control')
                                          ->required()
                                          ->attribute('disabled')
                                          ->id('propio') }}
                                </div>

                               </div>


                             
                                {{--<div class="row">
                                    
                                    <div class="form-group col-md-5 ">
                                        <input type="checkbox" name="propio" value="1" {{isset($bodega->propio)&&$bodega->propio==1?'checked':''}} /> Propio
                                    </div>
                                     
                                </div>--}}
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        {{ html()->label('Descripción')->for('name') }}
                                         <textarea class="summernote" id="descripcion" name="descripcion" title="Descripcion">
                                             {{ $bodega->descripcion }}
                                         </textarea>
                                    </div>
                                </div>

                                 
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

                               <div class="mail-body text-right tooltip-demo">
                                                        
                                <a class="btn btn-white btn-sm" href="{{route('admin.bodegas.index')}}" >@lang('buttons.general.cancel')</a>
                                
                                
                                
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
     $("#provincia_id").change(function () {

        $.ajax({
            url: "{{ url('admin/getComunas') }}",
            type: 'get',
            dataType: 'json',
            data: {"provincia_id": $("#provincia_id").val()},
            success: function (rta) {
                $('#comuna_id').empty();
                $('#comuna_id').append("<option value='' disabled selected style='display:none;'>Seleccione Comuna</option>");
                $.each(rta, function (index, value) {
                    $('#comuna_id').append("<option value='" + value.id + "'>" + value.nombre + "</option>");
                });
            }
        });
    });


</script>
@endsection
