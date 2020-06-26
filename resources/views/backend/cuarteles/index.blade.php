@extends('backend.layouts.app')

@section('title', app_name() . ' | Cuarteles')

@section('content')
    <div class="ibox float-e-margins">
                    <div class="ibox-title">
                       
                      <strong> Administración de Cuarteles</strong>
                       
                        
                    </div>
                <div class="ibox-content">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables"  data-page-length='8'>
                        <thead>
                        <tr>
                            <th>Nro.</th>
                            @if($logged_in_user->hasRole('administrator'))
                                <th>Empresa</th>
                            @endif
                            <th>Campo</th>
                            <th>Nombre</th>
                            <th>Propio</th>
                            <th>Productivo</th>
                            <th>Provincia</th>
                            <th>Comuna</th>
                            <th>Tamaño</th>
                            <th>Tipo Cultivo</th>
                            @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('administrator'))
                            <th>@lang('labels.general.actions')</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        @php  $key=count($cuarteles)@endphp 
                        @foreach($cuarteles as $cuartel)

                                <tr>
                                    <td>{{ $key-- }}</td>
                                @if($logged_in_user->hasRole('administrator'))
                                    <td onclick="window.location='{{route('admin.cuarteles.show', $cuartel->id)}}';">{{ ucwords($cuartel->campo->empresa->nombre) }}</td>
                                @endif
                                <td onclick="window.location='{{route('admin.cuarteles.show', $cuartel->id)}}';">{{ $cuartel->campo->nombre }}</td>
                                <td onclick="window.location='{{route('admin.cuarteles.show', $cuartel->id)}}';">{{ ucwords($cuartel->nombre) }}</td>
                                <td onclick="window.location='{{route('admin.cuarteles.show', $cuartel->id)}}';">
                                    @if($cuartel->propio==1)
                                        Propio
                                    @else
                                        Arrendado
                                    @endif

                                </td>
                                <td onclick="window.location='{{route('admin.cuarteles.show', $cuartel->id)}}';">
                                    @if($cuartel->productivo==1)
                                        Productivo
                                    @else
                                        No Productivo
                                    @endif

                                </td>
                                <td onclick="window.location='{{route('admin.cuarteles.show', $cuartel->id)}}';">{{$cuartel->provincia->nombre}}</td>
                                <td onclick="window.location='{{route('admin.cuarteles.show', $cuartel->id)}}';">{{$cuartel->comuna->nombre}}</td>
                                <td onclick="window.location='{{route('admin.cuarteles.show', $cuartel->id)}}';">{{number_format($cuartel->tamanno, 2,',','.')}}</td>
                                <td onclick="window.location='{{route('admin.cuarteles.show', $cuartel->id)}}';">
                                    @if(isset($cuartel->tipoCultivo->nombre))
                                        {{$cuartel->tipoCultivo->nombre}}
                                    @else 
                                        N/A
                                    @endif

                                </td>
                                @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('administrator'))
                                <td>{!! $cuartel->action_buttons !!}</td>
                                @endif
                            
                            </tr>
                            
                        @endforeach

                        </tbody>
                    </table>
                    @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('administrator'))
                           @include('backend.cuarteles.includes.header-buttons')
                       @endif
                </div>
            </div><!--col-->
        </div><!--row-->
    
   

@endsection
