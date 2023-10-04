## Installation

Clone the repository

    git clone https://github.com/stolak/News_Api_with_Laravel.git

Switch to the repo folder

    cd News_Api_with_Laravel

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env
    php artisan key:generate
    php artisan serve

If you are working locally and you encounter the error below which is due to the ssl/ issuer certificate 

    cURL error 60: SSL certificate problem: unable to get local issuer certificate (see https://curl.haxx.se/libcurl/c/libcurl-errors.html) for https://yh-finance.p.rapidapi.com/stock/v3/get-historical-data?symbol=AAWW&verify=0

You need to edit the following file in vendor/guzzlehttp/guzzle/src/Client.php

    $defaults = [
    'allow_redirects' => RedirectMiddleware: :$defaultSettings,
    'http_errors'     => true,
    'decode_content'  => true,
    'verify'          => true, //  TO BE REPLACED by false
    'cookies'         => false
    ];

Change it to:

    $defaults = [
    'allow_redirects' => RedirectMiddleware: :$defaultSettings,
    'http_errors'     => true,
    'decode_content'  => true,
    'verify'          => false,
    'cookies'         => false
    ];

To Run test

    php artisan test


