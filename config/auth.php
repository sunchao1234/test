<?php

return [
    'driver' => 'eloquent',
    'model'  => 'App\Models\Admin\AdminUsersModel',
    'table'  => 'users',
    'remember' => [
            'email'  => 'emails.password',
            'table'  => 'password_resets',
            'expire' => 60,
    ],
    'path' => [
        'redirect'      => '/admin',
        'login'          => '/admin/login',
        'logout_redirec' => '/admin'
    ]
];

