<?php

/*
 * You can place your custom package configuration in here.
 */
return [
    'accessToken' => env('CLICKSIGN_ACCESS_TOKEN'),
    'urlVersion' => env('CLICKSIGN_URL_VERSION', '/api/v1/documents?access_token='),
    'urlBase' => env('CLICKSIGN_DEV_MODE', true) ? env('CLICKSIGN_DEV_URL', 'https://sandbox.clicksign.com') : env('CLICKSIGN_PROD_URL', 'https://app.clicksign.com'),
];
