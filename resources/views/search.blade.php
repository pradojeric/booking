<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    SELECT - FLIGHTS
                </div>
            </div>
            <div class="flex flex-row-reverse space-x-4">
                <div class="w-1/4 mt-3">
                    <div class="bg-blue-700 p-3 text-white border border-white">
                        Your Booking
                    </div>
                    <div class="bg-blue-700 p-3 text-white border border-white">
                        <h1 class="text-sm">{{ count($passengers) }} Traveler</h1>
                        <ul>
                            @foreach ($passengers as $i => $passenger)
                                <li class="text-xs">{{ $passenger }} <span class="capitalize">{{ preg_replace("/[^A-Za-z0-9 ]/", '', $i); }}</span></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="grow mt-3">
                    <h1>Please select departure flight</h1>
                    <div class="flex space-x-5">
                        <div>
                            <h1 class="font-bold text-lg tracking-wide uppercase">
                                {{ $orig->city }}
                            </h1>
                            <p class="text-sm -mt-2">
                                {{ $orig->name }} ({{ $orig->code }})
                            </p>
                        </div>
                        <div>
                            ->
                        </div>
                        <div>
                            <h1 class="font-bold text-lg tracking-wide uppercase">
                                {{ $dest->city }}
                            </h1>
                            <p class="text-sm -mt-2">
                                {{ $dest->name }} ({{ $dest->code }})
                            </p>
                        </div>
                        <div>
                            {{ $travel->format('D d M') }}
                        </div>
                    </div>

                    <table class="w-full table bg-white sm:rounded-lg mt-3">
                        <thead>
                            <tr>
                                <th class="px-3 py-4 uppercase">Details</th>
                                <th class="px-3 py-4 uppercase">Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-t hover:border-2 hover:shadow-md bg-white">
                                <td class="px-3 py-2">
                                    <div>
                                        <span class="font-bold text-lg">04:10</span> Ninoy Aquino International (MNL)
                                    </div>
                                    <div>
                                        | Direct
                                    </div>
                                    <div>
                                        <span class="font-bold text-lg">05:35</span> Mactan International (CEB)
                                    </div>
                                    <div>
                                        Duration <span class="font-bold text-lg">01h25m</span>
                                    </div>
                                    <div>
                                        Airlines (PR4356)
                                    </div>
                                </td>
                                <td class="px-3 py-2 text-center">
                                    <x-button>
                                        <div>
                                            PHP
                                        </div>
                                        <div>
                                            4,500.00
                                        </div>
                                    </x-button>
                                </td>
                            </tr>
                            <tr class="border-t hover:border-2 hover:shadow-md bg-white">
                                <td class="px-3 py-2">
                                    <div>
                                        <span class="font-bold text-lg">04:10</span> Ninoy Aquino International (MNL)
                                    </div>
                                    <div>
                                        | Direct
                                    </div>
                                    <div>
                                        <span class="font-bold text-lg">05:35</span> Mactan International (CEB)
                                    </div>
                                    <div>
                                        Duration <span class="font-bold text-lg">01h25m</span>
                                    </div>
                                    <div>
                                        Airlines (PR4356)
                                    </div>
                                </td>
                                <td class="px-3 py-2 text-center">
                                    <x-button>
                                        <div>
                                            PHP
                                        </div>
                                        <div>
                                            4,500.00
                                        </div>
                                    </x-button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>

        </div>
    </div>


</x-app-layout>

