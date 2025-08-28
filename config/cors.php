<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | This configuration allows all origins, methods, and headers.
    |
    */

    'paths' => ['api/*', 'sanctum/csrf-cookie'], // كل مسارات API

    'allowed_methods' => ['*'], // السماح بكل طرق HTTP (GET, POST, PUT, DELETE...)

    'allowed_origins' => ['*'], // السماح لكل الدومينات

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'], // السماح بكل الهيدرز

    'exposed_headers' => ['*'], // السماح بالهيدرز المكشوفة

    'max_age' => 0, // مدة التخزين المؤقت للـ preflight

    'supports_credentials' => false, // false لتجنب مشاكل الكوكيز مع كل الدومينات

];
