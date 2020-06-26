<div class="mail-body text-right">
		@if( request()->route()->getName() == 'admin.clientes.index')
            <a href="{{ route('admin.cliente.create') }}" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="@lang('labels.general.create_new')">Nuevo Cliente</a>
        @else
            <a href="{{ route('admin.proveedor.create') }}" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="@lang('labels.general.create_new')">Nuevo Proveedor</a>
        @endif        
           
</div>

