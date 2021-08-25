@component('mail::message')
# Hi  {{$first_name}},
Your registration is successfully completed, welcome to DBPMS
you can login in using the following information 

email:  {{$email}}, <br>
password: the password you have used on the registration


Thanks,<br>
{{ config('app.name') }}
@endcomponent
