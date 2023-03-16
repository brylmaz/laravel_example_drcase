<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = Storage::disk('local')->get('/json/products.json');
        $Categories = json_decode($json,true);

        foreach ($Categories as $Category){
            if (Category::where('id', $Category['category_id'] )->exists()) {

            }
            else{
                Category::query()->updateOrCreate([
                    'id' => $Category['category_id'],
                    'name' =>$Category['category_title']
                ]);
            }
        }
    }
}
