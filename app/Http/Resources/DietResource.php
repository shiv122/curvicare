<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DietResource extends JsonResource
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
            'user' => new UserResource($this->whenLoaded('user')),
            'dietician' => new DieticianResource($this->whenLoaded('dietician')),
            'diet_template' => $this->diet,
            'date' => $this->schedule_date,
            'is_completed' => $this->is_completed,
        ];
    }
}
