<nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element"> <span>
                            
                           @php  $file=Auth::user()->avatar_location; @endphp
                           @if(Auth::user()->avatar_location!="" && file_exists($file))
                               <img alt="{{ $logged_in_user->email }}" class="img-circle" src="{{ $logged_in_user->picture }}" height="50px" width="50px" />
                             </span>
                            @else
                                <img alt="{{ $logged_in_user->email }}" class="img-circle" src="{{ asset('app/public/avatars/no_avatar.png')}}" height="50px" width="50px" />

                            @endif


                        
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">{{ $logged_in_user->full_name }}</strong>
                             </span> <span class="text-muted text-xs block">Opciones<b class="caret"></b></span> </span> </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a href="{{url('account')}}">Perfil</a></li>
                            <li class="divider"></li>
                            <li><a href="{{ route('frontend.auth.logout') }}">@lang('navs.general.logout')</a></li>
                        </ul>
                    </div>
                    <div class="logo-element">
                        PT
                    </div>
                </li>
                <li>
                    <a href="{{ route('admin.dashboard') }}"><i class="fa fa-th-large"></i> <span class="nav-label">Inicio
                </a></span> <span class="fa arrow"></span></a>
                </li>
                 
            <!-- Requerimient0 -->
          
            @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('user'))
               <li>
                <a href="{{ route('admin.requerimientos.index') }}" ><i class="fa fa-diamond"></i> <span class="nav-label">Requerimientos
                </a></span> <span class="fa arrow"></span></a>
            </li>
            @endif                 

            @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('user'))
               <li>
                <a href="{{ route('admin.ordenTrabajos.index') }}" ><i class="fa fa-edit"></i> <span class="nav-label">Ordenes Trabajos
                </a></span> <span class="fa arrow"></span></a>
            </li>
            @endif
            @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('user'))
               <li>

                <a href="{{ route('admin.ordenLaboratorios.index') }}" ><i class="fa fa-flask"></i> <span class="nav-label">Ordenes Laboratorio

                </a></span> <span class="fa arrow"></span></a>
            </li>
            @endif   

                        <!-- Contabilidad -->
            @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('user'))
            <li class="{{ active_class(Active::checkUriPattern('admin/facturas*')) }}
                      {{ active_class(Active::checkUriPattern('admin/guia_despachos*')) }}
                      {{ active_class(Active::checkUriPattern('admin/notascredito*')) }}
                      {{ active_class(Active::checkUriPattern('admin/orden_compras*')) }}">
                    <a href="#"><i class="fas fa-coins" aria-hidden="true"></i><span class="nav-label">Contabilidad</span><span class="fa arrow"></span></a>

                <ul class="nav nav-second-level collapse">
                    

                    @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('user'))

                    <li class="{{ active_class(Active::checkUriPattern('admin/facturas*')) }}">
                        <a  href="{{ route('admin.facturas.index') }}">
                            Facturas
                        </a>
                    </li>
                    @endif
                    <li class="{{ active_class(Active::checkUriPattern('admin/notascredito*')) }}">
                        <a  href="{{ route('admin.notascredito.index') }}">Nota crédito</a>
                    </li>

                    <li class="{{ active_class(Active::checkUriPattern('admin/guia_despachos*')) }}">
                        <a  href="{{ route('admin.guia_despachos.index') }}">Guías de despacho</a>
                    </li>

                    <li class="{{ active_class(Active::checkUriPattern('admin/orden_compras*')) }}">
                        <a  href="{{ route('admin.orden_compras.index') }}">Ordenes de Compra</a>
                    </li>

                    
                </ul>
            </li>
            @endif
            <!-- Contabilidad -->
                            
                <!-- Campos -->
               @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('user'))
                <li class="{{active_class(Active::checkUriPattern('admin/campos*'))}}  
                           {{active_class(Active::checkUriPattern('admin/cuarteles*'))}}">
                    <a href="#"><i class="glyphicon glyphicon-leaf"></i> <span class="nav-label">Campos</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li class="{{ active_class(Active::checkUriPattern('admin/campos*')) }}">
                            <a  href="{{ route('admin.campos.index') }}">Campos</a>
                        </li>
                        <li class="{{ active_class(Active::checkUriPattern('admin/cuarteles*')) }}">
                            <a  href="{{ route('admin.cuarteles.index') }}">Cuarteles</a>
                        </li>
                        
                        
                    </ul>
                </li>
                @endif
         
   
            <!-- Comercial -->
            @if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('user'))
            <li class="
                      {{ active_class(Active::checkUriPattern('admin/clientes*')) }}
                      
                      {{ active_class(Active::checkUriPattern('admin/contactos*')) }}
