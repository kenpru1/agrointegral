@foreach($oportunidades as $oportunidad)
    <div class="modal inmodal" id="myModal{{$oportunidad->id}}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <i class="fa fa-trash-o modal-icon"></i>
                    <h4 class="modal-title">Oportunidad Perdida</h4>
                    <small class="font-bold">Ingrese el motivo de la pérdida de la oportunidad.</small>
                </div>
                {{ html()->modelForm($oportunidad, 'PATCH', route('admin.oportunidades.perdida', $oportunidad))->class('form-horizontal')->attribute('enctype', 'multipart/form-data')->open() }}
                    <div class="modal-body">
                        
                            <div class="form-group">
                                {{ html()->label('Motivo Pérdida')->for('motivo_perdida') }}
                                
                                {{ html()->text('motivo_perdida')
                                            ->class('form-control')
                                            ->placeholder('motivo pérdida')
                                            ->attribute('maxlength', 100)
                                            ->required()
                                            ->autofocus() }}
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                {{ html()->form()->close() }}
            </div>
        </div>
    </div>
@endforeach