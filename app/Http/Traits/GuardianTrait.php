<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Http;

trait GuardianTrait
{

    // public static function news2()
    public static function news()
    {
        try {
            $response = Http::get('https://content.guardianapis.com/search', [
                'api-key' => env('GAURDIAN_NEWS_KEY')]);
            return  json_decode($response, true)['response']['results'] ;
          }
          //catch exception
          catch(Exception $e) {
            return  [];
          }
        
    }





}
