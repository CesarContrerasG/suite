<?php

namespace App\Http\Controllers\Cove;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Cove\CustomerRequest;
use App\Cove\Customer;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
        $type = auth()->user()->permission_cove;

        return view('Cove.customers.index')->with(['customers' => $customers, 'type' => $type]);
    }

    public function create()
    {    
        return view('Cove.customers.create');
    }

    public function store(CustomerRequest $request)
    {
        $customer = new Customer;
        Customer::insertOrUpdate($customer, $request);

        return redirect()->route('cove.customers.index');
    }

    public function  edit(Customer $customer)
    {          
        return view('Cove.customers.edit')->with('customer', $customer);
    }

    public function update(Customer $customer, CustomerRequest $request)
    {
        Customer::insertOrUpdate($customer, $request);

        return redirect()->route('cove.customers.index');
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();

        return response()->json(['redirect' => 'customers']);
    }
}