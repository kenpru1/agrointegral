@php 
    $total_aprobada = 0;
@endphp
<div class="col-xs-12 pitchuu">
    <div class="ibox">
        <div class="ibox-content">
            <h3>Aprobadas</h3>
            <p class="small"><i class="fa fa-hand-o-up"></i> Arrastra las oportunidades entre las listas</p>

            <ul class="sortable-list connectList agile-list" id="aprobada">
                @foreach($aprobadas as $aprobada)
                    <li class="{{$aprobada->estadoOportunidad->class_tablero}}" id="task{{$aprobada->id}}" value="{{$aprobada->id}}">
                        <div onclick="window.location='{{ route('admin.oportunidades.show', $aprobada->id) }}';">
                            {{ $aprobada->titulo }}: ${{ $aprobada->monto }}
                        </div>
                        <div class="agile-detail">
                            <a href="#" data-toggle="modal" data-target="#myModal{{$aprobada->id}}" class="pull-right btn btn-xs btn-white">Perdida</a>
                            <i class="fa fa-clock-o"></i> Cierra el {{ $aprobada->fecha_cierre->format('d-m-Y') }}
                        </div>
                    </li>
                    @php 
                        $total_aprobada = $total_aprobada + $aprobada->monto;
                    @endphp
                @endforeach       
            </ul>
            <div class="text-right">
                <span class="aprobada"><b>${{$total_aprobada}}</b></span>
            </div>
        </div>
    </div>
</div>