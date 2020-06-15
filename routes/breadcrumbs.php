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

// Courses
Breadcrumbs::for('courses', function ($trail) {
    $trail->push('Quản lý khóa học', route('courses.index'));
});

// Courses > Create
Breadcrumbs::for('courses.create', function ($trail) {
	$trail->parent('courses');
    $trail->push('Thêm mới', route('courses.create'));
});

// Courses > Edit
Breadcrumbs::for('courses.edit', function ($trail, $course) {
	$trail->parent('courses');
    $trail->push('Chỉnh sửa', route('courses.edit', $course->id));
});
