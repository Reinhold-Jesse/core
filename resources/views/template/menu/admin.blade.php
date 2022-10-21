<div>
    @foreach ($items as $item)
        @if (count($item->children) > 0)
            <x:component::menu.dropdown>
                <x-slot:trigger>{{ $item->title }}</x-slot:trigger>

                <x-slot:content>
                    @include('component::template.menu.admin', [
                        'items' => $item->children,
                        'type' => 'children',
                    ])
                </x-slot:content>
            </x:component::menu.dropdown>
        @else
            @if (isset($type) && $type == 'children')
                @if (isset($item->route))
                    @if (Route::has($item->route))
                        <x:component::menu.dropdown-link href="{{ route($item->route) }}">
                            {{ $item->title }}
                        </x:component::menu.dropdown-link>
                    @endif
                @else
                    <x:component::menu.dropdown-link href="{{ url($item->url) }}">
                        {{ $item->title }}
                    </x:component::menu.dropdown-link>
                @endif
            @else
                @if (isset($item->route))
                    @if (Route::has($item->route))
                        <x:component::menu.link href="{{ route($item->route) }}" target="{{ $item->target }}">
                            {{ $item->title }}
                        </x:component::menu.link>
                    @endif
                @else
                    <x:component::menu.link href="{{ url($item->url) }}" target="{{ $item->target }}">
                        {{ $item->title }}
                    </x:component::menu.link>
                @endif
            @endif
        @endif
    @endforeach
</div>
