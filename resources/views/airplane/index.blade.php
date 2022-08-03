<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    AIRPLANES
                </div>
            </div>

            <div class="my-3">
                <a href="{{ route('airplanes.create') }}">
                    <x-button type="button">
                        Create
                    </x-button>
                </a>
            </div>

            <table class="w-full">
                <thead>
                    <tr>
                        <th>NAME</th>
                        <th>SEATS</th>
                        <th>CABIN</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($airplanes as $airplane)
                        <tr>
                            <td class="text-center">{{ $airplane->name }}</td>
                            <td class="text-center">{{ $airplane->seats }}</td>
                            <td class="text-center">{{ $airplane->cabin }}</td>
                            <td class="text-center">
                                <x-button>View</x-button>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
