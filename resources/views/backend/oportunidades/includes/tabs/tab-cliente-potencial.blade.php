@php 
    $total_clientes = 0;
@endphp
<div class="col-xs-12 pitchuu">
    <div class="ibox">
        <div class="ibox-content">
            <h3>Cliente potencial</h3>
            <p class="small"><i class="fa fa-hand-o-up"></i> Arrastra las oportunidades entre las listas</p>

            <ul class="sortable-list connectList agile-list" id="cliente">
                @foreach($clientespos as $cliente)
                    <li class="{{$cliente->estadoOportunidad->class_tablero}}" id="task{{$cliente->id}}" value="{{$cliente->id}}">
                        <div onclick="window.location='{{ route('admin.oportunidades.show', $cliente->id) }}';">
                            {{ $cliente->titulo }}: ${{ $cliente->monto }}
                        </div>
                        <div class="agile-detail">
                            <a href="#" data-toggle="modal" data-target="#myModal{{$cliente->id}}" class="pull-right btn btn-xs btn-white">Perdida</a>
                            <i class="fa fa-clock-o"></i> Cierra el {{ $cliente->fecha_cierre->format('d-m-Y') }}
                        </div>
                    </li>
                    @php 
                        $total_clientes = $total_clientes + $cliente->monto;
                    @endphp
                @endforeach       
            </ul>
            <div class="text-right">
                <span class="cliente"><b>${{$total_clientes}}</b></span>
            </div>
        </div>
    </div>
</div>