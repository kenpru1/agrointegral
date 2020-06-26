@extends('backend.layouts.appTables')


@section('title', app_name() . ' | Requerimientos')


@section('style')



<!-- <link rel="stylesheet" href="{!! asset('css/editor/buttons.dataTables.min.css') !!}"/> -->

<link rel="stylesheet" href="{!! asset('css/editor/jquery.dataTables.min.css') !!}"/>
<link rel="stylesheet" href="{!! asset('css/editor/select.dataTables.min.css') !!}"/>
<link rel="stylesheet" href="{!! asset('css/editor/css/editor.dataTables.min.css') !!}"/>
<link rel="stylesheet" href="{!! asset('css/editor/css/editor.bootstrap.min.css') !!}"/>
<link rel="stylesheet" href="{!! asset('css/editor/buttons.dataTables.min.css') !!}"/>
<link rel="stylesheet" href="{!! asset('inspina/css/style.css') !!}">


@endsection

@section('content')
<div class="ibox float-e-margins">
    <div class="ibox-title">
        <strong>
               Administración de Requerimientos

        </strong>
    </div>

    <div class="ibox-content">
        <div class="table-responsive">
            <table id="DataTables_Table_0_wrapper" class="table table-striped table-bordered table-hover dataTables" data-page-length="8">
                <thead>
                    <tr>
                        <th>Requerimiento</th>
                        <th>Cliente</th>
                        <th>Cotizada</th>
                        <th>Aprobada</th>
                        <th>Fecha Muestreo</th>
                        <th>Numero Muestras</th>
                        <th>Enviada Laboratorio</th>
                        <th>Informe recibido</th>
                        <th>Factura laboratorio</th>
                        <th>Servicio facturado</th>

                    </tr>
                </thead>

            </table>
                @include('backend.requerimientos.includes.buttons-refresh')
        </div>
    </div>

    <!--col-->
</div>
<!--row-->
@endsection


@section('scripts')


         <!--data tables-->

        <script src="{!! asset('js/editor/jquery.dataTables.min.js') !!}"></script>
        <!-- <script src="{!! asset('js/editor/dataTables.buttons.min.js') !!}"></script> -->
        <script src="{!! asset('js/editor/dataTables.select.min.js') !!}"></script>
        <script src="{!! asset('js/editor/dataTables.bootstrap.min.js') !!}"></script>
        <!-- <script src="{!! asset('js/editor/js/editor.bootstrap.min.js') !!}"></script> -->
        <!-- <script src="{!! asset('js/editor/js/dataTables.editor.min.js') !!}"></script> -->
        <script src="{!! asset('js/editor/dataTables.altEditor.free.js') !!}"></script>

        <script src="{!! asset('js/editor/dataTables.buttons.min.js') !!}"></script>
        <script src="{!! asset('js/editor/jszip.min.js') !!}"></script>
        <script src="{!! asset('js/editor/pdfmake.min.js') !!}"></script>
        <script src="{!! asset('js/editor/buttons.html5.min.js') !!}"></script>
        <script src="{!! asset('js/editor/buttons.print.min.js') !!}"></script>



@endsection


