<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'images' => $this->images,
            'name' => $this->name,
            'price' => $this->price,
            'price_discount' => $this->price_discount,
            'group' => $this->group,
            'groupData'=> $this->groupData,
            'description' => $this->description,
        ];
    }
}
