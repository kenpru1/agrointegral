@php 
    $total_negociacion = 0;
@endphp
<div class="col-xs-12 pitchuu">
    <div class="ibox">
        <div class="ibox-content">
            <h3>Negociación</h3>
            <p class="small"><i class="fa fa-hand-o-up"></i> Arrastra las oportunidades entre las listas</p>

            <ul class="sortable-list connectList agile-list" id="negociacion">
                @foreach($negociaciones as $negociacion)
                    <li class="{{$negociacion->estadoOportunidad->class_tablero}}" id="task{{$negociacion->id}}" value="{{$negociacion->id}}">
                        <div onclick="window.location='{{ route('admin.oportunidades.show', $negociacion->id) }}';">
                            {{ $negociacion->titulo }}: ${{ $negociacion->monto }}
                        </div>
                        <div class="agile-detail">
                            <a href="#" data-toggle="modal" data-target="#myModal{{$negociacion->id}}" class="pull-right btn btn-xs btn-white">Perdida</a>
                            <i class="fa fa-clock-o"></i> Cierra el {{ $negociacion->fecha_cierre->format('d-m-Y') }}
                        </div>
                    </li>
                    @php 
                        $total_negociacion = $total_negociacion + $negociacion->monto;
                    @endphp
                @endforeach       
            </ul>
            <div class="text-right">
                <span class="negociacion"><b>${{$total_negociacion}}</b></span>
            </div>
        </div>
    </div>
</div>