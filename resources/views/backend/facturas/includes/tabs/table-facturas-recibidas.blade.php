<hr>
<div class="table-responsive">
    <table id="dataTables-recibidas" class="table table-striped table-bordered table-hover dataTables" data-page-length='8'>
        <thead>
            <tr>
                <th>-</th>
                @if($logged_in_user->hasRole('administrator'))
                    <th>Empresa</th>
                @endif
                <th>Ref.</th>
                <th>Ref. Vendedor</th>
                <th>Fecha de Emisión</th>
                <th>Fecha de Vencimiento</th>
                <th>Tercero</th>
                <th>Ciudad</th>
                <th>Código Postal</th>
                <th>Tipo de Pago</th>
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
                $montoNeto=0;
                $iva=0;
                $total=0;
                $keyRec=count($facturas_recibidas)
            @endphp 
            @foreach($facturas_recibidas as $factura_recibida)
            @php 
                $montoNeto=$montoNeto+$factura_recibida->monto_neto;
                $iva=$iva+$factura_recibida->iva;
                $total=$total+$factura_recibida->total;
            @endphp

                <tr>
                    <td>{{ $keyRec-- }}</td>
                    @if($logged_in_user->hasRole('administrator'))
                        <td>empresa</td>
                    @endif
                    <td onclick="window.location='{{route('admin.facturas_recibidas.show', $factura_recibida->id)}}';">{{ $factura_recibida->ref }}</td>
                    <td onclick="window.location='{{route('admin.facturas_recibidas.show', $factura_recibida->id)}}';">{{ $factura_recibida->ref_vendedor }}</td>
                    <td onclick="window.location='{{route('admin.facturas_recibidas.show', $factura_recibida->id)}}';">{{$factura_recibida->fecha_emision->format('d-m-Y')}}</td>
                    <td onclick="window.location='{{route('admin.facturas_recibidas.show', $factura_recibida->id)}}';">{{$factura_recibida->fecha_vence->format('d-m-Y')}}</td>
                    <td onclick="window.location='{{route('admin.facturas_recibidas.show', $factura_recibida->id)}}';">{{
                        isset($factura_recibida->cliente_proveedor->nombre_razon)?$factura_recibida->cliente_proveedor->nombre_razon:''}}</td>
                    <td onclick="window.location='{{route('admin.facturas_recibidas.show', $factura_recibida->id)}}';">{{$factura_recibida->comuna->nombre}}</td>
                    <td onclick="window.location='{{route('admin.facturas_recibidas.show', $factura_recibida->id)}}';">{{$factura_recibida->codigo_postal}}</td>
                    <td onclick="window.location='{{route('admin.facturas_recibidas.show', $factura_recibida->id)}}';">{{$factura_recibida->tipo_pago->nombre}}</td>
                    <td onclick="window.location='{{route('admin.facturas_recibidas.show', $factura_recibida->id)}}';">${{ number_format($factura_recibida->monto_neto, 0, '', '.') }}</td>
                    <td onclick="window.location='{{route('admin.facturas_recibidas.show', $factura_recibida->id)}}';">${{ number_format($factura_recibida->iva, 0, '', '.') }}</td>
                    <td onclick="window.location='{{route('admin.facturas_recibidas.show', $factura_recibida->id)}}';">${{ number_format($factura_recibida->total, 0, '', '.') }}</td>
                    <td onclick="window.location='{{route('admin.facturas_recibidas.show', $factura_recibida->id)}}';"  align="center"><span class="{{$factura_recibida->estado_factura->class}}">{{ $factura_recibida->estado_factura->nombre }}</span></td>
                                                                
                    @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('administrator'))
                        <td>{!! $factura_recibida->action_buttons !!}</td>
                    @endif
                </tr>
                            
            @endforeach

        </tbody>
        <tfoot>
            <tr>   
                <td class="text-right" colspan="9">Total:</td>
                <td class="text-right" colspan="1"><strong>${{ number_format($montoNeto, 0, '', '.') }}</strong></td>
                <td class="text-right" colspan="1"><strong>${{ number_format($iva, 0, '.', '.') }}</strong></td>
                <td class="text-right" colspan="1"><strong>${{ number_format($total, 0, '', '.') }}</strong></td>
                <td></td>
                <td></td>
            </tr>    
        </tfoot>
    </table>
    @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('administrator'))
        @include('backend.facturas_recibidas.includes.header-buttons')
    @endif
</div>
