<!DOCTYPE html>
@langrtl
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
@else
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@endlangrtl

<head>

    <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title', app_name())</title>
        <meta name="description" content="@yield('meta_description', 'ProTerra')">
        <meta name="author" content="@yield('meta_author', 'ProTerra')">
        @yield('meta')

        <link rel="stylesheet" href="{!! asset('inspina/css/bootstrap.min.css') !!}" />
        <link rel="stylesheet" href="{!! asset('inspina/css/font-awesome/css/font-awesome.css') !!}" />
        <link rel="stylesheet" href="{!! asset('inspina/css/animate.css') !!}" />
        <link rel="stylesheet" href="{!! asset('inspina/css/style.css') !!}" />




</head>

<body class="gray-bg">
<div id="app">
            @include('includes.partials.logged-in-as')
          
            <div class="container">
                
                @yield('content')
            </div><!-- container -->
        </div><!-- #app -->
 

    <script src="{!! asset('inspina/js/jquery-3.1.1.min.js') !!}"></script>
    <script src="{!! asset('inspina/js/bootstrap.min.js') !!}"></script>

 
      @stack('before-scripts')
        {{--{!! script(mix('js/manifest.js')) !!}--}}
        {!! script(mix('js/vendor.js')) !!}
        {!! script(mix('js/frontend.js')) !!}
        @stack('after-scripts')

        @include('includes.partials.ga')


@yield('scripts')
</body>

</html>


