@extends('backend.layouts.app')

@section('title', app_name() . ' | Empresas')

@section('content')
    <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <strong>Empresas</strong>
                       </div>
                <div class="ibox-content">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables" data-page-length='8'>
                        <thead>
                        <tr>
                            <th>Nro.</th>
                            <th>Rut</th>
                            <th>Nombre</th>
                            <th>Comuna</th>
                            <th>Email</th>
                            <th>Req. Factura</th>
                            <th>Estado</th>
                            <th>Fec. Creación</th>
                            <th>Inic. periodo</th>
                            <th>Fin periodo</th>
                            <th>Pago</th>
                            <th>Acciones</th>
                            
                            
                            
                        </tr>
                        </thead>
                        <tbody>
                       @php  $key=count($empresas)@endphp 
                        @foreach($empresas as $empresa)

                            <tr>
                                <td>{{ $key-- }}</td>
                                <td>{{$empresa->rut_dni}}</td>
                                <td>{{strip_tags($empresa->nombre)}}</td>
                                <td>{{strip_tags($empresa->comuna)}}</td>
                                <td>{{$empresa->email}}</td>
                                <td>{{ ($empresa->facturacion=='Si')?'Si':'No' }}</td>
                                <td>{{ ($empresa->activa==1)?'Activa':'Inactiva' }}</td>
                                <td>{{$empresa->created_at->format('d-m-Y')}}</td>
                                <td>{{ isset($empresa->pagos->last()->estado)?$empresa->pagos->last()->inicio_periodo->format('d-m-Y'):'-' }}</td>
                                <td>{{ isset($empresa->pagos->last()->estado)?$empresa->pagos->last()->fin_periodo->format('d-m-Y'):'-' }}</td>
                                <td>{{ isset($empresa->pagos->last()->estado)?$empresa->pagos->last()->estado:'-' }}</td>
                                <td>
                                    <div id="div_{{$empresa->id}}">
                                    @if($empresa->activa==1)
                                          <button class="btn btn-sm btn-danger" onclick="desactivacion({{ $empresa->id }})" type="button" empresa_id="{{ $empresa->id }}"  >Desactivar</button>
                                    @else

                                        <button class="btn btn-sm btn-primary" onclick="activacion({{ $empresa->id }})" type="button" empresa_id="{{ $empresa->id }}" >Activar</button>


                                    @endif
                                    </div>
                                    



                                </td>
                                
                            </tr>
                            
                        @endforeach

                        </tbody>
                    </table>
                   
                </div>
            </div><!--col-->
        </div><!--row-->

   

@endsection

@section('scripts')
<script>
    
    function activacion(empresa_id){
        $.ajax({
            url: "{{ url('admin/planes/actEmp') }}",
            type: 'get',
            dataType: 'json',
            data: {"empresa_id": empresa_id},
            success: function (rta) {
               $('#div_'+empresa_id).html('');
               $('#div_'+empresa_id).html('<button class="btn btn-sm btn-danger" type="button" onclick="desactivacion('+empresa_id+')" >Desactivar</button>');
              }
            
        });
    }

 function desactivacion(empresa_id){
   
        $.ajax({
            url: "{{ url('admin/planes/desactEmp') }}",
            type: 'get',
            dataType: 'json',
            data: {"empresa_id": empresa_id},
            success: function (rta) {
                $('#div_'+empresa_id).html('');
                $('#div_'+empresa_id).html('<button class="btn btn-sm btn-primary" type="button" onclick="activacion('+empresa_id+')" >Activar</button>');
       
            }
            
        });
    }

</script>
@endsection
