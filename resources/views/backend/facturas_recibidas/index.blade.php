@extends('backend.layouts.app')

@section('title', app_name() . ' | Facturas Recibidas')

@section('content')
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <strong>Facturas</strong>                
        </div>
        <div class="ibox-content">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover data-Tables" data-page-length='8'>
                    <thead>
                        <tr>
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
                            <th>Monto</th>
                            <th>Estado</th>
                            @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('administrator'))
                                <th>@lang('labels.general.actions')</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody> 
                        @foreach($facturas_recibidas as $factura_recibida)

                            <tr>
                                @if($logged_in_user->hasRole('administrator'))
                                    <td>empresa</td>
                                @endif
                                <td onclick="window.location='{{route('admin.facturas_recibidas.show', $factura_recibida->id)}}';">{{ $factura_recibida->ref }}</td>
                                <td onclick="window.location='{{route('admin.facturas_recibidas.show', $factura_recibida->id)}}';">{{ $factura_recibida->ref_vendedor }}</td>
                                <td onclick="window.location='{{route('admin.facturas_recibidas.show', $factura_recibida->id)}}';">{{$factura_recibida->fecha_emision->format('d-m-Y')}}</td>
                                <td onclick="window.location='{{route('admin.facturas_recibidas.show', $factura_recibida->id)}}';">{{$factura_recibida->fecha_vence->format('d-m-Y')}}</td>
                                <td onclick="window.location='{{route('admin.facturas_recibidas.show', $factura_recibida->id)}}';">{{$factura_recibida->cliente_proveedor_id}}</td>
                                <td onclick="window.location='{{route('admin.facturas_recibidas.show', $factura_recibida->id)}}';">{{$factura_recibida->ciudad}}</td>
                                <td onclick="window.location='{{route('admin.facturas_recibidas.show', $factura_recibida->id)}}';">{{$factura_recibida->codigo_postal}}</td>
                                <td onclick="window.location='{{route('admin.facturas_recibidas.show', $factura_recibida->id)}}';">{{$factura_recibida->tipo_pago->nombre}}</td>
                                <td onclick="window.location='{{route('admin.facturas_recibidas.show', $factura_recibida->id)}}';">${{$factura_recibida->monto_neto}}</td>
                                <td onclick="window.location='{{route('admin.facturas_recibidas.show', $factura_recibida->id)}}';"  align="center"><span class="{{$factura_recibida->estado_factura->class}}">{{ $factura_recibida->estado_factura->nombre }}</span></td>
                                                                
                                @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('administrator'))
                                <td>{!! $factura_recibida->action_buttons !!}</td>
                                @endif
                            </tr>
                            
                        @endforeach

                        </tbody>
                    </table>
                    @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('administrator'))
                           @include('backend.facturas_recibidas.includes.header-buttons')
                       @endif
                </div>
            </div><!--col-->
        </div><!--row-->
    </div>
   

@endsection
@section('scripts')
<script>
  
    $('.data-Tables').DataTable({
        pageLength: 25,
        responsive: true,
        "iDisplayLength": -1,
        "aaSorting": [[ 0, "desc" ]], 
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [{
            extend: 'copy'
        }, {
            extend: 'csv'
        }, {
            extend: 'excel',
            title: 'ExampleFile'
        }, {
            extend: 'pdf',
            title: 'ExampleFile'
        }, {
            extend: 'print',
            customize: function(win) {
                $(win.document.body).addClass('white-bg');
                $(win.document.body).css('font-size', '10px');
                $(win.document.body).find('table').addClass('compact').css('font-size', 'inherit');
            }
        }]
    });
</script>
@endsection
