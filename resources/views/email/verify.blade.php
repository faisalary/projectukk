@component('mail::message')
# Email Verification

Thank you for signing up. 

@component('mail::button', ['url' => $url])
Set Password
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent


{{-- @component('mail::message')
# Email Verification

Thank you for signing up. 
Your six-digit code is {{$url}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent --}}