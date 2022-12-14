<?php

namespace App\Http\Resources\Misc;

use Illuminate\Http\Resources\Json\JsonResource;

class FaqResource extends JsonResource
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
            'question' => $this->question,
            'answer' => $this->answer,
            'faq_category' => new FaqCategoryResource($this->whenLoaded('faq_category')),
            'is_paid' => $this->is_paid,
            'is_featured' => $this->is_featured,
        ];
    }
}
