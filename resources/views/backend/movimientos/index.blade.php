@extends('backend.layouts.app')

@section('title', app_name() . ' | Movimientos')

@section('content')
    <div class="ibox float-e-margins">
                    <div class="ibox-title">
                       
                      <strong> Movimientos</strong>
                       
                        
                    </div>
                    <div class="ibox-content">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="data-Tables" data-page-length='8'>
                        <thead>
                        <tr>
                            <th>Nro.</th>                            
                            @if($logged_in_user->hasRole('administrator'))
                               <th>Empresa</th>
                            @endif
                             <th>Fecha</th>
                             <th>No. Factura</th>
                             <th>No. Guía Despacho</th>
                             <th>Operación</th>
                             <th>Movimiento</th>
                             <th>Cantidad</th>
                             <th>Bodega</th>
                             <th>Cliente/Proveedor</th>
                             <th>Usuario</th>
                            
                           
                        </tr>
                        </thead>
                        <tbody>
                       
                        @php  $key=count($movimientos)@endphp 
                        @foreach($movimientos as $movimiento)

                            <tr onclick="window.location='{{route('admin.movimientos.show', $movimiento->id)}}';">
                            <td>{{ $key-- }}</td>
                               
                                @if($logged_in_user->hasRole('administrator'))
                                   <th>{{ $movimiento->stock->bodega->empresa->nombre }}</th>
                                @endif
                                <td>{{ $movimiento->fecha->format('d-m-Y') }}</td>
                                <td>

                                    @if($movimiento->tipo_movimiento_id==1)
                                        {{isset($movimiento->factura_recibida->ref) ? $movimiento->factura_recibida->ref:''}} 
                                    @else
                                        {{isset($movimiento->factura->numero) ? $movimiento->factura->numero:''}} 
                                        
                                    @endif



                                    


                                </td>
                                <td>{{isset($movimiento->guia_despacho->numero) ? $movimiento->guia_despacho->numero:''}}   </td>
                                <td>{{$movimiento->tipo_operacion->descripcion}}</td>
                                <td align="center">
                                    @if($movimiento->tipo_movimiento_id==1)
                                        <span class="badge badge-primary">
                                    @else
                                        <span class="badge badge-danger">

                                    @endif

                                    {{$movimiento->tipo_movimiento->descripcion}}
                                    </span>
                                </td>
                                <td align="rigth">{{$movimiento->cantidad}}</td>
                                <td>{{$movimiento->stock->bodega->nombre}}</td>
                                <td>@if($movimiento->cliente_proveedor!=null){{$movimiento->cliente_proveedor->nombre_razon}}@endif</td>
                                <td>{{$movimiento->user->name}}</td>
                                

                                
                               
                            </tr>
                            
                        @endforeach

                        </tbody>
                    </table>
                    @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('administrator'))
                           @include('backend.movimientos.includes.header-buttons')
                       @endif
                </div>
            </div><!--col-->
        </div><!--row-->
    
   

@endsection
@section('scripts')
<script>
  
    $('#data-Tables').DataTable({
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
