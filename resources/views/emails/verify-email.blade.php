@extends('emails.layouts.base')

@section('content')
    <div class="content">
        <h2>{{ __('email.hello') }} {{ $user->name }}!</h2>
        <h4>{{ __('email.email_confirm_p') }}</h4>

        <a class="btn btn-secondary mb-4 mt-4" href="{{ $url }}">{{ __('email.email_confirm') }}</a>

        <p>{{ __('email.regards') }},<br>{{ __('email.team') }} {{ config('app.name') }}</p>
    </div>
@endsection
