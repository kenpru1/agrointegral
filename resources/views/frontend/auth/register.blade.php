@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.frontend.auth.register_box_title'))

@section('content')

 <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>

                <img src="{{asset('img/frontend/proterra.png')}}">

            </div>
            
            
            <h3>Bienvenido a ProTerra</h3>
            <p>@lang('labels.frontend.auth.register_box_title')</p>
            @include('includes.partials.messages')

            
             {{ html()->form('POST', route('frontend.auth.register.post'))->open() }}

                <div class="form-group">
                    {{ html()->text('first_name')
                        ->class('form-control')
                        ->placeholder(__('validation.attributes.frontend.first_name'))
                        ->attribute('maxlength', 191) }}
                </div><!--col-->
                <div class="form-group">
                    {{ html()->text('last_name')
                        ->class('form-control')
                        ->placeholder(__('validation.attributes.frontend.last_name'))
                        ->attribute('maxlength', 191) }}
                </div><!--form-group-->
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
                    {{ html()->password('password_confirmation')
                        ->class('form-control')
                        ->placeholder(__('validation.attributes.frontend.password_confirmation'))
                        ->required() }}
                </div><!--form-group-->
                @if(config('access.captcha.registration'))
                    <div class="row">
                        <div class="col">
                            {!! Captcha::display() !!}
                            {{ html()->hidden('captcha_status', 'true') }}
                        </div><!--col-->
                    </div><!--row-->
                @endif
                

                <button type="submit" class="btn btn-primary block full-width m-b">@lang('labels.frontend.auth.register_button')
                </button>

                <a href="{{route('frontend.auth.login')}}" class="btn btn-sm btn-white btn-block">¿Ya tienes una cuenta?</a>

              
            {{ html()->form()->close() }}

            <div class="row">
                <div class="col">
                    <div class="text-center">
                        {!! $socialiteLinks !!}
                    </div>
                </div><!--/ .col -->
            </div><!-- / .row -->
            
            <p class="m-t"> <small>ProTerra 2019</small> </p>
        </div>
    </div>
   





@endsection

@push('after-scripts')
    @if(config('access.captcha.registration'))
        {!! Captcha::script() !!}
    @endif
@endpush
