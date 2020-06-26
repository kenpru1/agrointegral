@php 
    $total_cotizada = 0;
@endphp
    <div class="ibox">
        <div class="ibox-content">
            <h3 class="badge badge-warning">Cotizada</h3>
            <p class="small"><i class="fa fa-hand-o-up"></i> Arrastra los requerimientos entre las listas</p>

            <ul class="sortable-list connectList agile-list" id="cotizada">
                @foreach($cotizadas as $cotizada)

                    <li class="text-light" id="task{{$cotizada->id}}" value="{{$cotizada->id}}">                        
                        <div onclick="window.location='{{ route('admin.requerimientos.edit', $cotizada->id) }}';">
                            {{ $cotizada->titulo }}: ${{ $cotizada->monto }}
                        </div>                        
                        <div class="agile-detail">
                            <a href="#" data-toggle="modal" data-target="#myModal{{$cotizada->id}}" class="pull-right btn btn-xs btn-white">Archivar</a>
                            <i class="fa fa-clock-o"></i> Cierra el {{ $cotizada->fecha_cierre->format('d-m-Y') }}

                        </div>
                        <div class="row">
                        <div class="col-xs-6">
                            @if(isset($cotizada->presupuestos->numero))
                                <a href="{{ route('admin.presupuestos.show', $cotizada->presupuestos->id) }}" class="text-primary ml-2" style="color: #0000FF; margin-left: 5px;"> Cotización Nro. {{ $cotizada->presupuestos->numero}}</a>


                                <a href="javascript:cotiza(  {{ 'null' }}, {{  $cotizada->id }} )" class="text-primary" style="color: #000000;"> Quitar</a>
                                <br>
                            @else
                                <a href="{{ route('admin.requerimientos.edit', $cotizada->id) }}" class="text-primary " style="color: #0000FF; margin-left: 5px;">Asociar Cotización</a> 
                                <br>

                            @endif 


                        </div>    

                        </div>  
                    </li>
                    @php 
                        $total_cotizada = $total_cotizada + $cotizada->monto;
                    @endphp                        
                @endforeach       
            </ul>
            <div class="text-right">
                <span class="cliente"><b>${{$total_cotizada}}</b></span>
            </div>
        </div>
    </div>
