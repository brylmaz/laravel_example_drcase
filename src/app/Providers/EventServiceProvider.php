<?php

namespace App\Providers;

use App\Jobs\createOrder;
use App\Jobs\Testrabbit;
use App\Models\Author;
use App\Models\Campaign;
use App\Models\Category;
use App\Models\Order;
use App\Models\Orderline;
use App\Models\Product;
use App\Observers\AuthorObserver;
use App\Observers\CampaignObserver;
use App\Observers\CategoryObserver;
use App\Observers\OrderlineObserver;
use App\Observers\OrderObserver;
use App\Observers\ProductObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        App::bindMethod(Testrabbit::class."@handle",fn($job)=>$job->handle());
        App::bindMethod(createOrder::class."@handle",fn($job)=>$job->handle());

        Author::observe(AuthorObserver::class);
        Campaign::observe(CampaignObserver::class);
        Category::observe(CategoryObserver::class);
        Order::observe(OrderObserver::class);
        Orderline::observe(OrderlineObserver::class);
        Product::observe(ProductObserver::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
