@props(['disabled' => false])
<select {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' =>
        'outline-teal-300 py-3 px-5 w-full border-teal-300 focus:border-teal-300 focus:ring focus:ring-teal-200 focus:ring-opacity-70 rounded-md',
]) !!}>
    {{ $slot }}
</select>
