@extends('backend.layouts.app')

@section('title', app_name() . ' | Análisis Suelo')

@section('content')
    <div class="ibox float-e-margins">
                    <div class="ibox-title">
                       
                       <strong>Administración de Análisis Suelos</strong>
                       
                        
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
                            <th>Campo</th>
                            <th>Cuartel</th>
                            <th>Sector</th>
                            @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('administrator'))
                            <th>@lang('labels.general.actions')</th>
                            @endif
                            
                            
                        </tr>
                        </thead>
                        <tbody>
                       @php  $key=count($analisis)@endphp 
                        @foreach($analisis as $analisi)

                            <tr onclick="window.location='{{route('admin.analisis_suelo.show', $analisi->id)}}';">
                                <td>{{ $key-- }}</td>
                                @if($logged_in_user->hasRole('administrator'))
                                    <td>{{ ucwords($analisi->empresa->nombre) }}</td>
                                @endif
                                <td>{{ ucwords($analisi->cuartel->campo->nombre) }}</td>
                                <td>{{ ucwords($analisi->cuartel->nombre) }}</td>
                                <td>{{ $analisi->sector }}</td>
                                @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('administrator'))
                                    <td>{!! $analisi->action_buttons !!}</td>
                                @endif
                                
                            </tr>
                            
                        @endforeach

                        </tbody>
                    </table>
                    @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('administrator'))
                           @include('backend.analisis_suelo.includes.header-buttons')
                       @endif
                </div>
            </div><!--col-->
        </div><!--row-->
  
   

@endsection
