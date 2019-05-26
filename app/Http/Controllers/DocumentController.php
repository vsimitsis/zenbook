<?php

namespace App\Http\Controllers;

class DocumentController extends Controller
{
    /**
     * Return the document index page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('documents.index');
    }
}
