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
                @if (isset($item->route))
                    @if (Route::has($item->route))
                        <a href="{{ route($item->route) }}">{{ $item->title }}</a>
                    @endif
                @else
                    <a href="{{ url($item->url) }}">{{ $item->title }}</a>
                @endif
            @endif
        </li>
    @endforeach
</ul>
