<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NewsAPIOrgResource extends JsonResource
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
            'body' => $this['content']?$this['content']:$this['title'],
            'author' => $this['author']?$this['author']:'Unknown',
            'category' => 'News',
            'publish_date' => $this['publishedAt'],
            'source' => $this['source']['name'],
            'url' => $this['url'],
        ];
    }
}
