<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    BOOKINGS
                </div>
            </div>

            <div>
                Date: {{ $booking->travelFlight->departure_time }}
            </div>
            <div>
                Information: {{ $booking->bookingInformations()->first()->full_name }}
            </div>
            <div>
                Email: {{ $booking->email }}
            </div>
            <div>
                Passengers: {{ $booking->passengers }}
                <ul>
                    @foreach ($booking->bookingInformations as $passenger)
                        <li>{{ $passenger->full_name }} ({{ $passenger->passenger_type }})</li>
                    @endforeach
                </ul>
            </div>

            <div>
                Flight Information:
                <div>
                    <span class="font-bold text-lg">{{ $booking->travelFlight->departure_time->format('H:i') }}</span> {{ $booking->travelFlight->terminalOrig->name }} ({{ $booking->travelFlight->terminalOrig->code }})
                </div>
                <div>
                    | Direct
                </div>
                <div>
                    <span class="font-bold text-lg">{{ $booking->travelFlight->arrival_time->format('H:i') }}</span> {{ $booking->travelFlight->terminalDest->name }} ({{ $booking->travelFlight->terminalDest->code }})
                </div>
                <div>
                    Duration <span class="font-bold text-lg">{{ $booking->travelFlight->arrival_time->diff($booking->travelFlight->departure_time)->format('%Hhr%imin') }}</span>
                </div>
                <div>
                    ({{ $booking->travelFlight->airplane->name }})
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
