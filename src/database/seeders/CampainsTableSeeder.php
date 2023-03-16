<?php

namespace Database\Seeders;

use App\Models\Campaign;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class CampainsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = Storage::disk('local')->get('/json/campaigns.json');
        $campaigns = json_decode($json,true);

        foreach ($campaigns as $key => $campaign){
                Campaign::query()->updateOrCreate([

                    'name' =>$campaign['name'],
                    'type' =>$key,
                    'rule'=>json_encode($campaign['json']),
                    'discount' => $campaign['discount']
                ]);


        }
    }
}
