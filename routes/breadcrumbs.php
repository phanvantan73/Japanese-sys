<?php

// Dashboard
Breadcrumbs::for('dashboard', function ($trail) {
    $trail->push('Dashboard', route('dashboard'));
});

// Users
Breadcrumbs::for('users', function ($trail) {
    $trail->push('Quản lý người dùng', route('users.index'));
});

// Users > Create
Breadcrumbs::for('users.create', function ($trail) {
	$trail->parent('users');
    $trail->push('Thêm mới', route('users.create'));
});

// Users > Edit
Breadcrumbs::for('users.edit', function ($trail, $user) {
	$trail->parent('users');
    $trail->push('Chỉnh sửa', route('users.edit', $user->id));
});