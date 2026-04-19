<?php

return [
    'username'             => env('MOADIAN_USERNAME'),
    'private_key_path'     => env('MOADIAN_PRIVATE_KEY_PATH'),
    'private_key_password' => env('MOADIAN_PRIVATE_KEY_PASSWORD', null),
    'certificate_path'     => env('MOADIAN_CERTIFICATE_PATH'),
    'base_uri'             => env('MOADIAN_BASE_URI', 'https://tp.tax.gov.ir/requestsmanager/api/v2/'),
];
