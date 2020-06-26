
                    
                    <div class="ibox-content">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables" data-page-length='8'>
                        <thead>
                        <tr>
                            <th>Nro.</th>
                            @if($logged_in_user->hasRole('administrator'))
                                <th>Empresa</th>
                            @endif
                            <th>Caravana</th>
                            <th>Nombre</th>
                            <th>Especie</th>
                            <th>Raza</th>
                            <th>Rodeo</th>
                            
                            
                            @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('administrator'))
                            <th>@lang('labels.general.actions')</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                       @php  $key=count($animales)@endphp 
                        @foreach($animales as $animal)

                            <tr>
                                <td>{{ $key-- }}</td>
                                @if($logged_in_user->hasRole('administrator'))
                                    <td onclick="window.location='{{route('admin.animales.show', $animal->id)}}';">{{$animal->empresa->nombre}}</td>
                                @endif
                                <td onclick="window.location='{{route('admin.animales.show', $animal->id)}}';">{{$animal->caravana}}</td>
                                <td onclick="window.location='{{route('admin.animales.show', $animal->id)}}';">{{$animal->nombre}}</td>
                                <td onclick="window.location='{{route('admin.animales.show', $animal->id)}}';">{{isset($animal->especie->nombre)?$animal->especie->nombre:''}}</td>
                                <td onclick="window.location='{{route('admin.animales.show', $animal->id)}}';">{{$animal->raza}}</td>
                                <td onclick="window.location='{{route('admin.animales.show', $animal->id)}}';">{{isset($animal->rodeo->nombre)?$animal->rodeo->nombre:''}}</td>
                                
                                @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('administrator'))
                                 <td>{!! $animal->action_buttons !!}</td>
                                @endif
                            </tr>
                            
                        @endforeach

                        </tbody>
                    </table>
                    @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('administrator'))
                        @include('backend.animales.includes.header-buttons')
                    @endif
                </div>
            </div>
             