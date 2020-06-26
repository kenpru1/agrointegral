@extends('backend.layouts.app')

@section('title', 'Rendimientos')

@section('content')
    {{ html()->modelForm($rendimiento, 'PATCH', route('admin.rendimientos.update', $rendimiento->id))->class('form-horizontal')->attribute('enctype', 'multipart/form-data')->open() }}
        <div>
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>
                        Administrador de Rendimientos
                        <small class="text-muted">
                            Ver Rendimientos
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
                                        ->attribute('disabled')
                                        ->id('cuartel_id') }}
                            </div>
                            <div class="form-group col-md-5 col-md-push-1">
                                {{ html()->label('Fecha Cosecha')->for('fecha_año') }}
                                <input type="month" class="form-control" name="fecha_año" value="{{ $rendimiento->fecha_año }}" required readonly>
                            </div>
                        </div>
                        <div id="rendimiento">
                            <div class="row">
                                <div class="form-group col-md-5 ">
                                    {{ html()->label('Toneladas Brutas')->for('toneladas_brutas') }}
                                    <input type="text" class="form-control" value="{{$rendimiento->toneladas_brutas}}" name="toneladas_brutas" min="0" required readonly>
                                </div>
                                <div class="form-group col-md-5 col-md-push-1">
                                    {{ html()->label('Producción')->for('produccion') }}
                                    <input type="text" class="form-control" v-model="produccion" name="produccion" min="0" required readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-5">
                                    {{ html()->label('Descarte Bruto')->for('descarte_bruto') }}
                                    <input type="text" class="form-control" value="{{$rendimiento->descarte_bruto}}" name="descarte_bruto" min="0" required readonly>
                                </div>
                                <div class="form-group col-md-5 col-md-push-1">
                                    {{ html()->label('Total Producción')->for('total_produccion') }}
                                    <input type="text" class="form-control" v-model="produccion" name="total_produccion" min="0" required readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-5">
                                    {{ html()->label('Exportación')->for('exportacion') }}
                                    <input type="text" class="form-control" value="{{$rendimiento->exportacion}}" name="exportacion" min="0" required readonly>    
                                </div>
                                <div class="form-group col-md-5 col-md-push-1">
                                    {{ html()->label('Descarte Producción')->for('descarte_produccion') }}
                                    <input type="text" class="form-control" value="{{$rendimiento->descarte_produccion}}" name="descarte_produccion" min="0" required readonly>  
                                </div>
                            </div>
                        </div>
                        <div class="mail-body text-right tooltip-demo">
                            <a class="btn btn-white btn-sm" href="{{route('admin.rendimientos.index')}}">
                                @lang('buttons.general.cancel')
                            </a>
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
            produccion: {{$rendimiento->total_produccion}},
        }
    });
</script>
@endsection