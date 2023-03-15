<?php
namespace App\Services;



use App\Models\Order;
use App\Models\Orderline;
use App\Models\Product;
use App\Services\Campaign\CampaignFactory;

class OrderService
{
    protected $product;
    public function __construct(Product $product)
    {
        $this->product = $product;
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
        }

    }

}
