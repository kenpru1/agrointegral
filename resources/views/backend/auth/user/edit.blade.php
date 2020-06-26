@extends('backend.layouts.app')

@section('title', __('labels.backend.access.users.management') . ' | ' . __('labels.backend.access.users.edit'))

@section('breadcrumb-links')
    @include('backend.auth.user.includes.breadcrumb-links')
@endsection

@section('content')
{{ html()->modelForm($user, 'PATCH', route('admin.auth.user.update', $user->id))->class('form-horizontal')->open() }}
<div>
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>@lang('labels.backend.access.users.management')
                            <small class="text-muted">@lang('labels.backend.access.users.create')</small>
                            </h5>
                            
                        </div>
                        <div class="ibox-content">
                            <form class="form-horizontal">
                               
                                <div class="form-group col-md-6">
                                     {{ html()->label(__('validation.attributes.backend.access.users.first_name'))->class('col-md-2 form-control-label')->for('first_name') }}

                                    <div class="col-md-10">
                                       {{ html()->text('first_name')
                                          ->class('form-control')
                                          ->placeholder(__('validation.attributes.backend.access.users.first_name'))
                                          ->attribute('maxlength', 191)
                                          ->required()
                                          ->autofocus() }}
                                    </div><!--col-->
                                </div><!--form-group-->

                                <div class="form-group col-md-6">
                                        {{ html()->label(__('validation.attributes.backend.access.users.last_name'))->class('col-md-2 form-control-label')->for('last_name') }}

                                    <div class="col-md-10">
                                        {{ html()->text('last_name')
                                            ->class('form-control')
                                            ->placeholder(__('validation.attributes.backend.access.users.last_name'))
                                            ->attribute('maxlength', 191)
                                            ->required() }}
                                    </div><!--col-->
                                </div><!--form-group-->

                                <div class="form-group col-md-6">
                                    {{ html()->label('Correo')->class('col-md-2 form-control-label')->for('email') }}

                                    <div class="col-md-10">
                                       {{ html()->email('email')
                                           ->class('form-control')
                                           ->placeholder(__('validation.attributes.backend.access.users.email'))
                                           ->attribute('maxlength', 191)
                                          ->required() }}
                                    </div><!--col-->
                                </div><!--form-group-->

                                

                                <div class="form-group col-md-6">
                                    {{ html()->label(__('validation.attributes.backend.access.users.active'))->class('col-md-2 form-control-label')->for('active') }}

                                    <div class="col-md-10">
                                        <label class="switch switch-label switch-pill switch-primary">
                                            {{ html()->checkbox('active', true, '1')->class('switch-input') }}
                                            <span class="switch-slider" data-checked="yes" data-unchecked="no"></span>
                                        </label>
                                    </div><!--col-->
                                </div><!--form-group-->

                               {{-- <div class="form-group col-md-6">
                                    {{ html()->label(__('validation.attributes.backend.access.users.confirmed'))->class('col-md-2 form-control-label')->for('confirmed') }}

                                    <div class="col-md-10">
                                        <label class="switch switch-label switch-pill switch-primary">
                                           {{ html()->checkbox('confirmed', true, '1')->class('switch-input') }}
                                           <span class="switch-slider" data-checked="yes" data-unchecked="no"></span>
                                        </label>
                                    </div><!--col-->
                                </div><!--form-group-->--}}

                                @if(! config('access.users.requires_approval'))
                                    <div class="form-group col-md-6">
                                        {{ html()->label('Enviar Correo')->class('col-md-4 form-control-label')->for('confirmation_email') }}

                                    <div class="col-md-10">
                                        <label class="switch switch-label switch-pill switch-primary">
                                            {{ html()->checkbox('confirmation_email', true, '1')->class('switch-input') }}
                                            <span class="switch-slider" data-checked="yes" data-unchecked="no"></span>
                                        </label>
                                        </div><!--col-->
                                    </div><!--form-group-->
                                @endif

                                @if($logged_in_user->hasRole('administrator'))
                                    <div class="row">
                                        <div class="form-group col-md-5 ">
                                            {{ html()->label('Empresa')->for('empresa_id') }}
                                            {{ html()->select('empresa_id', $empresas,isset($user->empresas->first()->id )? $user->empresas->first()->id:null)
                                                ->placeholder('Seleccione Empresa', false)
                                                ->class('form-control chosen-select')
                                                ->required()
                                                ->id('empresa_id') }}
                                        </div><!--form-group-->
                                    </div>
                               @endif




                        @if($logged_in_user->hasRole('administrator') || $logged_in_user->hasRole('executive'))
                        <div class="row">
                         

                            <div class="col-md-10">
                                <div>
                                    <div class="ibox-title">
                                       <h5>Roles</h5>
                        
                                   </div>
                                    <table class="table">
                                        <thead>
                                       
                                        </thead>
                                         <tbody>
                                    <tr>
                                        <td>
                                            @if($roles->count())
                                                @foreach($roles as $role)
                                                   @if($logged_in_user->roles->first()->id <= $role->id )
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <div class="checkbox d-flex align-items-center">
                                                                {{ html()->label(
                                                                        html()->checkbox('roles[]', in_array($role->name, $userRoles), $role->name)
                                                                                ->class('switch-input')
                                                                                ->id('role-'.$role->id)
                                                                        . '<span class="switch-slider" data-checked="on" data-unchecked="off"></span>')
                                                                    ->class('switch switch-label switch-pill switch-primary mr-2')
                                                                    ->for('role-'.$role->id) }}
                                                                {{ html()->label(ucwords($role->name))->for('role-'.$role->id) }}
                                                            </div>
                                                        </div>
                                                   

                                                        {{--<div class="card-body">
                                                            @if($role->id != 1)
                                                                @if($role->permissions->count())
                                                                    @foreach($role->permissions as $permission)
                                                                        <i class="fas fa-dot-circle"></i> {{ ucwords($permission->name) }}
                                                                    @endforeach
                                                                @else
                                                                    @lang('labels.general.none')
                                                                @endif
                                                            @else
                                                                @lang('labels.backend.access.users.all_permissions')
                                                            @endif
                                                        </div>--}}
                                                    </div><!--card-->
                                                    @endif
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>
                                            {{--@if($permissions->count())
                                                @foreach($permissions as $permission)
                                                    <div class="checkbox d-flex align-items-center">
                                                        {{ html()->label(
                                                                html()->checkbox('permissions[]', in_array($permission->name, $userPermissions), $permission->name)
                                                                        ->class('switch-input')
                                                                        ->id('permission-'.$permission->id)
                                                                    . '<span class="switch-slider" data-checked="on" data-unchecked="off"></span>')
                                                                ->class('switch switch-label switch-pill switch-primary mr-2')
                                                            ->for('permission-'.$permission->id) }}
                                                        {{ html()->label(ucwords($permission->name))->for('permission-'.$permission->id) }}
                                                    </div>
                                                @endforeach
                                            @endif--}}
                                        </td>
                                    </tr>
                                </tbody>
                                    </table>
                                </div>
                            </div><!--col-->
                        </div><!--form-group-->
                    @endif
                                
                               

                            <div class="mail-body text-right tooltip-demo">
                                                        
                                <a class="btn btn-white btn-sm" href="{{route('admin.auth.user.index')}}" >@lang('buttons.general.cancel')</a>
                                <button class="btn btn-sm btn-primary" type="submit">Editar Usuario</button>
                                
                            </div>




                                
                            </form>
                        </div>
                    </div>
             


        </div><!--card-->    


{{ html()->closeModelForm() }}
@endsection
