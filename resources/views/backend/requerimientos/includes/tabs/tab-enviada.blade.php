@php 
    $total_enviada = 0;
@endphp
    <div class="ibox">
        <div class="ibox-content">
            <h3 class="badge badge-primary">Enviada a Loboratorio</h3>
            <p class="small"><i class="fa fa-hand-o-up"></i> Arrastra los requerimientos entre las listas</p>

            <ul class="sortable-list connectList agile-list" id="enviada_laboratorio">
                @foreach($enviadas as $enviada)
                    <li class="text-light" id="task{{$enviada->id}}" value="{{$enviada->id}}">
                        <div onclick="window.location='{{ route('admin.requerimientos.edit', $enviada->id) }}';">
                            {{ $enviada->titulo }}: ${{ $enviada->monto }}
                        </div>
                        <div class="agile-detail">
                            <a href="#" data-toggle="modal" data-target="#myModal{{$enviada->id}}" class="pull-right btn btn-xs btn-white">Archivar</a>
                            <i class="fa fa-clock-o"></i> Cierra el {{ $enviada->fecha_cierre->format('d-m-Y') }}
                        </div>
                        <div>
                            @if(isset($enviada->ordenTrabajos->numero))
                                <a href="{{ route('admin.ordenLaboratorios.show', $enviada->ordenLaboratorios->id) }}" class="text-primary" style="color: #0000FF;"> Ord. Laboratorio Nro. {{ $enviada->ordenLaboratorios->numero}}</a>
                                <a href="javascript:ordenLaboratorio(  {{ 'null' }}, {{  $enviada->id }} )" class="text-primary" style="color: #000000;"> quitar</a>                                
                                <br>
                                <a href="{{ route('admin.ordenTrabajos.show', $enviada->ordenTrabajos->id) }}" class="text-primary" style="color: #0000FF;"> Ord. Trabajo Nro. {{ $enviada->ordenTrabajos->numero}}</a>
                                <br>

                                <a href="{{ route('admin.presupuestos.show', $enviada->presupuestos->id) }}" class="text-primary" style="color: #0000FF;">Cotización Nro. {{ $enviada->presupuestos->numero}}</a>

                            @else
                                <a href="{{ route('admin.requerimientos.edit', $enviada->id) }}" class="text-primary" style="color: #0000FF;">Asociar Ord. Laboratorio</a>       
                            @endif
                        </div>                                                  
                    </li>
                    @php 
                        $total_enviada = $total_enviada + $enviada->monto;
                    @endphp
                @endforeach       
            </ul>
            <div class="text-right">
                <span class="enviada"><b>${{$total_enviada}}</b></span>
            </div>
        </div>
    </div>
