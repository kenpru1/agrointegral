@php 
    $total_entregada = 0;
@endphp
    <div class="ibox">
        <div class="ibox-content">
            <h3 class="badge badge-dark">Entregada</h3>
            <p class="small"><i class="fa fa-hand-o-up"></i> Arrastra los requerimientos entre las listas</p>
            <ul class="sortable-list connectList agile-list" id="entregada">
                @foreach($entregadas as $entregada)
                    <li class="text-light" id="task{{$entregada->id}}" value="{{$entregada->id}}">
                        <div onclick="window.location='{{ route('admin.requerimientos.show', $entregada->id) }}';">
                            {{ $entregada->titulo }}: ${{ $entregada->monto }}
                        </div>
                        <div class="agile-detail">
                            <a href="#" data-toggle="modal" data-target="#myModal{{$entregada->id}}" class="pull-right btn btn-xs btn-white">Archivar</a>
                            <i class="fa fa-clock-o"></i> Cierra el {{ $entregada->fecha_cierre->format('d-m-Y') }}
                        </div>
                        <div>
                                <a href="{{ route('admin.ordenLaboratorios.show', $entregada->ordenLaboratorios->id) }}" class="text-primary" style="color: #0000FF;"> Ord. Laboratorio Nro. {{ $entregada->ordenLaboratorios->numero}}</a>
                                <br>
                                <a href="{{ route('admin.ordenTrabajos.show', $entregada->ordenTrabajos->id) }}" class="text-primary" style="color: #0000FF;"> Ord. Trabajo Nro. {{ $entregada->ordenTrabajos->numero}}</a>
                                <br>
                                <a href="{{ route('admin.presupuestos.show', $entregada->presupuestos->id) }}" class="text-primary" style="color: #0000FF;">Cotización Nro. {{ $entregada->presupuestos->numero}}</a>

                        </div>                                                  
                    </li>
                    @php 
                        $total_entregada = $total_entregada + $entregada->monto;
                    @endphp
                @endforeach
            </ul>
            <div class="text-right">
                <span class="contacto"><b>${{$total_entregada}}</b></span>
            </div>
        </div>
    </div>
