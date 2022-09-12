@props(['disabled' => false])
<select {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' =>
        'outline-primary-300 py-3 px-5 w-full border-primary-300 focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-70 rounded-md',
]) !!}>
    {{ $slot }}
</select>
