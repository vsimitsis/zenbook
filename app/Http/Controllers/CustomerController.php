<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        return view('customers.create', [
            'customer' => new Customer(),
        ]);
    }

    public function store(Request $request)
    {
        //
    }

    public function edit(Customer $customer)
    {
        //
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
