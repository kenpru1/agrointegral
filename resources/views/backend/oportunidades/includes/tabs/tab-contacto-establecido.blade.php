@php 
    $total_contactos = 0;
@endphp
<div class="col-xs-12 pitchuu">
    <div class="ibox">
        <div class="ibox-content">
            <h3>Contacto establecido</h3>
            <p class="small"><i class="fa fa-hand-o-up"></i> Arrastra las oportunidades entre las listas</p>
            <ul class="sortable-list connectList agile-list" id="contacto">
                @foreach($establecidos as $establecido)
                    <li class="{{$establecido->estadoOportunidad->class_tablero}}" id="task{{$establecido->id}}" value="{{$establecido->id}}">
                        <div onclick="window.location='{{ route('admin.oportunidades.show', $establecido->id) }}';">
                            {{ $establecido->titulo }}: ${{ $establecido->monto }}
                        </div>
                        <div class="agile-detail">
                            <a href="#" data-toggle="modal" data-target="#myModal{{$establecido->id}}" class="pull-right btn btn-xs btn-white">Perdida</a>
                            <i class="fa fa-clock-o"></i> Cierra el {{ $establecido->fecha_cierre->format('d-m-Y') }}
                        </div>
                    </li>
                    @php 
                        $total_contactos = $total_contactos + $establecido->monto;
                    @endphp
                @endforeach                          
            </ul>
            <div class="text-right">
                <span class="contacto"><b>${{$total_contactos}}</b></span>
            </div>
        </div>
    </div>
</div>