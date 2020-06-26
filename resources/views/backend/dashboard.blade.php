@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('strings.backend.dashboard.title'))

@section('content')

<div class="row  border-bottom  dashboard-header">

    <div class="col-md-12">
    
        @if($logged_in_user->hasRole('administrator'))
            @include('backend.empresa.index')
        @endif



        @if($logged_in_user->hasRole('user')||$logged_in_user->hasRole('executive'))
         
           <!-- Widgets-->

            <div class="row">
                    <div class="col-lg-3">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <span class="label label-success pull-right">Total</span>
                                <h5>Campos</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins">{{ isset($campos)?count($campos):'0' }}</h1>
                                
                                <small>Cantidad</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <span class="label label-info pull-right">Total</span>
                                <h5>Cuarteles</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins">{{ isset($cuarteles)?count($cuarteles):'0' }}</h1>
                                {{-- <div class="stat-percent font-bold text-info">20% <i class="fa fa-level-up"></i></div> --}}
                                <small>Total</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <span class="label label-primary pull-right">Total</span>
                                <h5>Trabajadores</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins">{{ isset($trabajadores)?$trabajadores:'0' }}</h1>
                                {{-- <div class="stat-percent font-bold text-navy">44% <i class="fa fa-level-up"></i></div> --}}
                                <small>Cantidad</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <span class="label label-danger pull-right">Total</span>
                                <h5>Bodegas</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins">{{isset($bodegas)?$bodegas:'0'  }}</h1>
                                {{-- <div class="stat-percent font-bold text-danger">38% <i class="fa fa-level-down"></i></div> --}}
                                <small>Cantidad</small>
                            </div>
                        </div>
            </div>
        </div>
        <!-- Widgets-->

          <!--Grafico Flot
        <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>Orders</h5>
                                {{-- <div class="pull-right">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-xs btn-white active">Today</button>
                                        <button type="button" class="btn btn-xs btn-white">Monthly</button>
                                        <button type="button" class="btn btn-xs btn-white">Annual</button>
                                    </div>
                                </div>--}}
                            </div>
                            <div class="ibox-content">
                                <div class="row">
                                <div class="col-lg-9">
                                    <div class="flot-chart">
                                        <div class="flot-chart-content" id="flot-dashboard-chart"></div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <ul class="stat-list">
                                        <li>
                                            <h2 class="no-margins">{{ $presupuestado }}</h2>
                                            <small>Total Presupuestado</small>
                                            {{--<div class="stat-percent">48% <i class="fa fa-level-up text-navy"></i></div>
                                            <div class="progress progress-mini">
                                                <div style="width: 48%;" class="progress-bar"></div>
                                            </div>--}}
                                        </li>
                                        <li>
                                            <h2 class="no-margins ">{{ $facturado }}</h2>
                                            <small>Total Facturado</small>
                                            {{--<div class="stat-percent">60% <i class="fa fa-level-down text-navy"></i></div>
                                            <div class="progress progress-mini">
                                                <div style="width: 60%;" class="progress-bar"></div>
                                            </div>--}}
                                        </li>
                                        <li>
                                            <h2 class="no-margins ">{{ $pagado }}</h2>
                                            <small>Total Pagado</small>
                                            <?php
                                            if($facturado>0){
                                                $por=($pagado*100)/$facturado;
                                            }else{
                                                $por=0;
                                            }

                                            ?>
                                            <div class="stat-percent">{{ number_format($por,'2',',','')   }}%</div>
                                            <div class="progress progress-mini">
                                                <div style="width: {{ $por.'%' }};" class="progress-bar"></div>
                                            </div>
                                        </li>
                                        </ul>
                                    </div>
                                </div>
                                </div>

                            </div>
                        </div>
                    </div>

-->
       <!-- Grafico Flot -->
        
<br>

        
        <!--Gráfico Cuarteles -->    
        <div class="row">
            <div class="ibox-title">
                <h5>Distribución Cuarteles</h5>
                               
            </div>
             <div class="ibox-content">
                    <div class="row">  
            @foreach($camposConCuarteles as $key => $campo)
                  
                        <div class="col-lg-3">
                            <canvas id="doughnutChart_{{$key}}" width="100" height="100" style="margin: 18px auto 0"></canvas>
                            <h5><center>{{ $campo->nombre }}</center></h5>
                        </div>
                    
            @endforeach
            </div>
                </div>
            </div>
        
        @endif
       <!--Gráfico Cuarteles -->


     


                

@endsection

@section('scripts')
     
    <script type="text/javascript">
     /*Grafico Cuarteles*/   
        @foreach($camposConCuarteles as $key => $campo)
            var doughnutData_{{$key}} = {
                labels: {!! json_encode($dataLabels[$campo->nombre]) !!},
                datasets: [{
                    data: {!! json_encode($dataAmounts[$campo->nombre]) !!},
                    backgroundColor: {!! json_encode($dataColors[$campo->nombre]) !!}
                    }]
                };

            var doughnutOptions_{{$key}} = {
	            responsive: false,
	            legend: {
	                display: false
	                }
            };

            
            var ctx{{$key}} = document.getElementById("doughnutChart_{{$key}}").getContext('2d');
            		
            var chart{{$key}} = new Chart(ctx{{$key}}, {type: 'doughnut', data: doughnutData_{{$key}}, options: doughnutOptions_{{$key}} });

            $('#doughnutChart_{{$key}}').click(
            	function(evt){
            		var activePoints{{$key}} = chart{{$key}}.getElementsAtEvent(evt);
            		var url{{$key}} = "{{ url('cuarteles') }}";

            		console.log(activePoints{{$key}}[0]['_chart']['config']['data']['datasets']);
            		//alert(activePoints{{$key}});
            	}
            );		
            	
            
            
        @endforeach
    /*Grafico Cuarteles*/




