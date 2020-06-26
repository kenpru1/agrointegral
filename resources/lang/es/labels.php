<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Labels Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used in labels throughout the system.
    | Regardless where it is placed, a label can be listed here so it is easily
    | found in a intuitive way.
    |
    */

    'general' => [
        'all'        => 'Todos',
        'yes'        => 'Sí',
        'no'         => 'No',
        'copyright'  => 'Copyright',
        'create_new' => 'Crear Nuevo',        
        'custom'     => 'Personalizado',
        'actions'    => 'Acciones',
        'active'     => 'Activo',
        'buttons'    => [
            'save'   => 'Guardar',
            'update' => 'Actualizar',
        ],
        'hide'              => 'Ocultar',
        'inactive'          => 'Inactivo',
        'none'              => 'Ningúno',
        'show'              => 'Mostrar',
        'toggle_navigation' => 'Abrir/Cerrar menú de navegación',
    ],

    'backend' => [
        'access' => [
            'analisis' => [
                'create'     => 'Crear Análisis',
                'edit'       => 'Editar Análisis',
                'management' => 'Administración de Análisis',

                'table' => [
                    'total'     => 'Todos los Análisis',

                ],
            ], 
            'campos' => [
                'create'     => 'Crear Campos',
                'edit'       => 'Editar Campos',
                'management' => 'Administración de Campos',

                'table' => [
                    'total'     => 'Todos los Campos',

                ],
            ],              
            'clientes' => [
                'create'     => 'Crear Clientes',
                'edit'       => 'Editar Clientes',
                'management' => 'Administración de Clientes',

                'table' => [
                    'total'     => 'Todos los Clientes',

                ],
            ],  
            'especie_fuente' => [
                'create'     => 'Crear Especies / Fuentes',
                'edit'       => 'Editar Especies / Fuentes',
                'management' => 'Administración de Especies / Fuentes',

                'table' => [
                    'total'     => 'Todas las Especies / Fuentes',

                ],
            ],                                                              
            'grupos' => [
                'create'     => 'Crear Grupos de Clientes',
                'edit'       => 'Editar Grupos de Clientes',
                'management' => 'Administración de Grupos de Clientes',

                'table' => [
                    'total'     => 'Todos los grupos de Clientes',

                ],
            ],
            'laboratorio' => [
                'create'     => 'Crear Laboratorio',
                'edit'       => 'Editar Laboratorio',
                'management' => 'Administración de Laboratorio',

                'table' => [
                    'total'     => 'Todos los Laboratorio',

                ],
            ],                               
            'ordenTrabajo' => [
                'create'     => 'Crear Ordenens de Trabajo',
                'edit'       => 'Editar Ordenes de Trabajo',
                'management' => 'Administración de Ordenes de Trabajo',

                'table' => [
                    'total'     => 'Todos las Ordenes de Trabajo',

                ],
            ],                               
            'permissions' => [
                'create'     => 'Crear Permiso',
                'edit'       => 'Modificar Permiso',
                'management' => 'Administración de Permisos',

                'table' => [
                    'guard_name' => 'Guardian Nombre',
                    'permissions'     => 'Permisos',
                    'total'     => 'Todos los Permisos',
                    'number_of_roles' => 'Número de Roles',


                ],
            ],
            'presupuesto' => [
                'create'     => 'Crear Cotizaciones',
                'edit'       => 'Editar Cotización',
                'management' => 'Administración de Cotizaciones',

                'table' => [
                    'total'     => 'Todos las Cotizaciones',

                ],
            ],                                                       
            'proveedor' => [
                'create'     => 'Crear Proveedores',
                'edit'       => 'Editar Proveedores',
                'management' => 'Administración de Proveedores',

                'table' => [
                    'total'     => 'Todos los Proveedores',

                ],
            ],            
            'roles' => [
                'create'     => 'Crear Rol',
                'edit'       => 'Modificar Rol',
                'management' => 'Administración de Roles',

                'table' => [
                    'number_of_users' => 'Número de Usuarios',
                    'permissions'     => 'Permisos',
                    'role'            => 'Rol',
                    'sort'            => 'Orden',
                    'total'           => 'Todos los Roles',
                ],
            ],            
            'tipo_muestras' => [
                'create'     => 'Crear Tipos de Muestras',
                'edit'       => 'Editar Tipos de Muestras',
                'management' => 'Administración de Tipos de Muestras',

                'table' => [
                    'total'     => 'Todos los Tipos de Muestras',

                ],
            ],                
            'users' => [
                'active'              => 'Usuarios activos',
                'all_permissions'     => 'Todos los Permisos',
                'change_password'     => 'Cambiar la contraseña',
                'change_password_for' => 'Cambiar la contraseña para :user',
                'create'              => 'Crear Usuario',
                'deactivated'         => 'Usuarios desactivados',
                'deleted'             => 'Usuarios eliminados',
                'edit'                => 'Modificar Usuario',
                'management'          => 'Administración de Usuarios',
                'no_permissions'      => 'Sin Permisos',
                'no_roles'            => 'No hay Roles disponibles.',
                'permissions'         => 'Permisos',

                'table' => [
                    'confirmed'         => 'Confirmado',
                    'created'           => 'Creado',
                    'email'             => 'Correo',
                    'id'                => 'ID',
                    'last_updated'      => 'Última modificación',
                    'name'              => 'Nombre',
                    'first_name'        => 'Nombre',
                    'last_name'         => 'Apellidos',
                    'no_deactivated'    => 'Ningún Usuario desactivado disponible',
                    'no_deleted'        => 'Ningún Usuario eliminado disponible',
                    'other_permissions' => 'Otros Permisos',
                    'permissions'       => 'Permisos',
                    'roles'             => 'Roles',
                    'social'            => 'Cuenta Social',
                    'total'             => 'Todos los Usuarios',
                ],

                'tabs' => [
                    'titles' => [
                        'overview' => 'Resúmen',
                        'history'  => 'Historia',
                    ],

                    'content' => [
                        'overview' => [
                            'avatar'       => 'Avatar',
                            'confirmed'    => 'Confirmado',
                            'created_at'   => 'Creación',
                            'deleted_at'   => 'Eliminación',
                            'email'        => 'E-mail',
                            'last_login_at' => 'Último Login En',
                            'last_login_ip' => 'Último Login IP',
                            'last_updated' => 'Última Actualización',
                            'name'         => 'Nombre',
                            'first_name'   => 'Nombre',
                            'last_name'    => 'Apellidos',
                            'status'       => 'Estatus',
                            'timezone'     => 'Zona horaria',
                        ],
                    ],
                ],

                'view' => 'Ver Usuario',
            ],
        ],
    ],

    'frontend' => [

        'auth' => [
            'login_box_title'    => 'Iniciar Sesión',
            'login_button'       => 'Iniciar Sesión',
            'login_with'         => 'Iniciar Sesión mediante :social_media',
            'register_box_title' => 'Registrarse',
            'register_button'    => 'Registrarse',
            'remember_me'        => 'Recordarme',
        ],

        'contact' => [
            'box_title' => 'Contáctenos',
            'button' => 'Enviar información',
        ],

        'passwords' => [
            'expired_password_box_title'      => 'Tu contraseña a expirado.',
            'forgot_password'                 => 'Has olvidado la contraseña?',
            'reset_password_box_title'        => 'Reiniciar contraseña',
            'reset_password_button'           => 'Reiniciar contraseña',
            'update_password_button'          => 'Actualizar contraseña',
            'send_password_reset_link_button' => 'Enviar el correo de verificación',
        ],

        'user' => [
            'passwords' => [
                'change' => 'Cambiar la contraseña',
            ],

            'profile' => [
                'avatar'             => 'Avatar',
                'created_at'         => 'Creado el',
                'edit_information'   => 'Modificar la información',
                'email'              => 'Correo',
                'last_updated'       => 'Última modificación',
                'name'               => 'Nombre',
                'first_name'         => 'Nombre',
                'last_name'          => 'Apellidos',
                'update_information' => 'Actualizar la información',
            ],
        ],
    ],
];
