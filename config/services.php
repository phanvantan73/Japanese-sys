<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, SparkPost and others. This file provides a sane default
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'passport' => [
        'password_grant_type' => env('PASSPORT_GRANT_TYPE', 'password'),
        'refresh_token_grant_type' => env('PASSPORT_REFRESH_TOKEN_GRANT_TYPE', 'refresh_token'),
        'client_id' => env('PASSPORT_CLIENT_ID', '1'),
        'client_secret' => env('PASSPORT_CLIENT_SECRET', ''),
        'url_request_token' => env('PASSPORT_URL', 'localhost') . '/oauth/token',
        'url' => env('PASSPORT_URL', 'localhost'),
        'scheme' => env('PASSPORT_URL_SCHEME', 'http'),
        'access_token_expires' => env('PASSPORT_ACCESS_TOKEN_EXPIRES', 15),
        'refresh_token_expires' => env('PASSPORT_REFRESH_TOKEN_EXPIRES', 30),
    ],

];
