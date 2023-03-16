<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = Storage::disk('local')->get('/json/products.json');
        $Products = json_decode($json,true);

        foreach ($Products as $Product){
            if (Product::where('id', $Product['product_id'] )->exists()) {

            }
            else{
                Product::query()->updateOrCreate([
                    'id' => $Product['product_id'],
                    'title' => $Product['title'],
                    'list_price' => $Product['list_price'],
                    'stock_quantity' => $Product['stock_quantity'],
                    'category_id' => $Product['category_id'],
                    'author_id' => $Product['author_id'],
                ]);
            }

        }
    }
}
