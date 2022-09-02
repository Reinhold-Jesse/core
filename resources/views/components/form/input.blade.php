@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' =>
        'py-3 px-5 w-full border-teal-300 focus:border-teal-300 focus:ring focus:ring-teal-200 focus:ring-opacity-80 rounded-md outline-teal-300',
]) !!}>
