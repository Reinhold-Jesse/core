<div x-data="{ open: false }" class="relative w-full">

    @if (!isset($type))
        <button @click.prevent="open = ! open"
            class="absolute top-0 right-0 flex items-center gap-3 px-4 py-2 text-gray-600 md:hidden hover:text-primary-500">
            <x:component::icon.hamburger />
        </button>
    @endif

    @if (!isset($start))
        <ul x-cloak class="items-center gap-3 md:flex" :class="open ? '' : 'hidden'" click.outside="open = false">
    @endif

    @foreach ($items as $item)
        @if (count($item->children) > 0)
            <li x-data="{ open: false }" class="relative">
                <button @click.prevent="open = ! open"
                    class="flex items-center gap-3 px-4 py-2 text-gray-600 hover:text-primary-500">{{ $item->title }}
                    <x:component::icon.arrow-down />
                </button>
                <ul x-cloak x-show="open" click.outside="open = false"
                    x-transition:enter="transition ease-out duration-100 transform"
                    x-transition:enter-start="opacity-0 scale-30" x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-75 transform"
                    x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                    {{-- class="relative z-50 flex flex-col mt-2 mb-3 bg-gray-300 rounded-md shadow-sm w-44" --}}
                    class="relative z-10 flex flex-col font-normal bg-white divide-y divide-gray-100 rounded shadow md:absolute w-44 dark:bg-gray-700 dark:divide-gray-600">
                    @include('component::template.menu.horizontal', [
                        'items' => $item->children,
                        'type' => 'children',
                        'start' => true,
                    ])
                </ul>
            </li>
        @else
            @if (isset($type) && $type == 'children')
                <li>
                    <a href="{{ isset($item->route) ? route($item->route) : url($item->url) }}"
                        class="block px-4 py-2 text-gray-600 hover:text-primary-500">{{ $item->title }}</a>
                </li>
            @else
                <li>
                    <a href="{{ isset($item->route) ? route($item->route) : url($item->url) }}"
                        class="block px-4 py-2 text-gray-600 hover:text-primary-500">{{ $item->title }}</a>
                </li>
            @endif
        @endif
    @endforeach

    @if (!isset($start))
        </ul>
    @endif


</div>
