<?php

namespace Twedoo\Volcator\Http\Controllers;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        return 'To do : Front !';
        return view('elements.home.index');
    }
}
