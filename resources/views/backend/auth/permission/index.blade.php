@extends('backend.layouts.app')

@section('title', app_name() . ' | '. __('labels.backend.access.permissions.management'))

@section('content')
    <div class="ibox float-e-margins">
                    <div class="ibox-title">
                       
                       <strong>@lang('labels.backend.access.permissions.management')</strong>
                       
                        
                    </div>
                    <div class="ibox-content">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables" >
                        <thead>
                        <tr>
                            <th>@lang('labels.backend.access.permissions.table.permissions')</th>
                            <th>@lang('labels.backend.access.permissions.table.guard_name')</th>
                            <th>@lang('labels.backend.access.permissions.table.number_of_roles')</th>
                            
                            <th>@lang('labels.general.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                       
                        @foreach($permissions as $permission)

                            <tr>
                                <td>{{ ucwords($permission->name) }}</td>
                                <td>
                                   {{ ucwords($permission->guard_name) }}
                                </td>
                                <td>{{$permission->roles->count()}}</td>
                                <td>{!! $permission->action_buttons !!}</td>
                            </tr>
                            
                        @endforeach

                        </tbody>
                    </table>
                    @include('backend.auth.permission.includes.header-buttons')
                </div>
            </div><!--col-->
        </div><!--row-->
    </div>
   

@endsection
