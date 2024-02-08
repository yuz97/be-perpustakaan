<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ? config('app.name') }}</title>
    <link rel="stylesheet" href="{{ asset('css/all.css') }}">
    @stack('css')
</head>

<body>


    <script src="{{ asset('js/all.js') }}"></script>
    @stack('script')
</body>

</html>