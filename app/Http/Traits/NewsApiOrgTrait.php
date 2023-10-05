<?php

namespace App\Http\Traits;
use Illuminate\Support\Facades\Http;
use Session;

trait NewsApiOrgTrait
{

    // public static function news3()
    public static function news()
    {
        $response = Http::get('https://newsapi.org/v2/top-headlines', [
            'apiKey' => '2439fcb8a3b748e881ad29fce96f89c4','country' => 'us']);
        return  json_decode($response, true)['articles'];
    }





}
