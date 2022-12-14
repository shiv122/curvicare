<?php

namespace App\Http\Resources\Package;

use Illuminate\Http\Resources\Json\JsonResource;

class PackagePriceResource extends JsonResource
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
            'currency' => $this->currency,
            'price' => $this->price,
        ];
    }
}
