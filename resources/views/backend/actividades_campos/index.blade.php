@extends('backend.layouts.app')

@section('title', app_name() . ' | Actividades Campos')

@section('content')
    <div class="ibox float-e-margins">
                    <div class="ibox-title">
                       
                       
                       <strong>Administración de Actividades</strong>
                       
                        
                    </div>
                    <div class="ibox-content">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables" data-page-length='8'>
                        <thead>
                            
                        <tr>
                            <th>Nro.</th>
                            @if($logged_in_user->hasRole('administrator'))
                        <th>
                            Empresa
                        </th>
                        @endif
                            
                            <th>Fecha</th>
                            <th>Trabajadores</th>
                            <th>Tipo Actividades</th>
                            <th>Maquinarias</th>
                            <th>Campos</th>
                            <th>Cuarteles</th>
                            <th>Tiempo Horas:Minutos</th>
                            <th>@lang('labels.general.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                       @php  $key=count($actividades)@endphp 
                        @foreach($actividades as $actividad)

                            <tr>
                                <td>{{ $key-- }}</td>

                                @if($logged_in_user->hasRole('administrator'))
                                <td onclick="window.location='{{route('admin.actividades_campos.show', $actividad->id)}}';">
                                   {{$actividad->empresa->nombre}}
                                </td>
                                @endif
                               
                            <td onclick="window.location='{{route('admin.actividades_campos.show', $actividad->id)}}';">{{ ucwords($actividad->fecha->format('d-m-Y')) }}</td>
                            <td onclick="window.location='{{route('admin.actividades_campos.show', $actividad->id)}}';">
                                @foreach($actividad->trabajadores as $trabajador)

                                {{ $trabajador->nombre }},

                                @endforeach
                            </td>

                            <td onclick="window.location='{{route('admin.actividades_campos.show', $actividad->id)}}';">
                                @foreach($actividad->tipoActividades as $tipoActividad)

                                {{ $tipoActividad->nombre }},

                                @endforeach
                            </td>
                            <td onclick="window.location='{{route('admin.actividades_campos.show', $actividad->id)}}';">
                                @foreach($actividad->maquinarias as $maquinaria)

                                {{ $maquinaria->nombre }},

                                @endforeach
                            </td>
                            
                            
                            <td onclick="window.location='{{route('admin.actividades_campos.show', $actividad->id)}}';">
                                @foreach($actividad->campos as $campo)

                                {{ $campo->nombre }},

                                @endforeach
                            </td>
                            <td onclick="window.location='{{route('admin.actividades_campos.show', $actividad->id)}}';">
                                @foreach($actividad->cuarteles as $cuartel)

                                {{ $cuartel->nombre }},

                                @endforeach
                            </td>

                            <td onclick="window.location='{{route('admin.actividades_campos.show', $actividad->id)}}';">{{$actividad->horas }} - {{$actividad->minutos }}</td>
                                
                            @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('administrator'))
                                <td>{!! $actividad->action_buttons('actividades_campos') !!}</td>
                            @endif
                            </tr>
                            
                        @endforeach

                        </tbody>
                    </table>
                    @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('administrator'))
                           @include('backend.actividades_campos.includes.header-buttons')
                    @endif
                </div>
            </div><!--col-->
        </div><!--row-->
    
   

@endsection
