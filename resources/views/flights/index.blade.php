<x-app-layout>
    <div class="xl:px-60">

        <div class="my-3 flex justify-end">
            <a href="{{ route('flights.create') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                Create
            </a>
        </div>
        <div>
            <form action="{{ URL::current() }}" class="flex items-center">
                <label for="simple-search" class="sr-only">Search</label>
                <div class="relative w-full">
                    <x-input type="date" name="date" :value="request()->get('date')"></x-input>
                </div>
                <button type="submit" class="p-2.5 ml-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    <span class="sr-only">Search</span>
                </button>
            </form>
        </div>

        <div class="overflow-x-auto relative shadow-md sm:rounded-lg my-2">

            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="py-3 px-6">Details</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($flights as $flight)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="py-4 px-6">
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
                        </tr>
                    @endforeach

                </tbody>
            </table>

            {{ $flights->links() }}
        </div>
    </div>
</x-app-layout>
