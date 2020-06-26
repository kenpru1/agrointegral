@extends('backend.layouts.app')

@section('title', app_name() . ' | Stock')

@section('content')
    <div class="ibox float-e-margins">
                    <div class="ibox-title">
                       
                       <strong>Stock</strong>
                       
                        
                    </div>
                    <div class="ibox-content">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables" data-page-length='8'>
                        <thead>
                        <tr>
                            <th>Nro.</th>
                            <th>Bodega</th>
                            <th>Producto</th>
                            <th>Tipo</th>
                            <th>Cantidad</th>
      
                           
                            
                           
                        </tr>
                        </thead>
                        <tbody>
                       @php  $key=count($stocks)@endphp 
                        @foreach($stocks as $stock)

                            <tr>
                                <td>{{ $key-- }}</td>
                                <td>{{$stock->bodega->nombre}}</td>
                                <td>{{$stock->producto->nombre}}</td>
                                <td>{{$stock->producto->tipo_producto->nombre}}</td>
                                <td>{{ $stock->cantidad }}</td>
                                                             
                            </tr>
                            
                        @endforeach

                        </tbody>
                    </table>

                </div>
            </div><!--col-->
        </div><!--row-->
    
   

@endsection
