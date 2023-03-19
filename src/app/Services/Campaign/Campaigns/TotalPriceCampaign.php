<?php

namespace App\Services\Campaign\Campaigns;

use App\Models\Product;

class TotalPriceCampaign
{
    public function calculate($products=[],$campaign=[]){


        $total_price = 0;
        $discount_amount = 0;



        $rule = json_decode($campaign->rule,true);
        foreach ($products['data'] as $orderProduct){
            $product = Product::findByCache($orderProduct['product_id']);
            $total_price += ($product->list_price * $orderProduct['piece']);
        }

        if($total_price >= $rule['total_price']){
            $discount_amount += ($product->list_price * $campaign->discount) / 100;
        }
        $amount_to_be_paid = $total_price - $discount_amount;

        $response = array(
            'total_price' => $total_price,
            'discount_amount' => $discount_amount,
            'campain_info' => $campaign->name,
            'amount_to_be_paid' => $amount_to_be_paid
        );

        return $response;

    }

}
