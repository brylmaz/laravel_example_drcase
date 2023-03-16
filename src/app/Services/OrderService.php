<?php
namespace App\Services;




use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\Orderline;
use App\Models\Product;
use App\Services\Campaign\CampaignFactory;
use Exception;
use Illuminate\Support\Facades\Cache;


class OrderService
{
    protected $order;
    public function __construct(Order $order)
    {
        $this->order = $order;
    }
    public static function addOrder($data){

        $discountedOrder = CampaignFactory::make($data);

        $order = new Order();
        $order->order_number=$data['orderNumber'];
        $order->total_price = $discountedOrder['total_price'];
        $order->discount_amount = $discountedOrder['discount_amount'];
        $order->campain_info = $discountedOrder['campain_info'];
        $order->amount_to_be_paid = $discountedOrder['amount_to_be_paid'];
        //$order->user_id = $data['user_id'];
        $order->save();
       foreach ($data['data'] as $key =>$orderProduct){
                $product = Product::findByCache($orderProduct['product_id']);
                $orderLine = new Orderline();
                $orderLine->order_id = $order->id;
                $orderLine->product_id  =$product->id;
                $orderLine->price  =$product->list_price;
                $orderLine->piece  =$orderProduct['piece'];
                $orderLine->save();


                    $lastProduct = Product::where('id',$product->id)
                        ->update([
                       "stock_quantity" => ($product->stock_quantity - $orderProduct['piece'])
               ]);
        }

    }

    public static function getOrder($data){
        try {
            $orderInfo = Order::findByCache($data[0]['OrderNumber']);
            $orderInfo = OrderResource::collection($orderInfo);
            $orderInfo = json_decode($orderInfo->toJson(), true);
        }
        catch (\Error $error) {
            throw new Exception("Sipariş Getirilirken Hata Oluştu.");
        }

        return $orderInfo;
    }



}
