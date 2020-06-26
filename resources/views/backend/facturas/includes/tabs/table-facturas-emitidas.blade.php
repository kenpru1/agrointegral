<hr>
<div class="table-responsive">
    <table id="dataTables-emitidas" class="table table-striped table-bordered table-hover dataTables" data-page-length='8'>
                   
        <thead>
            <tr>
                <th>-</th>
                @if($logged_in_user->hasRole('administrator'))
                    <th>Empresa</th>
                @endif
                <th>Folio</th>
                <th>Emisión</th>
                <th>Cliente</th>
                <th>Condición Pago</th>
                <th>Tipo Pago</th>
                <th>Vencimiento</th>
                <th>Neto</th>
                <th>IVA</th>
                <th>Total</th>
                <th>Estado</th>
                @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('administrator'))
                    <th>@lang('labels.general.actions')</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @php  
                $total=0;
                $iva=0;
                $neto=0;

                $total_anulado=0;
                $iva_anulado=0;
                $neto_anulado=0;

                $key=count($facturas)
            @endphp 
            @foreach($facturas as $factura)
            @php 
                $total=$total+$factura->total;
                $iva=$iva+$factura->iva;
                $neto=$neto+$factura->sub_total; 

                if ($factura->estado_factura_id == 3) {
                    $total_anulado=$total_anulado+$factura->total;
                    $iva_anulado=$iva_anulado+$factura->iva;
                    $neto_anulado=$neto_anulado+$factura->sub_total;
                 }

            @endphp


                <tr>
                    <td>{{ $key-- }}</td>
                    @if($logged_in_user->hasRole('administrator'))
                        <td>empresa</td>
                    @endif
                    <td onclick="window.location='{{route('admin.facturas.show', $factura->id)}}';">{{ $factura->numero }}</td>
                    <td onclick="window.location='{{route('admin.facturas.show', $factura->id)}}';">{{ $factura->fecha->format('d-m-Y') }}</td>
                    <td onclick="window.location='{{route('admin.facturas.show', $factura->id)}}';">
                        
                        @if(isset($factura->cliente->nombre_razon))
                            {{ $factura->cliente->nombre_razon}}
                        @else
                           {{ App\Models\ClienteProveedor::withTrashed()->find($factura->cliente_id)->nombre_razon}}
                        @endif


                    </td>
                   
                    <td onclick="window.location='{{route('admin.facturas.show', $factura->id)}}';">{{$factura->condicion_pago->nombre}}</td>
                    <td onclick="window.location='{{route('admin.facturas.show', $factura->id)}}';">{{$factura->tipo_pago->nombre}}</td>
                   
                    <td onclick="window.location='{{route('admin.facturas.show', $factura->id)}}';">{{$factura->fecha_vencimiento->format('d-m-Y')}}</td>
                    @if($factura->estado_factura_id != 3)
                        <td onclick="window.location='{{route('admin.facturas.show', $factura->id)}}';">${{number_format($factura->sub_total, 0, '', '.')}}</td>
                        <td onclick="window.location='{{route('admin.facturas.show', $factura->id)}}';">${{number_format($factura->iva, 0, '', '.')}}</td>
                        <td onclick="window.location='{{route('admin.facturas.show', $factura->id)}}';">${{number_format($factura->total, 0, '', '.')}}</td>
                    @else
                        <td onclick="window.location='{{route('admin.facturas.show', $factura->id)}}';">-${{number_format($factura->sub_total, 0, '', '.')}}</td>
                        <td onclick="window.location='{{route('admin.facturas.show', $factura->id)}}';">-${{number_format($factura->iva, 0, '', '.')}}</td>
                        <td onclick="window.location='{{route('admin.facturas.show', $factura->id)}}';">-${{number_format($factura->total, 0, '', '.')}}</td>
                    @endif
                    <td onclick="window.location='{{route('admin.facturas.show', $factura->id)}}';"  align="center"><span class="{{$factura->estado_factura->class}}">{{ $factura->estado_factura->nombre }}</span></td>
                                                                
                    @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('administrator'))
                        <td>{!! $factura->action_buttons !!}</td>
                    @endif
                </tr>
                            
            @endforeach

            @php
                $neto = $neto - $neto_anulado;
                $iva = $iva - $iva_anulado;
                $total = $total - $total_anulado;
            @endphp

        </tbody>
        <tfoot>
            <tr>   
                <td class="text-right" colspan="7">Totales:</td>
                <td class="text-right" colspan="1"><strong>${{ number_format($neto, 0, '', '.') }}</strong></td>
                <td class="text-right" colspan="1"><strong>${{ number_format($iva, 0, '.', '.') }}</strong></td>
                <td class="text-right" colspan="1"><strong>${{ number_format($total, 0, '', '.') }}</strong></td>
               <td></td>
               <td></td>
            </tr>    
        </tfoot>
    </table>
    @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('administrator'))
        @include('backend.facturas.includes.header-buttons')
    @endif
</div>