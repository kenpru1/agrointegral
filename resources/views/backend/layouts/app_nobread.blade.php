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

    
    <link rel="stylesheet" href="{!! asset('inspina/css/style.css') !!}">

</head>
<body>

  <!-- Wrapper-->
    <div id="wrapper">

        <!-- Navigation -->
        @include('backend.includes.sidebar')


        <!-- Page wraper -->
        <div id="page-wrapper" class="gray-bg">

            <!-- Page wrapper -->
           @include('backend.includes.header')

          <main class="main">
            @include('includes.partials.logged-in-as')

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

                   @include('includes.partials.messages')

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



    <!-- Custom and plugin javascript -->

    <script src="{!! asset('inspina/js/plugins/pace/pace.min.js') !!}"></script>
    <script src="{!! asset('js/vendors/sweetalert2/dist/sweetalert2.all.js') !!}"></script>
    <script src="{!! asset('js/plugins.js') !!}" type="text/javascript"></script>
    <script src="{!! asset('inspina/js/plugins/metisMenu/jquery.metisMenu.js') !!}"></script>
    <script src="{!! asset('inspina/js/plugins/slimscroll/jquery.slimscroll.min.js') !!}"></script>


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


    <!-- GITTER -->
    <script src="{!! asset('inspina/js/plugins/gritter/jquery.gritter.min.js') !!}"></script>

    <!-- Sparkline -->
    <script src="{!! asset('inspina/js/plugins/sparkline/jquery.sparkline.min.js') !!}"></script>

    <!-- Sparkline demo data  -->
    <script src="{!! asset('inspina/js/demo/sparkline-demo.js') !!}"></script>

    <!-- ChartJS-->
    <script src="{!! asset('inspina/js/plugins/chartJs/Chart.min.js') !!}"></script>

    <!--data tables-->
    <script src="{!! asset('inspina/js/plugins/dataTables/datatables.min.js') !!}"></script>

     <!-- Jasny -->
    <script src="{!! asset('inspina/js/plugins/jasny/jasny-bootstrap.min.js') !!}"></script>

    <script>

    $(document).ready(function() {


   var data1 = [
        [0,4],[1,8],[2,5],[3,10],[4,4],[5,16],[6,5],[7,11],[8,6],[9,11],[10,30],[11,10],[12,13],[13,4],[14,3],[15,3],[16,6]
                        ];
        var data2 = [
                        [0,1],[1,0],[2,2],[3,0],[4,1],[5,3],[6,1],[7,5],[8,2],[9,3],[10,2],[11,1],[12,0],[13,2],[14,8],[15,0],[16,0]
                        ];
                        $("#flot-dashboard-chart").length && $.plot($("#flot-dashboard-chart"), [
                            data1, data2
                            ],
                            {
                                series: {
                                    lines: {
                                        show: false,
                                        fill: true
                                    },
                                    splines: {
                                        show: true,
                                        tension: 0.4,
                                        lineWidth: 1,
                                        fill: 0.4
                                    },
                                    points: {
                                        radius: 0,
                                        show: true
                                    },
                                    shadowSize: 2
                                },
                                grid: {
                                    hoverable: true,
                                    clickable: true,
                                    tickColor: "#d5d5d5",
                                    borderWidth: 1,
                                    color: '#d5d5d5'
                                },
                                colors: ["#1ab394", "#1C84C6"],
                                xaxis:{
                                },
                                yaxis: {
                                    ticks: 4
                                },
                                tooltip: false
                            }
                            );

                        var doughnutData = {
                            labels: ["App","Software","Laptop" ],
                            datasets: [{
                                data: [300,50,100],
                                backgroundColor: ["#a3e1d4","#dedede","#9CC3DA"]
                            }]
                        } ;


                        var doughnutOptions = {
                            responsive: false,
                            legend: {
                                display: false
                            }
                        };


                        var ctx4 = document.getElementById("doughnutChart").getContext("2d");
                        new Chart(ctx4, {type: 'doughnut', data: doughnutData, options:doughnutOptions});

                        var doughnutData = {
                            labels: ["App","Software","Laptop" ],
                            datasets: [{
                                data: [70,27,85],
                                backgroundColor: ["#a3e1d4","#dedede","#9CC3DA"]
                            }]
                        } ;


                        var doughnutOptions = {
                            responsive: false,
                            legend: {
                                display: false
                            }
                        };


                        var ctx4 = document.getElementById("doughnutChart2").getContext("2d");
                        new Chart(ctx4, {type: 'doughnut', data: doughnutData, options:doughnutOptions});

                    });




        $(document).ready(function(){
            $('.dataTables').DataTable({
                pageLength: 25,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    { extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel', title: 'ExampleFile'},
                    {extend: 'pdf', title: 'ExampleFile'},

                    {extend: 'print',
                     customize: function (win){
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');

                            $(win.document.body).find('table')
                                    .addClass('compact')
                                    .css('font-size', 'inherit');
                    }
                    }
                ]

            });

    // Minimalize menu
    $('.navbar-minimalize').on('click', function () {
        $("body").toggleClass("mini-navbar");

    });
    // MetsiMenu
    $('#side-menu').metisMenu();


    });

    </script>
@yield('scripts')


</body>
</html>
