<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Return the index page of the user notifications
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('notifications.index', [
            'notifications' => Auth::user()->notifications()->paginate(10),
            'search' => $request->search,
        ]);
    }
}
