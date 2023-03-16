<?php

namespace App\Services\Campaign\Campaigns;

use App\Models\Product;

class SpecificAuthorCampaign
{
    public function calculate($products=[],$campaign=[]){

        $orderQuantityCount = 1;
        $total_price = 0;
        $lastPrice = array();
        $discount_amount = 0;
        $campain_info = "Sabahattin Ali'nin Romanlarında İndirim";
        $amount_to_be_paid = 0;

        $rule = json_decode($campaign->rule,true);
        foreach ($products['data'] as $orderProduct){
            $product = Product::findByCache($orderProduct['product_id']);


            if($product->authors->id == $rule['author_id']){

                $orderQuantityCount++;

                if($orderQuantityCount <= $rule['order_product_quantity']){

                    $lastPrice[] = $product->list_price;

                }

            }

            $total_price += ($product->list_price * $orderProduct['piece']);

        }
        rsort($lastPrice);

        foreach ($lastPrice as $key  => $value){
            if($key == $campaign->discount)
            {
                break;
            }

            $discount_amount += $value;
        }

        $amount_to_be_paid = $total_price - $discount_amount;

        $response = array(
            'total_price' => $total_price,
            'discount_amount' => $discount_amount,
            'campain_info' => $campain_info,
            'amount_to_be_paid' => $amount_to_be_paid,
        );

        return $response;

    }

}
