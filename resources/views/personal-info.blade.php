<x-app-layout>
    <div class="xl:px-60">
        <h1 class="block mb-2 text-lg font-bold text-gray-900 dark:text-gray-300">Please select departure flight</h1>
        <div class="flex space-x-5 my-2 dark:text-gray-300">
            <div>
                <h1 class="font-bold text-lg tracking-wide uppercase">{{ $items['orig']->city }}</h1>
                <p class="text-sm -mt-2">{{ $items['orig']->name }} ({{ $items['orig']->code }})</p>
            </div>
            <div class="font-bold text-lg tracking-wide uppercase">
                To
            </div>
            <div>
                <h1 class="font-bold text-lg tracking-wide uppercase">{{ $items['dest']->city }}</h1>
                <p class="text-sm -mt-2">{{ $items['dest']->name }} ({{ $items['dest']->code }})</p>
            </div>
            <div>
                <h1 class="font-bold text-lg tracking-wide uppercase">{{ $items['travel']->format('D d M') }}</h1>
            </div>
        </div>

        <div class="p-6 max-w-full bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
            <form action="{{ route('book') }}" method="post">
                @csrf

                @foreach ($items['passengers'] as $index => $passenger)

                    @for($i = 1; $i <= $passenger; $i++)
                    <h1 class="block my-2 text-lg font-bold text-gray-900 dark:text-gray-400">Personal Information</h1>
                    <h5 class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">{{ preg_replace("/[^A-Za-z0-9 ]/", '', $index); }} {{ $i }}</h5>
                        <div class="grid md:grid-cols-2 md:gap-6">
                            <div class="my-1">
                                <label class="text-sm font-medium text-gray-900 dark:text-gray-300">Last Name</label>
                                <x-input type="text" name="passengers[{{ $index }}][{{ $i }}][last_name]"></x-input>
                            </div>
                            <div class="my-1">
                                <label class="text-sm font-medium text-gray-900 dark:text-gray-300">First Name</label>
                                <x-input type="text" name="passengers[{{ $index }}][{{ $i }}][first_name]"></x-input>
                            </div>
                            <div class="my-1">
                                <label class="text-sm font-medium text-gray-900 dark:text-gray-300">Birthday</label>
                                <x-input type="date" name="passengers[{{ $index }}][{{ $i }}][birthday]"></x-input>
                            </div>
                        </div>

                    @endfor


                @endforeach

                <div>
                    <h1 class="block my-2 text-lg font-bold text-gray-900 dark:text-gray-400">Contact Information</h1>
                    <div class="grid md:grid-cols-2 md:gap-6">
                        <div class="my-1">
                            <label class="text-sm font-medium text-gray-900 dark:text-gray-300">Email*</label>
                            <x-input type="email" name="email"></x-input>
                        </div>
                        <div class="my-1">
                            <label class="text-sm font-medium text-gray-900 dark:text-gray-300">Re-enter Email*</label>
                            <x-input type="email" name="email_confirmation"></x-input>
                        </div>
                        <div class="my-1">
                            <label class="text-sm font-medium text-gray-900 dark:text-gray-300">Mobile Phone</label>
                            <x-input type="text" name="mobile_phone"></x-input>
                        </div>
                        <div class="my-1">
                            <label class="text-sm font-medium text-gray-900 dark:text-gray-300">Emergency Name</label>
                            <x-input type="text" name="emergency_name"></x-input>
                        </div>
                        <div class="my-1">
                            <label class="text-sm font-medium text-gray-900 dark:text-gray-300">Emergency Phone</label>
                            <x-input type="text" name="emergency_phone"></x-input>
                        </div>
                    </div>
                </div>
                <div class="my-6">
                    <x-button>Continue</x-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

