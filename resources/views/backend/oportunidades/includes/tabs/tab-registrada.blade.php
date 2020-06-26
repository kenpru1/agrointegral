@php 
    $total_registradas = 0;
@endphp
<div class="col-xs-12 pitchuu">
    <div class="ibox">
        <div class="ibox-content">
            <h3>Registrada</h3>
            <p class="small"><i class="fa fa-hand-o-up"></i> Arrastra las oportunidades entre las listas</p>

            <ul class="sortable-list connectList agile-list" id="registrada">
                @foreach($registradas as $registrada)
                    <li class="{{$registrada->estadoOportunidad->class_tablero}}" id="task{{$registrada->id}}" value="{{$registrada->id}}">
                        <div onclick="window.location='{{ route('admin.oportunidades.show', $registrada->id) }}';">
                            {{ $registrada->titulo }}: ${{ $registrada->monto }}
                        </div>
                        <div class="agile-detail">
                            <a href="#" data-toggle="modal" data-target="#myModal{{$registrada->id}}" class="pull-right btn btn-xs btn-white">Perdida</a>
                            <i class="fa fa-clock-o"></i> Cierra el {{ $registrada->fecha_cierre->format('d-m-Y') }}
                        </div>
                    </li>
                    @php 
                        $total_registradas = $total_registradas + $registrada->monto;
                    @endphp
                @endforeach       
            </ul>
            <div class="text-right">
                <span class="registrada"><b>${{$total_registradas}}</b></span>
            </div>
        </div>
    </div>
</div>