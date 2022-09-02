@props(['disabled' => false])
<select {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' =>
        'py-3 px-5 w-full border-gray-300 focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 rounded-md',
]) !!}>
    {{ $slot }}
</select>
