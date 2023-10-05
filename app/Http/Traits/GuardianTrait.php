<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Http;

trait GuardianTrait
{

    // public static function news2()
    public static function news()
    {
        $response = Http::get('https://content.guardianapis.com/search', [
            'api-key' => '468d5695-49f5-4f3d-81a5-825c4f1f02b8']);
        return  json_decode($response, true)['response']['results'] ;
    }





}
