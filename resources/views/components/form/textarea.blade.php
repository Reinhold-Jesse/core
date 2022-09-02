@props(['value' => false])

<textarea rows="5" cols="5"
    {{ $attributes->merge(['class' => 'py-3 px-5 w-full border-gray-300 rounded-md focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50']) }}>{{ $value }}</textarea>
