<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function search(Request $request)
    {
        return view('search');
    }
}
