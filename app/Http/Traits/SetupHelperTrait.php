<?php

namespace App\Http\Traits;

use App\Models\Author;
use App\Models\Article;
use App\Models\Source;
use App\Models\Category;
use App\Models\ArticleTimer;
use App\Http\Traits\ConvertHelperTrait;
use App\Http\Traits\NewsApiTrait;
use App\Http\Traits\NewsApiOrgTrait;
use App\Http\Traits\GuardianTrait;
use App\Http\Resources\GaurdianAPIResource;
use App\Http\Resources\NewsAPIResource;
use App\Http\Resources\NewsAPIOrgResource;

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

    public function is_updateble()
    {
        $last = ArticleTimer::latest('last_run')->first()->last_run?? '1900-01-01 00:00:00';
        $from_time = strtotime( $last); 
        $to_time = strtotime(now()); 
        $diff_minutes = round(abs($from_time - $to_time) / 60);
        return ($diff_minutes > env('API_NEW_INTERVAL'));
    }

    public function update_timer()
    {
         ArticleTimer::create(['last_run'=>now()]);
        return;
    }


    public function create_new_from_apis()
    {
        
        if($this->is_updateble()){
        $news_apiorg = NewsAPIOrgResource::collection(NewsApiOrgTrait::news());
        $news_guardian = GaurdianAPIResource::collection(GuardianTrait::news());
        $newsapi = NewsAPIResource::collection(NewsApiTrait::news());
        $this->store_article($news_apiorg);
        $this->store_article($news_guardian);
        $this->store_article($newsapi);

        $this->update_category_list();
        $this->update_source_list();
        $this->update_author_list();
        $this->update_timer();
        }
        return;
    }


}
