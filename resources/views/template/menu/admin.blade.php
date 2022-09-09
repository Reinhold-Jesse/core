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
                <x:component::menu.dropdown-link
                    href="{{ isset($item->route) ? route($item->route) : url($item->url) }}">
                    {{ $item->title }}
                </x:component::menu.dropdown-link>
            @else
                <x:component::menu.link href="{{ isset($item->route) ? route($item->route) : url($item->url) }}">
                    {{ $item->title }}
                </x:component::menu.link>
            @endif
        @endif
    @endforeach
</div>
