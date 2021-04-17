<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Sites
    |--------------------------------------------------------------------------
    |
    | Each site should have root URL that is either relative or absolute. Sites
    | are typically used for localization (eg. English/French) but may also
    | be used for related content (eg. different franchise locations).
    |
    */

    'sites' => [

        // Newest version should be first in the array
        'v2.3' => [
            'name' => 'v2.3',
            'locale' => 'en_US',
            'url' => '/v2.3/',
        ],

        'v2.2' => [
            'name' => 'v2.2',
            'locale' => 'en_US',
            'url' => '/v2.2/',
        ],

        'v2.1' => [
            'name' => 'v2.1',
            'locale' => 'en_US',
            'url' => '/v2.1/',
        ],

        'v2.0' => [
            'name' => 'v2.0',
            'locale' => 'en_US',
            'url' => '/v2.0/',
        ],

        'marketing' => [
            'name' => 'Marketing',
            'locale' => 'en_US',
            'url' => '/',
        ],

    ],
];
