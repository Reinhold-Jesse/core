<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ setting('site.title') }}</title>
    <meta name="description" content="{{ setting('site.description') }}">

    <!-- Styles -->
    @livewireStyles

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="">

    <!-- Page Content -->
    <main>
        {{ $slot }}
    </main>

    @stack('modals')

    @livewireScripts
</body>

</html>
