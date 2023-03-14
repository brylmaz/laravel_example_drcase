<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderCreateRequest;
use App\Jobs\createOrder;
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
    public function index(OrderCreateRequest $request){

        ProductService::CheckStock($request->all());



        $orderNumber = rand();
        $data = array(
            'orderNumber' => $orderNumber,
            'data' => $request->all()
        );
        //OrderService::addOrder($data);
        createOrder::dispatch($data);
        //Artisan::call('queue:work --queue=high,createOrder');
        return response()->json(['success' => 'TRUE', 'Sipariş Numarası' => $orderNumber,'message'=>'Siparişiniz işleme alınmıştır.']);
    }
}
