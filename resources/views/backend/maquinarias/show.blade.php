@extends('backend.layouts.app')

@section('title', 'Maquinarias | Mostrar' )

@section('content')
{{ html()->modelForm($maquinaria, 'PATCH', route('admin.maquinarias.update',$maquinaria))->class('form-horizontal')->open() }}
<div>
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>
                Administrador de Maquinarias
                <small class="text-muted">
                    Editar Maquinarias
                </small>
            </h5>
        </div>
        <div class="ibox-content">
            <form class="form-horizontal">
                <div class="row">
                    <div class="form-group col-md-5">
                        {{ html()->label(__('validation.attributes.backend.access.permissions.name'))->for('name') }}
                                    {{ html()->text('nombre')
                                        ->class('form-control')
                                        ->placeholder(__('validation.attributes.backend.access.permissions.name'))
                                        ->attribute('maxlength', 100)
                                        ->required()
                                        ->readonly()
                                        ->autofocus() }}
                    </div>
                    <div class="form-group col-md-5 col-md-push-1">
                         {{ html()->label('Valor Compra')->for('valor_compra') }}
                        <input class="form-control" min="0" name="valor_compra" step="any" type="number" value="{{$maquinaria->valor_compra}}" readonly>
                        </input>
                       
                    </div>
                    <!--form-group-->
                </div>
                <div class="row">
                    <div class="form-group col-md-5">
                        {{ html()->label('Tipo')->for('tipo') }}
                                        {{ html()->select('maquinaria_tipo_id', $tipoMaquinas,null)
                                        ->placeholder('Seleccione Tipo', false)
                                        ->class('form-control')
                                        ->required()
                                        ->attribute('disabled')
                                        ->id('maquinaria_tipo_id') }}
                    </div>
                    <div class="form-group col-md-5 col-md-push-1">
                        {{ html()->label('Marca')->for('marca') }}
                                        {{ html()->text('marca')
                                            ->class('form-control')
                                            ->placeholder('Marca')
                                             ->readonly()
                                            ->attribute('maxlength', 100)
                                            
                                            ->autofocus() }}
                    </div>
                    <!--form-group-->
                </div>
                <div class="row">
                    <div class="form-group col-md-5">
                        {{ html()->label('Modelo')->for('modelo') }}
                                        {{ html()->text('modelo')
                                            ->class('form-control')
                                            ->placeholder('Modelo')
                                            ->attribute('maxlength', 100)
                                             ->readonly()
                                            ->autofocus() }}
                    </div>
                    <div class="form-group col-md-5 col-md-push-1">
                        {{ html()->label('Patente')->for('patente') }}
                                        {{ html()->text('patente')
                                            ->class('form-control')
                                            ->placeholder('Patente')
                                            ->attribute('maxlength', 20)
                                            ->readonly()
                                            ->autofocus() }}
                    </div>
                    <!--form-group-->
                </div>
                <div class="row">
                    <div class="form-group col-md-5">
                        {{ html()->label('Fecha Compra')->for('fecha_compra') }}
                                        
                        <input class="form-control" name="fecha_compra" type="date" value="{{isset($maquinaria->fecha_compra) ?$maquinaria->fecha_compra->format('Y-m-d'):null}}" required readonly>
                        </input>
                    </div>
                    <div class="form-group col-md-5 col-md-push-1">
                       
                        {{ html()->label('Vencimiento Rev. Técnica')->for('venc_rev_tecnica') }}
                        <input class="form-control" name="venc_rev_tecnica" type="date" value="{{isset($maquinaria->venc_rev_tecnica) ?$maquinaria->venc_rev_tecnica->format('Y-m-d'):null}}" required readonly>
                        </input>
                                        
                    </div>
                    <!--form-group-->
                </div>
                <div class="row">
                    <div class="form-group col-md-5">
                        {{ html()->label('Fecha Inspección')->for('fecha_inspeccion') }}
                        <input class="form-control" name="fecha_inspeccion" type="date" value="{{isset($maquinaria->fecha_inspeccion) ?$maquinaria->fecha_inspeccion->format('Y-m-d'):null}}" required readonly>
                        </input>
                    </div>
                    <div class="form-group col-md-5 col-md-push-1">
                        {{ html()->label('Fecha Seguro')->for('fecha_seguro') }}
                        <input class="form-control" name="fecha_seguro" type="date" value="{{isset($maquinaria->fecha_seguro) ?$maquinaria->fecha_seguro->format('Y-m-d'):null}}" required readonly>
                        </input>
                    </div>
                    <!--form-group-->
                </div>
                <div class="row">
                    <div class="form-group col-md-5">
                        {{ html()->label('Número Roma')->for('numero_roma') }}
                                        {{ html()->text('numero_roma')
                                            ->class('form-control')
                                            ->placeholder('Número Roma')
                                            ->readonly()
                                            ->autofocus() }}
                    </div>
                    <div class="form-group col-md-5 col-md-push-1">
                        {{ html()->select('propietario', $propietario,null)
                                        ->placeholder('Seleccione Propietario', false)
                                        ->class('form-control')
                                        ->required()
                                        ->attribute('disabled')
                                        ->id('propietario') }}
                    </div>
                    <!--form-group-->
                </div>
               
                 <div class="row">
                    <div class="form-group col-md-12">
                       {{ html()->label('Descripción')->for('name') }}
                        <textarea class="summernote" id="descripcion" name="descripcion" title="Descripcion">{{ $maquinaria->descripcion }}</textarea>
                    </div>
                </div>


                @if($logged_in_user->hasRole('administrator'))
                <div class="row">
                    <div class="form-group col-md-5 ">
                        {{ html()->label('Empresa')->for('empresa_id') }}
                                            {{ html()->select('empresa_id', $empresas,null)
                                                ->placeholder('Seleccione Empresa', false)
                                                ->class('form-control')
                                                ->required()
                                                ->readonly()
                                                ->id('empresa_id') }}
                    </div>
                    <!--form-group-->
                </div>
                @endif
                <div class="mail-body text-right tooltip-demo">
                                                        
                    <a class="btn btn-white btn-sm" href="{{route('admin.maquinarias.index')}}" >@lang('buttons.general.cancel')</a>
                   
                                
                </div>
                            
                
                <div class="ibox-content">
                    <div class="table-responsive">
                        <h3>
                            Mantenciones
                        </h3>
                        <table class="table table-striped table-bordered table-hover dataTables" id="dataTables">
                            <thead>
                                <tr>
                                    @if($logged_in_user->hasRole('administrator'))
                                    <th>
                                        Empresa
                                    </th>
                                    @endif
                                    <th>
                                        Maquinaria
                                    </th>
                                   
                                    <th>
                                        Descripción
                                    </th>
                                    <th>
                                        Fecha
                                    </th>
                                    <th>
                                        Neto
                                    </th>
                                    <th>
                                        IVA
                                    </th>
                                    <th>
                                        Total
                                    </th>
                                </tr>
                            </thead>
                            <?php 
                          $sumTotalIva=0;
                       ?>
                            <tbody>
                                @foreach($mantenciones as $mantencion)
                                <?php
                                  $sumTotalIva += $mantencion->
                                total_iva; 
                            ?>
                                <tr>
                                    @if($logged_in_user->hasRole('administrator'))
                                    <td>
                                        {{$mantencion->maquinaria->empresa->nombre}}
                                    </td>
                                    @endif
                                    <td>
                                        {{ ucwords($mantencion->maquinaria->nombre) }}
                                    </td>
                                    
                                    <td>
                                        {{strip_tags($mantencion->descripcion)}}
                                    </td>
                                    <td>
                                        {{$mantencion->fecha->format('d-m-Y')}}
                                    </td>
                                    <td class="text-right">
                                        ${{number_format($mantencion->costo, 0,'','.')}}
                                    </td>
                                    <td class="text-right">
                                        ${{number_format($mantencion->iva, 0,'','.')}}
                                    </td>
                                    <td class="text-right">
                                        ${{number_format($mantencion->total_iva, 0,'','.')}}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td class="text-right" colspan="5">
                                        Total:
                                    </td>
                                    <td class="text-right" colspan="5">
                                        <strong>
                                            ${{$mantenciones!=null?number_format($sumTotalIva, 0,'','.'):number_format(0, 0,'','.')}}
                                        </strong>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <!--col-->
            </form>
        </div>
    </div>
</div>
{{ html()->form()->close() }}
@endsection
@section('scripts')
<script>
    $('#descripcion').summernote({
        height: 150,
    });
   
</script>
@endsection