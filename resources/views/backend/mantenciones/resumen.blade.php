@extends('backend.layouts.app')

@section('title', app_name() .' | Mantenciones ')

@section('content')
{{ html()->form('POST', route('admin.mantenciones.buscar'))->class('form-horizontal')->open() }}

    <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Administrador de Mantenciones
                               
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
                                     {{ html()->label('Maquinarias')->for('maquinaria_id') }}
                                     {{ html()->select('maquinaria_id', $maquinarias,null)
                                        ->placeholder('Seleccione Maquinaria', false)
                                        ->class('form-control')
                                        ->id('maquinaria_id') }}
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
                            @if($logged_in_user->hasRole('administrator'))
                            <th>Empresa</th>
                            @endif
                            <th>Maquinaria</th>
                            <th>Descripción</th>
                            <th>Fecha</th>
                            <th>Neto</th>
                            <th>IVA</th>
                            <th>Total</th>
                            
                            
                        </tr>
                        </thead>
                       <?php 
                          $sumTotalIva=0;
                       ?>
                        <tbody>
                            @foreach($mantenciones as $mantencion)
                            <?php
                                  $sumTotalIva += $mantencion->total_iva; 
                            ?>
                            <tr>
                                @if($logged_in_user->hasRole('administrator'))
                                    <td>{{$mantencion->maquinaria->empresa->nombre}}</td>
                                @endif
                                <td>{{ ucwords($mantencion->maquinaria->nombre) }}</td>
                                <td>{{strip_tags($mantencion->descripcion)}}</td>
                                <td>{{$mantencion->fecha->format('d-m-Y')}}</td>
                                <td class="text-right" >${{number_format($mantencion->costo, 0,'','.')}}</td>
                                 <td class="text-right" >${{number_format($mantencion->iva, 0,'','.')}}</td>
                                 <td class="text-right" >${{number_format($mantencion->total_iva, 0,'','.')}}</td>
                                
                                
                                
                            </tr>
                            
                            @endforeach
                           </tbody>
                           <tfoot>
                                    
                                    <tr>   
                                        <td class="text-right" colspan="{{$logged_in_user->hasRole('administrator')?'6':'5'}}">Total:</td>
                                        <td class="text-right" colspan="{{$logged_in_user->hasRole('administrator')?'6':'5'}}"><strong>${{$mantenciones!=null?number_format($sumTotalIva, 0,'','.'):number_format(0, 0,'','.')}}</strong></td>
                                    </tr>    
                            </tfoot>
                   
                    </table>
                </div>
            </div><!--col-->

                                
                            </form>

                            <div class="mail-body text-right">
                                                        
                                <a class="btn btn-sm btn-primary" data-placement="top" data-toggle="tooltip" href="{{ route('admin.mantenciones.new') }}" title="@lang('labels.general.create_new')">
                                    Nueva Mantención </a>
                                
                            </div>
                        </div>
                    </div>
                </div>


{{ html()->form()->close() }}
@endsection
@section('scripts')
<script>
 

   $("#empresa_id").change(function () {

        $.ajax({
            url: "{{ url('admin/getMaquinarias') }}",
            type: 'get',
            dataType: 'json',
            data: {"empresa_id": $("#empresa_id").val()},
            success: function (rta) {
                $('#maquinaria_id').empty();
                $('#maquinaria_id').append("<option value='' disabled selected style='display:none;'>Seleccione Maquinaria</option>");
                $.each(rta, function (index, value) {
                    $('#maquinaria_id').append("<option value='" + value.id + "'>" + value.nombre + "</option>");
                });
            }
        });
    });

</script>
@endsection

