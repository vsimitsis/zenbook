<?php

namespace App\Http\Controllers;

class LessonController extends Controller
{
    /**
     * Return the lesson index page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('lessons.index');
    }
}
