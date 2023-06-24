<?php

namespace App\Http\Resources;

use App\Services\Editor\EditorHtmlParser;
use Illuminate\Http\Resources\Json\JsonResource;

class RecipeResource extends JsonResource
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
            'name' => $this->name,
            'recipe_html' => $this->recipe_html,
            'caution' => $this->caution,
            'image' => $this->image,
            'is_paid' => $this->is_paid,
            'foods' => FoodResource::collection($this->whenLoaded('foods')),
            'compositions' => CompositionResource::collection($this->whenLoaded('compositions')),
            'tags' => TagResource::collection($this->whenLoaded('tags')),
            'for' => $this->whenLoaded('pivot', function () {
                return $this->pivot->for;
            }),
            'day' => $this->whenLoaded('pivot', function () {
                return $this->pivot->day;
            }),
        ];
    }
}
