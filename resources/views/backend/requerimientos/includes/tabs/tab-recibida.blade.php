@php 
    $total_recibida = 0;
@endphp
    <div class="ibox">
        <div class="ibox-content">
            <h3 class="badge badge-dark">Informes Recibidos</h3>
            <p class="small"><i class="fa fa-hand-o-up"></i> Arrastra los requerimientos entre las listas</p>
            <ul class="sortable-list connectList agile-list" id="informes_recibidos">
                @foreach($recibidas as $recibida)
                    <li class="text-light" id="task{{$recibida->id}}" value="{{$recibida->id}}">
                        <div onclick="window.location='{{ route('admin.requerimientos.edit', $recibida->id) }}';">
                            {{ $recibida->titulo }}: ${{ $recibida->monto }}
                        </div>
                        <div class="agile-detail">
                            <a href="#" data-toggle="modal" data-target="#myModal{{$recibida->id}}" class="pull-right btn btn-xs btn-white">Archivar</a>
                            <i class="fa fa-clock-o"></i> Cierra el {{ $recibida->fecha_cierre->format('d-m-Y') }}
                        </div>
                        <div>
                                <a href="{{ route('admin.ordenLaboratorios.show', $recibida->ordenLaboratorios->id) }}" class="text-primary" style="color: #0000FF;"> Ord. Laboratorio Nro. {{ $recibida->ordenLaboratorios->numero}}</a>
                                <br>
                                <a href="{{ route('admin.ordenTrabajos.show', $recibida->ordenTrabajos->id) }}" class="text-primary" style="color: #0000FF;"> Ord. Trabajo Nro. {{ $recibida->ordenTrabajos->numero}}</a>
                                <br>
                                <a href="{{ route('admin.presupuestos.show', $recibida->presupuestos->id) }}" class="text-primary" style="color: #0000FF;">Cotización Nro. {{ $recibida->presupuestos->numero}}</a>

                        </div>                                                  
                    </li>
                    @php 
                        $total_recibida = $total_recibida + $recibida->monto;
                    @endphp
                @endforeach
            </ul>
            <div class="text-right">
                <span class="contacto"><b>${{$total_recibida}}</b></span>
            </div>
        </div>
    </div>
