<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    COUNTRIES
                </div>
            </div>

            <div class="my-3">
                <a href="{{ route('countries.create') }}">
                    <x-button type="button">
                        Create
                    </x-button>
                </a>
            </div>

            <table class="w-full">
                <thead>
                    <tr>
                        <th>NAME</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($countries as $country)
                        <tr>
                            <td class="text-center">{{ $country->name }}</td>
                            <td class="text-center">
                                <a href="{{ route('countries.terminals.index', $country) }}">
                                    <x-button>View</x-button>
                                </a>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
