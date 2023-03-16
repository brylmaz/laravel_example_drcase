<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            "order_number" => $this->order_number,
            "total_price"=> $this->total_price,
            "discount_amount"=> $this->discount_amount,
            "amount_to_be_paid"=> $this->amount_to_be_paid,
            "campain_info"=> $this->campain_info,
            "created_at"=> $this->created_at,
            "order_line" => OrderlineResource::collection($this->orderline),
        ];
    }
}
