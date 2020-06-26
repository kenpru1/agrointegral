@extends('backend.layouts.app')

@section('title', 'Movimentos' )

@section('content')
<div>
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>
                Movimiento
                <small class="text-muted">
                    Ver
                </small>
            </h5>
        </div>
        <div class="ibox-content">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <tr>
                        <th colspan="3">
                            <h3>
                                Empresa: {{ $movimiento->stock->bodega->empresa->nombre }}
                            </h3>
                        </th>
                    </tr>
                    <tr>
                        <td>
                            Factura: 

                                    @if($movimiento->nro_factura!=null)
                            <strong>
                                {{$movimiento->nro_factura}}
                            </strong>
                            @else
                            <strong>
                                N/A
                            </strong>
                            @endif
                        </td>
                        <td>
                            Fecha:
                            <strong>
                                {{$movimiento->fecha->format('d-m-Y')}}
                            </strong>
                        </td>
                        <td>
                            Tipo Operacion:
                            <strong>
                                {{$movimiento->tipo_operacion->descripcion}}
                            </strong>
                        </td>
                    </tr>
                    <tr>
                        <th colspan="3">
                            <h3>
                                Producto: 
                                @if(isset($movimiento->stock->producto->nombre ))
                                    {{$movimiento->stock->producto->nombre }}
                                @else
                                    {{ App\Models\Producto::withTrashed()->find($movimiento->stock->producto_id)->nombre}}
                                @endif

                                </strong></div></td>
                                            
                                
                            </h3>
                        </th>
                    </tr>
                    <tr>
                        <td>
                            Cantidad:
                            <strong>
                                {{$movimiento->cantidad}}
                            </strong>
                        </td>
                        <td>
                            Proveedor / Cliente:
                                   @if($movimiento->cliente_proveedor_id!=null)
                            <strong>
                                {{$movimiento->cliente_proveedor->nombre_razon}}
                            </strong>
                            @else
                            <strong>
                                N/A
                            </strong>
                            @endif
                        </td>
                        <td>
                            @if($movimiento->tipo_movimiento_id==1)
                            <span class="badge badge-primary">
                                @else
                                <span class="badge badge-danger">
                                    @endif

                                    Tipo Movimiento: {{$movimiento->tipo_movimiento->descripcion}} / Bodega: {{ $movimiento->stock->bodega->nombre }}
                                </span>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th colspan="3">
                            <h3>
                                Comentarios
                            </h3>
                        </th>
                    </tr>
                    <tr>
                        <td colspan="3">
                            {{--<textarea class="summernote" id="comentarios" name="comentarios" title="Descripcion">
                                {{$movimiento->comentarios}}
                            </textarea>--}}
                            <input type="text" class="form-control" name="comentarios" maxlength="800" value="{{$movimiento->comentarios}}">
                        </td>
                    </tr>
                </table>
                <div class="mail-body text-right tooltip-demo" v-if="operacion!=0">
                    <a class="btn btn-white btn-sm" href="{{route('admin.movimientos.index')}}">
                        @lang('buttons.general.cancel')
                    </a>
                </div>
            </div>
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
