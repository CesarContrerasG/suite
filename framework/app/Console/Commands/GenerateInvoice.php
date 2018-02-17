<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

use App\Qore\Contract;

class GenerateInvoice extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'invoice:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Invoice created Automatically';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        /**
         * Logica del comando - Función para evaluar las facturas requeridas.
         *
         * @return mixed
         */

         $contracts = Contract::all();

         foreach ($contracts as $contract) {
             $detail = $contract->details->first();
             $days = $contract->dates->credit_days;
             $date = date("Y-m-d", strtotime($detail->billing_date." + ".$days."days"));

             if($date >= date("Y-m-d")){
                 Log::info("Se registrara una factura automaticamente para el contrato con indice: {$contract->id} / fecha de facturación {$date} dias de credito incluidos");
             }
         }

    }
}
