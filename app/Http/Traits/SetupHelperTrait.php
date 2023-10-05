<?php

namespace App\Http\Traits;

use App\Models\Author;
use App\Models\Article;
use App\Models\Source;
use App\Models\Category;
use App\Http\Traits\ConvertHelperTrait;

trait SetupHelperTrait
{

    public function update_category_list()
    {
        $category = Article::groupBy('category')->select('category')->get();
        foreach($this->object_to_array( $category) as  $val){
            Category::updateOrCreate($val,[]);
        }
        return;
    }
    public function update_author_list()
    {
        $author = Article::groupBy('author')->select('author')->get();
        foreach($this->object_to_array( $author) as  $val){
            Author::updateOrCreate($val,[]);
        }
        return;
    }
    public function update_source_list()
    {
        $source = Article::groupBy('source')->select('source')->get();
        foreach($this->object_to_array( $source) as  $val){
            Source::updateOrCreate($val,[]);
        }
        return;
    }





}
