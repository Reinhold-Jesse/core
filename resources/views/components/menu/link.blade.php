@props(['target' => null])

<a {{ $attributes->merge(['class' => 'block py-3 text-gray-600 transition-all duration-200 ease-linear hover:text-primary-500']) }}
    @if ($target == '_blank') target="_blank" @endif>{{ $slot }}</a>
