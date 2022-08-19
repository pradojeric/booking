<x-app-layout>
    <div class="xl:px-60">
        <h1 class="block mb-2 text-lg font-bold text-gray-900 dark:text-gray-300">Select Flight</h1>
        <div class="flex space-x-5 my-2 dark:text-gray-300">
            <div>
                <h1 class="font-bold text-lg tracking-wide uppercase">{{ $orig->city }}</h1>
                <p class="text-sm -mt-2">{{ $orig->name }} ({{ $orig->code }})</p>
            </div>
            <div class="font-bold text-lg tracking-wide uppercase">
                To
            </div>
            <div>
                <h1 class="font-bold text-lg tracking-wide uppercase">{{ $dest->city }}</h1>
                <p class="text-sm -mt-2">{{ $dest->name }} ({{ $dest->code }})</p>
            </div>
            <div>
                <h1 class="font-bold text-lg tracking-wide uppercase">{{ $travel->format('D d M') }}</h1>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-8">
        <div class="overflow-x-auto relative shadow-md sm:rounded-lg md:col-span-2">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="py-3 px-6">Details</th>
                    <th scope="col" class="py-3 px-6">Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($flights as $flight)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="py-4 px-6">
                            <div>
                                <span class="font-bold text-lg">{{ $flight->departure_time->format('H:i') }}</span> {{ $flight->terminalOrig->name }} ({{ $flight->terminalOrig->code }})
                                <br>Direct<br>
                                <span class="font-bold text-lg">{{ $flight->arrival_time->format('H:i') }}</span> {{ $flight->terminalDest->name }} ({{ $flight->terminalDest->code }})
                                <br>Duration<br>
                                <span class="font-bold text-lg">{{ $flight->arrival_time->diff($flight->departure_time)->format('%Hhr%imin') }}</span>
                                ({{ $flight->airplane->name }})
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            <form action="{{ route('personal.info') }}" method="post">
                                @csrf
                                <input type="hidden" name="travel_flight" value="{{ $flight->id }}">
                                <x-button :disabled="$flight->computeRemainingSeats() < 1">
                                    @if($flight->computeRemainingSeats() < 1)
                                        Not Available
                                        @else
                                            <div>
                                                PHP {{ $flight->price }}
                                            </div>
                                        @if($flight->computeRemainingSeats() < 5)
                                            <div>
                                                Seats Remaining: {{ $flight->computeRemainingSeats() }}
                                            </div>
                                        @endif
                                    @endif
                                </x-button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        </div>
        <div class="p-6 max-w-sm bg-white rounded-lg border border-gray-200 shadow-md bg-gray-800 dark:bg-gray-800 dark:border-gray-700">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-100 dark:text-white">Your Booking</h5>
            <p class="mb-3 font-normal text-gray-100 dark:text-gray-400">{{ array_sum($passengers) }} Traveler</p>
            <ul>
                @foreach ($passengers as $i => $passenger)
                    <li class="mb-3 font-normal text-gray-100 dark:text-gray-400">{{ $passenger }} <span class="capitalize">{{ preg_replace("/[^A-Za-z0-9 ]/", '', $i); }}</span></li>
                @endforeach
            </ul>
        </div>
        </div>
    </div>
</x-app-layout>

