<?php

namespace app\Modules\Events\Providers;

use App\Models\User;
use App\Modules\Events\Observers\EventObserver;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Model;

class EventsServiceProvider extends ServiceProvider
{

    protected $observedModels = [];
    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../migrations');
        Event::listen('eloquent.*', EventObserver::class);
    }
}
