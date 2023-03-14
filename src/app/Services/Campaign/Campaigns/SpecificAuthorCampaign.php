<?php

namespace App\Services\Campaign\Campaigns;

use App\Models\Product;

class SpecificAuthorCampaign
{
    public function calculate($products=[],$rule=[]){
        print_r($products);
        foreach ($products as $orderProduct){
            $product = Product::findByCache($orderProduct['product_id']);

        }
        print_r($rule);

    }

}
