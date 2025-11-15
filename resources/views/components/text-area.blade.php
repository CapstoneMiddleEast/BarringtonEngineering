@props(['disabled' => false])

<textarea @disabled($disabled)
    {{ $attributes->merge(['class' => 'text-gray-900 border-red-300 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm bg-white']) }}>{{ $slot }}</textarea>
