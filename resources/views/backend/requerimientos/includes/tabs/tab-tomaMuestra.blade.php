@php 
    $total_tomaMuestra = 0;
@endphp
    <div class="ibox">
        <div class="ibox-content">
            <h3 class="badge badge-success">Toma Muestra</h3>
            <p class="small"><i class="fa fa-hand-o-up"></i> Arrastra los requerimientos entre las listas</p>

            <ul class="sortable-list connectList agile-list" id="muestra">
                @foreach($tomaMuestras as $tomaMuestra)
                    @if($tomaMuestra->orden_laboratorio_id != null)
                    <li class="text-light" id="task{{$tomaMuestra->id}}" value="{{$tomaMuestra->id}}">
                        <div onclick="window.location='{{ route('admin.requerimientos.edit', $tomaMuestra->id) }}';">
                            {{ $tomaMuestra->titulo }}: ${{ $tomaMuestra->monto }}
                        </div>
                        <div class="agile-detail">
                            <a href="#" data-toggle="modal" data-target="#myModal{{$tomaMuestra->id}}" class="pull-right btn btn-xs btn-white">Archivar</a>
                            <i class="fa fa-clock-o"></i> Cierra el {{ $tomaMuestra->fecha_cierre->format('d-m-Y') }}
                        </div>
                        <div>
                            @if(isset($tomaMuestra->ordenLaboratorios->numero))
                                <a class="text-primary" href="{{ route('admin.ordenLaboratorios.show', $tomaMuestra->ordenLaboratorios->id) }}" class="text-primary" style="color: #0000FF;"> Orden de Laboratorio Nro. {{ $tomaMuestra->ordenLaboratorios->numero}}</a>
                                <a href="javascript:ordenLaboratorio(  {{ 'null' }}, {{  $tomaMuestra->id }} )" class="text-primary" style="color: #000000;"> Quitar</a>                                
                                <br>
                                <a href="{{ route('admin.ordenTrabajos.show', $tomaMuestra->ordenTrabajos->id) }}" class="text-primary" style="color: #0000FF;"> Ord. Trabajo Nro. {{ $tomaMuestra->ordenTrabajos->numero}}</a>

                                <br>
                                <a href="{{ route('admin.presupuestos.show', $tomaMuestra->presupuestos->id) }}" class="text-primary " style="color: #0000FF;">Cotización Nro. {{ $tomaMuestra->presupuestos->numero}}</a>
                             
                            @else
                                <a href="{{ route('admin.requerimientos.edit', $tomaMuestra->id) }}" class="text-primary" style="color: #0000FF;">Asociar Orden de Laboratorio</a>                            
                            @endif

                        </div>
                    </li>
                    @php 
                        $total_tomaMuestra = $total_tomaMuestra + $tomaMuestra->monto;
                    @endphp

                    @else
                    <li class="text-light" id="task{{$tomaMuestra->id}}" value="{{$tomaMuestra->id}}">                        
                        <div onclick="window.location='{{ route('admin.requerimientos.edit', $tomaMuestra->id) }}';">
                            {{ $tomaMuestra->titulo }}: ${{ $tomaMuestra->monto }}
                        </div>                        
                        <div class="agile-detail">
                            <a href="#" data-toggle="modal" data-target="#myModal{{$tomaMuestra->id}}" class="pull-right btn btn-xs btn-white">Archivar</a>
                            <i class="fa fa-clock-o"></i> Cierra el {{ $tomaMuestra->fecha_cierre->format('d-m-Y') }}
                        </div>
                        <div class="row">
                        <div class="col-xs-6">

                            @if(isset($tomaMuestra->ordenTrabajos->numero))
                                
                                <a href="{{ route('admin.ordenTrabajos.show', $tomaMuestra->ordenTrabajos->id) }}" class="text-primary" style="color: #0000FF;"> Ord. Trabajo Nro. {{ $tomaMuestra->ordenTrabajos->numero}}</a>
                                <a href="javascript:ordenTrabajo(  {{ 'null' }}, {{  $tomaMuestra->id }} )" class="text-primary" style="color: #000000;"> Quitar</a>                                
                                <br>
                                <a href="{{ route('admin.presupuestos.show', $tomaMuestra->presupuestos->id) }}" class="text-primary" style="color: #0000FF;">Cotización Nro. {{ $tomaMuestra->presupuestos->numero}}</a>  
                                <br>                                                   
                            @else
                                <a href="{{ route('admin.requerimientos.edit', $tomaMuestra->id) }}" class="text-primary" style="color: #0000FF;">Asociar Orden Trabajo</a>
                                <br>                           
                            @endif 
                            <a href="{{ route('admin.requerimientos.edit', $tomaMuestra->id) }}" class="text-primary" style="color: #0000FF;">Asociar Ord. Laboratorio</a>                            

                        </div>    

                        </div>  
                    </li>
                    @php 
                        $total_tomaMuestra = $total_tomaMuestra + $tomaMuestra->monto;
                    @endphp                        
                    @endif               
                @endforeach       
            </ul>
            <div class="text-right">
                <span class="tomaMuestra"><b>${{$total_tomaMuestra}}</b></span>
            </div>
        </div>
    </div>
