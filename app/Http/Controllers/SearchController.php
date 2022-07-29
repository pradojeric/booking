<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function home()
    {
        $countries = Country::with(['terminals'])->orderBy('name')->get();

        return view('home', compact('countries'));
    }

    public function search(Request $request)
    {
        return view('search');
    }
}
