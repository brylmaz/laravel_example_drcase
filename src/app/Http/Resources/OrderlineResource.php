<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderlineResource extends JsonResource
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
            "product_id"=> $this->product_id,
            "price" => $this->price,
            "piece" => $this->piece,
            "product" => [
                "title" => $this->product->title,
                "list_price" => $this->product->list_price,
                "stock_quantity" => $this->product->stock_quantity,
                "CategoryName" =>$this->product->categories->name,
                "AuthorName" =>$this->product->authors->name,
                "AuthorType" =>$this->product->authors->AuthorType,
            ],
        ];
    }
}
