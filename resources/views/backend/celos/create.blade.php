@extends('backend.layouts.app')

@section('title', ' Administración | Celos ' )

@section('content')
{{ html()->form('POST', route('admin.celos.store'))->class('form-horizontal')->open() }}
<div>
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>
                Administración de Celos
                <small class="text-muted">
                    Crear
                </small>
            </h5>
        </div>
        <div class="ibox-content">
            <form class="form-horizontal">
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
                <div class="row">
                    <div class="form-group col-md-5 ">
                        {{ html()->label('Animal')->for('animal_id') }}
                                     {{ html()->select('animal_id', $animales,null)
                                        ->placeholder('Seleccione Animal', false)
                                        ->class('form-control chosen-select')
                                        ->required()
                                        ->id('animal_id') }}
                    </div>
                    <!--form-group-->
                    <div class="form-group col-md-5 col-md-push-1">
                        {{ html()->label('Fecha Detección')->for('fecha_deteccion') }}
                        <input type="date" class="form-control" name="fecha_deteccion" value="{{ date('Y-m-d') }}" required>
                                     
                    <!--form-group-->
                </div>
            </div>
                
                <div class="row">
                    <div class="form-group col-md-12">
                        {{ html()->label('Observaciones')->for('name') }}
                        <textarea class="summernote" id="observaciones" name="observaciones" title="Observaciones"></textarea>
                    </div>
                </div>
               
                <div class="mail-body text-right tooltip-demo">
                    <a class="btn btn-white btn-sm" href="{{route('admin.celos.index')}}">
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
    $('#observaciones').summernote({
        height: 150,
    });
  
</script>
@endsection
