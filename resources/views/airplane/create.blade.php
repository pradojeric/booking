<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    AIRPLANES
                </div>
            </div>

            <div class="my-3">
                <a href="{{ route('airplanes.index') }}">
                    <x-button type="button">
                        Back
                    </x-button>
                </a>
            </div>

            <form action="{{ route('airplanes.store') }}" method="post">
                @csrf
                <div class="mt-2">
                    <x-input name="name"></x-input>
                </div>
                <div class="mt-2">
                    <x-input name="seats"></x-input>
                </div>
                <div class="mt-2">
                    <select name="cabin">
                        @foreach ($cabins as $cabin)
                            <option value="{{ $cabin }}">{{ $cabin }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <x-button>Submit</x-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
