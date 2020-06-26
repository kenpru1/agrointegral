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
    <link rel="stylesheet" href="{!! asset('inspina/css/vendor.css') !!}" />
    <link rel="stylesheet" href="{!! asset('inspina/css/app.css') !!}" />

    <link rel="stylesheet" href="{!! asset('inspina/css/plugins/dataTables/datatables.min.css') !!}" />

     <link rel="stylesheet" href="{!! asset('js/vendors/sweetalert2/dist/sweetalert2.css') !!}" />

</head>
<body>

  <!-- Wrapper-->
    <div id="wrapper">

        


        <!-- Page wraper -->
        <div id="page-wrapper" class="gray-bg">

            

          <main class="main">
          

           <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    
                </div>
                <div class="col-lg-2">

                </div>
            </div>



            <div class="container-fluid">
                <div class="animated fadeIn">
                    <div class="content-header">
                        @yield('page-header')
                    </div><!--content-header-->

                  

            <!-- Main view  -->
            @yield('content')

              </div><!--animated-->
           </div><!--container-fluid-->
        </main><!--main-->

            <!-- Footer -->
            @include('backend.includes.footer')

        </div>
        <!-- End page wrapper-->

    </div>
    <!-- End wrapper-->


<!-- Scripts -->
    <script src="{!! asset('inspina/js/jquery-3.1.1.min.js') !!}"></script>
    <!--<script src="{!! asset('inspina/js/app.js') !!}" type="text/javascript"></script>-->
    <script src="{!! asset('inspina/js/bootstrap.min.js') !!}"></script>




  


</body>
</html>
