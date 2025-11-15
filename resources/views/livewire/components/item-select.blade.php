<div x-data="{ open: false, search: '' }" class="relative w-full" @click.away="open = false">
    <!-- Display Selected Name -->
    <div class="border mt-1 bg-white text-gray-900 border-red-300 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm px-3 py-2 cursor-pointer"
        @click="open = !open">
        <span x-data="{ selected: $wire.options.find(o => o.id == $wire.modelValue) }" x-init="$watch('$wire.modelValue', value => selected = $wire.options.find(o => o.id == value))"
            x-html="selected 
            ? (selected.name + ' <span class=&quot;text-sm&quot;> - ' + selected.description + '</span>') 
            : 'Select item...'">
        </span>
    </div>

    <!-- Dropdown -->
    <div x-show="open"
        class="absolute z-50 bg-gray-100 border border-red-500 w-full mt-1 rounded shadow max-h-60 overflow-hidden">
        <!-- Sticky Search -->
        <div class="sticky top-0 bg-gray-100 z-10">
            <input type="text" x-model="search" placeholder="Search..."
                class="w-full p-2 border bg-white text-gray-900 border-red-300 focus:border-red-500 focus:ring-red-500">
        </div>

        <!-- Scrollable Options -->
        <div class="overflow-y-auto max-h-48">
            <template
                x-for="option in $wire.options.filter(o =>
                    o.name.toLowerCase().includes(search.toLowerCase()) ||
                    (o.description || '').toLowerCase().includes(search.toLowerCase())
                )"
                :key="option.id">
                <div class="px-3 py-2 hover:bg-red-300 cursor-pointer"
                    @click="$wire.modelValue = option.id; open = false">
                    <div class="font-bold text-gray-900" x-text="option.name"></div>
                    <div class="text-sm text-gray-900" x-text="option.description"></div>
                </div>
            </template>
        </div>
    </div>
</div>
