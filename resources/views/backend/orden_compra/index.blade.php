@extends('backend.layouts.app')

@section('title', app_name() . ' | Ordenes de Compra')

@section('content')
    <div class="ibox float-e-margins">
                    <div class="ibox-title">
                       
                      <strong>Ordenes de Compra</strong>
                       
                        
                    </div>
                    <div class="ibox-content">
                <div class="table-responsive">
                   <table class="table table-striped table-bordered table-hover dataTables" data-page-length='8'>
                   
                        <thead>
                        <tr>
                            <th>Nro.</th>
                            <th>Orden</th>
                            <th>Fecha</th>
                            <th>Cliente</th>
                            <th>SubTotal</th>
                            <th>Total</th>

                          
                            @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('administrator'))
                                <th>@lang('labels.general.actions')</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                       @php  $key=count($ordenes)@endphp 
                        @foreach($ordenes as $orden)

                            <tr>
                                 <td>{{ $key-- }}</td>
                                 <td onclick="window.location='{{route('admin.orden_compras.show', $orden->id)}}';">{{ $orden->numero }}</td>
                                <td onclick="window.location='{{route('admin.orden_compras.show', $orden->id)}}';">{{ $orden->fecha->format('d-m-Y') }}</td>
                                <td onclick="window.location='{{route('admin.orden_compras.show', $orden->id)}}';">{{$orden->cliente->nombre_razon}}</td>
                                <td onclick="window.location='{{route('admin.orden_compras.show', $orden->id)}}';">{{number_format($orden->sub_total,2,'.','')}}</td>
                                <td onclick="window.location='{{route('admin.orden_compras.show', $orden->id)}}';">{{number_format($orden->total,2,'.','')}}</td>
                             
                            
                                                                
                                @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('administrator'))
                                <td>{!! $orden->action_buttons !!}</td>
                                @endif
                            </tr>
                            
                        @endforeach

                        </tbody>
                    </table>
                    @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('administrator'))
                           @include('backend.orden_compra.includes.header-buttons')
                       @endif
                </div>
            </div><!--col-->
        </div><!--row-->
    
   

@endsection
@section('scripts')
<script>
  
    $('.data-Tables').DataTable({
        pageLength: 25,
        responsive: true,
        "iDisplayLength": -1,
        "aaSorting": [[ 1, "desc" ]], 
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
