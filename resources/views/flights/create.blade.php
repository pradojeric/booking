<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" x-data="flights">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    FLIGHTS
                </div>
            </div>

            <div class="my-3">
                <a href="{{ route('flights.index') }}">
                    <x-button type="button">
                        Back
                    </x-button>
                </a>
            </div>

            <form action="{{ route('flights.store') }}" method="post">
                @csrf
                <div>
                    <h1>Leaving From</h1>
                    <div>
                        <x-label>Select A Country / Region</x-label>
                        <x-select class="block w-full" x-model.number="countryOrigin" x-on:change="getTerminalsOrigin()">
                            <option value="0">...</option>
                            <template x-for="(country, countryIndex) in countries" :key="`C`+countryIndex">
                                <option :value="country.id" x-text="country.name"></option>
                            </template>
                        </x-select>
                    </div>
                    <div>
                        <x-label>Select A City</x-label>
                        <x-select class="block w-full" x-model.number="terminalOrigin" name="terminal_orig_id">
                            <option value="0">...</option>
                            <template x-for="(t, terminalIndex) in terminalsOrigin" :key="`TO`+terminalIndex">
                                <option :value="t.id" x-text="t.city + ` (`+ t.code +`)`"></option>
                            </template>
                        </x-select>
                    </div>
                    <div>
                        <x-label value="Departure"></x-label>
                        <x-input type="datetime-local" class="block w-full" name="departure_time"></x-input>
                    </div>
                </div>

                <div>
                    <h1>Going To</h1>
                    <div>
                        <x-label>Select A Country / Region</x-label>
                        <x-select class="block w-full" x-model.number="countryDest" x-on:change="getTerminalsDest()">
                            <option value="0">...</option>
                            <template x-for="(country, countryIndex) in countries" :key="`C`+countryIndex">
                                <option :value="country.id" x-text="country.name"></option>
                            </template>
                        </x-select>
                    </div>
                    <div>
                        <x-label>Select A City</x-label>
                        <x-select class="block w-full" x-model.number="terminalDest" name="terminal_dest_id">
                            <option value="0">...</option>
                            <template x-for="(t, terminalIndex) in terminalsDest" :key="`TD`+terminalIndex">
                                <option :value="t.id" x-text="t.city + ` (`+ t.code +`)`"></option>
                            </template>
                        </x-select>
                    </div>
                    <div>
                        <x-label value="Arrival"></x-label>
                        <x-input type="datetime-local" class="block w-full" name="arrival_time"></x-input>
                    </div>
                </div>

                <div class="mt-2">
                    <x-label>Airplane</x-label>
                    <x-select class="block w-full" name="airplane_id">
                        @foreach ($airplanes as $airplane)
                            <option value="{{ $airplane->id }}">{{ $airplane->name }} ({{ $airplane->seats }} seats) - {{ strtoupper($airplane->cabin) }}</option>
                        @endforeach
                    </x-select>
                </div>

                <div class="mt-2">

                    <x-label value="Price"></x-label>
                    <x-input type="number" class="block w-full" name="price"></x-input>

                </div>

                <div class="mt-2">
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
