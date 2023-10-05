<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Http;

trait ConvertHelperTrait
{

    public static function object_to_array($val)
    {
        return json_decode(json_encode($val),true);
    }





}
