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
    <script defer src="https://unpkg.com/alpinejs@3.10.3/dist/cdn.min.js"></script>

    <style>
        [x-cloak] {
            display: none !important;
        }

        #toast.show {
            visibility: visible;
            -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
            animation: fadein 0.5s, fadeout 0.5s 2.5s;
        }

        #toast {
            visibility: hidden;
            min-width: 400px;
            margin-left: -200px;
            background-color: #333;
            color: #fff;
            text-align: center;
            border-radius: 2px;
            padding: 16px;
            position: fixed;
            z-index: 1;
            left: 50%;
            bottom: 30px;
            font-size: 17px;
        }

        @keyframes fadein {
            opacity: 'show';
        }
    </style>
</head>

<body class="py-12 antialiased bg-gray-200">

    <div class="container mx-auto">
        <div class="grid grid-cols-1 gap-7">
            @if (is_array($content))
                <h2
                    class="mb-3 text-4xl font-extrabold leading-none text-center text-gray-900 md:text-5xl xl:text-6xl dark:text-white">
                    Blade Komponente übersicht</h2>
                @foreach ($content as $element)
                    <div class="bg-gray-100 border p-7">
                        @if (is_array($element))
                            {{-- is array --}}
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
                                    {{-- icons --}}
                                    <div class="grid grid-cols-3 gap-5">
                                        @foreach ($element['date'] as $value)
                                            <div class="px-5 py-3 ">
                                                <div class="flex items-center gap-5 mb-3">
                                                    <p class="py-3">{{ $value }}</p>
                                                    <code
                                                        class="px-3 py-1 text-sm text-white bg-teal-500 rounded-full shadow-sm cursor-pointer hover:bg-teal-600">
                                                        &lt;x:component::{{ $element['name'] }}.{{ $value }}
                                                        /&gt;
                                                    </code>
                                                </div>

                                                <?php try{ ?>
                                                <x-dynamic-component :component="'component::' . $element['name'] . '.' . $value" />
                                                <?php }catch(\Exception $e){ ?>
                                                <p class="text-red-500">Vorschau laden nicht möglich da diese Komponente
                                                    Parameter erwarten.</p>
                                                <?php } ?>

                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    @foreach ($element['date'] as $value)
                                        <div class="px-5 py-3 ">
                                            <div class="flex items-center gap-5 mb-3">
                                                <p class="py-3">{{ $value }}</p>
                                                <code
                                                    class="px-3 py-1 text-sm text-white bg-teal-500 rounded-full shadow-sm cursor-pointer hover:bg-teal-600">
                                                    &lt;x:component::{{ $element['name'] }}.{{ $value }} /&gt;
                                                </code>
                                            </div>


                                            <?php try{ ?>
                                            <x-dynamic-component :component="'component::' . $element['name'] . '.' . $value" />
                                            <?php }catch(\Exception $e){ ?>
                                            <p class="text-red-500">Vorschau laden nicht möglich da diese Komponente
                                                Parameter erwarten.</p>
                                            <?php } ?>

                                            {{-- <x-dynamic-component :component="'component::' . $element['name'] . '.' . $value" /> --}}
                                        </div>
                                    @endforeach
                                @endif
                            @endif
                        @else
                            {{-- single file --}}
                            <div class="px-5 py-3 ">
                                <p class="py-3">{{ $element }}</p>

                                <?php try{ ?>
                                <x-dynamic-component :component="'form.' . $element" />
                                <?php }catch(\Exception $e){ ?>
                                <p class="text-red-500">Vorschau laden nicht möglich</p>
                                <?php } ?>

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

    <div id="toast">Snippet in die Zwischenablage kopiert.</div>


    @livewireScripts


    <script>
        'use strict';

        (() => {

            // === DOM & VARS ===
            const DOM = {};
            DOM.code = document.querySelectorAll('code')
            // === INIT =========

            const init = () => {
                copyByClick()
            }

            // === EVENTS / XHR =======

            // === FUNCTIONS ====
            let copyByClick = () => {

                Array.from(DOM.code).forEach((element) => {
                    element.addEventListener('click', (event) => {
                        event.preventDefault();
                        navigator.clipboard.writeText(event.target.innerText).then(() => {
                            const x = document.getElementById("toast");
                            x.className = "show";
                            setTimeout(() => {
                                x.className = x.className.replace("show", "");
                            }, 3000);
                        });
                    });
                })
            }
            init();

        })();
    </script>
</body>

</html>
