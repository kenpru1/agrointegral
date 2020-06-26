@extends('backend.layouts.app')

@section('title', app_name() . ' | '. __('labels.backend.access.roles.management'))

@section('content')
    <div class="ibox float-e-margins">
                    <div class="ibox-title">
                       
                       
                       <strong>@lang('labels.backend.access.roles.management')</strong>
                       
                        
                    </div>
                    <div class="ibox-content">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables" data-page-length='8'>
                        <thead>
                        <tr>
                            <th>@lang('labels.backend.access.roles.table.role')</th>
                            <th>@lang('labels.backend.access.roles.table.permissions')</th>
                            <th>@lang('labels.backend.access.roles.table.number_of_users')</th>
                            <th>@lang('labels.general.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                       
                        @foreach($roles as $role)
                            <tr>
                                <td>{{ ucwords($role->name) }}</td>
                                <td>
                                    @if($role->id == 1)
                                        @lang('labels.general.all')
                                    @else
                                        @if($role->permissions->count())
                                            @foreach($role->permissions as $permission)
                                                {{ ucwords($permission->name) }}
                                            @endforeach
                                        @else
                                            @lang('labels.general.none')
                                        @endif
                                    @endif
                                </td>
                                <td>{{ $role->users->count() }}</td>
                                <td>{!! $role->action_buttons !!}</td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                    @include('backend.auth.role.includes.header-buttons')
                </div>
            </div><!--col-->
        </div><!--row-->
    </div>
   



@endsection
