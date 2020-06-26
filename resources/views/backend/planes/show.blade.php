@extends('backend.layouts.app')

@section('title', 'Raciones ')

@section('content')
{{ html()->modelForm($racion, 'PATCH', route('admin.raciones.update',$racion))->class('form-horizontal')->open() }}
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
                        {{ html()->label('Animal')->for('animal') }}
                        <input type="text" name="animal_nombre" class="form-control" value="{{ $racion->animal->nombre }}">
                        <input type="hidden" name="animal_id"  value="{{ $racion->animal->id }}">
                       
                        
                    </div>
                    <div class="form-group col-md-5 col-md-push-1">
                        {{ html()->label('Responsable')->for('responsable') }}
                        {{ html()->select('trabajador_id', $trabajadores,$racion->trabajador_id)
                            ->placeholder('Seleccione Responsable', false)
                            ->class('form-control chosen-select')
                            ->required()
                            ->attribute('disabled')
                            ->id('trabajador_id') }}
                        
                    </div>

                    
                </div>


                <div class="row">
                    <div class="form-group col-md-5">
                        {{ html()->label('Fecha ')->for('fecha') }}
                        <input type="date" class="form-control" name="fecha_inicio" value="{{isset($racion->fecha)?$racion->fecha->format('Y-m-d'):date('Y-m-d') }}" readonly>
                        
                    </div>
                    <div class="form-group col-md-5 col-md-push-1">
                        {{ html()->label('Tipo Ración')->for('tipo_racion_id') }}
                         {{ html()->select('tipo_racion_id', $tipoRac,$racion->tipo_racion_id)
                            ->placeholder('Seleccione Tipo Sanitario', false)
                            ->class('form-control chosen-select')
                            ->required()
                            ->attribute('disabled')
                            ->id('tipo_racion_id') }}
                           
                    </div>
                    
                    
                </div>
                <div class="row">
                    <div class="form-group col-md-5">
                        {{ html()->label('Nombre')->for('nombre') }}
                        <input type="text" class="form-control" name="nombre" maxlength="100" value="{{ $racion->nombre }}" readonly>
                    </div>

                    
                </div>
                

                 <div class="row">
                    <div class="form-group col-md-12">
                        {{ html()->label('Descripción')->for('descripcion') }}
                        <textarea class="summernote" id="descripcion" name="descripcion" title="Descripción">
                            {{ $racion->descripcion }}
                        </textarea>
                    </div>
                </div>

                </input>
            </form>
        </div>
        <div class="mail-body text-right tooltip-demo">
            <a class="btn btn-white btn-sm" href="{{route('admin.raciones.index')}}">
                @lang('buttons.general.cancel')
            </a>
           
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
</script>
@endsection
