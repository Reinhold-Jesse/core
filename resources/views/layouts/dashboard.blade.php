<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="apple-touch-icon" sizes="57x57" href="{{ url('favicon/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ url('favicon/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ url('favicon/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ url('favicon/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ url('favicon/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ url('favicon/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ url('favicon/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ url('favicon/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ url('favicon/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ url('favicon/android-icon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ url('favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ url('favicon/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ url('favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ url('favicon/manifest.json') }}">
    <meta name="msapplication-TileColor" content="#18306a">
    <meta name="msapplication-TileImage" content="{{ url('favicon/ms-icon-144x144.png') }}">
    <meta name="theme-color" content="#18306a">

    <title>@yield('title') - {{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    @livewireStyles

    @vite(['resources/css/dashboard.css', 'resources/js/dashboard.js'])
</head>

<body class="bg-gray-200">
    <x:component::flash-message on="saved" />

    <div x-data="{ isOpen: true }" class="flex overflow-hidden">
        <div x-cloak :class="isOpen ? '-left-72' : 'left-0'"
            class="fixed top-0 bottom-0 px-5 overflow-y-auto transition-all duration-300 ease-linear bg-white w-72 py-7">

            <div class="pb-3 border-b border-gray-200">
                <a href="#" class="block">
                    <h1 class="mb-3 text-3xl font-bold text-center">Company</h1>
                </a>
            </div>

            <div class="pl-1 pr-3">

                <div class="mt-7">
                    {{ menu('admin', 'admin') }}
                </div>

                <div class="">
                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}" x-data>
                        @csrf
                        <x:component::menu.link href="{{ route('logout') }}" @click.prevent="$root.submit();"
                            class="flex gap-2 text-gray-600 transition-all duration-200 ease-linear hover:text-dashboard-500">
                            Logout
                            <x:component::icon.logout class="text-red-500" />
                        </x:component::menu.link>
                    </form>
                </div>
            </div>

        </div>
        <div :class="isOpen ? 'left-0' : 'left-72'" class="relative w-full transition-all duration-300 ease-linear">
            <div class="shadow-sm bg-dashboard-900 backend-background-image">
                <div class="bg-gray-900 bg-opacity-50">
                    <div class="flex justify-between pl-5 pr-10 py-7">
                        <button x-on:click="isOpen = ! isOpen" type="button"
                            class="text-white hover:text-dashboard-500">
                            <x:component::icon.hamburger />
                        </button>

                        @if (Auth::user())
                            <div class="flex items-center gap-5">

                                @livewire('notification.component.message-counter')

                                <div
                                    class="flex items-center gap-2 pr-3 text-sm transition border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300">
                                    <img class="object-cover w-8 h-8 rounded-full"
                                        src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}">
                                    <span class="text-gray-300">{{ Auth::user()->name }}</span>
                                </div>
                            </div>
                        @endif
                    </div>

                    @if (isset($header))
                        <header class="container mx-auto text-3xl text-white px-7 pt-7 pb-14">
                            {{ $header }}
                        </header>
                    @endif
                </div>
            </div>
            <main class="px-5 pb-12 pt-7 mb-7">
                {{ $slot }}
            </main>
        </div>
    </div>

    @livewireScripts

</body>

</html>
