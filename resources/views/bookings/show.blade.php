<x-app-layout>
    <div class="xl:px-60">
        <div class="p-6 w-full bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
            <div>
                <span class="font-bold">Date:</span> {{ $booking->travelFlight->departure_time }}
            </div>
            <div>
                <span class="font-bold">Information:</span> {{ $booking->bookingInformations()->first()->full_name }}
            </div>
            <div>
                <span class="font-bold">Email:</span> {{ $booking->email }}
            </div>
            <div>
                <span class="font-bold">Passengers:</span> {{ $booking->passengers }}
                <ul>
                    @foreach ($booking->bookingInformations as $passenger)
                        <li>{{ $passenger->full_name }} ({{ $passenger->passenger_type }})</li>
                    @endforeach
                </ul>
            </div>

            <div class="mt-6">
                <h1 class="font-bold text-lg tracking-wide uppercase my-2">Flight Information:</h1>
                <div>
                    <span class="font-bold text-lg">{{ $booking->travelFlight->departure_time->format('H:i') }}</span> {{ $booking->travelFlight->terminalOrig->name }} ({{ $booking->travelFlight->terminalOrig->code }})
                    <br>Direct<br>
                    <span class="font-bold text-lg">{{ $booking->travelFlight->arrival_time->format('H:i') }}</span> {{ $booking->travelFlight->terminalDest->name }} ({{ $booking->travelFlight->terminalDest->code }})
                    <br>Duration<br>
                    <span class="font-bold text-lg">{{ $booking->travelFlight->arrival_time->diff($booking->travelFlight->departure_time)->format('%Hhr%imin') }}</span>
                    ({{ $booking->travelFlight->airplane->name }})
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
