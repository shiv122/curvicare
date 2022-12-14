<?php

namespace App\Http\Resources\Misc;

use App\Http\Resources\TagResource;
use Illuminate\Http\Resources\Json\JsonResource;

class BlogResource extends JsonResource
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
            'created_at' => $this->created_at,
            'tags' => TagResource::collection($this->whenLoaded('direct_tags')),
            'images' => $this->whenLoaded('images', function () {
                return $this->images->map(function ($image) {
                    return [
                        'image' => $image->image,
                    ];
                });
            }),
            'dietician' => $this->whenLoaded('dietician'),
            'is_featured' => $this->is_featured,
            'is_paid' => $this->is_paid,
        ];
    }
}
