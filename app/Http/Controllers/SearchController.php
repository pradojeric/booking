<?php

namespace App\Http\Controllers;

use App\Mail\BookingSuccessful;
use App\Models\Booking;
use Carbon\Carbon;
use App\Models\Flight;
use App\Models\Country;
use App\Models\Terminal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
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
        $request->validate([
            'terminalOrigin' => ['required'],
            'terminalDest' => ['required'],
            'passengers' => ['required', 'array'],
            'cabin' => ['required'],
            'trip' => ['required'],
            'travel' => ['required'],
            'back' => ['required_if:trip,returning'],
        ]);

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

    public function getPersonalInfo(Request $request)
    {
        $items = Session::get('items');

        $items['travel_flight'] = $request->travel_flight;

        Session::put('items', $items);

        return view('personal-info', compact('items'));
    }

    public function book(Request $request)
    {
        $request->validate([
            'email' => ['required', 'confirmed', 'email'],
            'phone' => ['nullable'],
            'emergency_name' => ['required'],
            'emergency_phone' => ['required'],
            'passengers' => ['required', 'array'],
        ]);

        $items = Session::get('items');

        DB::beginTransaction();
        //store booking
        $booking = Booking::create([
            'travel_flight_id' => $items['travel_flight'],
            'back_flight_id' => $items['back_flight'] ?? null,
            'passengers' => array_sum($items['passengers']),
            'email' => $request->email,
            'phone' => $request->phone,
            'emergency_name' => $request->emergency_name,
            'emergency_phone' => $request->emergency_phone,
        ]);

        foreach($request->passengers as $i => $passengers)
        {
            foreach($passengers as $passenger)
            {
                $data[] = [
                    'passenger_type' => $i,
                    'last_name' => $passenger['last_name'],
                    'first_name' => $passenger['first_name'],
                    'birthday' => $passenger['birthday'],
                ];
            }
        }

        $booking->bookingInformations()->createMany($data);

        //email booking
        Mail::to($request->email)
            ->send(new BookingSuccessful($booking));

        DB::commit();
        return view('booking_success', [
            'email' => $request->email,
        ]);
    }
}
