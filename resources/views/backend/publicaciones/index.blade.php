@extends('backend.layouts.app')

@section('title', app_name() . ' | Publicaciones')

@section('content')
<div class="ibox float-e-margins">
    <div class="ibox-title">
        <strong>
            Administración de Publicaciones
        </strong>
    </div>
    <div class="ibox-content">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover dataTables" data-page-length="8">
                <thead>
                    <tr>
                        <th>Nro.</th>
                         <th>Titulo</th>
                        <th>Clasificacion</th>
                        <th>Producto o Servicio</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        
                        @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('administrator'))
                        <th>
                            
                        </th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @php  $key=count($publicaciones)@endphp 
                    @foreach($publicaciones as $publicacion)
                    <tr>
                        <td>{{ $key-- }}</td>
                        <td onclick="window.location='{{route('admin.publicaciones.show', $publicacion->id)}}';">
                            {{ ucwords($publicacion->titulo) }}
                        </td>
                        <td onclick="window.location='{{route('admin.publicaciones.show', $publicacion->id)}}';">
                        
                            @if($publicacion->clasificacion==0)
                                Producto
                            @else
                                Servicio
                            @endif
                        </td>
                        <td onclick="window.location='{{route('admin.publicaciones.show', $publicacion->id)}}';">
                        
                            @if($publicacion->producto_id!=null)
                                {{$publicacion->producto->nombre}}
                            @endif

                            @if($publicacion->tipo_actividad_id!=null)
                                {{$publicacion->tipo_actividad->nombre}}
                            @endif

                            @if($publicacion->otro!=null)
                                {{$publicacion->otro}}
                            @endif
                        </td>
                        <td class="text-right"  onclick="window.location='{{route('admin.publicaciones.show', $publicacion->id)}}';">$ {{number_format($publicacion->precio, 0,'.','') }}</td>

                        
                        
                        <td>{{$publicacion->cantidad}}</td>
                       
                        @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('administrator'))
                        <td>{!! $publicacion->action_buttons !!}</td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('administrator'))
                @include('backend.publicaciones.includes.header-buttons')
            @endif
        </div>
    </div>
    <!--col-->
</div>
<!--row-->
@endsection
