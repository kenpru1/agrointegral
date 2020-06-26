@extends('backend.layouts.app_nobread')

@section('content')

    <div class="big-box text-center loginscreen animated fadeInDown">
        <div>
            @if(session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

           {{-- <h3>@lang('navs.frontend.user.account')</h3>
            @can('view backend')
                    <a href="{{ route('admin.dashboard')}}" class="btn btn-danger btn-sm mb-1">
                        <i class="fa fa-user-secret"></i> @lang('navs.frontend.user.administration')
                   </a>
            @endcan
                   <a href="{{ route('frontend.auth.logout') }}" class="btn btn-info btn-sm mb-1">
                        <i class="fa fa-sign-out"></i> @lang('navs.general.logout')
                   </a>
             --}}
                        

                <div class="tabs-container">

                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#profile"> @lang('navs.frontend.user.profile')</a></li>
                            <li class=""><a data-toggle="tab" href="#edit">@lang('labels.frontend.user.profile.update_information')</a></li>
                            {{--<li class=""><a data-toggle="tab" href="#empresa">Empresa</a></li>--}}
                            {{--<li class=""><a data-toggle="tab" href="#planes">Planes</a></li>--}}
                            @if($logged_in_user->canChangePassword())
                                <li class=""><a data-toggle="tab" href="#password">@lang('navs.frontend.user.change_password')</a></li>
                            @endif
                        </ul>
                        
                        <div class="tab-content">
                            <div id="profile" class="tab-pane active">
                                <div class="panel-body">
                                    @include('frontend.user.account.tabs.profile')
                                </div>
                            </div>
                            <div id="edit" class="tab-pane">
                                <div class="panel-body">
                                    @include('frontend.user.account.tabs.edit')
                                      
                                </div>
                            </div>
                           {{-- <div id="empresa" class="tab-pane">
                                <div class="panel-body">
                                    @include('frontend.user.account.tabs.empresa')
                                      
                                </div>
                            </div>--}}
                            {{--<div id="planes" class="tab-pane">
                                <div class="panel-body">
                                    @include('frontend.user.account.tabs.planes')
                                      
                                </div>
                            </div>--}}
                            @if($logged_in_user->canChangePassword())
                                <div id="password" class="tab-pane">
                                    <div class="panel-body">
                                        @include('frontend.user.account.tabs.change-password')
                                      
                                    </div>
                                </div>
                            @endif
                        </div>


                    </div>

                            
            
          
            <p class="m-t"> <small>ProTerra 2019</small> </p>
        </div>
    </div>


@endsection
