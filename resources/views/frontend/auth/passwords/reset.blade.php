@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.frontend.passwords.reset_password_box_title'))

@section('content')
   <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>

                <img src="{{asset('img/frontend/proterra.png')}}">

            </div>
            <h3>Bienvenido a ProTerra</h3>
            <p>@lang('labels.frontend.passwords.reset_password_box_title')</p>
            @include('includes.partials.messages')
            

                    {{ html()->form('POST', route('frontend.auth.password.reset'))->class('form-horizontal')->open() }}
                        {{ html()->hidden('token', $token) }}

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    {{ html()->label(__('validation.attributes.frontend.email'))->for('email') }}

                                    {{ html()->email('email')
                                        ->class('form-control')
                                        ->placeholder(__('validation.attributes.frontend.email'))
                                        ->attribute('maxlength', 191)
                                        ->required() }}
                                </div><!--form-group-->
                            </div><!--col-->
                        </div><!--row-->

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    {{ html()->label(__('validation.attributes.frontend.password'))->for('password') }}

                                    {{ html()->password('password')
                                        ->class('form-control')
                                        ->placeholder(__('validation.attributes.frontend.password'))
                                        ->required() }}
                                </div><!--form-group-->
                            </div><!--col-->
                        </div><!--row-->

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    {{ html()->label(__('validation.attributes.frontend.password_confirmation'))->for('password_confirmation') }}

                                    {{ html()->password('password_confirmation')
                                        ->class('form-control')
                                        ->placeholder(__('validation.attributes.frontend.password_confirmation'))
                                        ->required() }}
                                </div><!--form-group-->
                            </div><!--col-->
                        </div><!--row-->

                        <div class="row">
                            <div class="col">
                                <div class="form-group mb-0 clearfix">
                                    

                                    <button type="submit" class="btn btn-primary block full-width m-b">@lang('labels.frontend.passwords.reset_password_button')</button>
                                </div><!--form-group-->
                            </div><!--col-->
                        </div><!--row-->
                    {{ html()->form()->close() }}
                <p class="m-t"> <small>ProTerra 2019</small> </p>
        </div>
    </div>- 
@endsection
