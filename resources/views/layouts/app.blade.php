<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    @yield('refressMeta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    @yield('extraCss')
</head>
<body class="flex flex-col min-h-screen">

    @yield('content')

    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @yield('extraJs')
</body>
</html>
