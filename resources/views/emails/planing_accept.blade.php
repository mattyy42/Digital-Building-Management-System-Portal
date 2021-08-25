@component('mail::message')
# Hi  {{$first_name}},
Your planing consent is successfully accepted, you can go to DBPMS <br>
web portal and start the application process<br>


Thanks,<br>
{{ config('app.name') }}
@endcomponent
