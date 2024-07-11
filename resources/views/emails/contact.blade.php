@component('mail::message')

#Nuovo messaggio dal form di contatto

**Nome:** {{$name}}

**Email:** {{$email}}

**Messaggio:**

{{$message}}

@endcomponent
