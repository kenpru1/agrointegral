<div class="mail-body text-right">
    <a class="btn btn-white btn-sm" href="{{route('admin.maquinarias.index')}}">
        Volver
    </a>
    <a class="btn btn-sm btn-primary" data-placement="top" data-toggle="tooltip" href="{{ route('admin.mantenciones.create',$maquinaria->id) }}" title="@lang('labels.general.create_new')">
        Nueva Mantención
    </a>
</div>
