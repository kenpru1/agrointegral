@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.frontend.auth.login_box_title'))

@section('content')
<div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>
                

                {{-- <img src="{{asset('img/frontend/proterra_logo.png')}}"> --}}
                <img src="{{asset('img/frontend/123aaa.png')}}">
            </div>
            <p>Actualiza tu Contraseña</p>
            @include('includes.partials.messages')
            {{ html()->form('PATCH', route('frontend.auth.password.expired.update'))->class('form-horizontal')->open() }}

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    {{ html()->label(__('validation.attributes.frontend.old_password'))->for('old_password') }}

                                    {{ html()->password('old_password')
                                        ->class('form-control')
                                        ->placeholder(__('validation.attributes.frontend.old_password'))
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

                        <button type="submit" class="btn btn-primary block full-width m-b">Actualizar Contraseña</button>

                    {{ html()->form()->close() }}
        
            <p class="m-t"> <small>ProTerra 2019</small> </p>
        </div>
    </div>



@endsection
