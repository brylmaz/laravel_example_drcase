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
            try {
                $class = '\App\Services\Campaign\Campaigns\\'.$campaign->type;
                $campaignObject = new $class();
                $tempOrder = $campaignObject->calculate($products,$campaign->rule);
            }catch (\Error $error){
                continue;
            }

            //TODO:: ilk önce temp order'a at eğer total price discountedOrderdeki total_priceden kücükse veya discountedOrder boşsa discountedOrder'a at
        }
        return $discountedOrder;
    }

}
