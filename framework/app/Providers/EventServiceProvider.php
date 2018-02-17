<?php

namespace App\Providers;

use App\Activity;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        /*
        'App\Events\SomeEvent' => [
            'App\Listeners\EventListener',
        ],
        */

        'Illuminate\Auth\Events\Login' => [
            'App\Listeners\LogLastLogin',
            'App\Listeners\UpdateLastLoggedAt',
        ],

        'App\Events\Qore\ContractWasRegistered' => [
            'App\Listeners\Qore\ValidDatabase',
            'App\Listeners\Qore\ExecuteScriptOfDatabase',
        ],

        'App\Events\Qore\InvoiceWasRegistered' => [
            'App\Listeners\Qore\SendEmailInvoice',
        ],

        'App\Events\Qore\PaymentWasRegistered' => [
            'App\Listeners\Qore\SendEmailPayment',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        Event::listen('eloquent.created: *', function($model){
            Activity::record('create', $model);
        });

        Event::listen('eloquent.updated: *', function($model){
            Activity::record('update', $model);
        });

        Event::listen('eloquent.deleted: *', function($model){
            Activity::record('delete', $model);
        });
    }
}
