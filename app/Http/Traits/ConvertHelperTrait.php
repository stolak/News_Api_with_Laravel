<?php

namespace App\Http\Traits;

trait ConvertHelperTrait
{

    public static function  object_to_array($val)
    {
        return json_decode(json_encode($val),true);
    }





}
