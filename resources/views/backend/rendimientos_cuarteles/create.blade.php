@extends('backend.layouts.app')

@section('title', 'Rendimientos'))

@section('content')
{{ html()->form('POST', route('admin.rendimientos.store'))->class('form-horizontal')->attribute('enctype', 'multipart/form-data')->open() }}
<div>
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>
                Administrador de Rendimientos
                <small class="text-muted">
                    Crear Rendimientos
                </small>
            </h5>
        </div>
        <div class="ibox-content">
            <form class="form-horizontal">
                <div class="row">
                    <div class="form-group col-md-5">
                        {{ html()->label('Cuartel')
                                ->for('cuartel') }}
                        {{ html()->select('cuartel_id', $cuarteles,null)
                                ->placeholder('Seleccione Cuartel', false)
                                ->class('form-control  chosen-select')
                                ->required()
                                ->id('cuartel_id') }}
                    </div>
                    <div class="form-group col-md-5 col-md-push-1">
                        {{ html()->label('Fecha Cosecha')->for('fecha_año') }}
                        <input type="month" class="form-control" name="fecha_año" value={{ date('Y-m') }} required>
                    </div>
                </div>
                <hr>
                <div id="rendimiento">
                    <div class="row">
                        <div class="form-group col-md-5 ">
                            {{ html()->label('Toneladas Brutas')->for('toneladas_brutas') }}
                            <input type="number" step="any" class="form-control" name="toneladas_brutas" value="{{ old('toneladas_brutas') }}" min="0" placeholder="0" required>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="form-group col-md-5">
                            {{ html()->label('Producción')->for('produccion') }}
                            <input type="number" step="any" class="form-control" name="produccion" value="{{ old('produccion') }}" v-model="produccion" min="0" placeholder="0" required>
                        </div>
                        <div class="form-group col-md-5 col-md-push-1">
                            {{ html()->label('Descarte Bruto')->for('descarte_bruto') }}
                            <input type="number" step="any" class="form-control" name="descarte_bruto" value="{{ old('descarte_bruto') }}" min="0" placeholder="0" required>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="form-group col-md-5">
                            {{ html()->label('Total Producción')->for('total_produccion') }}
                            <input type="number" step="any" class="form-control" v-model="produccion" name="total_produccion" value="{{ old('total_produccion') }}" min="0" placeholder="0" required>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="form-group col-md-5">
                            {{ html()->label('Descarte Producción')->for('descarte_produccion') }}
                            <input type="number" step="any" class="form-control" name="descarte_produccion" value="{{ old('descarte_produccion') }}" min="0" placeholder="0" required>  
                        </div>
                        <div class="form-group col-md-5 col-md-push-1">
                            {{ html()->label('Exportación')->for('exportacion') }}
                            <input type="number" step="any" class="form-control" name="exportacion" value="{{ old('exportacion') }}" min="0" placeholder="0" required>    
                        </div>
                    </div>
                </div>
                <div class="mail-body text-right tooltip-demo">
                    <a class="btn btn-white btn-sm" href="{{route('admin.rendimientos.index')}}">
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
    var rendimiento = new Vue({
        el:"#rendimiento",
        data: {
            produccion: {{ old('total_produccion') ? old('total_produccion') : 0 }},
        }
    });
</script>
@endsection
