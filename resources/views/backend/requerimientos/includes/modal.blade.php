@foreach($requerimientos as $requerimiento)
    <div class="modal inmodal" id="myModal{{$requerimiento->id}}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <!-- <i class="fa fa-trash-o modal-icon"></i> -->
                    <h4 class="modal-title">¿Desea archivar el requerimiento?</h4>
                </div>
                {{ html()->modelForm($requerimiento, 'PATCH', route('admin.requerimientos.perdida', $requerimiento))->class('form-horizontal')->attribute('enctype', 'multipart/form-data')->open() }}
                    <div class="modal-body">
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Archivar</button>
                    </div>
                {{ html()->form()->close() }}
            </div>
        </div>
    </div>
@endforeach