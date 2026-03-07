<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SIRATA - Sistem Rapor STIMATA</title>

    @vite(['resources/css/app.css','resources/js/app.js'])

</head>

<body class="bg-white">

    @yield('content')

</body>

</html>