@component('mail::message')
# Hi  {{$first_name}},
Your Application is rejected, you can go to DBPMS <br>
web portal and check your comment section and rework on the comment or<br>
you can apply complain on the rejected Application <br>


Thanks,<br>
{{ config('app.name') }}
@endcomponent
