<?php

return [
    'default' => env('MAIL_MAILER', 'smtp'),

    'mailers' => [
        'smtp' => [
            'transport' => 'smtp',
            'host' => env('MAIL_HOST', 'smtp.gmail.org'),
            'port' => env('MAIL_PORT', 587),
            'encryption' => env('MAIL_ENCRYPTION', 'tls'),
            'username' => env('MAIL_USERNAME'),
            'password' => env('MAIL_PASSWORD'),
            'timeout' => null,
            'auth_mode' => null,
        ],
        // ... other mailers
    ],

    'from' => [
        'address' => env('MAIL_FROM_ADDRESS', 'durieltims@gmail.com'),
        'name' => env('MAIL_FROM_NAME', 'HRIS'),
    ],
];
