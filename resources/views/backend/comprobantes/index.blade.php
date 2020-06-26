@extends('backend.layouts.app')

@section('title', app_name() . ' | Comprobantes de Pago')

@section('content')
<div class="ibox float-e-margins">
    <div class="ibox-title">
        <strong>
            Administración de Comprobantes de Pago
        </strong>
    </div>
    <div class="ibox-content">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover dataTables" data-page-length="8">
                <thead>
                    <tr>
                        <th>Nro.</th>
                        <th>Nro. Provisional</th>
                        <th>Trabajador</th>
                        <th>Fecha de Pago</th>
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
                       $key=count($comprobantes); 
                       $total=0;
                    @endphp 
                    @foreach($comprobantes as $comprobante)
                    @php 
                        $total=$total+$comprobante->total;
                @endphp
                    <tr>
                        <td>{{ $key-- }}</td>
                        <td onclick="window.location='{{route('admin.comprobantes.show', $comprobante->id)}}';">{{ $comprobante->numero }}</td>
                        <td onclick="window.location='{{route('admin.comprobantes.show', $comprobante->id)}}';">
                            {{$comprobante->trabajador->nombre}}
                        </td>
                        <td onclick="window.location='{{route('admin.comprobantes.show', $comprobante->id)}}';">
                            {{ $comprobante->fecha_pago->format('d-m-Y') }}
                        </td>
                        <td align="right" onclick="window.location='{{route('admin.comprobantes.show', $comprobante->id)}}';">
                            ${{ $comprobante->total }}
                        </td>
                        @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('administrator'))
                        <td>
                            {!! $comprobante->action_buttons !!}
                        </td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
            <tr>   
                <td class="text-right" colspan="4">Totales:</td>
                <td class="text-right" colspan="1"><strong>${{ number_format($total, 0, '', '.') }}</strong></td>
               <td></td>
               <td></td>
            </tr>    
        </tfoot>
            </table>
            @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('administrator'))
                @include('backend.comprobantes.includes.header-buttons')
            @endif
        </div>
    </div>
    <!--col-->
</div>
<!--row-->
@endsection
