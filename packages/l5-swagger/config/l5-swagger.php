<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Basic Info
    |--------------------------------------------------------------------------
    |
    | The basic info for the application such as the title description,
    | description, version, etc...
    |
    */

    'openapi'     => env('OPENAPI_VERSION', '3.0.1'),
    'title'       => env('APP_NAME'),
    'description' => env('OPENAPI_DESCRIPTION', 'Ahihi'),
    'appVersion'  => env('APP_VERSION', '1.0.0'),

    'url'      => env('APP_URL'),
    'basePath' => '/',

    'schemes' => [
        // 'http',
        // 'https',
    ],

    'consumes' => [
        'application/json',
        'multipart/form-data'
    ],

    'produces' => [
        'application/json',
    ],

    /*
    |--------------------------------------------------------------------------
    | Ignore methods
    |--------------------------------------------------------------------------
    |
    | Methods in the following array will be ignored in the paths array
    |
    */

    'ignoredMethods' => [
        'head',
    ],

    'securitySchemes' => [

    ]
];
