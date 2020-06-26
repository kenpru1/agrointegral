@php 
    $total_presupuestadas = 0;
@endphp
<div class="col-xs-12 pitchuu">
    <div class="ibox">
        <div class="ibox-content">
            <h3>Presupuestada</h3>
            <p class="small"><i class="fa fa-hand-o-up"></i> Arrastra las oportunidades entre las listas</p>

            <ul class="sortable-list connectList agile-list" id="presupuestada">
                @foreach($presupuestadas as $presupuestada)
                    <li class="{{$presupuestada->estadoOportunidad->class_tablero}}" id="task{{$presupuestada->id}}" value="{{$presupuestada->id}}">
                        <div onclick="window.location='{{ route('admin.oportunidades.show', $presupuestada->id) }}';">
                            {{ $presupuestada->titulo }}: ${{ $presupuestada->monto }}
                        </div>
                        <div class="agile-detail">
                            <a href="#" data-toggle="modal" data-target="#myModal{{$presupuestada->id}}" class="pull-right btn btn-xs btn-white">Perdida</a>
                            <i class="fa fa-clock-o"></i> Cierra el {{ $presupuestada->fecha_cierre->format('d-m-Y') }}
                        </div>
                    </li>
                    @php 
                        $total_presupuestadas = $total_presupuestadas + $presupuestada->monto;
                    @endphp
                @endforeach       
            </ul>
            <div class="text-right">
                <span class="presupuestada"><b>${{$total_presupuestadas}}</b></span>
            </div>
        </div>
    </div>
</div>