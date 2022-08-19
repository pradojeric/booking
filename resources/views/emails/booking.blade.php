@component('mail::message')

# Booking Successful

@component('mail::panel')
Departure:  <b>{{ $booking->travelFlight->departure_time }}</b><br>
Info: <b>{{ $booking->bookingInformations()->first()->full_name }}</b><br>
Email: <b>{{ $booking->email }}</b><br>
Passengers: <b>{{ $booking->passengers }}</b><br>
<ul>
    @foreach ($booking->bookingInformations as $passenger)
        <li>{{ $passenger->full_name }} ({{ $passenger->passenger_type }})</li>
    @endforeach
</ul>
@endcomponent

@endcomponent
