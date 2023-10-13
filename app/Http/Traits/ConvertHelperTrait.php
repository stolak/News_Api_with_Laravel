<?php

namespace App\Http\Traits;

trait ConvertHelperTrait
{

    public static function  objectToArray($val)
    {
        return json_decode(json_encode($val),true);
    }





}
