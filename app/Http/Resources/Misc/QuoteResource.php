<?php

namespace App\Http\Resources\Misc;

use App\Http\Resources\MoodResource;
use Illuminate\Http\Resources\Json\JsonResource;

class QuoteResource extends JsonResource
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
            'quote' => $this->quote,
            'image' => $this->image,
            'mood' => new MoodResource($this->whenLoaded('mood')),
        ];
    }
}
