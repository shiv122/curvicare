<?php

namespace App\Http\Resources\Chat;

use App\Http\Resources\DieticianResource;
use App\Http\Resources\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ChatResources extends JsonResource
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
            'dietician' => new DieticianResource($this->whenLoaded('dietician')),
            'user' => new UserResource($this->whenLoaded('user')),
            'messages' => MessageResources::collection($this->whenLoaded('messages')),
            'created_at' => $this->created_at,
        ];
    }
}
