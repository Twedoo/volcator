<?php

return [
    'minio' => [
        'driver' => 's3',
        'endpoint' => env('MINIO_ENDPOINT', 'http://127.0.0.1:9000'),
        'use_path_style_endpoint' => true,
        'key' => env('MINIO_KEY'),
        'secret' => env('MINIO_SECRET'),
        'region' => env('MINIO_REGION'),
        'bucket' => env('MINIO_BUCKET'),
    ]
];
