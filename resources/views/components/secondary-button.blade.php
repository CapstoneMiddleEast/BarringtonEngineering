<button
    {{ $attributes->merge(['type' => 'button', 'class' => 'focus:outline-none text-gray-900 bg-gray-300 hover:bg-gray-400 focus:ring-4 focus:ring-gray-500 font-bold rounded-lg text-sm px-5 py-2.5 mb-2 uppercase']) }}>
    {{ $slot }}
</button>