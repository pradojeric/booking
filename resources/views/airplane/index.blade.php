<x-app-layout>
    <div class="xl:px-60">

            <div class="my-3 flex justify-end">
                <a href="{{ route('airplanes.create') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                    Create
                </a>
            </div>

            <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="py-3 px-6">Name</th>
                            <th scope="col" class="py-3 px-6">Seats</th>
                            <th scope="col" class="py-3 px-6">Cabin</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($airplanes as $airplane)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="py-4 px-6">{{ $airplane->name }}</td>
                                <td class="py-4 px-6">{{ $airplane->seats }}</td>
                                <td class="py-4 px-6">{{ $airplane->cabin }}</td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
