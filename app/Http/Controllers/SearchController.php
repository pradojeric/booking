<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Flight;
use App\Models\Country;
use App\Models\Terminal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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
        $flights = Flight::where('terminal_orig_id', $orig->id)
            ->where('terminal_dest_id', $dest->id)
            ->whereDate('departure_time', $travel)->get();
        $back = [];
        if($request->back) {

            $back = Carbon::parse($request->back);
            $end = Flight::where('terminal_orig_id', $dest->id)
                ->where('terminal_dest_id', $orig->id)
                ->whereDate('departure_time', $back)->get();
        }

        $data = [
            'orig' => $orig,
            'dest' => $dest,
            'passengers' => $passengers,
            'cabin' => $cabin,
            'travel' => $travel,
            'back' => $back ?? null,
        ];

        Session::put('items', $data);

        // $endRoute = Flight::where('terminal_dest_id', $dest);
        return view('search', compact('orig', 'dest', 'passengers', 'cabin', 'trip', 'travel', 'flights', 'back'));
    }

    public function personalInfo(Request $request)
    {
        $items = Session::get('items');


        return view('personal-info', compact('items'));
    }
}
