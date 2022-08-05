<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Flight;
use App\Models\Country;
use App\Models\Terminal;
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


        $orig = Terminal::find($request->terminalOrigin);
        $dest = Terminal::find($request->terminalDest);
        $passengers = array_filter( $request->passengers );
        $cabin = $request->cabin;
        $trip = $request->trip;
        $travel = Carbon::parse($request->travel);





        return view('search', compact('orig', 'dest', 'passengers', 'cabin', 'trip', 'travel'));
    }
}
