<?php
return [
    'route_prefix' => env('LARATUS_ROUTE_PREFIX', 'tus'),
    'middleware' => [],
    'upload_disk' => env('LARATUS_TEMP_DISK', 'local'),
    'upload_path' => env('LARATUS_TEMP_PATH', 'tus-uploads'),
    'max_size' => '500M',
    'max_chunk_size' => null,
    'extensions' => [
        'creation',
        'termination',
        'checksum',
        'concatenation',
    ]
];
