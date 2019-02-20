<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Timezone;
use App\Country;

class CustomerController extends Controller
{
    /**
     * Return the customers index page
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('customers.index', [
            'customers' => Auth::user()->company->customers()->paginate(10),
            'search' => $request->search,
        ]);
    }

    public function show(Customer $customer)
    {
        //
    }

    /**
     * Return the customer create page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $customer = new Customer();

        return view('customers.create', [
            'customer' => $customer,
            'timezones' => Timezone::all(),
            'contacts' => $customer->contacts,
            'addresses' => $customer->addresses,
            'countries' => Country::all(),
        ]);
    }

    public function store(Request $request)
    {
        //
    }

    public function edit(Customer $customer)
    {
        return view('customers.edit', [
            'customer' => $customer,
            'company' => $customer->company,
            'contacts' => $customer->contacts,
            'addresses' => $customer->addresses,
            'countries' => Country::all(),
            'timezones' => Timezone::all()
        ]);
    }

    public function update(Request $request, Customer $customer)
    {
        //
    }

    public function delete(Customer $customer)
    {
        //
    }
}
