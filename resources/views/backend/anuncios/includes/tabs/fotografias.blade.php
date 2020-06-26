 {{ html()->form('POST', route('admin.publicaciones.upload'))->id('my-awesome-dropzone')->class('form-horizontal dropzone')->open() }}  
            <div class="fallback">
                <input name="file" type="file" multiple />         
            </div>
            <input type="hidden" name="drop_ident" value="{{ $identificador }}">
        {{ html()->form()->close() }} 
  <!--<div class="table-responsive">

                                          <table class="table table-bordered table-stripped">
                                                <thead>
                                                <tr>
                                                    <th>
                                                        Image preview
                                                    </th>
                                                    
                                                    <th>
                                                        Sort order
                                                    </th>
                                                    <th>
                                                        Actions
                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td>
                                                        <img src="img/gallery/2s.jpg">
                                                    </td>
                                                    
                                                    <td>
                                                        <input type="text" class="form-control" value="1">
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-white"><i class="fa fa-trash"></i> </button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <img src="img/gallery/1s.jpg">
                                                    </td>
                                                    
                                                    <td>
                                                        <input type="text" class="form-control" value="2">
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-white"><i class="fa fa-trash"></i> </button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <img src="img/gallery/3s.jpg">
                                                    </td>
                                                    
                                                    <td>
                                                        <input type="text" class="form-control" value="3">
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-white"><i class="fa fa-trash"></i> </button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <img src="img/gallery/4s.jpg">
                                                    </td>
                                                    
                                                    <td>
                                                        <input type="text" class="form-control" value="4">
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-white"><i class="fa fa-trash"></i> </button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <img src="img/gallery/5s.jpg">
                                                    </td>
                                                    
                                                    <td>
                                                        <input type="text" class="form-control" value="5">
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-white"><i class="fa fa-trash"></i> </button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <img src="img/gallery/6s.jpg">
                                                    </td>
                                                    
                                                    <td>
                                                        <input type="text" class="form-control" value="6">
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-white"><i class="fa fa-trash"></i> </button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <img src="img/gallery/7s.jpg">
                                                    </td>
                                                    
                                                    <td>
                                                        <input type="text" class="form-control" value="7">
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-white"><i class="fa fa-trash"></i> </button>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
</div>-->

