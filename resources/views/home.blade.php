<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-auth-validation-errors></x-auth-validation-errors>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    BOOK A FLIGHT
                </div>
            </div>
            <form method="post" action="{{ route('search') }}">
                @csrf
                <div class="px-6 mt-3" x-data="booking()">
                    <div class="flex space-x-4">
                        <div class="flex items-center space-x-2">
                            <input type="radio" value="one_way" x-model="trip" id="one_way">
                            <x-label for="one_way" value="One Way" />
                        </div>
                        <div class="flex items-center space-x-2">
                            <input type="radio" value="returning" x-model="trip" id="returning">
                            <x-label for="returning" value="Returning" />
                        </div>
                    </div>

                    <div class="bg-blue-200 p-6 mt-3 flex space-x-5">
                        <div class="w-full">
                            <h1>Leaving From</h1>
                            <div>
                                <x-label>Select A Country / Region</x-label>
                                <x-select class="block w-full" x-model.number="countryOrigin" x-on:change="getTerminalsOrigin()">
                                    <template x-for="(country, countryIndex) in countries" :key="`C`+countryIndex">
                                        <option :value="country.id" x-text="country.name"></option>
                                    </template>
                                </x-select>
                            </div>
                            <div>
                                <x-label>Select A City</x-label>
                                <x-select class="block w-full" x-model.number="terminalOrigin" name="terminalOrigin"  required>
                                    <template x-for="(t, terminalIndex) in terminalsOrigin" :key="`TO`+terminalIndex">
                                        <option :value="t.id" x-text="t.city + ` (`+ t.code +`)`"></option>
                                    </template>
                                </x-select>
                            </div>
                        </div>
                        <div class="w-full">
                            <h1>Going To</h1>
                            <div>
                                <x-label>Select A Country / Region</x-label>
                                <x-select class="block w-full" x-model.number="countryDest" x-on:change="getTerminalsDest()">
                                    <option value="">...</option>
                                    <template x-for="(country, countryIndex) in countries" :key="`C`+countryIndex">
                                        <option :value="country.id" x-text="country.name"></option>
                                    </template>
                                </x-select>
                            </div>
                            <div>
                                <x-label>Select A City</x-label>
                                <x-select class="block w-full" x-model.number="terminalDest" name="terminalDest" required>
                                    <option value="">...</option>
                                    <template x-for="(t, terminalIndex) in terminalsDest" :key="`TD`+terminalIndex">
                                        <option :value="t.id" x-text="t.city + ` (`+ t.code +`)`"></option>
                                    </template>
                                </x-select>
                            </div>
                        </div>
                    </div>

                    <div class="p-6">
                        <h1>Travel Dates</h1>
                        <div>
                            <x-label>Travel</x-label>
                            <x-input type="date" class="block w-full" name="travel" required></x-input>
                        </div>
                        <template x-if="trip == 'returning'">
                            <div>
                                <x-label>Back</x-label>
                                <x-input type="date" class="block w-full" name="back"></x-input>
                            </div>
                        </template>
                    </div>
                    <div class="bg-blue-200 p-6">
                        <div x-data="{ open : false }">
                            <h1>Passenger Type</h1>
                            <div class="flex justify-between p-2 border" x-on:click="open = !open">
                                <div x-text="sum+ ` PASSENGER (s)`"></div>
                                <div>
                                    <button type="button" class="font-bold text-sm">Dropdown</button>
                                </div>
                            </div>
                            <div
                                x-show="open"
                                x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="opacity-0 scale-100"
                                x-transition:enter-end="opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-100"
                                x-transition:leave-start="opacity-100 scale-100"
                                x-transition:leave-end="opacity-0 scale-100" >
                                <template x-for="(passenger, index) in passengers" :key="`passenger` + index">
                                    <div class="flex justify-between items-center w-full py-1">
                                        <span class="text-sm" x-text="passenger.label"></span>
                                        <x-select class="text-sm" x-model.number="passenger.count" x-on:change="getTotalPassengers(index)" x-bind:name="`passengers[`+ passenger.name +`]`">
                                            <template x-for="(i, pIndex) in passenger.totalPassengers" :key="`total` + i">
                                                <option x-value="pIndex" x-text="pIndex"></option>
                                            </template>
                                        </x-select>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <x-label>Cabin Class</x-label>
                        <x-select class="block w-full" name="cabin" required>
                            <option value="economy">ECONOMY</option>
                            <option value="premium economy">PREMIUM ECONOMY</option>
                            <option value="business">BUSINESS</option>
                        </x-select>
                    </div>
                    <div class="mt-3">
                        <x-button class="w-full block">Search</x-button>
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

