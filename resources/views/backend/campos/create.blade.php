@extends('backend.layouts.app')

@section('title',  'Campos | ' . __('labels.backend.access.campos.create'))

@section('content')
{{ html()->form('POST', route('admin.campos.store'))->class('form-horizontal')->open() }}
<div>
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>
                Administración de Campos
                <small class="text-muted">
                    Crear
                </small>
            </h5>
        </div>
        <div class="ibox-content">
            <form class="form-horizontal">
                 <div class="row">
                    <div class="form-group col-md-5 ">
                        {{ html()->label('Cliente')->for('cliente_id') }}
                        {{ html()->select('cliente_proveedor_id', $clientes,null)
                            ->placeholder('Seleccione Cliente', false)
                            ->class('form-control chosen-select')
                            ->required()
                            ->id('cliente_id') }}
                       
                    </div>
                    <!--form-group-->

                    <div class="form-group col-md-5 col-md-push-1">
                        {{ html()->label('Contacto')->for('contacto_id') }}
                        {{ html()->select('empresa_contacto_id', null,null)
                            ->placeholder('Seleccione Contacto', false)
                            ->class('form-control chosen-select')
                            ->required()
                            ->id('contacto_id') }}
                    </div>
                       
                    <!--form-group-->                    
                    
                </div>


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
                    <div class="form-group col-md-5 col-md-push-1">
                        {{ html()->label('Seleccione Propiedad')->for('propio') }}
                        {{ html()->select('propio', $propio,null)
                            ->placeholder('Seleccione Propiedad', false)
                            ->class('form-control chosen-select')
                            ->required()
                            ->id('propio') }}

                    <!--form-group-->
                </div>
            </div>
                <div class="row">
                    <div class="form-group col-md-5 ">
                        {{ html()->label('Provincias')->for('provincia_id') }}
                                     {{ html()->select('provincia_id', $provincias,null)
                                        ->placeholder('Seleccione Provincia', false)
                                        ->class('form-control chosen-select')
                                        ->required()
                                        ->id('provincia_id') }}
                    </div>
                    <!--form-group-->
                    <div class="form-group col-md-5 col-md-push-1">
                        {{ html()->label('Comunas')->for('comuna_id') }}
                                     {{ html()->select('comuna_id', null,null)
                                          ->placeholder('Seleccione Comuna', false)
                                          ->class('form-control chosen-select')
                                          ->required()
                                          ->id('comuna_id') }}
                    </div>
                    <!--form-group-->
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
                            ->class('form-control')
                            ->required()
                            ->id('empresa_id') }}
                    </div>
                    <!--form-group-->
                </div>
                @endif
                <div class="mail-body text-right tooltip-demo">
                    <a class="btn btn-white btn-sm" href="{{route('admin.campos.index')}}">
                        @lang('buttons.general.cancel')
                    </a>
                    <button class="btn btn-sm btn-primary" type="submit">
                        Guardar
                    </button>
                    
                </div>
            </form>
        </div>
    </div>
</div>
{{ html()->form()->close() }}
@endsection

@section('scripts')
<script>
    $("#cliente_id").change(function () {

        $.ajax({
            url: "{{ url('admin/getContactos') }}",
            type: 'get',
            dataType: 'json',
            data: {"cliente_proveedor_id": $("#cliente_id").val()},
            success: function (rta) {
                
                $('#contacto_id').empty();
                $('#contacto_id').append("<option value='' disabled selected style='display:none;'>Seleccione Contacto</option>");
                $.each(rta, function (index, value) {
                    $('#contacto_id').append("<option value='" + value.id + "'>" + value.nombres + ' ' + value.apellidos + "</option>");
                });
                $('#contacto_id').trigger("chosen:updated");
            },
            error : function() 
            {
                alert('error...');
            },
        });
    });








    $('#descripcion').summernote({
        height: 150,
    });
    $("#provincia_id").change(function () {

        $.ajax({
            url: "{{ url('admin/getComunas')  }}",
            type: 'get',
            dataType: 'json',
            data: {"provincia_id": $("#provincia_id").val()},
            success: function (rta) {
                $('#comuna_id').empty();
                $('#comuna_id').append("<option value='' disabled selected style='display:none;'>Seleccione Comuna</option>");
                $.each(rta, function (index, value) {
                    $('#comuna_id').append("<option value='" + value.id + "'>" + value.nombre + "</option>");
                });
                $('#comuna_id').trigger("chosen:updated");
            }
        });
    });

</script>
@endsection
