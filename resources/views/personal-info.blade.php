<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <x-auth-validation-errors></x-auth-validation-errors>
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
                        <h1 class="text-sm">{{ array_sum($items['passengers']) }} Traveler</h1>
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
                        <form action="{{ route('book') }}" method="post">
                            @csrf

                            @foreach ($items['passengers'] as $index => $passenger)

                                @for($i = 1; $i <= $passenger; $i++)

                                    <div class="mt-3">
                                        <h1 class="uppercase text-lg tracking-wider">Personal Information</h1>
                                        <h5 class="capitalize text-xs">{{ preg_replace("/[^A-Za-z0-9 ]/", '', $index); }} {{ $i }}</h5>

                                        <x-label>Last Name</x-label>
                                        <x-input class="block w-full" type="text" name="passengers[{{ $index }}][{{ $i }}][last_name]"></x-input>
                                        <x-label>First Name</x-label>
                                        <x-input class="block w-full" type="text" name="passengers[{{ $index }}][{{ $i }}][first_name]"></x-input>
                                        <x-label>Birthday</x-label>
                                        <x-input class="block w-full" type="date" name="passengers[{{ $index }}][{{ $i }}][birthday]"></x-input>
                                    </div>

                                @endfor


                            @endforeach

                            <div class="mt-3">

                                <h1 class="uppercase font-bold text-lg">Contact Information</h1>
                                <x-label>Email*</x-label>
                                <x-input class="block w-full" type="email" name="email"></x-input>
                                <x-label>Re-enter Email*</x-label>
                                <x-input class="block w-full" type="email" name="email_confirmation"></x-input>
                                <x-label>Mobile Phone</x-label>
                                <x-input class="block w-full" type="text" name="mobile_phone"></x-input>

                                <hr>

                                <x-label>Emergency Name</x-label>
                                <x-input class="block w-full" type="text" name="emergency_name"></x-input>
                                <x-label>Emergency Phone</x-label>
                                <x-input class="block w-full" type="text" name="emergency_phone"></x-input>
                            </div>

                            <x-button>Continue</x-button>
                        </form>
                    </div>
                </div>

            </div>

        </div>
    </div>


</x-app-layout>

