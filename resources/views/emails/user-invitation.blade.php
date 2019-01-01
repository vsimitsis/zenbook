@component('mail::message')
# Hi {{ $user->name }},

{{ $currentUser->name }} has invited you to join {{ $currentUser->company->name }}.

@component('mail::button', ['url' => $url])
Set Password
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
