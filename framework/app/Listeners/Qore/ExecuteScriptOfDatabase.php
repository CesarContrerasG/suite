<?php

namespace App\Listeners\Qore;

use App\Events\Qore\ContractWasRegistered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ExecuteScriptOfDatabase implements ShouldQueue
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
        $event->contract->executeScripts();
    }
}
