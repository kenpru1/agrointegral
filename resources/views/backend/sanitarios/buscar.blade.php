@extends('backend.layouts.app')

@section('title', ' Mantenciones ')

@section('content')
{{ html()->form('POST', route('admin.sanitarios.buscar'))->class('form-horizontal')->open() }}

    <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Administrador de Sanitarios
                               
                            </h5>
                            
                        </div>
                        <div class="ibox-content">
                            <form class="form-horizontal">
                                  @if($logged_in_user->hasRole('administrator'))
                                    <div class="row">
                                        <div class="form-group col-md-5 ">
                                            {{ html()->label('Empresa')->for('empresa_id') }}
                                            {{ html()->select('empresa_id', $empresas,null)
                                                ->placeholder('Seleccione Empresa', false)
                                                ->class('form-control chosen-select')
                                                ->id('empresa_id') }}
                                        </div><!--form-group-->
                                    </div>
                               @endif
                               <div class="row">
                              
                               
                                <div class="form-group col-md-4 ">
                                     {{ html()->label('Animales')->for('animal_id') }}
                                     {{ html()->select('animal_id', $animales,null)
                                        ->placeholder('Seleccione Animal', false)
                                        ->class('form-control chosen-select')
                                        ->id('animal_id') }}
                                </div><!--form-group-->
                                <div class="form-group col-md-8">
                                    <div class="col-md-4">
                                    {{ html()->label('Fecha Inicio')->for('fecha_inicio') }}
                                    <input type="date" class="form-control" name="fecha_inicio">
                                    </div>
                                    <div class="col-md-4">
                                    {{ html()->label('Fecha Fin')->for('fecha_fin') }}
                                    <div class="input-group"><input type="date" class="form-control" name="fecha_fin"><span class="input-group-btn"> <button class="btn btn-primary" type="submit">Consultar</button></span></div>


                                    </div>
                                                        
                                </div>

                                </div>
                            
                                <div class="ibox-content">
                <div class="table-responsive">
                       <table class="table table-striped table-bordered table-hover dataTables" data-page-length='8'>
                        <thead>
                        <tr>
                            <th>No.</th>
                            @if($logged_in_user->hasRole('administrator'))
                            <th>Empresa</th>
                            @endif
                            <th>Animal</th>
                            <th>Tipo</th>
                            <th>Nombre</th>
                            <th>Fecha Inicio</th>
                            <th>Fecha Termino</th>
                                                       
                        </tr>
                        </thead>
                       <?php 
                          $sumTotalIva=0;
                       ?>
                        <tbody>
                            @php  $key=count($sanitarios)@endphp 
                            @foreach($sanitarios as $sanitario)
                            
                            <tr>
                                <td>{{ $key-- }}</td>
                                @if($logged_in_user->hasRole('administrator'))
                                    <td>{{$sanitario->animal->empresa->nombre}}</td>
                                @endif
                                <td>{{ ucwords($sanitario->animal->nombre) }}</td>
                                <td>{{$sanitario->tipo_sanitario->nombre}}</td>
                                <td>{{$sanitario->nombre}}</td>
                                <td>{{isset($sanitario->fecha_inicio)?$sanitario->fecha_inicio->format('d-m-Y'):'-'}}</td>
                                <td>{{isset($sanitario->fecha_termino)?$sanitario->fecha_termino->format('d-m-Y'):'-'}}</td>
                                                         
                                
                            </tr>
                            
                            @endforeach
                           </tbody>
                           
                   
                    </table>
                </div>
            </div><!--col-->

                                
                            </form>

                            <div class="mail-body text-right">
                                                        
                                <a class="btn btn-sm btn-primary" data-placement="top" data-toggle="tooltip" href="{{ route('admin.sanitarios.new') }}" title="@lang('labels.general.create_new')">
                                    Nueva Sanitario </a>
                                
                            </div>
                        </div>
                    </div>
                </div>


{{ html()->form()->close() }}
@endsection
@section('scripts')
<script src="//cdn.datatables.net/plug-ins/1.10.19/api/sum().js"></script>
<script>

    
 

   $("#empresa_id").change(function () {

        $.ajax({
            url: "{{ url('admin/getAnimales') }}",
            type: 'get',
            dataType: 'json',
            data: {"empresa_id": $("#empresa_id").val()},
            success: function (rta) {
                $('#animal_id').empty();
                $('#animal_id').append("<option value='' disabled selected style='display:none;'>Seleccione Animal</option>");
                $.each(rta, function (index, value) {
                    $('#animal_id').append("<option value='" + value.id + "'>" + value.nombre + "</option>");
                });
                 $('#animal_id').trigger("chosen:updated");
            }
        });
    });

</script>
@endsection

