<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>

<body class="font-sans antialiased h-full">
    @include('layouts.navigation')

    <!-- Page Content -->
    <main class="flex h-full bg-gray-100">
        @include('layouts.sidebar')
        {{ $slot }}
    </main>

    <!-- flash messages -->
    @if(session()->has('success'))
    <div x-data="{ show:true }" x-init="setTimeout(()=>show = false,4000)" x-show="show" class="fixed bg-green-300 text-white py-5 px-10 rounded-xl top-5 left-1/2 text-md">
        <p>
            {{ session('success') }}
        </p>
    </div>
    @endif

    @if(session()->has('error'))
    <div x-data="{ show:true }" x-init="setTimeout(()=>show = false,4000)" x-show="show" class="fixed bg-red-300 text-white py-5 px-10 rounded-xl top-5 left-1/2 text-md">
        <p>
            {{ session('error') }}
        </p>
    </div>
    @endif
</body>

</html>