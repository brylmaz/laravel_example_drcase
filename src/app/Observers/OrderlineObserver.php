<?php

namespace App\Observers;

use App\Models\Orderline;
use Illuminate\Support\Facades\Cache;

class OrderlineObserver
{
    /**
     * Handle the Orderline "created" event.
     *
     * @param  \App\Models\Orderline  $orderline
     * @return void
     */
    public function created(Orderline $orderline)
    {
        Cache::flush();
    }

    /**
     * Handle the Orderline "updated" event.
     *
     * @param  \App\Models\Orderline  $orderline
     * @return void
     */
    public function updated(Orderline $orderline)
    {
        Cache::flush();
    }

    /**
     * Handle the Orderline "deleted" event.
     *
     * @param  \App\Models\Orderline  $orderline
     * @return void
     */
    public function deleted(Orderline $orderline)
    {
        Cache::flush();
    }

    /**
     * Handle the Orderline "restored" event.
     *
     * @param  \App\Models\Orderline  $orderline
     * @return void
     */
    public function restored(Orderline $orderline)
    {
        //
    }

    /**
     * Handle the Orderline "force deleted" event.
     *
     * @param  \App\Models\Orderline  $orderline
     * @return void
     */
    public function forceDeleted(Orderline $orderline)
    {
        //
    }
}