/*Grafico Flot*/

        var data2 = [
                [gd(2012, 1, 1), 5], [gd(2012, 1, 2), 6], [gd(2012, 1, 3), 4], [gd(2012, 1, 4), 8],
                [gd(2012, 1, 5), 9], [gd(2012, 1, 6), 7], [gd(2012, 1, 7), 5], [gd(2012, 1, 8), 4],
                [gd(2012, 1, 9), 7], [gd(2012, 1, 10), 8], [gd(2012, 1, 11), 9], [gd(2012, 1, 12), 6],
                [gd(2012, 1, 13), 4], [gd(2012, 1, 14), 5], [gd(2012, 1, 15), 11], [gd(2012, 1, 16), 8],
                [gd(2012, 1, 17), 8], [gd(2012, 1, 18), 11], [gd(2012, 1, 19), 11], [gd(2012, 1, 20), 6],
                [gd(2012, 1, 21), 6], [gd(2012, 1, 22), 8], [gd(2012, 1, 23), 11], [gd(2012, 1, 24), 13],
                [gd(2012, 1, 25), 7], [gd(2012, 1, 26), 9], [gd(2012, 1, 27), 9], [gd(2012, 1, 28), 8],
                [gd(2012, 1, 29), 5], [gd(2012, 1, 30), 8], [gd(2012, 1, 31), 25]
            ];



            var data3 = [
                [gd(2012, 1, 1), 800], [gd(2012, 1, 2), 500], [gd(2012, 1, 3), 600], [gd(2012, 1, 4), 700],
                [gd(2012, 1, 5), 500], [gd(2012, 1, 6), 456], [gd(2012, 1, 7), 800], [gd(2012, 1, 8), 589],
                [gd(2012, 1, 9), 467], [gd(2012, 1, 10), 876], [gd(2012, 1, 11), 689], [gd(2012, 1, 12), 700],
                [gd(2012, 1, 13), 500], [gd(2012, 1, 14), 600], [gd(2012, 1, 15), 700], [gd(2012, 1, 16), 786],
                [gd(2012, 1, 17), 345], [gd(2012, 1, 18), 888], [gd(2012, 1, 19), 888], [gd(2012, 1, 20), 888],
                [gd(2012, 1, 21), 987], [gd(2012, 1, 22), 444], [gd(2012, 1, 23), 999], [gd(2012, 1, 24), 567],
                [gd(2012, 1, 25), 786], [gd(2012, 1, 26), 666], [gd(2012, 1, 27), 888], [gd(2012, 1, 28), 900],
                [gd(2012, 1, 29), 178], [gd(2012, 1, 30), 555], [gd(2012, 1, 31), 993]
            ];


            var dataset = [
                {
                    label: "Numero de Ordenes",
                    data: data3,
                    color: "#1ab394",
                    bars: {
                        show: true,
                        align: "center",
                        barWidth: 24 * 60 * 60 * 600,
                        lineWidth:0
                    }

                }, {
                    label: "Pagado",
                    data: data2,
                    yaxis: 2,
                    color: "#1C84C6",
                    lines: {
                        lineWidth:1,
                            show: true,
                            fill: true,
                        fillColor: {
                            colors: [{
                                opacity: 0.2
                            }, {
                                opacity: 0.4
                            }]
                        }
                    },
                    splines: {
                        show: false,
                        tension: 0.6,
                        lineWidth: 1,
                        fill: 0.1
                    },
                }
            ];


            var options = {
                xaxis: {
                    mode: "time",
                    tickSize: [3, "day"],
                    tickLength: 0,
                    axisLabel: "Date",
                    axisLabelUseCanvas: true,
                    axisLabelFontSizePixels: 12,
                    axisLabelFontFamily: 'Arial',
                    axisLabelPadding: 10,
                    color: "#d5d5d5"
                },
                yaxes: [{
                    position: "left",
                    max: 1070,
                    color: "#d5d5d5",
                    axisLabelUseCanvas: true,
                    axisLabelFontSizePixels: 12,
                    axisLabelFontFamily: 'Arial',
                    axisLabelPadding: 3
                }, {
                    position: "right",
                    clolor: "#d5d5d5",
                    axisLabelUseCanvas: true,
                    axisLabelFontSizePixels: 12,
                    axisLabelFontFamily: ' Arial',
                    axisLabelPadding: 67
                }
                ],
                legend: {
                    noColumns: 1,
                    labelBoxBorderColor: "#000000",
                    position: "nw"
                },
                grid: {
                    hoverable: false,
                    borderWidth: 0
                }
            };

            function gd(year, month, day) {
                return new Date(year, month - 1, day).getTime();
            }
            var previousPoint = null, previousLabel = null;

            $.plot($("#flot-dashboard-chart"), dataset, options);
       
    </script>

@endsection
