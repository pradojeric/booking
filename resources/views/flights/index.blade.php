<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    FLIGHTS
                </div>
            </div>

            <div class="my-3 flex justify-between">
                <a href="{{ route('flights.create') }}">
                    <x-button type="button">
                        Create
                    </x-button>
                </a>
                <div>
                    <form action="{{ URL::current() }}">
                        <x-input type="date" name="date" :value="request()->get('date')"></x-input>
                        <x-button>Search</x-button>
                    </form>
                </div>
            </div>

            <table class="w-full">
                <thead>
                    <tr>
                        <th>Details</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($flights as $flight)
                        <tr>
                            <td class="px-6 py-3">
                                <div>
                                    {{ $flight->departure_time->format('F d') }}
                                </div>
                                <div>
                                    {{ $flight->departure_time->format('H:i') }} - {{ $flight->terminalOrig->name }}
                                </div>
                                <div>
                                    {{ $flight->arrival_time->format('H:i') }} - {{ $flight->terminalDest->name }}
                                </div>
                                <div>
                                    Duration: {{ $flight->arrival_time->diff($flight->departure_time)->format('%Hhr%imin') }}
                                </div>
                                <div>
                                    {{ $flight->airplane->name }}
                                </div>
                            </td>
                            <td class="text-center">
                                <x-button>View</x-button>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>

            {{ $flights->links() }}
        </div>
    </div>
</x-app-layout>
