<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditCampaignRequest;
use App\Services\CampaignService;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    public function ListCampaign(){
        $response = CampaignService::ListAll();
        return response()->json(['success' => 'TRUE', 'message'=>'Listeleme Başarılı','data'=>$response]);
    }

    public function EditCampaign(EditCampaignRequest $request){
        $response = CampaignService::UpdateAll($request->all());
        if ($response){
            return response()->json(['success' => 'TRUE', 'message'=>'Güncelleme Başarılı.']);
        }
        else{
            return response()->json(['success' => 'FALSE', 'message'=>'Güncelleme Başarısız.']);
        }
    }
}
