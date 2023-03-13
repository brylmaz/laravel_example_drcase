<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class AuthorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = Storage::disk('local')->get('/json/products.json');
        $Authors = json_decode($json,true);

        foreach ($Authors as $Author){
            if (Author::where('id', $Author['author_id'] )->exists()) {

            }
            else{
                Author::query()->updateOrCreate([
                    'id' => $Author['author_id'],
                    'name' =>$Author['author']
                ]);
            }

        }
    }
}
