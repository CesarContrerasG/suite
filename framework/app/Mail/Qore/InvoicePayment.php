<?php

namespace App\Mail\Qore;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Qore\Pay;

class InvoicePayment extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $pay;

    public function __construct(Pay $pay)
    {
        $this->pay = $pay;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('Mails.qore.payment')
                    ->from('suite@e-code.mx', 'Esuite Qore');
    }
}
