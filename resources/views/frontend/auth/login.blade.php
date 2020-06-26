@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.frontend.auth.login_box_title'))

@section('content')
<div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>
                
            <img src="{{asset('img/frontend/proterra.png')}}">
            </div>
            <p>Ingresa para empezar</p>

                     
            @include('includes.partials.messages')
            {{ html()->form('POST', route('frontend.auth.login.post'))->open() }}
                

                <div class="form-group">
                    {{ html()->email('email')
                        ->class('form-control')
                        ->placeholder(__('validation.attributes.frontend.email'))
                        ->attribute('maxlength', 191)
                        ->required() }}
                </div><!--form-group-->

                <div class="form-group">
                    {{ html()->password('password')
                        ->class('form-control')
                        ->placeholder(__('validation.attributes.frontend.password'))
                        ->required() }}
                </div><!--form-group-->

                <div class="form-group">
                    <div class="checkbox">
                        {{ html()->label(html()->checkbox('remember', true, 1) . ' ' . __('labels.frontend.auth.remember_me'))->for('remember') }}
                    </div>
                </div><!--form-group-->

                <button type="submit" class="btn btn-primary block full-width m-b">Login</button>

                <a href="{{ route('frontend.auth.password.reset') }}"><small>@lang('labels.frontend.passwords.forgot_password')</small></a>
                <!-- <p class="text-muted text-center"><small>¿No tienes cuenta?</small></p> -->
                <!--  <a class="btn btn-sm btn-white btn-block" href="{{route('frontend.auth.register')}}">@lang('navs.frontend.register')</a>
 -->
             {{ html()->form()->close() }}
            {!! $socialiteLinks !!}
            <p class="m-t"> <small>ProTerra 2019</small> </p>
        </div>
    </div>



@endsection
