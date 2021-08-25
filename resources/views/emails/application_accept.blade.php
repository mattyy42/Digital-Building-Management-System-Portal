@component('mail::message')
# Hi  {{$first_name}},
Your Application is successfully accepted, you can go to DBPMS <br>
web portal <br>


Thanks,<br>
{{ config('app.name') }}
@endcomponent
