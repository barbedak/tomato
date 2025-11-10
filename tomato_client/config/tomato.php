<?php

return [
    'email' => env('TOMATO_EMAIL',''),
    'password' => env('TOMATO_PASSWORD',''),
    'domain' => env('TOMATO_DOMAIN',''),
    'login_path' => env('TOMATO_LOGIN_PATH','/api/auth/login'),
];
