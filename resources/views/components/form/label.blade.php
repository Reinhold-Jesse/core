@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-gray-700 mb-3 ml-2']) }}>
    {{ $value ?? $slot }}
</label>
