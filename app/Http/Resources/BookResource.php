<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [

            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'image' => $this->photoUrl(),
            'release' => $this->release_year,
            'price' => $this->price,
            'total_page' => $this->total_page,
            'category_id' => new CategoryResource($this->category)
        ];
    }
}