\
                      {{ active_class(Active::checkUriPattern('admin/presupuestos*')) }}">
                    <a href="#"><i class="fa fa-usd" aria-hidden="true"></i><span class="nav-label">Comercial</span><span class="fa arrow"></span></a>

                <ul class="nav nav-second-level collapse">
                    
                   
                    <li class="{{ active_class(Active::checkUriPattern('admin/clientes')) }}">
                        <a  href="{{ route('admin.clientes.index') }}">
                            Clientes
                        </a>
                    </li>
                    <li class="{{ active_class(Active::checkUriPattern('admin/contactos')) }}">
                        <a  href="{{ route('admin.contactos.index') }}">
                            Contactos
                        </a>
                    </li>                    

                    <li class="{{ active_class(Active::checkUriPattern('admin/presupuestos')) }}">
                        <a  href="{{ route('admin.presupuestos.index') }}">
                            Cotizaciones
                        </a>
                    </li>

                                     
                </ul>
            </li>
            @endif
            <!-- Comercial -->

             <!-- Configuración -->
            <li class="
                       {{active_class(Active::checkUriPattern('admin/grupos*'))}}
                       {{active_class(Active::checkUriPattern('admin/tipoMuestras*'))}}
                       {{active_class(Active::checkUriPattern('admin/especieFuente*'))}}                       
                       {{active_class(Active::checkUriPattern('admin/analisis*'))}} 
                       {{active_class(Active::checkUriPattern('admin/laboratorio*'))}}

                       {{active_class(Active::checkUriPattern('admin/auth/*'))}}
                       {{active_class(Active::checkUriPattern('admin/trabajadores*'))}}                       
                       {{ active_class(Active::checkUriPattern('admin/perfil_planes*')) }}
                       {{active_class(Active::checkUriPattern('admin/perfil_empresa*'))}}">

                    <a href="#"><i class="fas fa-cogs"></i> <span class="nav-label">Configuración</span><span class="fa arrow"></span></a>

                {{--@if($logged_in_user->hasRole('executive') || $logged_in_user->hasRole('administrator'))--}}
                <ul class="nav nav-second-level collapse">

                    <li class="{{ active_class(Active::checkUriPattern('admin/perfil_empresa')) }}">
                        <a  href="{{ route('admin.perfil_empresa') }}">Empresa </a>
                    </li>

                    @if($logged_in_user->hasRole('user')||$logged_in_user->hasRole('executive'))
                    
                    <li class="{{ active_class(Active::checkUriPattern('admin/perfil_planes')) }}">
                        <a  href="{{ route('admin.perfil_planes') }}">Plan y Facturación</a>
                    </li>

                    @endif                                        
                    <li class="{{ active_class(Active::checkUriPattern('admin/auth/user*')) }}">
                        <a href="{{ route('admin.auth.user.index') }}">Usuarios

                               {{-- @if ($pending_approval > 0)
                                    <span class="badge badge-danger">{{ $pending_approval }}</span>
                                @endif--}}
                            </a>
                    </li>
                    <li class="{{ active_class(Active::checkUriPattern('admin/trabajadores*')) }}">
                        <a  href="{{ route('admin.trabajadores.index') }}">Trabajadores</a>
                    </li>                    


                    @if($logged_in_user->hasRole('user')||$logged_in_user->hasRole('executive'))
                             
                    <li class="{{ active_class(Active::checkUriPattern('admin/grupos')) }}">
                        <a  href="{{ route('admin.grupos.index') }}">Grupos </a>
                    </li>                                        
                                       
                    <li class="{{ active_class(Active::checkUriPattern('admin/tipoMuestras')) }}">
                        <a  href="{{ route('admin.tipo_muestras.index') }}">Tipo de Muestras </a>
                    </li>
                    <li class="{{ active_class(Active::checkUriPattern('admin/especieFuente')) }}">
                        <a  href="{{ route('admin.especieFuente.index') }}">Especies/Fuentes </a>
                    </li>                                      

                    <li class="{{ active_class(Active::checkUriPattern('admin/analisis')) }}">
                        <a  href="{{ route('admin.analisis.index') }}">Analisis </a>
                    </li> 
                    <li class="{{ active_class(Active::checkUriPattern('admin/laboratorio')) }}">
                        <a  href="{{ route('admin.laboratorio.index') }}">Laboratorio </a>
                    </li>              
                    @endif
  
             
                    
                </ul>
            </li>
            @if($logged_in_user->hasRole('user')||$logged_in_user->hasRole('executive'))
            <li>
                <a href="https://wiki.proterra.cl" target="_blank"><i class="fa fa-question-circle"></i> <span class="nav-label">Ayuda
                </a></span> <span class="fa arrow"></span></a>
            </li>
            @endif
                 
              

            @if ($logged_in_user->isAdmin())
                {{--<li class="{{ active_class(Active::checkUriPattern('admin/auth/*')) }}">
                    
                    <a href="#"><i class="fa fa-key"></i> <span class="nav-label">@lang('menus.backend.access.title')</span><span class="fa arrow"></span>
                        @if ($pending_approval > 0)
                            <span class="badge badge-danger">{{ $pending_approval }}</span>
                        @endif
                    </a>

                     <ul class="nav nav-second-level collapse">
                        <li class="{{ active_class(Active::checkUriPattern('admin/auth/user*')) }}">
                            <a href="{{ route('admin.auth.user.index') }}"><i class="nav-icon icon-cursor"></i> 
                                @lang('labels.backend.access.users.management')

                                @if ($pending_approval > 0)
                                    <span class="badge badge-danger">{{ $pending_approval }}</span>
                                @endif
                            </a>
                        </li>
                        <li class="{{ active_class(Active::checkUriPattern('admin/auth/role*')) }}">
                            <a  href="{{ route('admin.auth.role.index') }}"><i class="nav-icon icon-cursor"></i> 
                                @lang('labels.backend.access.roles.management')
                            </a>
                        </li>
                        <li class="{{ active_class(Active::checkUriPattern('admin/auth/permission*')) }}">
                            <a href="{{ route('admin.auth.permission.index') }}"><i class="nav-icon icon-cursor"></i> 
                                @lang('labels.backend.access.permissions.management')
                            </a>
                        </li>
                    </ul>
                </li>--}}
       
                <li class="{{ active_class(Active::checkUriPattern('admin/log-viewer*')) }}">
                    <a href="#"><i class="fa fa-file-text" aria-hidden="true"></i> <span class="nav-label">@lang('menus.backend.log-viewer.main')</span><span class="fa arrow"></span></a>

                <ul class="nav nav-second-level collapse">
                    <li class="{{ active_class(Active::checkUriPattern('admin/log-viewer')) }}">
                        <a  href="{{ route('log-viewer::dashboard') }}">
                            @lang('menus.backend.log-viewer.dashboard')
                        </a>
                    </li>
                    <li class="{{ active_class(Active::checkUriPattern('admin/log-viewer/logs*')) }}">
                        <a  href="{{ route('log-viewer::logs.list') }}">
                            @lang('menus.backend.log-viewer.logs')
                        </a>
                    </li>
                </ul>
            </li>

     @endif 
            </ul>

        </div>
    </nav>