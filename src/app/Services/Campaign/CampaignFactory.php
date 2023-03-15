<?php

namespace App\Services\Campaign;

use App\Models\Campaign;

class CampaignFactory
{
    public static function make($products=[]){
        $campaigns = Campaign::allByCache();
        $discountedOrder = [];
        $tempOrder = [];
        foreach ($campaigns as $campaign){
            $class = '\App\Services\Campaign\Campaigns\\'.$campaign->type;
            $campaignObject = new $class();
            $tempOrder = $campaignObject->calculate($products,$campaign);
//            try {
//
//
//            }catch (\Error $error){
//                continue;
//            }
            if(empty($discountedOrder)){
                $discountedOrder = $tempOrder;
            }
            elseif ($tempOrder['discount_amount'] > $discountedOrder['discount_amount']){
                $discountedOrder = $tempOrder;
            }

        }

        if($discountedOrder['discount_amount']==0){
            $response = array(
                'total_price' => $discountedOrder['total_price'],
                'discount_amount' => $discountedOrder['discount_amount'],
                'campain_info' => "Herhangi bir Kampanyadan Yararlanmıyor.",
                'amount_to_be_paid' => $discountedOrder['amount_to_be_paid'],
            );
            $discountedOrder = $response;
        }

        return $discountedOrder;
    }

}
