@component('mail::message')
# {{ $details['title'] }}


{{ $details['message'] }}<br>
download link:<a href="{{ $details['document'] }}">{{ $details['document'] }}</a> <br>

@endcomponent
