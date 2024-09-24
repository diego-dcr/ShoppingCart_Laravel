<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-screen p-0 m-0">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Vite Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased h-screen">
    @auth
        <div class="flex flex-row h-screen p-0 mt-3">
            @include('layouts.navigation')
            <main class="basis-4/5">
                @yield('content')
            </main>
        </div>
    @else
        <main class="login h-screen">
            @yield('login')
        </main>
    @endauth
</body>

</html>
