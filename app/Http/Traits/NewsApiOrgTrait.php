<?php

namespace App\Http\Traits;
use Illuminate\Support\Facades\Http;
use Session;
use Exception;

trait NewsApiOrgTrait
{

    // public static function news3()
    public static function news()
    {
        try {
            $response = Http::get('https://newsapi.org/v2/top-headlines', [
                'apiKey' => env('NEWSAPIORG_KEY'),'country' => 'us']);
            return  json_decode($response, true)['articles'];
          }
          //catch exception
          catch(Exception $e) {
            return  [];
          }

    }





}
