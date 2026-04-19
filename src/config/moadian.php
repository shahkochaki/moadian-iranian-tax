<?php

return [
    'username'         => env('MOADIAN_USERNAME'),
    'password'         => env('MOADIAN_PASSWORD', null),
    'private_key_path' => env('MOADIAN_PRIVATE_KEY_PATH'),
    'certificate_path' => env('MOADIAN_CERTIFICATE_PATH'),
    'base_uri'         => env('MOADIAN_BASE_URI', 'https://tp.tax.gov.ir/requestsmanager/api/v2/'),
];
