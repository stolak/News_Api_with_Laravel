<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NewsAPIResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'title' => $this['title'],
            'body' => $this['body'],
            'author' => 'Unknown', //$this['author'],
            'category' => $this['source']['dataType'], //$this['category'],
            'publish_date' => $this['date'],
            'source' => $this['source']['title'],
            'url' => $this['url'],
        ];
    }
}
