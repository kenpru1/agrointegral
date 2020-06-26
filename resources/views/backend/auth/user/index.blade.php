@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.access.users.management'))

@section('breadcrumb-links')
    @include('backend.auth.user.includes.breadcrumb-links')
@endsection

@section('content')
<div class="ibox float-e-margins">
                    <div class="ibox-title">
                      
{{ $logged_in_user->roles->first()->id }}

                      <strong>Administración de Usuarios<small class="text-muted"> {{ __('labels.backend.access.users.active') }}</small>
                       </strong> 
                        
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
                            <th>@lang('labels.backend.access.users.table.last_name')</th>
                            <th>@lang('labels.backend.access.users.table.first_name')</th>
                            <th>@lang('labels.backend.access.users.table.email')</th>
                            @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('administrator'))
                            <th>Activo</th>
                            @endif
                            <th>@lang('labels.backend.access.users.table.roles')</th>
                           
                            <th>@lang('labels.backend.access.users.table.last_updated')</th>
                            <th>Creación</th>
                            {{--<th>Limite Prueba</th>--}}
                            @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('administrator'))
                            <th>@lang('labels.general.actions')</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                       @php  $key=count($users)@endphp 
                        @foreach($users as $user)
                        @if($logged_in_user->roles->first()->id <= $user->roles->first()->id )
                            <tr>
                                <td>{{ $key-- }}</td>
                                @if($logged_in_user->hasRole('administrator'))
                                    <td onclick="window.location='{{route('admin.auth.user.show', $user->id)}}';">
                                        @if($user->empresaUser()!=null)
                                            {{ ucwords($user->empresaUser()->nombre) }}
                                        @else 
                                        --
                                        @endif

                                    </td>
                                @endif
                                <td onclick="window.location='{{route('admin.auth.user.show', $user->id)}}';">{{ $user->last_name }}</td>
                                <td onclick="window.location='{{route('admin.auth.user.show', $user->id)}}';">{{ $user->first_name }}</td>
                                <td onclick="window.location='{{route('admin.auth.user.show', $user->id)}}';">{{ $user->email }}</td>
                                @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('administrator'))
                                <td onclick="window.location='{{route('admin.auth.user.show', $user->id)}}';">{!! $user->confirmed_label !!}</td>
                                @endif
                                <td onclick="window.location='{{route('admin.auth.user.show', $user->id)}}';">{!! $user->roles_label !!}</td>
                              
                                <td onclick="window.location='{{route('admin.auth.user.show', $user->id)}}';">{{ $user->updated_at->diffForHumans() }}</td>
                                <td onclick="window.location='{{route('admin.auth.user.show', $user->id)}}';">{{ $user->created_at->format('d-m-Y H:m:s') }}</td>
                                {{--<td onclick="window.location='{{route('admin.auth.user.show', $user->id)}}';">
                                    @if (!$user->isAdmin())
                                    {{ $user->created_at->addDays(config('auth.test_time'))->format('d-m-Y H:m:s') }} 
                                    @else
                                     N/A
                                    @endif

                                </td>--}}
                                @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('administrator'))
                                <td>{!! $user->action_buttons !!}</td>
                                @endif
                            </tr>
                            @endif
                        @endforeach

                        </tbody>
                    </table>
                    @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('administrator'))
                        @include('backend.auth.user.includes.header-buttons')
                    @endif
                </div>
            </div><!--col-->
        </div><!--row-->
    


@endsection
