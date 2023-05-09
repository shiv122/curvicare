<?php

namespace App\Http\Resources\Support;

use App\Http\Resources\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketResource extends JsonResource
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
            'ticket_no' => $this->ticket_no,
            'user' => new UserResource($this->whenLoaded('user')),
            'question' => new TicketQuestionResource($this->whenLoaded('question')),
            'description' => $this->description,
            'reply' => $this->reply,
            'status' => $this->status,
            'created_at' => $this->created_at
        ];
    }
}
