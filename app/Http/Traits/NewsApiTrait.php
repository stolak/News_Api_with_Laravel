<?php

namespace App\Http\Traits;

use Exception;

trait NewsApiTrait
{

    public static function news()
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'http://eventregistry.org/api/v1/article/getArticles',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
          CURLOPT_POSTFIELDS =>'{
          "action": "getArticles",
          "keyword": "Barack Obama",
          "articlesPage": 1,
          "articlesCount": 2,
          "articlesSortBy": "date",
          "articlesSortByAsc": false,
          "articlesArticleBodyLen": -1,
          "resultType": "articles",
          "dataType": [
            "news",
            "pr"
          ],
          "apiKey": "'.env('NEWSAPI_KEY').'",
          "forceMaxDataTimeWindow": 31
        }',
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
          ),
        ));


        try {
          $response = curl_exec($curl);
          curl_close($curl);
          return  json_decode($response, true)['articles']['results'];
        }
        //catch exception
        catch(Exception $e) {
          return  [];
        }
    }





}
