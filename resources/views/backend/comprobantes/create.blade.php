@extends('backend.layouts.app')

@section('title', 'Crear Comprobante de Pago')

@section('content')
{{ html()->form('POST', route('admin.comprobantes.store'))->class('form-horizontal')->attribute('enctype', 'multipart/form-data')->open() }}
    <div>
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Crear Comprobante de Pago | Nro. Provisional:
                <b> {{ $nroProv }}</b></h5>
                            
            </div>
            <div class="ibox-content">
                <form class="form-horizontal">
                    <div class="row">
                        <div class="form-group col-md-5">
                            {{ html()->label('Fecha de Pago')->for('fecha_pago') }}
                            <input type="date" class="form-control"  id="fecha" name="fecha_pago" value={{ date('Y-m-d') }} required>   
                        </div>
                        <div class="form-group col-md-5 col-md-push-1">
                            {{ html()->label('Trabajador')->for('trabajador_id') }}
                            {{ html()->select('trabajador_id', $trabajadores, null)
                                ->placeholder('Seleccione Trabajador', false)
                                ->class('form-control chosen-select')
                                ->id('trabajador')
                                ->required() }}
                        </div><!--form-group-->                               
                    </div>

                    <div class="row">
                        <table id="table_trabajos" class="table table-striped table-bordered table-hover">
                            <tbody>
                                <tr>
                                    <td>
                                        {{ html()->label('Trabajo Realizado')->for('trabajo_realizado') }}
                                        <input type="text" class="form-control" name="trabajo_realizado" id="trabajo_realizado" maxlength="100">
                                                     
                                    </td>
                                    <td>
                                        {{ html()->label('Total')->for('total') }}
                                        
                                        <div class="input-group m-b">
                                            <span class="input-group-addon">$</span> 
                                            <input type="number" class="form-control" id="total" placeholder ="0" name="total" min="0" step="1" >
                                        </div>            
                                    </td>
                                    <td>
                                        <a onclick="agregar_trabajos()" class="btn btn-primary" data-toggle="tooltip" title="Agregar trabajo">Agregar</a> 
                                    </td>
                                </tr>    
                            </tbody>
                        </table>
                    </div>

                    <div class="row">
                        <div class="col-md-3"></div>

                        <div class="col-md-5">   
                            <table class="table table-striped table-bordered table-hover">
                                <tr>
                                    <td>
                                        {{ html()->label('Total')->for('total') }}
                                    </td>
                                    <td>
                                        <div class="col-md-10 col-sm-10 col-xs-12">
                                            <div class="input-group m-b">
                                                <span class="input-group-addon">$</span> 
                                                <input type="number" class="form-control" id="total_comprobante" name="total_comprobante" value="0.00" readonly>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-3">
                            <input type="hidden" name="numero_trabajos" id="numero_trabajos">
                        </div>
                    </div>
                                                                                                                    
                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-4"></div>
                        <div class="col-md-4 col-md-push-1">    
                            <a class="btn btn-white btn-sm" href="{{route('admin.comprobantes.index')}}" >@lang('buttons.general.cancel')
                            </a>
                            <button class="btn btn-sm btn-primary" type="submit">Guardar</button>
                        </div>
                    </div>                                                            
                </form>
            </div>
        </div>
    </div>

{{ html()->form()->close() }}

@endsection
@section('scripts')
<script>
    var numero_trabajos = 0;

    function agregar_trabajos(){
        var lineId = Math.floor((Math.random() * 1000000) + 1);
        lineId = lineId + "_" + Math.floor((Math.random() * 1000000) + 1);
        numero_trabajos++;

        if($('#trabajo_realizado').val() != '' && $('#total').val() != ''){
            var html="";
            html+='<tr lineid='+lineId+'>';
            html+='<td>'+($('#trabajo_realizado').val());
            html+='<input type="hidden"  value="'+($('#trabajo_realizado').val())+'" name="trabajo_realizado_array[]">'+'</td>';

            html+='<td class="text-right"> <b>$ </b>'+($('#total').val())+'</td>';
            html+='<input type="hidden" class="sum_trabajos" value="'+($('#total').val())+'" name="total_array[]">'+'</td>';

            html+='<td> <a href="#" class="borrar_trabajos btn btn-success" data-toggle="tooltip" lineid="'+lineId+'" title="Eliminar"><i class="fa fa-minus"></i></a></td>';

            html+='</tr>';

            $("#table_trabajos").append(html);
            $("#numero_trabajos").val(numero_trabajos);

            clean();
            calcular();
        }
        else{
            alert('Debe Ingresar Trabajo Realizado y Total');
        }
    }

    function calcular(){
        var sumaTrabajos = 0;

        $('.sum_trabajos').each(function (index, element){
            sumaTrabajos = parseFloat(sumaTrabajos) + parseFloat($(element).val());
        });

        $('#total_comprobante').val(sumaTrabajos.toFixed(0));
    } 

    function clean(){
        $('#trabajo_realizado').val('');
        $('#total').val(0);
    }

    $('body').on('click', '.borrar_trabajos', function (e){
        numero_trabajos--;

        $('#numero_trabajos').val(numero_trabajos);
        e.preventDefault();
        var id = $(this).attr("lineid");
        var valor = $(this).parents("tr").find('.value').val();

        $("[lineid=" + id + "]").remove();

        calcular();
    });   

</script>
@endsection

