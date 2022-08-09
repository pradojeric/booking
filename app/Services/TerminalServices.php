<?php

namespace app\Services;

use App\Models\Flight;

class TerminalServices {

    public function getFlights($routes, $orig, $dest)
    {
        $flights = [];
        $count = 0;

        while($routes->exists())
        {
            foreach($routes->get() as $route)
            {
                $flights[] = $route;

                $routes = Flight::where('terminal_dest_id', '<>', $orig)
                    ->where('terminal_orig_id', $route->terminal_dest_id);
            }
        }
    }
}
