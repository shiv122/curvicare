<?php

namespace App\Http\Resources\Support;

use App\Http\Resources\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class SupportChatResource extends JsonResource
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
            'user' => new UserResource($this->whenLoaded('user')),
            'file' => $this->file,
            'from' => $this->from,
            'read_by_admin' => $this->read_by_admin,
            'read_by_user' => $this->read_by_user,
            'created_at' => $this->created_at,
        ];
    }
}
