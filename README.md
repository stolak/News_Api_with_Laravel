## Installation

Clone the repository

    git clone https://github.com/stolak/News_Api_with_Laravel.git

Switch to the repo folder

    cd News_Api_with_Laravel
    cp .env.example .env
Edit the neccessary variables

Using docker image 

    docker-compose up -d
    docker-compose exec web php artisan migrate
    docker-compose exec web cp Client.example vendor/guzzlehttp/guzzle/src/Client.php
    docker-compose exec web php artisan key:generate
    docker-compose exec web php artisan serve --host=0.0.0.0

The application should be running on http://localhost. 


Running on application without using docker
    composer install
    cp Client.example vendor/guzzlehttp/guzzle/src/Client.php
    php artisan key:generate
    php artisan migrate
    php artisan serve

Note that  the below command is neccessary in order to avoid the error below which is due to the ssl/ issuer certificate

    cp Client.example vendor/guzzlehttp/guzzle/src/Client.php

    cURL error 60: SSL certificate problem: unable to get local issuer certificate (see https://curl.haxx.se/libcurl/c/libcurl-errors.html) for ...

    cp Client.example vendor/guzzlehttp/guzzle/src/Client.php

The above command will edit the following file in vendor/guzzlehttp/guzzle/src/Client.php

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



To Run test

    php artisan test


