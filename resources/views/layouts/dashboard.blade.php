<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    @livewireStyles

    @vite(['resources/css/dashboard.css', 'resources/js/dashboard.js'])
</head>

<body class="bg-gray-200">
    <div x-data="{ isOpen: true }" class="flex overflow-hidden">
        <div x-cloak :class="isOpen ? '-left-72' : 'left-0'"
            class="fixed top-0 bottom-0 px-5 overflow-y-auto transition-all duration-300 ease-linear bg-white w-72 py-7">

            <div class="pb-3 border-b border-gray-200">
                <a href="#" class="block">
                    <h1 class="mb-3 text-3xl font-bold text-center">Company</h1>
                </a>
            </div>

            <div class="px-3">

                <div class="mt-7">
                    {{ menu('admin', 'admin') }}
                </div>

                <div class="">
                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}" x-data>
                        @csrf
                        <x:component::menu.link href="{{ route('logout') }}" @click.prevent="$root.submit();"
                            class="flex gap-2 text-gray-600 transition-all duration-200 ease-linear hover:text-primary-500">
                            Logout
                            <x:component::icon.logout class="text-red-500" />
                        </x:component::menu.link>
                    </form>
                </div>
            </div>

        </div>
        <div :class="isOpen ? 'left-0' : 'left-72'" class="relative w-full transition-all duration-300 ease-linear">
            <div class="bg-gray-900 shadow-sm pb-7">
                <div class="flex justify-between pl-5 pr-10 py-7">
                    <button x-on:click="isOpen = ! isOpen" type="button" class="text-white hover:text-primary-500">
                        <x:component::icon.hamburger />
                    </button>

                    @if (Auth::user())
                        <div
                            class="flex items-center gap-2 pr-3 text-sm transition border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300">
                            <img class="object-cover w-8 h-8 rounded-full" src="{{ Auth::user()->profile_photo_url }}"
                                alt="{{ Auth::user()->name }}">
                            <span class="text-gray-300">{{ Auth::user()->name }}</span>
                        </div>
                    @endif

                </div>

                @if (isset($header))
                    <header class="container mx-auto text-3xl text-white p-7">
                        {{ $header }}
                    </header>
                @endif
            </div>
            <main class="px-5 py-7">
                {{ $slot }}
            </main>
        </div>
    </div>

    @livewireScripts

</body>

</html>
