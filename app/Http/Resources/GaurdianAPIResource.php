<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GaurdianAPIResource extends JsonResource
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
            'title' => $this['webTitle'],
            'body' => $this['webTitle'],
            'author' => 'Unknown', //$this['author'],
            'category' => $this['pillarName'], //$this['category'],
            'publish_date' => $this['webPublicationDate'],
            'source' => 'The Guardian',
            'url' => $this['webUrl'],
        ];
    }
}
