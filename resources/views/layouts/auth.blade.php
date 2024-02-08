<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }}</title>
    <link href="{{ asset('/sbadmin/css/sb-admin-2.min.css') }}" rel="stylesheet">
    @stack('css')
</head>

<body>
    <div class="container">
        @yield('content')
    </div>
    <script src="{{ asset('/sbadmin/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('/sbadmin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('/js/all.js') }}"></script>
    @stack('script')
</body>

</html>