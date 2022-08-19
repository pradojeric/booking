<x-app-layout>
        <div class="xl:px-60">
            <div class="p-6 max-w-full bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
                <form method="post" action="{{ route('search') }}">
                    @csrf
                    <div x-data="booking()">
                        <div class="flex my-6">
                            <div class="flex items-center mr-4">
                                <input type="radio" value="one_way" x-model="trip" id="one_way" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="one_way" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">One Way</label>
                            </div>
                            <div class="flex items-center mr-4">
                                <input type="radio" value="returning" x-model="trip" id="returning" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="returning" value="Returning" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Returning</label>
                            </div>
                        </div>

                        <div class="grid md:grid-cols-2 md:gap-6">
                            <div class="relative z-0 w-full group">
                                <h1 class="block mb-2 text-lg font-bold text-gray-900 dark:text-gray-400">Leaving From</h1>
                                <div class="my-1">
                                    <label class="text-sm font-medium text-gray-900 dark:text-gray-300">Select A Country / Region</label>
                                    <select x-model.number="countryOrigin" x-on:change="getTerminalsOrigin()" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <template x-for="(country, countryIndex) in countries" :key="`C`+countryIndex">
                                            <option :value="country.id" x-text="country.name"></option>
                                        </template>
                                    </select>
                                </div>
                                <div class="my-1">
                                    <label class="text-sm font-medium text-gray-900 dark:text-gray-300">Select A City</label>
                                    <select x-model.number="terminalOrigin" name="terminalOrigin" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required >
                                        <template x-for="(t, terminalIndex) in terminalsOrigin" :key="`TO`+terminalIndex">
                                            <option :value="t.id" x-text="t.city + ` (`+ t.code +`)`"></option>
                                        </template>
                                    </select>
                                </div>
                            </div>
                            <div class="relative z-0 w-full group">
                                <h1 class="block mb-2 text-lg font-bold text-gray-900 dark:text-gray-400">Going To</h1>
                                <div class="my-1">
                                    <label class="text-sm font-medium text-gray-900 dark:text-gray-300">Select A Country / Region</label>
                                    <select x-model.number="countryDest" x-on:change="getTerminalsDest()" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <template x-for="(country, countryIndex) in countries" :key="`C`+countryIndex">
                                            <option :value="country.id" x-text="country.name"></option>
                                        </template>
                                    </select>
                                </div>
                                <div class="my-1">
                                    <label class="text-sm font-medium text-gray-900 dark:text-gray-300">Select A City</label>
                                    <select x-model.number="terminalDest" name="terminalDest" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                        <template x-for="(t, terminalIndex) in terminalsDest" :key="`TD`+terminalIndex">
                                            <option :value="t.id" x-text="t.city + ` (`+ t.code +`)`"></option>
                                        </template>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="grid md:grid-cols-2 md:gap-6">
                            <div class="my-1">
                                <h1 class="block mb-2 text-lg font-bold text-gray-900 dark:text-gray-400">Date</h1>
                                    <div class="my-2">
                                        <label class="text-sm font-medium text-gray-900 dark:text-gray-300">Select Departure Date</label>
                                        <x-input type="date" name="travel" required></x-input>
                                    </div>
                                <template x-if="trip == 'returning'">
                                    <div class="my-2">
                                        <label class="text-sm font-medium text-gray-900 dark:text-gray-300">Arrival</label>
                                        <x-input type="date" name="back"></x-input>
                                    </div>
                                </template>
                            </div>

                            <div class="my-1">
                                <h1 class="block mb-2 text-lg font-bold text-gray-900 dark:text-gray-400">Cabin</h1>
                                <label class="text-sm font-medium text-gray-900 dark:text-gray-300">Select Cabin Class</label>
                                <select name="cabin" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                    <option value="economy">ECONOMY</option>
                                    <option value="premium economy">PREMIUM ECONOMY</option>
                                    <option value="business">BUSINESS</option>
                                </select>
                            </div>

                            <div class="my-1">
                                <x-button type="button" id="dropdownDefault" data-dropdown-toggle="dropdown"><span x-text="sum+ ` PASSENGER (s)`"></span></x-button>
                                <div id="dropdown" class="hidden z-10 p-5 bg-white rounded shadow dark:bg-gray-700">
                                    <template x-for="(passenger, index) in passengers" :key="`passenger` + index">
                                        <div>
                                            <label x-text="passenger.label" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400"></label>
                                            <select x-model.number="passenger.count" x-on:change="getTotalPassengers(index)" x-bind:name="`passengers[`+ passenger.name +`]`" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                <template x-for="(i, pIndex) in passenger.totalPassengers" :key="`total` + i">
                                                    <option x-value="pIndex" x-text="pIndex"></option>
                                                </template>
                                            </select>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </div>
                        <div class="my-6">
                            <x-button>Search</x-button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    <script>
        function booking(){
            return {
                countryOrigin: 1,
                terminalOrigin: 1,
                countryDest: null,
                terminalDest: null,
                countries: [],
                terminalsOrigin: [],
                terminalsDest: [],
                sum: 1,
                trip: "one_way",
                passengers: [
                    {'name' : 'adult', 'label' : 'Adult (12y +)', 'count' : 0, totalPassengers: 10},
                    {'name' : 'children', 'label' : 'Children (2y - 11)', 'count' : 0, totalPassengers: 10},
                    {'name' : 'infant', 'label' : 'Infant (16d - 23m)', 'count' : 0, totalPassengers: 10},
                    {'name' : 'senior', 'label' : 'Senior Citizen (60y)', 'count' : 0, totalPassengers: 10},
                    {'name' : 'pwd', 'label' : 'Person With Disability', 'count' : 0, totalPassengers: 10},
                    {'name' : 'ofw', 'label' : 'Overseas Filipino Worker', 'count' : 0, totalPassengers: 10},
                ],
                init() {
                    this.$nextTick(() => {
                        this.passengers[0].count = 1
                        this.countries = @json($countries);
                        terminals = this.countries.filter((c) => c.id == 1)[0].terminals
                        this.terminalsOrigin = Alpine.raw(terminals)
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
                getTotalPassengers(index) {
                    const total = 10
                    var sum = 0

                    this.passengers.forEach( el => {
                        sum += el.count
                    })

                    if(sum == 0) {
                        this.passengers[0].count = 1
                        sum = 1
                    }else{
                        var t = total - sum

                        this.passengers.forEach( (el, i) => {
                            el.totalPassengers = el.count + t
                        })
                    }
                    this.sum = sum


                },
            }
        }
    </script>

</x-app-layout>

