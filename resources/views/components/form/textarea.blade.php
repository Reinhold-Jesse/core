@props(['value' => false])

<textarea rows="5" cols="5"
    {{ $attributes->merge(['class' => 'outline-teal-300 py-3 px-5 w-full border-teal-300 rounded-md focus:border-teal-300 focus:ring focus:ring-teal-200 focus:ring-opacity-70']) }}>{{ $value }}</textarea>
