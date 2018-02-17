<?php

namespace App\Listeners\Qore;

use App\Events\Qore\PaymentWasRegistered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

use App\Mail\Qore\InvoicePayment;

class SendEmailPayment implements ShouldQueue
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
     * @param  PaymentWasRegistered  $event
     * @return void
     */
    public function handle(PaymentWasRegistered $event)
    {
        $send_to = $event->pay->invoice->contract->company->contact;
        Mail::to($send_to)->send(new InvoicePayment($event->pay));
    }
}
