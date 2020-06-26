@extends('backend.layouts.app')

@section('title', app_name() . ' | Animales')

@section('content')
    <div class="ibox float-e-margins">


        <div class="wrapper wrapper-content  animated fadeInRight">
            <div class="row">
                <div class="col-sm-12">
                    <div class="ibox">
                        <div class="ibox-content">
                            
                            
                            
                                <ul class="nav nav-tabs">
                                    <li class="active"><a data-toggle="tab" href="#tab-1">Animales en Rodeo</a></li>
                                    <li class=""><a data-toggle="tab" href="#tab-2"> Animales</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div id="tab-1" class="tab-pane active">
                                        <div class="full-height-scroll">
                                           @include('backend.animales.includes.tabs.animales-rodeo-table')
                                        </div>
                                    </div>
                                    <div id="tab-2" class="tab-pane">
                                        <div class="full-height-scroll">
                                            @include('backend.animales.includes.tabs.animales-table')
                                        </div>
                                    </div>
                                </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

