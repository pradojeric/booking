<x-app-layout>
    <div class="xl:px-60">

            <div class="my-3 flex justify-end">
                <a href="{{ route('countries.index') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                    Back
                </a>
            </div>

            <div class="p-6 w-full bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
                <form action="{{ route('countries.store') }}" method="post">
                    @csrf
                    <div>
                        <label class="text-sm font-medium text-gray-900 dark:text-gray-300">Name</label>
                        <x-input type="text" name="name"></x-input>
                    </div>
                    <div class="my-6">
                        <x-button>Submit</x-button>
                    </div>
                </form>
            </div>

    </div>
</x-app-layout>
