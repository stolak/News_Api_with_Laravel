<?php

namespace App\Http\Traits;
use App\Models\Article;
use App\Http\Traits\ConvertHelperTrait;
use Illuminate\Support\Facades\Http;


trait ArticleTrait
{
    use ConvertHelperTrait;
    public function storeArticle($rec)
    {


        foreach($this->objectToArray($rec) as  $val){
            Article::create($val);
        }

    }





}
