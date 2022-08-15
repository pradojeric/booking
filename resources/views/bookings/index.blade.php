<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    BOOKINGS
                </div>
            </div>

            <table class="w-full">
                <thead>
                    <tr>
                        <th>Flight ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Passengers</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bookings as $booking)
                        <tr>
                            <td class="text-center">{{ $booking->travel_flight_id }}</td>
                            <td class="text-center">{{ $booking->bookingInformations->first()->last_name }}</td>
                            <td class="text-center">{{ $booking->email }}</td>
                            <td class="text-center">{{ $booking->passengers }}</td>
                            <td class="text-center">
                                <a href="{{ route('bookings.show', $booking) }}">
                                    <x-button>View</x-button>
                                </a>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
