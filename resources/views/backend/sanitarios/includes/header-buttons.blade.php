<div class="mail-body text-right">
    <a class="btn btn-white btn-sm" href="{{route('admin.animales.index')}}">
        Volver
    </a>
    <a class="btn btn-sm btn-primary" data-placement="top" data-toggle="tooltip" href="{{ route('admin.sanitarios.create',$animal->id) }}" title="@lang('labels.general.create_new')">
        Nuevo Sanitario
    </a>
</div>
