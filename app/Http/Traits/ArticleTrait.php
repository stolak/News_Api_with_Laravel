<?php

namespace App\Http\Traits;
use App\Models\Article;
use App\Http\Traits\ConvertHelperTrait;
use Illuminate\Support\Facades\Http;


trait ArticleTrait
{
    use ConvertHelperTrait;
    public function store_article($rec)
    {
        
        
        foreach($this->object_to_array($rec) as  $val){
            Article::create($val);
        }
        
    }





}
