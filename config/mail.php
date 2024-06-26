<?php

return [

    'default' => env('MAIL_MAILER', 'smtp'),

    'mailers' => [
        'smtp' => [
            'transport' => 'smtp',
            'host' => env('MAIL_HOST', 'smtp.gmail.com'),
            'port' => env('MAIL_PORT', 587),
            'encryption' => env('MAIL_ENCRYPTION', 'tls'),
            'username' => env('durieltims@gmail.com'),
            'password' => env('oterksdyfnfhrqtj'),
            'timeout' => null,
            'auth_mode' => null,
        ],

        // Other mailers can be added here...
    ],

    'from' => [
        'address' => env('MAIL_FROM_ADDRESS', 'durieltims@gmail.com'),
        'name' => env('MAIL_FROM_NAME', 'HRIS'),
    ],

    // Additional configuration settings...
];