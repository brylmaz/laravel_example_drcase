<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderCreateRequest;
use App\Http\Requests\GetOrderRequest;
use App\Jobs\createOrder;
use App\Models\Order;
use App\Services\Campaign\CampaignFactory;
use App\Services\OrderService;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class OrderController extends Controller
{
    /**
     * @param Request $request
     * @return void
     */
    public function CreateOrder(OrderCreateRequest $request){

        ProductService::CheckStock($request->all());



        $orderNumber = rand();
        $data = array(
            'orderNumber' => $orderNumber,
            'data' => $request->all()
        );

        createOrder::dispatch($data);

        return response()->json(['success' => 'TRUE', 'Sipariş Numarası' => $orderNumber,'message'=>'Siparişiniz işleme alınmıştır.']);
    }

    /**
     * @param GetOrderRequest $request
     * @return void
     */
    public function GetOrder(GetOrderRequest $request){
        $getOrder=OrderService::getOrder($request->all());
        if (empty($getOrder)){
            return response()->json(['success' => 'FALSE', 'message'=>'Bu Sipariş Numarası ile bir kayıt bulunamadı.','data' => $getOrder,]);
        }
        else{
            return response()->json(['success' => 'TRUE', 'message'=>' Sipariş Bilgileri Listelenmiştir.','data' => $getOrder,]);
        }

    }
}
