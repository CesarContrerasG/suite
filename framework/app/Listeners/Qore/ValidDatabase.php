<?php

namespace App\Listeners\Qore;

use App\Events\Qore\ContractWasRegistered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Setup\Configuration;

class ValidDatabase implements ShouldQueue
{

    use InteractsWithQueue;
    
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ContractWasRegistered  $event
     * @return void
     */
    public function handle(ContractWasRegistered $event)
    {
        $configuration = Configuration::where('master_id', $event->contract->master_id)->first();
        if($event->contract->needDatabase())
        {
            Configuration::createDB($event->contract, $configuration);
        }
    }
}
