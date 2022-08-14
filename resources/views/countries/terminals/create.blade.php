<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    COUNTRIES
                </div>
            </div>

            <div class="my-3">
                <a href="{{ route('countries.terminals.index', $country) }}">
                    <x-button type="button">
                        Back
                    </x-button>
                </a>
            </div>

            <form action="{{ route('countries.terminals.store', $country) }}" method="post">
                @csrf
                <div class="mt-2">
                    <x-label>City</x-label>
                    <x-input name="city" class="block w-full"></x-input>
                </div>
                <div class="mt-2">
                    <x-label>Name</x-label>
                    <x-input name="name" class="block w-full"></x-input>
                </div>
                <div class="mt-2">
                    <x-label>Code</x-label>
                    <x-input name="code" class="block w-full"></x-input>
                </div>
                <div class="mt-2">
                    <x-button>Submit</x-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
