<?php

namespace App\Http\Resources\Chat;

use App\Http\Resources\DieticianResource;
use Illuminate\Http\Resources\Json\JsonResource;

class MessageResources extends JsonResource
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
            'message' => $this->message,
            'user_id' => $this->user_id,
            'dietician' => new DieticianResource($this->whenLoaded('dietician')),
            'media' => MessageMediaResources::collection($this->whenLoaded('media')),
            'reply' => new MessageResources($this->whenLoaded('reply')),
            'created_at' => $this->created_at,
        ];
    }
}
