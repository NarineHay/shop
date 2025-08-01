@extends('emails.layouts.base')

@section('content')
    <div class="content">
        <h2>{{__('email.hello')}}</h2>
        <p>{{__('email.reset_p1')}}</p>
        <p> {{__('email.reset_p2')}} </p>

        <a class="btn" href="{{ $url }}" style=""> {{__('email.reset_pass')}}</a>
        <p> {{__('email.reset_p3')}}</p>

        <p>{{ __('email.regards') }},<br>{{ __('email.team') }} {{ config('app.name') }}</p>
    </div>
@endsection


