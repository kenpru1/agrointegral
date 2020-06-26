  <div class="row">
            <div class="ibox-content">
                <div class="table-responsive">
                    
                    <table class="table table-striped table-bordered table-hover dataTables"  data-page-length='8'>
                        <thead>
                        <tr>
                            <th>Nro.</th>
                            <th>Orden</th>
                            <th>Estado</th>
                            <th>Total</th>
                            <th>Medio</th>
                            <th>Fecha</th>
                            <th>Inicio Periodo</th>
                            <th>Fin Periodo</th>
                            <th>Correo</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @php  $key=count($pagos)@endphp 
                        @foreach ($pagos as $pago)
                            <tr>
                                <td>{{ $key-- }}</td>
                                <td>{{ $pago->id }}</td>
                                <td>{{ $pago->estado }}</td>
                                <td>{{ $pago->total }}</td>
                                <td>{{ $pago->medio }}</td>
                                <td>{{isset($pago->fecha_pago)?$pago->fecha_pago->format('d-m-Y'):'-'  }}</td>
                                <td>{{ isset($pago->inicio_periodo)?$pago->inicio_periodo->format('d-m-Y'):'-'}}</td>
                                <td>{{ isset($pago->fin_periodo)?$pago->fin_periodo->format('d-m-Y'):'-'  }}</td>
                                <td>{{ $pago->email_pagador }}</td>
                                <td>
                                    @if($pago->estado='Pagada')

                                    <a href="{{ route('admin.pago.print', $pago->id) }}" target="_blank"  ><i class="fa fa-download" data-toggle="tooltip" data-placement="top" title="PDF"></i></a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div><!--col-->
        </div><!--row-->