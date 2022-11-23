<?php

namespace App\Http\Resources\Tracker;

use Illuminate\Http\Resources\Json\JsonResource;

class UserMoodResource extends JsonResource
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
            'mood' => $this->whenLoaded('mood', function () {
                return $this->mood->name;
            }),
            'created_at' => $this->created_at,
        ];
    }
}
