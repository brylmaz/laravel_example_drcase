<?php
namespace App\Services;



use App\Exceptions\ProductStockException;
use App\Models\Product;

class ProductService
{
    protected $product;
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public static function CheckStock($data){

        foreach ($data as $key=>$value){
            $stock = Product::findByCache($value['product_id']);
            if ($stock->stock_quantity < $value['piece']){
                throw new ProductStockException($value['product_id'].' product_id li ürün için stok yetersiz');
            }
        }

    }
}
