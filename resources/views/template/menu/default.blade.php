<ul>
    @foreach ($items as $item)
        <li>
            @if (count($item->children) > 0)
                {{ trim($item->title) }}

                @include('component::template.menu.default', [
                    'items' => $item->children,
                    'type' => 'children',
                ])
            @else
                <a href="{{ isset($item->route) ? route($item->route) : url($item->url) }}">{{ $item->title }}</a>
            @endif
        </li>
    @endforeach
</ul>
