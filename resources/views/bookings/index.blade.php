<x-app-layout>
    <div class="xl:px-60">
        <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="py-3 px-6">Flight ID</th>
                        <th scope="col" class="py-3 px-6">Name</th>
                        <th scope="col" class="py-3 px-6">Email</th>
                        <th scope="col" class="py-3 px-6">Passengers</th>
                        <th scope="col" class="py-3 px-6">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bookings as $booking)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="py-4 px-6">{{ $booking->travel_flight_id }}</td>
                            <td class="py-4 px-6">{{ $booking->bookingInformations->first()->last_name }}</td>
                            <td class="py-4 px-6">{{ $booking->email }}</td>
                            <td class="py-4 px-6">{{ $booking->passengers }}</td>
                            <td class="py-4 px-6">
                                <a href="{{ route('bookings.show', $booking) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                    View
                                </a>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
