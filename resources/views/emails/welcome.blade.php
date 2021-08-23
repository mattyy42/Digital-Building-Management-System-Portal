@component('mail::message')
# Hi  {{$first_name}},
Your registration is successfully completed, welcome to DBPMS
you can login in using the following information 

email:  {{$email}}, <br>
password:   {{$password}},


Thanks,<br>
{{ config('app.name') }}
@endcomponent
