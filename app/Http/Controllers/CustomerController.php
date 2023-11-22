<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerCreateRequest;
use App\Http\Requests\CustomerUpdateRequest;
use App\Models\Customer;
use App\Models\Firms;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $models = Customer::all();
        return view('customers.index', ['models' => $models]);
    }
    public function show(Customer $customer)
    {
        // dd($customer);
        $models = Firms::where('customer_id', $customer->id)->get();
        return view('customers.show', ['customer' => $customer, 'models' => $models]);
    }
    public function store(CustomerCreateRequest $customerCreateRequest)
    {
        $customer = Customer::create($customerCreateRequest->all());
        return redirect()->back()->with('text', 'Информация введена');
    }
    public function update(CustomerUpdateRequest $customerUpdateRequest, Customer $customer)
    {
        $customer->update($customerUpdateRequest->all());
        return redirect()->back()->with('text', 'Информация была изменена');
    }
    public function delete(Customer $customer)
    {
        $customer->delete();
        return redirect()->back()->with('text', 'Информация удалены');
    }
    public function status(Customer $customer)
    {
        if ($customer->status == 1) {
            $customer->update(['status' => 0]);
        } else {
            $customer->update(['status' => 1]);
        }
        return redirect()->back();
    }
}
