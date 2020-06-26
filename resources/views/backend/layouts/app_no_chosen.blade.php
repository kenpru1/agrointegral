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

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.0/css/all.css" integrity="sha384-Mmxa0mLqhmOeaE8vgOSbKacftZcsNYDjQzuCOm6D02luYSzBG8vpaOykv9lFQ51Y" crossorigin="anonymous">
    <link rel="stylesheet" href="{!! asset('inspina/css/bootstrap.min.css') !!}" />
    <link rel="stylesheet" href="{!! asset('inspina/css/vendor.css') !!}" />
    <link rel="stylesheet" href="{!! asset('inspina/css/app.css') !!}" />

 

    <link rel="stylesheet" href="{!! asset('inspina/css/plugins/dataTables/datatables.min.css') !!}" />
    <link rel="stylesheet" href="{!! asset('js/vendors/sweetalert2/dist/sweetalert2.css') !!}" />
    <link rel="stylesheet" href="{!! asset('inspina/css/plugins/summernote/summernote.css') !!}" />
    <link rel="stylesheet" href="{!! asset('inspina/css/plugins/summernote/summernote-bs3.css') !!}" />
    <link rel="stylesheet" href="{!! asset('inspina/css/plugins/jasny/jasny-bootstrap.min.css') !!}" />
    <link href="{!! asset('inspina/css/plugins/chosen/chosen.css') !!}" rel="stylesheet">
    <link href="{!! asset('inspina/css/plugins/chosen/bootstrap-chosen.css') !!}" rel="stylesheet">

    
   <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/min/dropzone.min.css">
-->

    <link rel="stylesheet" href="{!! asset('inspina/css/plugins/dropzone/basic.css') !!}" />
    <link rel="stylesheet" href="{!! asset('inspina/css/plugins/dropzone/dropzone.css') !!}" />

    <link rel="stylesheet" href="{!! asset('inspina/css/plugins/slick/slick.css') !!}">
    <link rel="stylesheet" href="{!! asset('inspina/css/plugins/slick/slick-theme.css') !!}">

    <link rel="stylesheet" href="{!! asset('inspina/css/animate.css') !!}">
    
    <link rel="stylesheet" href="{!! asset('inspina/css/style.css') !!}">




</head>
<body>

  <!-- Wrapper-->
    <div id="wrapper">

        <!-- Navigation -->
        @include('backend.includes.sidebar')


        <!-- Page wraper -->
       <div id="page-wrapper" class="gray-bg dashbard-1">

            <!-- Page wrapper -->
           @include('backend.includes.header')

          
            @include('includes.partials.logged-in-as')
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">

                    {!! Breadcrumbs::render() !!}
                </div>
                <div class="col-lg-2">

                </div>
            </div>
           


            <div class="row wrapper wrapper-content animated fadeInRight">

                <div class="col-lg-12">

                    @yield('page-header')
                    <div class="ibox float-e-margins">

                        @include('includes.partials.messages')
                        <!-- Main view  -->
                        @yield('content')
                    </div>
                </div>
            </div>



            

        </div>
        <!-- End page wrapper-->

    </div>
    <!-- End wrapper-->





<!-- Scripts -->
    <script src="{!! asset('inspina/js/jquery-3.1.1.min.js') !!}"></script>
    <!--<script src="{!! asset('inspina/js/app.js') !!}" type="text/javascript"></script>-->
    <script src="{!! asset('inspina/js/bootstrap.min.js') !!}"></script>



    <!-- Custom and plugin javascript -->

    <script src="{!! asset('inspina/js/plugins/pace/pace.min.js') !!}"></script>
    <script src="{!! asset('js/vendors/sweetalert2/dist/sweetalert2.all.js') !!}"></script>
    <script src="{!! asset('js/plugins.js') !!}" type="text/javascript"></script>
    <script src="{!! asset('inspina/js/plugins/metisMenu/jquery.metisMenu.js') !!}"></script>
    <script src="{!! asset('inspina/js/plugins/slimscroll/jquery.slimscroll.min.js') !!}"></script>
    <script src="{!! asset('inspina/js/inspinia.js') !!}"></script>


    <!-- Flot -->
    <script src="{!! asset('inspina/js/plugins/flot/jquery.flot.js') !!}"></script>
    <script src="{!! asset('inspina/js/plugins/flot/jquery.flot.tooltip.min.js') !!}"></script>
    <script src="{!! asset('inspina/js/plugins/flot/jquery.flot.spline.js') !!}"></script>
    <script src="{!! asset('inspina/js/plugins/flot/jquery.flot.resize.js') !!}"></script>
    <script src="{!! asset('inspina/js/plugins/flot/jquery.flot.pie.js') !!}"></script>
 
    <!-- Peity -->
    <script src="{!! asset('inspina/js/plugins/peity/jquery.peity.min.js') !!}"></script>
    <script src="{!! asset('inspina/js/demo/peity-demo.js') !!}"></script>

    <!-- jQuery UI -->
    <script src="{!! asset('inspina/js/plugins/jquery-ui/jquery-ui.min.js') !!}"></script>
    <script src="{!! asset('inspina/js/plugins/touchpunch/jquery.ui.touch-punch.min.js') !!}"></script>

    <!-- GITTER -->
    <script src="{!! asset('inspina/js/plugins/gritter/jquery.gritter.min.js') !!}"></script>

    <!-- Sparkline -->
    <script src="{!! asset('inspina/js/plugins/sparkline/jquery.sparkline.min.js') !!}"></script>

    <!-- Sparkline demo data  -->
    <script src="{!! asset('inspina/js/demo/sparkline-demo.js') !!}"></script>

    <!-- ChartJS-->
    

    <!--data tables-->
    <script src="{!! asset('inspina/js/plugins/dataTables/datatables.min.js') !!}"></script>

    <!--personal-->
    <script src="{!! asset('inspina/js/personal.js') !!}"></script>

    

    <!-- chosen -->
    <script src="{!! asset('inspina/js/plugins/chosen/chosen.jquery.js') !!}"></script>

    <!-- SummerNote -->
    <script src="{!! asset('inspina/js/plugins/summernote/summernote.min.js') !!}"></script>

    <!-- Jasny -->
    <script src="{!! asset('inspina/js/plugins/jasny/jasny-bootstrap.min.js') !!}"></script>
    <!--<script src="js/plugins/jasny/jasny-bootstrap.min.js"></script>-->


    <!-- Vue -->
    <script src="{!! asset('inspina/js/vue.min.js') !!}"></script>

    <!-- DROPZONE -->
    <script src="{!! asset('inspina/js/plugins/dropzone/dropzone.js') !!}"></script>


   <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/min/dropzone.min.js"></script>-->

    


    <script type="text/javascript">
        $('.chosen-select').chosen({width: "100%"});

    </script>






@yield('scripts')


</body>
</html>
