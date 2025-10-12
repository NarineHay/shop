@extends('emails.layouts.base')

@section('content')
    <div class="content">
        <div><strong> Name:</strong> {{$data['name']}}</div>
        <div><strong>Phone:</strong> {{$data['phone']}}</div>
        <div><strong>Email:</strong> {{$data['email']}}</div>
        <div><strong>Subject:</strong> {{$data['subject']}}</div>
        <div><strong>Message:</strong> {{$data['message']}}</div>

        <p>{{ __('email.regards') }},<br>{{ __('email.team') }} {{ config('app.name') }}</p>
    </div>
@endsection
