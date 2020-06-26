@php 
    $total_aprobada = 0;
@endphp
    <div class="ibox">
        <div class="ibox-content">
            <h3 class="badge badge-danger">Aprobada</h3>
            <p class="small"><i class="fa fa-hand-o-up"></i> Arrastra los requerimientos entre las listas</p>

            <ul class="sortable-list connectList agile-list" id="aprobada">
                @foreach($aprobadas as $aprobada)
                    <li class="text-light" id="task{{$aprobada->id}}" value="{{$aprobada->id}}">
                        <div onclick="window.location='{{ route('admin.requerimientos.edit', $aprobada->id) }}';">
                            {{ $aprobada->titulo }}: ${{ $aprobada->monto }}
                        </div>
                        <div class="agile-detail">
                            <a href="#" data-toggle="modal" data-target="#myModal{{$aprobada->id}}" class="pull-right btn btn-xs btn-white">Archivar</a>
                            <i class="fa fa-clock-o"></i> Cierra el {{ $aprobada->fecha_cierre->format('d-m-Y') }}
                        </div>
                        <div>
                            @if(isset($aprobada->ordenTrabajos->numero))
                                <a href="{{ route('admin.ordenTrabajos.show', $aprobada->ordenTrabajos->id) }}" class="text-primary" style="color: #0000FF;"> Orden de Trabajo Nro. {{ $aprobada->ordenTrabajos->numero}}</a>
                                <a href="javascript:ordenTrabajo(  {{ 'null' }}, {{  $aprobada->id }} )" class="text-primary" style="color: #000000;"> Quitar</a>                                
                                <br>
                                <a href="{{ route('admin.presupuestos.show', $aprobada->presupuestos->id) }}" class="text-primary" style="color: #0000FF;">Cotización Nro. {{ $aprobada->presupuestos->numero}}</a>

                                <br>                                
                            @else
                                <a href="{{ route('admin.presupuestos.show', $aprobada->presupuestos->id) }}" class="text-primary ml-2" style="color: #0000FF; margin-left: 5px;"> Cotización Nro. {{ $aprobada->presupuestos->numero}}</a>
                                <a href="javascript:cotiza(  {{ 'null' }}, {{  $aprobada->id }} )" class="text-primary" style="color: #000000;"> Quitar</a>
                                <br>                            
                                <a href="{{ route('admin.requerimientos.edit', $aprobada->id) }}" class="text-primary" style="color: #0000FF;">Asociar Orden de Trabajo</a>       
                            @endif
                        </div>                                                  
                    </li>
                    @php 
                        $total_aprobada = $total_aprobada + $aprobada->monto;
                    @endphp
                @endforeach       
            </ul>
            <div class="text-right">
                <span class="presupuestada"><b>${{$total_aprobada}}</b></span>
            </div>
        </div>
    </div>
