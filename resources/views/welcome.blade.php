<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    @livewireStyles
    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="py-12 antialiased bg-gray-200">

    <div class="container mx-auto">
        <div class="grid grid-cols-1 gap-7">
            @if (is_array($content))
                @foreach ($content as $element)
                    <div class="bg-gray-100 border p-7">
                        @if (is_array($element))
                            @if (isset($element['name']) && !empty($element['name']))
                                <div class="flex items-center">
                                    <span class="mr-3 text-6xl text-teal-500">#</span>
                                    <h3
                                        class="max-w-lg mb-3 text-4xl font-extrabold leading-none text-gray-900 md:text-5xl xl:text-6xl dark:text-white">
                                        {{ $element['name'] }}
                                    </h3>
                                </div>
                            @endif

                            @if (isset($element['date']) && !empty($element['date']))
                                @if ($element['name'] == 'icon' || $element['name'] == 'icons')
                                    <div class="grid grid-cols-4 gap-5">
                                        @foreach ($element['date'] as $value)
                                            <div class="px-5 py-3 ">
                                                <p class="py-3">{{ $value }}</p>
                                                <x-dynamic-component :component="$element['name'] . '.' . $value" />
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    @foreach ($element['date'] as $value)
                                        <div class="px-5 py-3 ">
                                            <p class="py-3">{{ $value }}</p>
                                            <x-dynamic-component :component="$element['name'] . '.' . $value" />
                                        </div>
                                    @endforeach
                                @endif
                            @endif
                        @else
                            <div class="px-5 py-3 ">
                                <p class="py-3">{{ $element }}</p>
                                <x-dynamic-component :component="'form.' . $element" />
                            </div>
                        @endif
                    </div>
                @endforeach
            @else
                <div class="px-5 py-3 text-white bg-red-500 rounded-md">
                    <p>Keine Daten wurde gefunden.</p>
                </div>

            @endif

        </div>
    </div>
    @livewireScripts
</body>

</html>
