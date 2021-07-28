<?php

declare(strict_types=1);

return [
    /*
     * ------------------------------------------------------------------------
     * Default Firebase project
     * ------------------------------------------------------------------------
     */
    'default' => env('FIREBASE_PROJECT', 'app'),

    /*
     * ------------------------------------------------------------------------
     * Firebase project configurations
     * ------------------------------------------------------------------------
     */
    'projects' => [
        'app' => [
            /*
             * ------------------------------------------------------------------------
             * Credentials / Service Account
             * ------------------------------------------------------------------------
             *
             * In order to access a Firebase project and its related services using a
             * server SDK, requests must be authenticated. For server-to-server
             * communication this is done with a Service Account.
             *
             * If you don't already have generated a Service Account, you can do so by
             * following the instructions from the official documentation pages at
             *
             * https://firebase.google.com/docs/admin/setup#initialize_the_sdk
             *
             * Once you have downloaded the Service Account JSON file, you can use it
             * to configure the package.
             *
             * If you don't provide credentials, the Firebase Admin SDK will try to
             * auto-discover them
             *
             * - by checking the environment variable FIREBASE_CREDENTIALS
             * - by checking the environment variable GOOGLE_APPLICATION_CREDENTIALS
             * - by trying to find Google's well known file
             * - by checking if the application is running on GCE/GCP
             *
             * If no credentials file can be found, an exception will be thrown the
             * first time you try to access a component of the Firebase Admin SDK.
             *
             */
            'credentials' => [
                'file' => env('FIREBASE_CREDENTIALS', env('GOOGLE_APPLICATION_CREDENTIALS')),
                "type" => "service_account",
                "project_id" => "nuocmiasaigon-fc089",
                "private_key_id" => "3aae871089f6b2adc522a8291acd628f4646fb43",
                "private_key" => "-----BEGIN PRIVATE KEY-----\nMIIEvQIBADANBgkqhkiG9w0BAQEFAASCBKcwggSjAgEAAoIBAQCtXi1JD4Q5ZgHH\n9Lj2gLm61N9sP8vTZgVF0/QgjqUD2k9ilK764EGbc6yijDxDWif48/2ms4yqX044\nDb5ix7x/aFXLYWq6W+Sbd+mSEaiuQeQa9TmrKOqS/iQwKSkV+3HhTBdT+MqqXY6O\n6GeaKAV7rJ1tWRn7f7blFC5/jZifMAzv0qNzNJ3kHuZrhbwQYXa4X1gUCr/r9CDn\nlJeHzdg7ysFhXk/FL5IxnKVW91CAAuKwROyOE3+R4xfeOXq/3LKjb2u8ad+9AKHQ\ngbQVbDu2SjiSsuoy6mPrCOOzBjjXHZVdp9qSTGlZ+ZX6EouIBtaJzLBDlz90R/hc\nkGDw+2QfAgMBAAECggEAD/I1oB65Pr5PM6Ei0imM685grog/qzYbDg0sy0HTk8Mk\nwiCC57hw0GeXXWwgruFAA/oNPqQNMC6L90PsWxGcGOvz2D0hn/qL0HD7HuBY745H\n+OLNZxzgVpzhnzxp9weltd9V1fdwTLNGRYbC4L8FohaCdGhZp3Rb0j5E+J6Bh0Kx\nR0KMmgdhdtmv+l3u8cecV+KABfMdBgwRpNMW7Is3ROLwjtnaN+H817QhLTcoAgMm\nfTc08DjTeY/JoRZEtNxI/u7Q82CG8z5WTGl9f1upmNBNzjSkGWNgSODSoBf3AYLh\nrB8QsGtAopJbn9mcHvZlT7hNkFqw2pSxb132vnWjoQKBgQDlxb++sVi7VTdl3zQs\nyVazfv9gJzt7XAenIABkd1F8suqr1Ecj3H59sqzmSVdbs9+PCzm/d7vY4mx5Ybjm\nundNe2WwkCFCGnz3NCxW/ifNV58G1IkZ0kTCUi225Rec9bFkh3G8bexIk4O4O6Fo\nse6raeTaN/GjJbul8AB3yKVsewKBgQDBKDZnMiV2QPfcG5xrG0ajTyr4wVvMEoKo\nSYBVu/exqAnP06fb0xvmY2AqWz46Dmyw49MyNS875zacaSQXM2PJlcjYINbfC8gP\nZicTq1kdfVXObgx/bm3Xb7MbGT7/XS44sXzAOUXAuBBbslQWwD5g4oM3WvebvkJt\nF3sYtEuvrQKBgQDheyqMfsr9o0Wm8d/op3gu00zW1gk4KHrWFcBs1u6feZBzKPDb\nD1EOFx43KvfQZPbZEAIOk/hCgQhEIZLq0UesQJDtMLOChC3oBUoR4H28s+S6Ni2I\nqmCRdUWpOq3ueOkpJwWFDTYXjrNvQw1FiX8WtedAAjBdkvTPhXNgGQXFKwKBgFfB\nfE4QQ2Lhi3qt9LfYsZQasMxJlPo3YrMwiaTp/FPzo1mPsNC3rhJTDerQf4oC6bDI\nITjLXwVZO79+KU59I5X/fjtrWBQIF0GfyJswGxHB0s0xxG3U7wSVFAt4wd1lKU3K\nnYH7w0wWlCAE+h1IBE8iOjlZE+vnWeiUZXHI4CYVAoGACMFN/x0X9BO0lxoIyYVH\ns9lA6TbJIqRG9ahBfsXUmA3qgzJybK33thPp+RRtvh34qLHO3MiPI0G9+9hzWLQH\ndEKO8mtpJiAcYlQ/cLYDHTbp5Di5ASFH0Noewqy6AK7TLyCJj6CBVdQAu5m4IEr9\nS4CctYNW0+0rrp0cq62TG7Y=\n-----END PRIVATE KEY-----\n",
                "client_email" => "nuocmiasaigon-fc089@appspot.gserviceaccount.com",
                "client_id" => "112802856677128659459",
                "auth_uri" => "https://accounts.google.com/o/oauth2/auth",
                "token_uri" => "https://oauth2.googleapis.com/token",
                "auth_provider_x509_cert_url" => "https://www.googleapis.com/oauth2/v1/certs",
                "client_x509_cert_url" => "https://www.googleapis.com/robot/v1/metadata/x509/nuocmiasaigon-fc089%40appspot.gserviceaccount.com",
                "api_key" => "AIzaSyDnRh_oMqOjCUBzbkz7piCzzazA2IadUzE",
                "auth_domain" => "nuocmiasaigon-fc089.firebaseapp.com",
                "storage_bucket" => "nuocmiasaigon-fc089.appspot.com",
                "messaging_sender_id" => "524071043855",
                "app_id" => "1:524071043855:web:1ae39a8183cc94b85ef47a",

                /*
                 * If you want to prevent the auto discovery of credentials, set the
                 * following parameter to false. If you disable it, you must
                 * provide a credentials file.
                 */
                'auto_discovery' => true,
            ],

            /*
             * ------------------------------------------------------------------------
             * Firebase Auth Component
             * ------------------------------------------------------------------------
             */

            'auth' => [
                'tenant_id' => env('FIREBASE_AUTH_TENANT_ID'),
            ],

            /*
             * ------------------------------------------------------------------------
             * Firebase Realtime Database
             * ------------------------------------------------------------------------
             */

            'database' => [
                /*
                 * In most of the cases the project ID defined in the credentials file
                 * determines the URL of your project's Realtime Database. If the
                 * connection to the Realtime Database fails, you can override
                 * its URL with the value you see at
                 *
                 * https://console.firebase.google.com/u/1/project/_/database
                 *
                 * Please make sure that you use a full URL like, for example,
                 * https://my-project-id.firebaseio.com
                 */
                'url' => env('FIREBASE_DATABASE_URL'),
            ],

            'dynamic_links' => [
                /*
                 * Dynamic links can be built with any URL prefix registered on
                 *
                 * https://console.firebase.google.com/u/1/project/_/durablelinks/links/
                 *
                 * You can define one of those domains as the default for new Dynamic
                 * Links created within your project.
                 *
                 * The value must be a valid domain, for example,
                 * https://example.page.link
                 */
                'default_domain' => env('FIREBASE_DYNAMIC_LINKS_DEFAULT_DOMAIN'),
            ],

            /*
             * ------------------------------------------------------------------------
             * Firebase Cloud Storage
             * ------------------------------------------------------------------------
             */

            'storage' => [
                /*
                 * Your project's default storage bucket usually uses the project ID
                 * as its name. If you have multiple storage buckets and want to
                 * use another one as the default for your application, you can
                 * override it here.
                 */

                'default_bucket' => env('FIREBASE_STORAGE_DEFAULT_BUCKET'),
            ],

            /*
             * ------------------------------------------------------------------------
             * Caching
             * ------------------------------------------------------------------------
             *
             * The Firebase Admin SDK can cache some data returned from the Firebase
             * API, for example Google's public keys used to verify ID tokens.
             *
             */

            'cache_store' => env('FIREBASE_CACHE_STORE', 'file'),

            /*
             * ------------------------------------------------------------------------
             * Logging
             * ------------------------------------------------------------------------
             *
             * Enable logging of HTTP interaction for insights and/or debugging.
             *
             * Log channels are defined in config/logging.php
             *
             * Successful HTTP messages are logged with the log level 'info'.
             * Failed HTTP messages are logged with the the log level 'notice'.
             *
             * Note: Using the same channel for simple and debug logs will result in
             * two entries per request and response.
             */

            'logging' => [
                'http_log_channel' => env('FIREBASE_HTTP_LOG_CHANNEL'),
                'http_debug_log_channel' => env('FIREBASE_HTTP_DEBUG_LOG_CHANNEL'),
            ],

            /*
             * ------------------------------------------------------------------------
             * HTTP Client Options
             * ------------------------------------------------------------------------
             *
             * Behavior of the HTTP Client performing the API requests
             */
            'http_client_options' => [
                /*
                 * Use a proxy that all API requests should be passed through.
                 * (default: none)
                 */
                'proxy' => env('FIREBASE_HTTP_CLIENT_PROXY'),

                /*
                 * Set the maximum amount of seconds (float) that can pass before
                 * a request is considered timed out
                 * (default: indefinitely)
                 */
                'timeout' => env('FIREBASE_HTTP_CLIENT_TIMEOUT'),
            ],

            /*
             * ------------------------------------------------------------------------
             * Debug (deprecated)
             * ------------------------------------------------------------------------
             *
             * Enable debugging of HTTP requests made directly from the SDK.
             */
            'debug' => env('FIREBASE_ENABLE_DEBUG', false),
        ],
    ],
];
