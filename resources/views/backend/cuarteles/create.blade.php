@extends('backend.layouts.app')

@section('title', 'Cuarteles '))

@section('content')
{{ html()->form('POST', route('admin.cuarteles.store'))->class('form-horizontal')->open() }}
<div>
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>
                Administrador de Cuarteles
                <small class="text-muted">
                    Crear Cuarteles
                </small>
            </h5>
        </div>
        <input type="hidden" name="coordenadas" id="coordenadas" >
        <input type="hidden" name="ubiq_lat" id="ubiq_lat" >
        <input type="hidden" name="ubiq_lng" id="ubiq_lng" >
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
                    <div class="form-group col-md-5 col-md-push-1">
                        {{ html()->label('Campo')->for('campo_id') }}
                                     {{ html()->select('campo_id', $campos,null)
                                        ->placeholder('Seleccione Campo', false)
                                        ->class('form-control  chosen-select')
                                        ->required()
                                        ->id('campo_id') }}
                    </div>
                    <!--form-group-->
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
                    <div class="form-group col-md-5">
                        {{ html()->label('Tamaño (Hectareas)')->for('name') }}
                        <div class="input-group">
                             <input class="form-control" id="tamanno" min="0" name="tamanno" required="" step="any" type="number"> 
                            <span class="input-group-btn"><a class="btn btn-primary" data-target="#mapa" data-toggle="modal" title="Calcular usando Google Maps" type="button">
                                Medir
                            </a></span></div>
                    </div>
                    <div class="form-group col-md-5 col-md-push-1">
                        {{ html()->label('Tipo Cultivo')->for('campo_id') }}
                                     {{ html()->select('tipo_cultivo_id', $tipoCultivos,null)
                                        ->placeholder('Seleccione Tipo de Cultivo', false)
                                        ->class('form-control chosen-select')
                                        ->id('tipo_cultivo_id') }}
                    </div>
                    <!--form-group-->
                </div>
                <div class="row">
                    <div class="form-group col-md-5">
                        {{ html()->label('Propio')->for('propio') }}
                        {{ html()->select('propio', $propio,null)
                            ->placeholder('Seleccione Propiedad', false)
                            ->class('form-control chosen-select')
                            ->required()
                            ->id('propio') }}

                        
                    </div>
                    <div class="form-group col-md-5 col-md-push-1">
                        {{ html()->label('Productivo')->for('productivo') }}
                        {{ html()->select('productivo', $productivo,null)
                            ->placeholder('Seleccione Producción', false)
                            ->class('form-control chosen-select')
                            ->required()
                            ->id('productivo') }}

                        
                    </div>
                    <!--form-group-->
                </div>
                <div class="row">
                    <div class="form-group col-md-12">
                        {{ html()->label('Descripción')
                                            ->for('name') }}
                        <textarea class="summernote" id="descripcion" name="descripcion" title="Descripcion">
                        </textarea>
                    </div>
                </div>
                <div class="mail-body text-right tooltip-demo">
                    <a class="btn btn-white btn-sm" href="{{route('admin.cuarteles.index')}}">
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

    $('#productivo').change(function(){
   
    var productivo=$('#productivo').val();
        if(productivo==1){
            $('#tipo_cultivo_id').prop("required", true);
        }else{
            $('#tipo_cultivo_id').removeAttr("required");
        }

    
    $('#tipo_cultivo_id').trigger("chosen:updated");

    });



    var pacContainerInitialized = false; 
   $('#pac-input').keypress(function() { 
        if (!pacContainerInitialized) { 
            $('.pac-container').css('z-index','9999'); 
            pacContainerInitialized = true; 
        } 
    });


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
                $('#comuna_id').trigger("chosen:updated");
            }
        });
    });
</script>
@endsection
@include('backend.cuarteles.modal')
