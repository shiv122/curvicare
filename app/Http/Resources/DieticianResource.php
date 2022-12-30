<?php

namespace App\Http\Resources;

use App\Http\Resources\Misc\ExpertiseResource;
use Illuminate\Http\Resources\Json\JsonResource;

class DieticianResource extends JsonResource
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
            'image' => $this->image,
            'expertise' => ExpertiseResource::collection($this->whenLoaded('direct_expertise')),
        ];
    }
}
