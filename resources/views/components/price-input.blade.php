@props(['disabled' => false])
<div class="relative">
    <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none">
        <button
            class="flex-shrink-0 z-10 inline-flex items-center py-2.5 px-4 text-sm font-medium text-center text-gray-900 bg-gray-100 border border-gray-300 rounded-s-lg hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100"
            type="button">
            AED
        </button>
    </div>
    <input @disabled($disabled)
        {{ $attributes->merge(['class' => 'text-gray-900 border-red-300 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm pl-16']) }}>

</div>
