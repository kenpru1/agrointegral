<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Menus Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used in menu items throughout the system.
    | Regardless where it is placed, a menu item can be listed here so it is easily
    | found in a intuitive way.
    |
    */

    'backend' => [
        'access' => [
            'title' => 'Administración de acceso',

            'permissions' => [
                'all'        => 'Todos los Permisos',
                'create'     => 'Nuevo Permiso',
                'edit'       => 'Modificar Permiso',
                'management' => 'Administración de Permisos',
                'main'       => 'Permisos',
            ],

            'roles' => [
                'all'        => 'Todos los Roles',
                'create'     => 'Nuevo Rol',
                'edit'       => 'Modificar Rol',
                'management' => 'Administración de Roles',
                'main'       => 'Roles',
            ],

            'users' => [
                'all'             => 'Todos los Usuarios',
                'change-password' => 'Cambiar la contraseña',
                'create'          => 'Nuevo Usuario',
                'deactivated'     => 'Usuarios Desactivados',
                'deleted'         => 'Usuarios Eliminados',
                'edit'            => 'Modificar Usuario',
                'main'            => 'Usuario',
                'view'            => 'Ver Usuario',
            ],
        ],

        'log-viewer' => [
            'main'      => 'Gestor de Logs',
            'dashboard' => 'Principal',
            'logs'      => 'Logs',
        ],

        'sidebar' => [
            'dashboard' => 'Dashboard',
            'general'   => 'General',
            'history'   => 'Historia',
            'system'    => 'Sistema',
            'reports'   => 'Reportes',
            'configs'   => 'Configuraciones',
        ],

        'cdrs' => [
            'title'      => 'Archivos Registros de Llamadas',
            'all'        => 'Todos los Permisos',
            'management' => 'Descargas de Cdrs',
            'main'       => 'CDRS',
        ],
    ],

    'language-picker' => [
        'language' => 'Idioma',
        /*
         * Add the new language to this array.
         * The key should have the same language code as the folder name.
         * The string should be: 'Language-name-in-your-own-language (Language-name-in-English)'.
         * Be sure to add the new language in alphabetical order.
         */
        'langs' => [
            'ar'    => 'العربية (Arabic)',
            'zh'    => '(Chinese Simplified)',
            'zh-TW' => '(Chinese Traditional)',
            'da'    => 'Danés (Danish)',
            'de'    => 'Alemán (German)',
            'el'    => '(Greek)',
            'en'    => 'Inglés (English)',
            'es'    => 'Español (Spanish)',
            'fa'    => 'Persa (Persian)',
            'fr'    => 'Francés (French)',
            'he'    => 'Hebreo (Hebrew)',
            'id'    => 'Indonesio (Indonesian)',
            'it'    => 'Italiano (Italian)',
            'ja'    => '(Japanese)',
            'nl'    => 'Holandés (Dutch)',
            'no'    => 'Noruego (Norwegian)',
            'pt_BR' => 'Portugués Brasileño',
            'ru'    => 'Russian (Russian)',
            'sv'    => 'Sueco (Swedish)',
            'th'    => '(Thai)',
            'tr'    => '(Turkish)',
        ],
    ],
];
