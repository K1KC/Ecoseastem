<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('import.bootstrap-link')
    <title>NexSea</title>
</head>
<body>
    @include('layout.navbar')
    @yield('body')
    @include('layout.footer')
    @include('import.bootstrap-script')
</body>
</html>
