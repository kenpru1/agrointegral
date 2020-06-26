@extends('backend.layouts.app')

@section('title',  'Sanitarios | Mostra' )

@section('content')
{{ html()->modelForm($sanitario, 'PATCH', route('admin.sanitarios.update',$sanitario))->class('form-horizontal')->open() }}
<div class="col-lg-12">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>
                Administrador de Sanitario
                <small class="text-muted">
                    {{$sanitario->animal->nombre}}
                </small>
            </h5>
        </div>
        <div class="ibox-content">
            <form class="form-horizontal">
                <input name="animal_id" type="hidden" value="{{$sanitario->animal->id}}">

                
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
                        
                    </div>

                    
                </div>


                <div class="row">
                    <div class="form-group col-md-5">
                        {{ html()->label('Fecha Inicio')->for('fecha_inicio') }}
                        <input type="date" class="form-control" name="fecha_inicio" value="{{isset($sanitario->fecha_inicio)? $sanitario->fecha_inicio->format('Y-m-d'):''}}">
                        
                    </div>
                    <div class="form-group col-md-5 col-md-push-1">
                        {{ html()->label('Fecha Termino')->for('fecha_termino') }}
                        <input type="date" class="form-control" name="fecha_termino" value="{{isset($sanitario->fecha_termino)? $sanitario->fecha_termino->format('Y-m-d'):''}}">
                    </div>

                    
                </div>
                <div class="row">
                    <div class="form-group col-md-5">
                        {{ html()->label('Tipo Sanitario')->for('tipo_sanitario_id') }}
                         {{ html()->select('tipo_sanitario_id', $tipoSan,null)
                            ->placeholder('Seleccione Tipo Sanitario', false)
                            ->class('form-control chosen-select')
                            ->required()
                            ->id('tipo_sanitario_id') }}
                        
                        
                    </div>
                    <div class="form-group col-md-5 col-md-push-1">
                        {{ html()->label('Nombre')->for('nombre') }}
                        <input type="text" class="form-control" name="nombre" maxlength="100" value="{{ $sanitario->nombre }}">
                    </div>

                    
                </div>
                <div class="row">
                    <div class="form-group col-md-5">
                        {{ html()->label('Tratamiento Utilizado')->for('tratamiento_utilizado') }}
                         <input type="text" class="form-control" name="tratamiento_utilizado" maxlength="400" value="{{ $sanitario->tratamiento_utilizado}}">
                        
                        
                    </div>
                    <div class="form-group col-md-5 col-md-push-1">
                        {{ html()->label('Días')->for('dias') }}
                        <input type="text" class="form-control" name="dias" maxlength="100" value="{{ $sanitario->dias }}">
                    </div>

                    
                </div>

                 <div class="row">
                    <div class="form-group col-md-12">
                        {{ html()->label('Comentarios')->for('comentarios') }}
                        <textarea class="summernote" id="comentarios" name="comentarios" title="Comentarios">
                            {!! $sanitario->comentario !!}
                        </textarea>
                    </div>
                </div>

                </input>
            </form>
        </div>
        <div class="mail-body text-right tooltip-demo">
            <a class="btn btn-white btn-sm" href="{{route('admin.sanitarios.index',$sanitario->animal->id)}}">
                @lang('buttons.general.cancel')
            </a>
           
        </div>
    </div>
</div>
{{ html()->form()->close() }}
@endsection
@section('scripts')
<script>
$('#comentarios').summernote({
        height: 150,
    });
</script>
@endsection
