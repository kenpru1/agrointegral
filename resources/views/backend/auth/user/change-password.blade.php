@extends('backend.layouts.app')

@section('title', __('labels.backend.access.users.management') . ' | ' . __('labels.backend.access.users.change_password'))

@section('breadcrumb-links')
    @include('backend.auth.user.includes.breadcrumb-links')
@endsection

@section('content')
{{ html()->form('PATCH', route('admin.auth.user.change-password.post', $user))->class('form-horizontal')->open() }}
 <div>
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5> @lang('labels.backend.access.users.change_password')
                                <small class="text-muted"> @lang('labels.backend.access.users.change_password_for', ['user' => $user->name])</small>
                            </h5>
                            
                        </div>
                        <div class="ibox-content">
                            <form class="form-horizontal">
                               <div class="row">
                                <div class="form-group col-md-5">
                                    {{ html()->label(__('validation.attributes.backend.access.users.password'))->for('password') }}

                                    {{ html()->password('password')
                                        ->class('form-control')
                                        ->placeholder( __('validation.attributes.backend.access.users.password'))
                                        ->required()
                                        ->autofocus() }}
                                               
                                </div>

                                <div class="form-group col-md-5 col-md-push-1">
                                    {{ html()->label(__('validation.attributes.backend.access.users.password_confirmation'))->for('password_confirmation') }}
                    
                                        {{ html()->password('password_confirmation')
                                            ->class('form-control')
                                            ->placeholder( __('validation.attributes.backend.access.users.password_confirmation'))
                                            ->required() }}
                                </div><!--form-group-->

                                
                                </div>
                        
                                
                               <div class="mail-body text-right tooltip-demo">
                                                        
                                <a class="btn btn-white btn-sm" href="{{route('admin.auth.user.index')}}" >@lang('buttons.general.cancel')</a>
                                <button class="btn btn-sm btn-primary" type="submit">Cambiar Password</button>
                                
                            </div>



                                
                            </form>
                        </div>
                    </div>
                </div>












{{ html()->form()->close() }}
@endsection
