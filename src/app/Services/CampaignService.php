<?php
namespace App\Services;



use App\Exceptions\ProductStockException;
use App\Http\Resources\CampaignResource;
use App\Models\Campaign;
use Illuminate\Support\Facades\Cache;

class CampaignService
{
    protected $campaign;
    public function __construct(Campaign $campaign)
    {
        $this->campaign = $campaign;
    }

    public static function ListAll(){

        return CampaignResource::collection(Campaign::allByCache());

    }
    public static function UpdateAll($data){

        foreach ($data as $key => $row){

            $campain = Campaign::where('type',$key)
                        ->update([
                            "name" => $row['name'],
                            "type" => $key,
                            "rule" => json_encode($row['rule']),
                            "discount" => $row['discount']
                        ]);

        }
        Cache::forget('campaigns');

        try {
            return true;
        }
        catch (\Error $error){
            return false;
        }





    }
}
