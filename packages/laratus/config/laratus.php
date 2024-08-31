<?php
return [
    'route_prefix' => env('LARATUS_ROUTE_PREFIX', 'tus'),
    'middleware' => [
        \Illuminate\Cookie\Middleware\EncryptCookies::class,
        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        \Illuminate\Foundation\Http\Middleware\ValidateCsrfToken::class,
        \Illuminate\Routing\Middleware\SubstituteBindings::class,

    ],
    'upload_disk' => env('LARATUS_TEMP_DISK', 'local'),
    'upload_path' => env('LARATUS_TEMP_PATH', 'tus-uploads'),
    'cache_store' =>  env('LARATUS_CACHE_STORE', env('CACHE_STORE', 'database')),
    'max_size' => '500M',
    'max_chunk_size' => null,
    'extensions' => [
        'creation',
        'termination',
        'checksum',
        'concatenation',
    ]
];
