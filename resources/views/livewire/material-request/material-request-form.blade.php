<div>
    <form wire:submit.prevent="save">
        <div class="md:grid grid-cols-4 gap-5 mb-6">
            <div>
                <x-input-label :value="__('Requested Date')" />
                <x-text-input type="date" class="mt-1 block w-full" required wire:model="requested_date" />
                <x-input-error class="mt-2" :messages="$errors->get('requested_date')" />
            </div>
            <div>
                <x-input-label :value="__('Project')" />
                <x-text-input type="text" class="mt-1 block w-full" required wire:model="project" />
                <x-input-error class="mt-2" :messages="$errors->get('project')" />
            </div>
            <div class="col-span-2">
                <x-input-label :value="__('Purpose of Use')" />
                <x-text-input type="text" class="mt-1 block w-full" required wire:model="purpose_of_use" />
                <x-input-error class="mt-2" :messages="$errors->get('purpose_of_use')" />
            </div>
        </div>
        @foreach ($items as $index => $item)
            <div class="bg-gray-100 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-white">
                    <div class="md:grid grid-cols-4 gap-5 mb-6">
                        <div>
                            <x-input-label :value="__('Material Name')" />
                            <select wire:model="items.{{ $index }}.material_name" required
                                class="w-full text-gray-900 border-red-300 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm mt-1">
                                <option value="">-- Select --</option>
                                @foreach ($materialOptions as $mat)
                                    <option value="{{ $mat }}">{{ $mat }}</option>
                                @endforeach
                            </select>
                            @error('items.' . $index . '.material_name')
                                <span class="text-red-500">{{ $message }}</span>
                                <x-input-error class="mt-2" :messages="$message" />
                            @enderror
                        </div>
                        <div>
                            <x-input-label :value="__('Description')" />
                            <x-text-input type="text" class="mt-1 block w-full" required
                                wire:model="items.{{ $index }}.material_description" />
                            @error('items.' . $index . '.material_description')
                                <span class="text-red-500">{{ $message }}</span>
                                <x-input-error class="mt-2" :messages="$message" />
                            @enderror
                        </div>
                        <div class="inline-flex gap-5">
                            <div>
                                <x-input-label :value="__('Quantity')" />
                                <x-text-input type="number" class="mt-1 block w-full" required
                                    wire:model="items.{{ $index }}.quantity" />
                                @error('items.' . $index . '.quantity')
                                    <span class="text-red-500">{{ $message }}</span>
                                    <x-input-error class="mt-2" :messages="$message" />
                                @enderror
                            </div>
                            <div>
                                <x-input-label :value="__('Unit')" />
                                <select wire:model="items.{{ $index }}.unit" required
                                    class="w-32 text-gray-900 border-red-300 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm mt-1">
                                    <option value="">-- Select --</option>
                                    @foreach ($unitOptions as $unit)
                                        <option value="{{ $unit }}">{{ $unit }}</option>
                                    @endforeach
                                </select>
                                @error('items.' . $index . '.unit')
                                    <span class="text-red-500">{{ $message }}</span>
                                    <x-input-error class="mt-2" :messages="$message" />
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="md:grid grid-cols-4 gap-5 mb-6">
                        <div>
                            <x-input-label :value="__('Date Needed')" />
                            <x-text-input type="date" class="mt-1 block w-full" required
                                wire:model="items.{{ $index }}.date_needed" />
                            @error('items.' . $index . '.date_needed')
                                <span class="text-red-500">{{ $message }}</span>
                                <x-input-error class="mt-2" :messages="$message" />
                            @enderror
                        </div>
                        <div>
                            <x-input-label :value="__('Scope of Work')" />
                            <x-text-input type="text" class="mt-1 block w-full" required
                                wire:model="items.{{ $index }}.scope_of_work" />
                            @error('items.' . $index . '.scope_of_work')
                                <span class="text-red-500">{{ $message }}</span>
                                <x-input-error class="mt-2" :messages="$message" />
                            @enderror
                        </div>
                        <div>
                            <x-input-label :value="__('Project Location')" />
                            <x-text-input type="text" class="mt-1 block w-full" required
                                wire:model="items.{{ $index }}.project_location" />
                            @error('items.' . $index . '.project_location')
                                <span class="text-red-500">{{ $message }}</span>
                                <x-input-error class="mt-2" :messages="$message" />
                            @enderror
                        </div>
                        <div class="flex items-end">
                            @if (count($items) > 1)
                                <x-red-button wire:click="removeItem({{ $index }})">Remove Item</x-red-button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="mt-6">
            <x-green-button wire:click="addItem">Add More Item</x-green-button>
            <x-primary-button class="ml-2">{{ __('Save') }}</x-primary-button>
        </div>
    </form>
</div>
