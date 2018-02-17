<?php

namespace App\Http\Controllers\Qore;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Vinkla\Hashids\Facades\Hashids;

use App\Http\Controllers\Controller;
use App\Http\Requests\Qore\InvoiceRequest;
use App\Http\Requests\Qore\PayRequest;
use App\Http\Requests\Qore\ContractFilesRequest;
use App\Mail\Qore\InvoicePayment;
use App\Qore\Contract;
use App\Qore\Invoice;
use App\Qore\Pay;
use App\Qore\Product;
use App\Qore\Details;
use App\Qore\Files;

class AccountsController extends Controller
{
    public function index()
    {
        $contracts = Contract::where('master_id', \Auth::user()->current_master->id)->get();
        return view('Qore.accounts.index', compact('contracts'));
    }

    public function invoices(Contract $contract)
    {
        foreach ($contract->details as $detail) {
            $products[] = $detail->service_id;
        }
        $services = Product::whereIn('id', $products)->pluck('name', 'id');
        $invoices = Invoice::where('contract_id', $contract->id)->get();
        return view('Qore.accounts.invoices', compact('contract', 'invoices', 'services'));
    }

    public function invoicesStore(Contract $contract, InvoiceRequest $request)
    {
        $result = Contract::saveInvoice($contract, $request);
        if ($result === true) {
            Session::flash('message', 'Registro exitoso!!');
        } else {
            Session::flash('message', $result);
        }
        return redirect()->back();
    }

    public function invoicePDF(Invoice $invoice)
    {
        $storage = dataForStorage($invoice->billing_register);
        return response()->download('framework'.Storage::disk('qore')->url('modules/qore/'.$storage['master'].'/'.$storage['year'].'/'.$storage['month'].'/billings/'.$invoice->id.'/'.$invoice->pdf));
    }

    public function invoiceXML(Invoice $invoice)
    {
        $storage = dataForStorage($invoice->billing_register);
        return response()->download('framework'.Storage::disk('qore')->url('modules/qore/'.$storage['master'].'/'.$storage['year'].'/'.$storage['month'].'/billings/'.$invoice->id.'/'.$invoice->xml));
    }


    public function payments(Invoice $invoice)
    {
        $payments = Pay::where('invoice_id', $invoice->id)->get();
        return view('Qore.accounts.payments', compact('invoice', 'payments'));
    }

    public function paymentsStore(Invoice $invoice, PayRequest $request)
    {
        $result = Contract::savePayment($invoice, $request);
        if($result === true){
            Session::flash('message', 'Registro exitoso!!');
        } else {
            Session::flash('message', $result);
        }

        return redirect()->route('qore.receivable.payments.index', $invoice);
    }

    public function paymentPDF(Pay $pay)
    {
        $storage = dataForStorage($pay->payment_date);
        return response()->download('framework'.Storage::disk('qore')->url('modules/qore/'.$storage['master'].'/'.$storage['year'].'/'.$storage['month'].'/payments/'.$pay->id.'/'.$pay->voucher));
    }

    public function files(Contract $contract)
    {
        return view('Qore.accounts.files', compact('contract'));
    }

    public function filesStore(Contract $contract, ContractFilesRequest $request)
    {
        $master = \Auth::user()->current_master->rfc;
        $data = $request->all();
        $data['document'] = $request->file('document')->getClientOriginalName();
        $file = Files::create($data);

        Files::storageImage($request, $file, $master);

        Session::flash('message', 'Registro exitoso!!');
        return redirect()->back();
    }

    public function fileDownload(Files $file)
    {
        $storage = dataForStorage($file->emition_date);
        return response()->download('framework'.Storage::disk('qore')->url('modules/qore/'.$storage['master'].'/'.$storage['year'].'/'.$storage['month'].'/contracts/'.$file->id.'/'.$file->document));
    }

    public function history()
    {
        $dates = Contract::history();

        $results = Contract::historyInvoice();
        $dates_invoices = $results['dates'];
        $contracts = $results['contracts'];

        $results_payments = Contract::historyPayment();
        $dates_payments = $results_payments['dates'];
        $billings = $results_payments['billings'];

        return view('Qore.accounts.history', compact('dates', 'dates_invoices', 'contracts', 'dates_payments', 'billings'));
    }

    public function invoiceHistory()
    {
        $results = Contract::historyInvoice();
        $dates = $results['dates'];
        $contracts = $results['contracts'];
        return view('Qore.accounts.invoices-history', compact('dates', 'contracts'));
    }

    public function paymentHistory()
    {
        $results = Contract::historyPayment();
        $dates = $results['dates'];
        $billings = $results['billings'];
        return view('Qore.accounts.payment-history', compact('dates', 'billings'));
    }
}
