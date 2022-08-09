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
                        <h1 class="text-sm">{{ count($items['passengers']) }} Traveler</h1>
                        <ul>
                            @foreach ($items['passengers'] as $i => $passenger)
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
                                {{ $items['orig']->city }}
                            </h1>
                            <p class="text-sm -mt-2">
                                {{ $items['orig']->name }} ({{ $items['orig']->code }})
                            </p>
                        </div>
                        <div>
                            ->
                        </div>
                        <div>
                            <h1 class="font-bold text-lg tracking-wide uppercase">
                                {{ $items['dest']->city }}
                            </h1>
                            <p class="text-sm -mt-2">
                                {{ $items['dest']->name }} ({{ $items['dest']->code }})
                            </p>
                        </div>
                        <div>
                            {{ $items['travel']->format('D d M') }}
                        </div>
                    </div>

                    <div class="mt-5">
                        <form action="" method="post">
                            @csrf

                            <h1 class="uppercase font-bold text-lg">Personal Information</h1>

                            <x-label>Last Name</x-label>
                            <x-input class="block w-full"></x-input>
                            <x-label>First Name</x-label>
                            <x-input class="block w-full"></x-input>
                            <x-label>Middle Name</x-label>
                            <x-input class="block w-full"></x-input>
                            <x-label>Birthday</x-label>
                            <x-input class="block w-full"></x-input>
                            <x-label>Nationality</x-label>
                            <x-input class="block w-full"></x-input>
                            <x-label>Email</x-label>
                            <x-input class="block w-full"></x-input>
                            <x-label>Contact Number</x-label>
                            <x-input class="block w-full"></x-input>
                            <x-label>Valid ID</x-label>
                            <x-input class="block w-full"></x-input>
                        </form>
                    </div>
                </div>

            </div>

        </div>
    </div>


</x-app-layout>

