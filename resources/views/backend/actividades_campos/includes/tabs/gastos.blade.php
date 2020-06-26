<hr>
<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover dataTables" data-page-length='8'>
        <thead>
            <tr>
                
                <th>Nro.</th>
                <th>Fecha</th>
                <th>Factura</th>
                <th>Comprobante</th>
                <th>Proveedor</th>
                <th>Neto</th>
                <th>Iva</th>
                <th>Total</th>
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
                $keyRec=count($actividad->gastos);
            @endphp 
            @foreach($actividad->gastos as $gasto)
            @php 
                $montoNeto=$montoNeto+$gasto->neto;
                $iva=$iva+$gasto->iva;
                $total=$total+$gasto->total;
            @endphp

                <tr>
                    <td>{{ $keyRec-- }}</td>
                    <td onclick="window.location='{{route('admin.actividades_campos.show_gasto', $gasto->id)}}';">{{$gasto->fecha->format('d-m-Y')}}</td>

                    <td onclick="window.location='{{route('admin.actividades_campos.show_gasto', $gasto->id)}}';">{{ $gasto->nro_factura }}</td>
                    <td onclick="window.location='{{route('admin.actividades_campos.show_gasto', $gasto->id)}}';">{{ $gasto->nro_comprobante }}</td>
                    
                    <td onclick="window.location='{{route('admin.actividades_campos.show_gasto', $gasto->id)}}';">{{
                        isset($gasto->cliente_proveedor_id)?$gasto->proveedor->nombre_razon:''}}</td>

                   
                   
                    <td class="text-right" onclick="window.location='{{route('admin.actividades_campos.show_gasto', $gasto->id)}}';">${{ number_format($gasto->neto, 0, '', '.') }}</td>
                    <td class="text-right" onclick="window.location='{{route('admin.actividades_campos.show_gasto', $gasto->id)}}';">${{ number_format($gasto->iva, 0, '', '.') }}</td>
                    <td class="text-right" onclick="window.location='{{route('admin.actividades_campos.show_gasto', $gasto->id)}}';">${{ number_format($gasto->total, 0, '', '.') }}</td>
                                                                                
                    @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('administrator'))
                        <td>{!! $gasto->action_buttons !!}</td>
                    @endif
                </tr>
                            
            @endforeach

        </tbody>
        <tfoot>
            <tr>   
                <td class="text-right" colspan="6">Total:</td>
                <td class="text-right" colspan="1"><strong>${{ number_format($montoNeto, 0, '', '.') }}</strong></td>
                <td class="text-right" colspan="1"><strong>${{ number_format($iva, 0, '.', '.') }}</strong></td>
                <td class="text-right" colspan="1"><strong>${{ number_format($total, 0, '', '.') }}</strong></td>
              
               
            </tr>    
        </tfoot>
    </table>
    @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('administrator'))
        <div class="mail-body text-right">
            <a href="{{ route('admin.actividades_campos.nuevo_gasto',$actividad) }}" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="@lang('labels.general.create_new')">Nuevo Gasto</a>
           
</div>

    @endif
</div>