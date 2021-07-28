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
'firebase'=>[
    "type"=> "service_account",
    "project_id"=> "nuocmiasaigon-fc089",
    "private_key_id"=> "3aae871089f6b2adc522a8291acd628f4646fb43",
    "private_key"=> "-----BEGIN PRIVATE KEY-----\nMIIEvQIBADANBgkqhkiG9w0BAQEFAASCBKcwggSjAgEAAoIBAQCtXi1JD4Q5ZgHH\n9Lj2gLm61N9sP8vTZgVF0/QgjqUD2k9ilK764EGbc6yijDxDWif48/2ms4yqX044\nDb5ix7x/aFXLYWq6W+Sbd+mSEaiuQeQa9TmrKOqS/iQwKSkV+3HhTBdT+MqqXY6O\n6GeaKAV7rJ1tWRn7f7blFC5/jZifMAzv0qNzNJ3kHuZrhbwQYXa4X1gUCr/r9CDn\nlJeHzdg7ysFhXk/FL5IxnKVW91CAAuKwROyOE3+R4xfeOXq/3LKjb2u8ad+9AKHQ\ngbQVbDu2SjiSsuoy6mPrCOOzBjjXHZVdp9qSTGlZ+ZX6EouIBtaJzLBDlz90R/hc\nkGDw+2QfAgMBAAECggEAD/I1oB65Pr5PM6Ei0imM685grog/qzYbDg0sy0HTk8Mk\nwiCC57hw0GeXXWwgruFAA/oNPqQNMC6L90PsWxGcGOvz2D0hn/qL0HD7HuBY745H\n+OLNZxzgVpzhnzxp9weltd9V1fdwTLNGRYbC4L8FohaCdGhZp3Rb0j5E+J6Bh0Kx\nR0KMmgdhdtmv+l3u8cecV+KABfMdBgwRpNMW7Is3ROLwjtnaN+H817QhLTcoAgMm\nfTc08DjTeY/JoRZEtNxI/u7Q82CG8z5WTGl9f1upmNBNzjSkGWNgSODSoBf3AYLh\nrB8QsGtAopJbn9mcHvZlT7hNkFqw2pSxb132vnWjoQKBgQDlxb++sVi7VTdl3zQs\nyVazfv9gJzt7XAenIABkd1F8suqr1Ecj3H59sqzmSVdbs9+PCzm/d7vY4mx5Ybjm\nundNe2WwkCFCGnz3NCxW/ifNV58G1IkZ0kTCUi225Rec9bFkh3G8bexIk4O4O6Fo\nse6raeTaN/GjJbul8AB3yKVsewKBgQDBKDZnMiV2QPfcG5xrG0ajTyr4wVvMEoKo\nSYBVu/exqAnP06fb0xvmY2AqWz46Dmyw49MyNS875zacaSQXM2PJlcjYINbfC8gP\nZicTq1kdfVXObgx/bm3Xb7MbGT7/XS44sXzAOUXAuBBbslQWwD5g4oM3WvebvkJt\nF3sYtEuvrQKBgQDheyqMfsr9o0Wm8d/op3gu00zW1gk4KHrWFcBs1u6feZBzKPDb\nD1EOFx43KvfQZPbZEAIOk/hCgQhEIZLq0UesQJDtMLOChC3oBUoR4H28s+S6Ni2I\nqmCRdUWpOq3ueOkpJwWFDTYXjrNvQw1FiX8WtedAAjBdkvTPhXNgGQXFKwKBgFfB\nfE4QQ2Lhi3qt9LfYsZQasMxJlPo3YrMwiaTp/FPzo1mPsNC3rhJTDerQf4oC6bDI\nITjLXwVZO79+KU59I5X/fjtrWBQIF0GfyJswGxHB0s0xxG3U7wSVFAt4wd1lKU3K\nnYH7w0wWlCAE+h1IBE8iOjlZE+vnWeiUZXHI4CYVAoGACMFN/x0X9BO0lxoIyYVH\ns9lA6TbJIqRG9ahBfsXUmA3qgzJybK33thPp+RRtvh34qLHO3MiPI0G9+9hzWLQH\ndEKO8mtpJiAcYlQ/cLYDHTbp5Di5ASFH0Noewqy6AK7TLyCJj6CBVdQAu5m4IEr9\nS4CctYNW0+0rrp0cq62TG7Y=\n-----END PRIVATE KEY-----\n",
    "client_email"=> "nuocmiasaigon-fc089@appspot.gserviceaccount.com",
    "client_id"=> "112802856677128659459",
    "auth_uri"=> "https://accounts.google.com/o/oauth2/auth",
    "token_uri"=>"https://oauth2.googleapis.com/token",
    "auth_provider_x509_cert_url"=> "https://www.googleapis.com/oauth2/v1/certs",
    "client_x509_cert_url"=> "https://www.googleapis.com/robot/v1/metadata/x509/nuocmiasaigon-fc089%40appspot.gserviceaccount.com",
    "api_key"=> "AIzaSyDnRh_oMqOjCUBzbkz7piCzzazA2IadUzE",
    "auth_domain"=> "nuocmiasaigon-fc089.firebaseapp.com",
    "storage_bucket"=> "nuocmiasaigon-fc089.appspot.com",
    "messaging_sender_id"=> "524071043855",
    "app_id"=> "1:524071043855:web:1ae39a8183cc94b85ef47a"
],
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

];
