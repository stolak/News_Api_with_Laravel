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
        foreach($this->objectToArray( $category) as  $val){
            Category::updateOrCreate($val,[]);
        }
        return;
    }
    public function update_author_list()
    {
        $author = Article::groupBy('author')->select('author')->get();
        foreach($this->objectToArray( $author) as  $val){
            Author::updateOrCreate($val,[]);
        }
        return;
    }
    public function updateSourceList()
    {
        $source = Article::groupBy('source')->select('source')->get();
        foreach($this->objectToArray( $source) as  $val){
            Source::updateOrCreate($val,[]);
        }
        return;
    }

    public function isUpdateble()
    {
        $last = ArticleTimer::latest('last_run')->first()->last_run?? '1900-01-01 00:00:00';
        $from_time = strtotime( $last);
        $to_time = strtotime(now());
        $diff_minutes = round(abs($from_time - $to_time) / 60);
        return ($diff_minutes > env('API_NEW_INTERVAL'));
    }

    public function updateTimer()
    {
         ArticleTimer::create(['last_run'=>now()]);
        return;
    }


    public function createNewsFromApis()
    {

        if($this->isUpdateble()){
        $news_apiorg = NewsAPIOrgResource::collection(NewsApiOrgTrait::news());
        $news_guardian = GaurdianAPIResource::collection(GuardianTrait::news());
        $newsapi = NewsAPIResource::collection(NewsApiTrait::news());
        $this->storeArticle($news_apiorg);
        $this->storeArticle($news_guardian);
        $this->storeArticle($newsapi);

        $this->update_category_list();
        $this->updateSourceList();
        $this->update_author_list();
        $this->updateTimer();
        }
        return;
    }


}
