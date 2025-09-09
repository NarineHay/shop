<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>

    body {
        font-family: 'Segoe UI', 'Helvetica Neue', sans-serif;
        background-color: #f5f5f5;
        margin: 0;
        padding: 0;
        border: ipx solid #555555
    }

    .email-wrapper {
        max-width: 600px;
        margin: 30px auto;
        background-color: #ffffff;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        border: 1px solid #555555
    }

    .email-header {
        background-color: #f5f5f5;
        padding: 20px;
        text-align: center;
    }

    .email-header img {
        max-height: 50px;
    }

    .email-body {
        padding: 30px;
        font-size: 16px;
        color: #222222;
        line-height: 1.6;
    }

    .btn {
        display: inline-block;
        border-radius: .25rem;
        text-decoration: none;
        font-weight: 400;
        margin-top: 20px;
        text-align: center;
        text-decoration: none;
        vertical-align: middle;
        color: #fff
    }

    .btn-secondary {
        background: #111 none repeat scroll 0 0;
        line-height: 35px;
        padding: 0 0.7rem;
        text-transform: capitalize;
        color: #fff;
    }

    .mb-4 {
        margin-bottom: 1.5rem !important;
    }

    .mt-4 {
        margin-top: 1.5rem !important;
    }

    .btn-secondary:hover {
        background-color: #fedc19;
        border-color: #fedc19;
        color: #111;
    }

    .email-footer {
        background-color: #f5f5f5;
        text-align: center;
        font-size: 13px;
        color: #555555;
        padding: 20px;
    }

    .email-contact-info {
        display: flex;
        justify-content: space-around;
        flex-wrap: wrap;
        text-align: center;
        margin-top: 30px;
        padding-top: 20px;
        border-top: 1px solid #eee;
        font-size: 14px;
        color: #555555;
    }

    .email-contact-info div {
        margin: 10px 0;
        max-width: 45%;
    }

    .email-contact-info img {
        height: 24px;
        margin-bottom: 10px;
    }

    h2, h4 {
        color: #222222;
        margin-bottom: 12px;
    }
    </style>
</head>
<body>
    <div class="email-wrapper">
        @include('emails.layouts.header')

        <div class="email-body">
            @yield('content')
        </div>

        @include('emails.layouts.footer')
    </div>
</body>
</html>
