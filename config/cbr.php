<?php

use Illuminate\Support\Str;

return [

    /*
    |--------------------------------------------------------------------------
    | Host of the Central Bank
    |--------------------------------------------------------------------------
    |
    | This variable is utilized to dynamically modify the endpoint of the service, specifying the
    | host of the Central Bank. This is essential for retrieving accurate currency rate data.
    |
    */

    'host' => env('CBR_HOST'),
];
