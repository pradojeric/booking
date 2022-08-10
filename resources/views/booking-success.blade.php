<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-auth-validation-errors></x-auth-validation-errors>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    BOOKED SUCCESSFULLY
                </div>
            </div>
            <div class="flex justify-center">
                We sent an email to {{ $email }}
            </div>
        </div>
    </div>



</x-app-layout>

