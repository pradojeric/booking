<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Flight;
use App\Models\Country;
use App\Models\Airplane;
use Illuminate\Http\Request;

class FlightController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('flights.index', [
            'flights' => Flight::when($request->get('date'), function($query) use ($request) {
                $query->whereDate('departure_time', $request->get('date'));
            })->orderBy('departure_time')->paginate(25),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('flights.create', [
            'airplanes' => Airplane::all(),
            'countries' => Country::with(['terminals'])->orderBy('name')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $depart = Carbon::parse($request->departure_time);
        $arrive = Carbon::parse($request->arrival_time);

        for($i = 0; $i < 7; $i++)
        {
            Flight::create([
                'terminal_orig_id' => $request->terminal_orig_id,
                'terminal_dest_id' => $request->terminal_dest_id,
                'airplane_id' => $request->airplane_id,
                'price' => $request->price,
                'departure_time' => $depart,
                'arrival_time' => $arrive,
            ]);

            $depart = (clone $depart)->addWeek();
            $arrive = (clone $arrive)->addWeek();

        }

        return redirect()->route('flights.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Flight  $flight
     * @return \Illuminate\Http\Response
     */
    public function show(Flight $flight)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Flight  $flight
     * @return \Illuminate\Http\Response
     */
    public function edit(Flight $flight)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Flight  $flight
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Flight $flight)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Flight  $flight
     * @return \Illuminate\Http\Response
     */
    public function destroy(Flight $flight)
    {
        //
    }
}
