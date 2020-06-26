@extends('backend.layouts.app')

@section('title', 'Raciones ')

@section('content')
{{ html()->form('POST', route('admin.raciones.store'))->class('form-horizontal')->open() }}
<div class="col-lg-12">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>
                Administrador de Raciones
                <small class="text-muted">
                    
                </small>
            </h5>
        </div>
        <div class="ibox-content">
            <form class="form-horizontal">
                {{--<input name="animal_id" type="hidden" value="{{$animal->id}}">--}}

               <div class="row">
                    <div class="form-group col-md-5">
                        {{ html()->label('Tipo Aplicación')->for('tipo_aplicacion') }}
                        {{ html()->select('tipo_aplicacion', $tipoAp,null)
                            ->placeholder('Seleccione Tipo Aplicación', false)
                            ->class('form-control chosen-select')
                            ->required()
                            ->id('tipo_aplicacion') }}
                        
                    </div>
                    <div class="form-group col-md-5 col-md-push-1">
                        
                        
                    </div>

                    
                </div>

               <div class="row">
                    <div class="form-group col-md-5">
                        {{ html()->label('Responsable')->for('responsable') }}
                        {{ html()->select('trabajador_id', $trabajadores,null)
                            ->placeholder('Seleccione Responsable', false)
                            ->class('form-control chosen-select')
                            ->required()
                            ->id('trabajador_id') }}
                        
                    </div>
                    <div class="form-group col-md-5 col-md-push-1">
                        <div id="div_animal">
                            {{ html()->label('Animales')->for('animal_id') }}
                            {{ html()->select('animal_id', $animales,null)
                                ->placeholder('Seleccione Animal', false)
                                ->class('form-control chosen-select')
                                ->required()
                                ->id('animal_id') }}
                        </div>
                        <div id="div_rodeo">
                            {{ html()->label('Rodeos')->for('rodeo_id') }}
                            {{ html()->select('rodeo_id', $rodeos,null)
                                ->placeholder('Seleccione Rodeos', false)
                                ->class('form-control chosen-select')
                                ->required()
                                ->id('rodeo_id') }}
                        </div>
                        
                    </div>

                    
                </div>


                <div class="row">
                    <div class="form-group col-md-5">
                        {{ html()->label('Fecha ')->for('fecha') }}
                        <input type="date" class="form-control" name="fecha" value="{{ date('Y-m-d') }}">
                        
                    </div>
                    <div class="form-group col-md-5 col-md-push-1">
                        {{ html()->label('Tipo Ración')->for('tipo_racion_id') }}
                         {{ html()->select('tipo_racion_id', $tipoRac,null)
                            ->placeholder('Seleccione Tipo Sanitario', false)
                            ->class('form-control chosen-select')
                            ->required()
                            ->id('tipo_racion_id') }}
                           
                    </div>
                    
                    
                </div>
                <div class="row">
                    <div class="form-group col-md-5">
                        {{ html()->label('Nombre')->for('nombre') }}
                        <input type="text" class="form-control" name="nombre" maxlength="100">
                    </div>

                    
                </div>
                

                 <div class="row">
                    <div class="form-group col-md-12">
                        {{ html()->label('Descripción')->for('descripcion') }}
                        <textarea class="summernote" id="descripcion" name="descripcion" title="Descripción"></textarea>
                    </div>
                </div>

                </input>
            </form>
        </div>
        <div class="mail-body text-right tooltip-demo">
            <a class="btn btn-white btn-sm" href="{{route('admin.raciones.index')}}">
                @lang('buttons.general.cancel')
            </a>
            <button class="btn btn-sm btn-primary" type="submit">
                Guardar
            </button>
        </div>
    </div>
</div>
{{ html()->form()->close() }}
@endsection
@section('scripts')
<script>
    /*Estatdo  carga inicial del formulario*/
    $('#div_animal').hide();
    $('#div_rodeo').hide();
    $('#animal_id').removeAttr("required");
    $('#rodeo_id').removeAttr("required");
    $('#animal_id').trigger("chosen:updated");
    $('#rodeo_id').trigger("chosen:updated");
    /*Estatdo  carga inicial del formulario*/

    //cambios al seleccionar si es animal o rodeo
    $('#tipo_aplicacion').change(function(){
        var tipoAp=$('#tipo_aplicacion').val();
        //Individual
        if(tipoAp==1){
            $('#rodeo_id').val("0");
            $('#div_animal').show();
            $('#div_rodeo').hide();
            $('#animal_id').prop("required", true);
            $('#rodeo_id').removeAttr("required");
            $('#animal_id').trigger("chosen:updated");
            $('#rodeo_id').trigger("chosen:updated");
            

        }
        //Rodeo
        if(tipoAp==2){
            $('#animal_id').val("0");
            $('#div_animal').hide();
            $('#div_rodeo').show();
            $('#rodeo_id').prop("required", true);
            $('#animal_id').removeAttr("required");
            $('#animal_id').trigger("chosen:updated");
            $('#rodeo_id').trigger("chosen:updated");
            
        }
        //cambios al seleccionar si es animal o rodeo

    });




$('#descripcion').summernote({
        height: 150,
    });
</script>
@endsection
