<?php

// config for Bakr/LocalizedEnum
return [

    /*
     * The request header used to detect the locale for enum labels.
     * Override per-enum by overriding getLocaleHeaderKey() on the enum itself.
     */
    'header_key' => env('LOCALIZED_ENUM_HEADER_KEY', 'X-Locale'),

    /*
     * Restrict which locales the header value is allowed to select, e.g. ['en', 'ar'].
     * Leave as null/empty to trust any value sent by the client (falls back to
     * config('app.locale') whenever the header is absent).
     */
    'available_locales' => null,

];
