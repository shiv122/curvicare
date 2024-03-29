<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'email' => $this->email,
            'image' => $this->image,
            'user_data' => new UserDataResource($this->whenLoaded('user_data')),
            'subscriptions' => UserSubscriptionResource::collection($this->whenLoaded('subscriptions')),
            'medical_conditions' => UserMedicalCondition::collection($this->whenLoaded('medical_conditions')),

        ];
    }
}
