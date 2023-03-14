<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Campaign extends Model
{
    use HasFactory;

    protected $table = 'campaigns';

    public static function allByCache(){
        $campaigns = Cache::get('campaigns');
        if ($campaigns == null){
            $campaigns = Campaign::all();
            Cache::put('campaigns',json_encode($campaigns));
            return $campaigns;
        }
        return json_decode($campaigns);
    }

}
