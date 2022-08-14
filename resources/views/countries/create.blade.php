<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    COUNTRIES
                </div>
            </div>

            <div class="my-3">
                <a href="{{ route('countries.index') }}">
                    <x-button type="button">
                        Back
                    </x-button>
                </a>
            </div>

            <form action="{{ route('countries.store') }}" method="post">
                @csrf
                <div>
                    <x-label>Name</x-label>
                    <x-input name="name"></x-input>
                </div>
                <div>
                    <x-button>Submit</x-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
