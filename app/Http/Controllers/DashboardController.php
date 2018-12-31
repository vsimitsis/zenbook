<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    /**
     * Returns the dashboard index view
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('dashboard');
    }
}
