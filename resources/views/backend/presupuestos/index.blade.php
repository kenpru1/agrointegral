@extends('backend.layouts.app')

@section('title', app_name() . ' | Cotizaciones')

@section('content')
    <div class="ibox float-e-margins">
                    <div class="ibox-title">
                       
                      <strong>Cotización</strong>

                            
                    </div>
                    <div class="ibox-content">
                <div class="table-responsive">
                   <table class="table table-striped table-bordered table-hover dataTables" data-page-length='8'>
                   
                        <thead>
                        <tr>
                            <th>Nro.</th>
                            @if($logged_in_user->hasRole('administrator'))
                                <th>Empresa</th>
                            @endif
                            <th>Nro.</th>
                            <th>Fecha</th>
                             <th>Cliente</th>
                             <th>Validez</th>
                             <th>Condición Pago</th>
                             <th>Tipo Pago</th>
                             <th>Fuente</th>
                             <th>Fecha Entrega</th>
                             <th>Estado</th>
                            @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('administrator'))
                                <th>@lang('labels.general.actions')</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                       @php  $key=count($presupuestos)@endphp 
                        @foreach($presupuestos as $presupuesto)


                            <tr>
                                <td>{{ $key-- }}</td>
                                @if($logged_in_user->hasRole('administrator'))
                                    <td>empresa</td>
                                @endif
                                <td onclick="window.location='{{route('admin.presupuestos.show', $presupuesto->id)}}';">{{ $presupuesto->numero }}</td>                               

                                <td onclick="window.location='{{route('admin.presupuestos.show', $presupuesto->id)}}';">{{ $presupuesto->fecha->format('d-m-Y') }}</td>

                                <td onclick="window.location='{{route('admin.presupuestos.show', $presupuesto->id)}}';">{{$presupuesto->cliente->nombre_razon}}</td>

                                <td onclick="window.location='{{route('admin.presupuestos.show', $presupuesto->id)}}';">{{$presupuesto->validez}}</td>

                                <td onclick="window.location='{{route('admin.presupuestos.show', $presupuesto->id)}}';">{{$presupuesto->condicion_pago->nombre}}</td>

                                <td onclick="window.location='{{route('admin.presupuestos.show', $presupuesto->id)}}';">{{$presupuesto->tipo_pago->nombre}}</td>

                                <td onclick="window.location='{{route('admin.presupuestos.show', $presupuesto->id)}}';">{{$presupuesto->fuente->nombre}}</td>

                                <td onclick="window.location='{{route('admin.presupuestos.show', $presupuesto->id)}}';">{{$presupuesto->fecha_entrega->format('d-m-Y')}}</td>

                                <td onclick="window.location='{{route('admin.presupuestos.show', $presupuesto->id)}}';"  align="center"><span class="{{$presupuesto->estado_presupuesto->class}}">{{ $presupuesto->estado_presupuesto->nombre }}</span></td>
                                                                
                                @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('administrator'))
                                <td>{!! $presupuesto->action_buttons !!}</td>
                                @endif
                            </tr>
                            
                        @endforeach

                        </tbody>
                    </table>
                    @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('administrator'))
                           @include('backend.presupuestos.includes.header-buttons')
                       @endif
                </div>
            </div><!--col-->
        </div><!--row-->
   
   

@endsection
