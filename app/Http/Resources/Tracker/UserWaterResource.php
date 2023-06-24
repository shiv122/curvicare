<?php

namespace App\Http\Resources\Tracker;

use App\Http\Resources\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class UserWaterResource extends JsonResource
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
            'water_amount' => $this->water_amount,
            'created_at' => $this->created_at,
        ];
    }
}
