<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. A "local" driver, as well as a variety of cloud
    | based drivers are available for your choosing. Just store away!
    |
    | Supported: "local", "ftp", "s3", "rackspace"
    |
    */

    'default' => 'local',

    /*
    |--------------------------------------------------------------------------
    | Default Cloud Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Many applications store files both locally and in the cloud. For this
    | reason, you may specify a default "cloud" driver here. This driver
    | will be bound as the Cloud disk implementation in the container.
    |
    */

    'cloud' => 's3',

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been setup for each driver as an example of the required options.
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'visibility' => 'public',
        ],

        'users' => [
            'driver' => 'local',
            'root' => storage_path('users'),
            'url' => env('APP_URL').'/esuite/framework/storage/users',
            'visibility' => 'public',
        ],

        'companies' => [
            'driver' => 'local',
            'root' => storage_path('companies'),
            'url' => env('APP_URL').'/esuite/framework/storage/companies',
            'visibility' => 'public',
        ],

        'qore' => [
            'driver' => 'local',
            'root' => storage_path('modules/qore'),
            'visibility' => 'public',
        ],

        'cove' => [
            'driver' => 'local',
            'root' => storage_path('modules/cove'),
            'visibility' => 'public',
            'url' => env('APP_URL').'/esuite/framework/storage/modules/cove',
        ],

        'documents' => [
            'driver' => 'local',
            'root' => storage_path('documents'),
            'visibility' => 'public',
        ],
        'logos' => [
            'driver' => 'local',
            'root' => storage_path('modules/logos'),
            'url' => env('APP_URL').'/esuite/framework/storage/modules/logos',
            'visibility' => 'public',
        ],
        'xml' => [
            'driver' => 'local',
            'root' => storage_path('xml'),
            'visibility' => 'public',
        ],

        'seals' => [
            'driver' => 'local',
            'root' => storage_path('seals'),
            'visibility' => 'public'
        ],

        's3' => [
            'driver' => 's3',
            'key' => 'your-key',
            'secret' => 'your-secret',
            'region' => 'your-region',
            'bucket' => 'your-bucket',
        ],

    ],

];
