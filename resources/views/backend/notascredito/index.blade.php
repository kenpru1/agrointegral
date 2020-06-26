@extends('backend.layouts.app')

@section('title', app_name() . ' | Notas de Crédito')

@section('content')
<div class="ibox float-e-margins">
    <div class="ibox-title">
        <strong>
            Administración de Notas de Crédito
        </strong>
    </div>
    <div class="ibox-content">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover dataTables" data-page-length="8">
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
                        <th>Neto</th>
                        <th>IVA</th>
                        <th>Total</th>
                        @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('administrator'))
                        <th>
                            @lang('labels.general.actions')
                        </th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @php
                        $total=0;
                        $iva=0;
                        $neto=0;  
                        $key=count($notas)
                    @endphp 
                    @foreach($notas as $nota)

                        @php 
                            $total=$total+$nota->factura->total;
                            $iva=$iva+$nota->factura->iva;
                            $neto=$neto+$nota->factura->sub_total;
                        @endphp
                        <tr>
                            <td>{{ $key-- }}</td>
                            @if($logged_in_user->hasRole('administrator'))
                                <td onclick="window.location='{{route('admin.notascredito.show', $nota->id)}}';">
                                {{$empresaUser->nombre}}
                            </td>
                            @endif
                            <td onclick="window.location='{{route('admin.notascredito.show', $nota->id)}}';">
                                {{ $nota->numero }}
                            </td>
                            <td onclick="window.location='{{route('admin.notascredito.show', $nota->id)}}';">
                                {{ $nota->fecha->format('d-m-Y') }}
                            </td>
                            <td onclick="window.location='{{route('admin.notascredito.show', $nota->id)}}';">
                                {{ $nota->factura->cliente->nombre_razon }} 
                            </td>
                            <td onclick="window.location='{{route('admin.notascredito.show', $nota->id)}}';">
                                {{$nota->factura->condicion_pago->nombre}}
                            </td>
                            <td onclick="window.location='{{route('admin.notascredito.show', $nota->id)}}';">
                                {{ $nota->factura->tipo_pago->nombre }}
                            </td>
                            <td onclick="window.location='{{route('admin.notascredito.show', $nota->id)}}';">
                                ${{ number_format($nota->factura->sub_total, 0, '', '.') }}
                            </td>
                            <td onclick="window.location='{{route('admin.notascredito.show', $nota->id)}}';">${{number_format($nota->factura->iva, 0, '', '.')}}
                            </td>
                            <td onclick="window.location='{{route('admin.notascredito.show', $nota->id)}}';">${{number_format($nota->factura->total, 0, '', '.')}}</td>
                            @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('administrator'))
                            <td>
                                {!! $nota->action_buttons !!}
                            </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>   
                        <td class="text-right" colspan="6">Totales:</td>
                        <td class="text-right" colspan="1"><strong>${{ number_format($neto, 0, '', '.') }}</strong></td>
                        <td class="text-right" colspan="1"><strong>${{ number_format($iva, 0, '.', '.') }}</strong></td>
                        <td class="text-right" colspan="1"><strong>${{ number_format($total, 0, '', '.') }}</strong></td>
                       <td></td>
                       <td></td>
                    </tr>    
                </tfoot>
            </table>
        </div>
    </div>
    <!--col-->
</div>
<!--row-->
@endsection
