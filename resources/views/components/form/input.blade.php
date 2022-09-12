@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' =>
        'py-3 px-5 w-full border-primary-300 focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-80 rounded-md outline-primary-300',
]) !!}>
