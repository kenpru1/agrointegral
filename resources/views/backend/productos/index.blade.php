@extends('backend.layouts.app')

@section('title', app_name() . ' | Productos')

@section('content')
    <div class="ibox float-e-margins">
                    <div class="ibox-title">
                       
                      <strong> Administración de Productos</strong>
                       
                        
                    </div>
                    <div class="ibox-content">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables" data-page-length='8'>
                        <thead>
                        <tr>
                            <th>Nro.</th>
                            @if($logged_in_user->hasRole('administrator'))
                                <th>Empresa</th>
                            @endif
                            <th>Nombre</th>
                             <th>Unidad Medida</th>
                             <th>Tipo</th>
                             <th>Estado Venta</th>

                             <th>Ficha Técnica</th>
                            
                            @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('administrator'))
                            <th>@lang('labels.general.actions')</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                       @php  $key=count($productos)@endphp 
                        @foreach($productos as $producto)

                            <tr>
                                <td>{{ $key-- }}</td>
                                @if($logged_in_user->hasRole('administrator'))
                                    <td onclick="window.location='{{route('admin.productos.show', $producto->id)}}';">{{$producto->empresa->nombre}}</td>
                                @endif
                                <td onclick="window.location='{{route('admin.productos.show', $producto->id)}}';">{{ ucwords($producto->nombre) }}</td>
                                <td onclick="window.location='{{route('admin.productos.show', $producto->id)}}';">{{$producto->unidad->nombre}}</td>
                                <td onclick="window.location='{{route('admin.productos.show', $producto->id)}}';">{{$producto->tipo_producto->nombre}}</td>
                                <td onclick="window.location='{{route('admin.productos.show', $producto->id)}}';">{{$producto->estado_venta->nombre}}</td>
                                <td align="center">
                                    @if($producto->ficha_tecnica!=null)
                                   <div class="btn-group btn-group-sm">
                                        <a href="{{asset($producto->ficha_tecnica)}}" title="Descargar"  target="_blank"><i class="fa fa-arrow-down"></i> </a>
                                    </div>


                                    @else
                                    N/A
                                    @endif

                                </td>

                                
                                @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('administrator'))
                                <td>{!! $producto->action_buttons !!}</td>
                                @endif
                            </tr>
                            
                        @endforeach

                        </tbody>
                    </table>
                    @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('administrator'))
                           @include('backend.productos.includes.header-buttons')
                       @endif
                </div>
            </div><!--col-->
        </div><!--row-->
    
   

@endsection
