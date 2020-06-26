<!-- Modal-->
<div id="myModal1" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <!-- Modal content-->
    <div class="modal-content">
      <!--Cabecera del modal-->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Editar datos</h4>
      </div>
      <!--Contenido del modal-->
      <div class="modal-body">

        <div class="form-group">
          <div class="col-xm-6">
          <input class="form-control" type="text" id="numero_muestra" name="numero_muestra" placeholder="Numero de Muestras" value='{{ $data }}'>
          </div>
        </div>

        <div class="form-group">
          <div class="col-xm-6">
          <input class="form-control " type="text" id="txt_costo" name="txt_costo" placeholder="Costo" required="">
          </div>
        </div>
      </div>
      <!--Final del modal-->
      <div class="modal-footer">
        <button type="submit" id="guardar" class="btn btn-success btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span> Guardar</button>
      </div>
    </div>
  </div>
</div>