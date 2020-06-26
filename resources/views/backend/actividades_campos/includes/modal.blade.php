<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="hideFields" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="hideFields">Centro de Costo</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-8">
                      <table id="table_modal" class="table table-striped table-bordered table-hover">
                                    <tr>
                                        <td>Nombre</td>
                                        <td>Has</td>
                                        <td>Seleccionar</td>
                                    </tr>
                                    @foreach($actividad->cuarteles as $cuartel)
                                    <tr>
                                        <td>{{ $cuartel->nombre }}</td>
                                        <td>{{ $cuartel->tamanno }}</td>
                                        <td><input class="cuartel_input" type="number" min=0 value=0 name="{{ $cuartel->id }}"></td>
                                    </tr>
                                    @endforeach
                                    
                                </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" id="confirmar" data-dismiss="modal"  class="btn btn-primary">Confirmar</button>
                
            </div>
        </div>
      
    </div>
</div>