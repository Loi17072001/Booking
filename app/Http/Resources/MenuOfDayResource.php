<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class MenuOfDayResource extends JsonResource
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
            'date' => $this->date,
            'product_id' => $this->product_id,
            'price' => $this->price,
            'price_discount' => $this->price_discount,
            'qty' => $this->qty,
            'product' => $this->product,
            'description' => $this->description,
            'group' => $this->group,
        ];
    }
}
