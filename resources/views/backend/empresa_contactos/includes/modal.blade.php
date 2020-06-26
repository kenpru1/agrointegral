<div class="modal inmodal" id="modalImportarContactos" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <i class="fa fa-file-excel-o modal-icon"></i>
                <h4 class="modal-title">Importar Contactos</h4>
                <small class="font-bold">Seleccione su archivo excel o csv para importar masivamente</small>
            </div>
            {{ html()->form('POST', route('admin.importarContactos'))->class('form-horizontal')->attribute('enctype', 'multipart/form-data')->open() }}
                {{csrf_field()}}
                <div class="modal-body">
                        
                    <div class="form-group">
                        {{ html()->label('Archivo')->for('archivo') }}
                                
                        <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                            <div class="form-control" data-trigger="fileinput">
                                <i class="glyphicon glyphicon-file fileinput-exists"></i>
                                <span class="fileinput-filename"></span>
                            </div>
                            <span class="input-group-addon btn btn-default btn-file">
                                <span class="fileinput-new">Seleccione Archivo</span>
                                <span class="fileinput-exists">Cambiar</span>
                                <input type="file" name="archivo"/>
                            </span>
                            <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Quitar</a>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Importar</button>
                </div>
            {{ html()->form()->close() }}
        </div>
    </div>
</div>