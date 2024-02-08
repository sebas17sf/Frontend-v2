<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'firebase' => [
        'api_key' => 'AIzaSyDhWi9glDQGV1ioVtnpt4-3hRLizqN98sc',
        'auth_domain' => 'avanzada-3ce1f.firebaseapp.com',
        'database_url' => '',  
        'project_id' => 'avanzada-3ce1f',
        'storage_bucket' => 'avanzada-3ce1f.appspot.com',
        'messaging_sender_id' => '419660386246',
        'app_id' => '1:419660386246:web:47abbf273f37390574ecc7',
        'measurement_id' => '',  
    ],
    


];
