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
            
            
            {{ html()->form('POST', route('frontend.auth.password.email.post'))->open() }}

                <div class="form-group">
                    {{ html()->email('email')
                        ->class('form-control')
                        ->placeholder(__('validation.attributes.frontend.email'))
                        ->attribute('maxlength', 191)
                        ->required()
                        ->autofocus() }}
                </div><!--form-group-->
                

                

                <button type="submit" class="btn btn-primary block full-width m-b">@lang('labels.frontend.passwords.send_password_reset_link_button')</button>

              
            {{ html()->form()->close() }}
            
            <p class="m-t"> <small>ProTerra 2019</small> </p>
        </div>
    </div>

@endsection
