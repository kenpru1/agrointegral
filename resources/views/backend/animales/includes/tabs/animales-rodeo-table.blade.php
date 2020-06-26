 <div class="ibox-content">
                <div class="table-responsive">
             <table class="table table-striped table-bordered table-hover dataTables" data-page-length='8'>
                        <thead>
                        <tr>
                            <th>Nro.</th>
                             <th>Rodeos</th>
                          
                        </tr>
                        </thead>
                        <tbody>
                       @php  $key=count($rodeos)@endphp 
                        @foreach($rodeos as $rodeo)

                            <tr>
                                <td>{{ $key-- }}</td>
                               
                                <td>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <h3>{{ $rodeo->nombre }}</h3>
                                        </div>

                                        <div class="col-md-8">   
                                                                       
                                         <h3>{{ App\Models\Animal::where('empresa_id',$empresa_id)->where('rodeo_id',$rodeo->id)->count() }}    Animales  </h3>

                                        </div>
                                        <div class="col-md-1 col-md-pull-5">
                                            <img src="{{ asset('img/backend/cow.png') }}"  height='40px' width='40px'>
                                        </div>
                                     </div>
                                </td>
                             
                            </tr>
                            
                        @endforeach

                        </tbody>
                    </table>
               </div>
           </div>