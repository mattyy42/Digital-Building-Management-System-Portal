@component('mail::message')
# Hi  {{$first_name}},
Your planing consent is rejected, you can go to DBPMS <br>
web portal and check your comment section and rework the comment or<br>
you can apply complain on the rejected planing consent <br>


Thanks,<br>
{{ config('app.name') }}
@endcomponent
