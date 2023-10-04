<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;
class NewsApi extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<array, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        // dd($this);
        return [
            'id' => 'hello word',
            // 'Title' => $request->title,
            // 'body' => $request->body,
        // 'name' => $this[],
            // 'email' => $this->email,
            // 'created_at' => $this->created_at,
            // 'updated_at' => $this->updated_at,
        ];
    }
}
