@extends('backend.layouts.app')

@section('title', app_name() . ' | Bodegas')

@section('content')
    <div class="ibox float-e-margins">
                    <div class="ibox-title">
                       
                       <strong>Administración de Bodegas</strong>
                       
                        
                    </div>
                    <div class="ibox-content">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables" >
                        <thead>
                        <tr>
                            <th>Nro.</th>
                            @if($logged_in_user->hasRole('administrator'))
                                <th>Empresa</th>
                            @endif
                            <th>Nombre</th>
                            <th>Campo</th>
                            <th>Propio</th>
                            <th>Dirección</th>
                            <th>Provincia</th>
                            <th>Comuna</th>
                            @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('administrator'))
                            <th>@lang('labels.general.actions')</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                       @php  $key=count($bodegas)@endphp 
                        @foreach($bodegas as $bodega)

                            <tr>
                                <td>{{ $key-- }}</td>
                                @if($logged_in_user->hasRole('administrator'))
                                    <td onclick="window.location='{{route('admin.bodegas.show', $bodega->id)}}';">{{ ucwords($bodega->empresa->nombre) }}</td>
                                @endif
                                <td onclick="window.location='{{route('admin.bodegas.show', $bodega->id)}}';">{{ ucwords($bodega->nombre) }}</td>
                                <td onclick="window.location='{{route('admin.bodegas.show', $bodega->id)}}';">
                                    @if(isset($bodega->campo->nombre))
                                    {{ $bodega->campo->nombre}}
                                    @else
                                    -
                                    @endif

                                     </td>
                                <td onclick="window.location='{{route('admin.bodegas.show', $bodega->id)}}';">
                                    @if($bodega->propio==1)
                                        Propio
                                    @else
                                        Arrendado
                                    @endif

                                </td>
                                <td onclick="window.location='{{route('admin.bodegas.show', $bodega->id)}}';">{{$bodega->direccion}}</td>
                                <td onclick="window.location='{{route('admin.bodegas.show', $bodega->id)}}';">{{$bodega->provincia->nombre}}</td>
                                <td onclick="window.location='{{route('admin.bodegas.show', $bodega->id)}}';">{{$bodega->comuna->nombre}}</td>
                                @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('administrator'))
                                    <td>{!! $bodega->action_buttons !!}</td>
                                @endif
                            </tr>
                            
                        @endforeach

                        </tbody>
                    </table>
                    @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('administrator'))
                           @include('backend.bodegas.includes.header-buttons')
                       @endif
                </div>
            </div><!--col-->
        </div><!--row-->
   
   

@endsection
