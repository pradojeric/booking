<x-app-layout>
    <div class="xl:px-60">
        <div class="my-3 flex justify-end">
            <a href="{{ route('flights.index') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                Back
            </a>
        </div>
        <div class="p-6 w-full bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
            <form action="{{ route('flights.store') }}" method="post">
                @csrf
                <div class="grid md:grid-cols-2 md:gap-6">
                    <div class="relative z-0 w-full group">
                        <h1 class="block mb-2 text-lg font-bold text-gray-900 dark:text-gray-400">Leaving From</h1>
                        <div>
                            <label class="text-sm font-medium text-gray-900 dark:text-gray-300">Select A Country / Region</label>
                            <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" x-model.number="countryOrigin" x-on:change="getTerminalsOrigin()">
                                <template x-for="(country, countryIndex) in countries" :key="`C`+countryIndex">
                                    <option :value="country.id" x-text="country.name"></option>
                                </template>
                            </select>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-900 dark:text-gray-300">Select A City</label>
                            <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" x-model.number="terminalOrigin" name="terminal_orig_id">
                                <template x-for="(t, terminalIndex) in terminalsOrigin" :key="`TO`+terminalIndex">
                                    <option :value="t.id" x-text="t.city + ` (`+ t.code +`)`"></option>
                                </template>
                            </select>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-900 dark:text-gray-300">Departure</label>
                            <x-input type="datetime-local" class="block w-full" name="departure_time"></x-input>
                        </div>
                    </div>

                    <div class="relative z-0 w-full group">
                        <h1 class="block mb-2 text-lg font-bold text-gray-900 dark:text-gray-400">Going To</h1>
                        <div>
                            <label class="text-sm font-medium text-gray-900 dark:text-gray-300">Select A Country / Region</label>
                            <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" x-model.number="countryDest" x-on:change="getTerminalsDest()">
                                <template x-for="(country, countryIndex) in countries" :key="`C`+countryIndex">
                                    <option :value="country.id" x-text="country.name"></option>
                                </template>
                            </select>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-900 dark:text-gray-300">Select A City</label>
                            <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" x-model.number="terminalDest" name="terminal_dest_id">
                                <template x-for="(t, terminalIndex) in terminalsDest" :key="`TD`+terminalIndex">
                                    <option :value="t.id" x-text="t.city + ` (`+ t.code +`)`"></option>
                                </template>
                            </select>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-900 dark:text-gray-300">Arrical</label>
                            <x-input type="datetime-local" class="block w-full" name="arrival_time"></x-input>
                        </div>
                    </div>
                </div>
                <div class="grid md:grid-cols-2 md:gap-6">
                    <div class="my-1">
                        <label class="text-sm font-medium text-gray-900 dark:text-gray-300">Airplane</label>
                        <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="airplane_id">
                            @foreach ($airplanes as $airplane)
                                <option value="{{ $airplane->id }}">{{ $airplane->name }} ({{ $airplane->seats }} seats) - {{ strtoupper($airplane->cabin) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="my-1">
                        <label class="text-sm font-medium text-gray-900 dark:text-gray-300">Price</label>
                        <x-input type="number" class="block w-full" name="price"></x-input>
                    </div>
                </div>

                <div class="my-6">
                    <x-button>Submit</x-button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function flights() {
            return {
                countryOrigin: 0,
                terminalOrigin: 0,
                countryDest: 0,
                terminalDest: 0,
                countries: [],
                terminalsOrigin: [],
                terminalsDest: [],
                init() {
                    this.$nextTick(() => {
                        this.countries = @json($countries);
                    })
                },
                getTerminalsOrigin(){
                    console.log(this.countryOrigin)

                    terminals = this.countries.filter((c) => c.id == this.countryOrigin)[0].terminals
                    this.terminalsOrigin = Alpine.raw(terminals)

                },
                getTerminalsDest(){
                    console.log(this.countryDest)

                    terminals = this.countries.filter((c) => c.id == this.countryDest)[0].terminals
                    this.terminalsDest = Alpine.raw(terminals)
                },
            }
        }
    </script>
</x-app-layout>
