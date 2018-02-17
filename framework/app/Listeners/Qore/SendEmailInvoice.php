<?php

namespace App\Listeners\Qore;

use App\Events\Qore\InvoiceWasRegistered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

use App\Mail\Qore\InvoiceRegistered;

class SendEmailInvoice implements ShouldQueue
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
     * @param  InvoiceWasRegistered  $event
     * @return void
     */
    public function handle(InvoiceWasRegistered $event)
    {
        $send_to = $event->invoice->contract->company->contact;
        Mail::to($send_to)->send(new InvoiceRegistered($event->invoice));
    }
}
