<?php

Breadcrumbs::for('admin.auth.permission.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Permisos', route('admin.auth.permission.index'));
});

Breadcrumbs::for('admin.auth.permission.create', function ($trail) {
    $trail->parent('admin.auth.permission.index');
    $trail->push('Nuevo', route('admin.auth.permission.create'));
});

Breadcrumbs::for('admin.auth.permission.edit', function ($trail, $id) {
    $trail->parent('admin.auth.permission.index');
    $trail->push('Editar', route('admin.auth.permission.edit', $id));
});
