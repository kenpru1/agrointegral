@php 
    $total_registradas = 0;
@endphp
    <div class="ibox">
        <div class="ibox-content">
            <h3 class="badge badge-light">Registrada</h3>
            <p class="small"><i class="fa fa-hand-o-up"></i> Arrastra los requerimientos entre las listas</p>

            <ul class="sortable-list connectList agile-list" id="registrada">
                @foreach($registradas as $registrada)
                    @if($registrada->presupuesto_id != null)
                    <li class="text-light" id="task{{$registrada->id}}" value="{{$registrada->id}}">
                        <div onclick="window.location='{{ route('admin.requerimientos.edit', $registrada->id) }}';">
                            {{ $registrada->titulo }}: ${{ $registrada->monto }}
                        </div>
                        <div>
                            <a href="{{ route('admin.presupuestos.show', $registrada->presupuestos->id) }}" class="text-primary" style="color: #0000FF;"> Cotización Nro. {{ $registrada->presupuestos->numero}}</a>
                            
                        </div>                                                  
                        <div class="agile-detail">
                            <a href="#" data-toggle="modal" data-target="#myModal{{$registrada->id}}" class="pull-right btn btn-xs btn-white">Archivar</a>
                            <i class="fa fa-clock-o"></i> Cierra el {{ $registrada->fecha_cierre->format('d-m-Y') }}
                        </div>

                    </li>
                    @php 
                        $total_registradas = $total_registradas + $registrada->monto;
                    @endphp

                    @else
                    <li class="text-{{$registrada->etapaRequerimiento->colores}}" id="task{{$registrada->id}}" value="{{$registrada->id}}">                        
                        <div onclick="window.location='{{ route('admin.requerimientos.edit', $registrada->id) }}';">
                            {{ $registrada->titulo }}: ${{ $registrada->monto }}
                        </div>                        
                        <div>
                            <a href="{{ route('admin.requerimientos.edit', $registrada->id) }}" class="text-primary" style="color: #0000FF;">Asociar Cotización</a>
                            
                        </div>                          
                        <div class="agile-detail">
                            <a href="#" data-toggle="modal" data-target="#myModal{{$registrada->id}}" class="pull-right btn btn-xs btn-white">Archivar</a>
                            <i class="fa fa-clock-o"></i> Cierra el {{ $registrada->fecha_cierre->format('d-m-Y') }}
                        </div>

                    </li>
                    @php 
                        $total_registradas = $total_registradas + $registrada->monto;
                    @endphp                        
                    @endif               
                @endforeach       
            </ul>
            <div class="text-right">
                <span class="registrada"><b>${{$total_registradas}}</b></span>
            </div>
        </div>
    </div>
