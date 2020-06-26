@extends('backend.layouts.app')

@section('title', app_name() . ' | Planes')

@section('content')
    <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <strong>Planes</strong>
                       </div>
                <div class="ibox-content">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables" data-page-length='8'>
                        <thead>
                        <tr>
                            <th>Nro.</th>
                            <th>Nombre</th>
                            <th>UF</th>
                            <th>Cantidad UF</th>
                            <th>Costo</th>
                            
                            
                            @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('administrator'))
                            <th>@lang('labels.general.actions')</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                       @php  $key=count($planes)@endphp 
                        @foreach($planes as $plan)

                            <tr>
                                <td>{{ $key-- }}</td>
                                <td onclick="window.location='{{route('admin.raciones.show', $plan->id)}}';">{{strip_tags($plan->nombre)}}</td>
                                
                                 <td onclick="window.location='{{route('admin.raciones.show', $plan->id)}}';"  >$<strong>{{$plan->valor_uf}}</strong></td>

                                  <td onclick="window.location='{{route('admin.raciones.show', $plan->id)}}';"  ><strong>{{$plan->cantidad_uf}}</strong></td>


                                <td onclick="window.location='{{route('admin.raciones.show', $plan->id)}}';"  >$<strong>{{$plan->costo}}</strong></td>

                               

                               
                               
                                
                                @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('administrator'))
                                    <td> {!! $plan->action_buttons !!}</td>
                                @endif
                                
                            </tr>
                            
                        @endforeach

                        </tbody>
                    </table>
                    @include('backend.planes.includes.header-buttons')
                </div>
            </div><!--col-->
        </div><!--row-->

   

@endsection
