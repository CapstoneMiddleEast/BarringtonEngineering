<div>
    @if ($errors->any())
        <x-error-alert :errors="$errors" />
    @endif
    <form wire:submit.prevent="save" wire:confirm="Please click 'Calculate Totals' and verify all totals before saving.">
        <div class="md:grid grid-cols-5 gap-5 mb-6">
            <div>
                <x-input-label :value="__('Invoice No')" />
                <x-text-input type="text" class="mt-1 block w-full" required wire:model="invoice_no" />
                <x-input-error class="mt-2" :messages="$errors->get('invoice_no')" />
            </div>
            <div>
                <x-input-label for="client_id" :value="__('Client Name')" />
                <select wire:model.live="client_id"
                    class="w-full text-gray-900 border-red-300 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm mt-1">
                    <option value="">Select Client</option>
                    @foreach ($clients as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('client_id')" />
            </div>
            <div>
                <x-input-label :value="__('Invoice Date')" />
                <x-text-input type="date" class="mt-1 block w-full" required wire:model.live="invoice_date" />
                <x-input-error class="mt-2" :messages="$errors->get('invoice_date')" />
            </div>
            <div>
                <x-input-label :value="__('Client Invoice')" />
                <x-text-input type="text" class="mt-1 block w-full" required wire:model.live="client_invoice" />
                <x-input-error class="mt-2" :messages="$errors->get('client_invoice')" />
            </div>
            <div>
                <x-input-label :value="__('LPO Number')" />
                <x-text-input type="text" class="mt-1 block w-full" required wire:model.live="lpo_no" />
                <x-input-error class="mt-2" :messages="$errors->get('lpo_no')" />
            </div>
        </div>
        @foreach ($items as $index => $item)
            <div class="bg-gray-100 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6"
                wire:key="item-{{ $index }}">
                <div class="p-6 text-white">
                    <div class="md:grid grid-cols-5 gap-5 mb-6">
                        <div class="col-span-2">
                            <x-input-label :value="__('Item Code')" />
                            <div wire:cloak>
                                <livewire:components.item-select wire:model.live="items.{{ $index }}.item_id"
                                    :wire:key="'select-'.$index" />
                            </div>
                            @error('items.' . $index . '.item_id')
                                <span class="text-red-500">{{ $message }}</span>
                                <x-input-error class="mt-2" :messages="$message" />
                            @enderror
                        </div>
                        <div>
                            <x-input-label :value="__('Delivery Date')" />
                            <x-text-input type="date" class="mt-1 block w-full" required
                                wire:model.live="items.{{ $index }}.delivery_date" />
                            @error('items.' . $index . '.delivery_date')
                                <span class="text-red-500">{{ $message }}</span>
                                <x-input-error class="mt-2" :messages="$message" />
                            @enderror
                        </div>
                        <div>
                            <x-input-label :value="__('Delivery Point')" />
                            <x-text-input type="text" class="mt-1 block w-full" required
                                wire:model.live="items.{{ $index }}.delivery_point" />
                            @error('items.' . $index . '.delivery_point')
                                <span class="text-red-500">{{ $message }}</span>
                                <x-input-error class="mt-2" :messages="$message" />
                            @enderror
                        </div>
                        <div>
                            <x-input-label :value="__('Do No')" />
                            <x-text-input type="text" class="mt-1 block w-full" required
                                wire:model.live="items.{{ $index }}.do_no" />
                            @error('items.' . $index . '.do_no')
                                <span class="text-red-500">{{ $message }}</span>
                                <x-input-error class="mt-2" :messages="$message" />
                            @enderror
                        </div>
                    </div>
                    <div class="md:grid grid-cols-6 gap-5 mb-6">
                        <div>
                            <x-input-label :value="__('Ticket No')" />
                            <x-text-input type="text" class="mt-1 block w-full" required
                                wire:model.live="items.{{ $index }}.ticket_no" />
                            @error('items.' . $index . '.ticket_no')
                                <span class="text-red-500">{{ $message }}</span>
                                <x-input-error class="mt-2" :messages="$message" />
                            @enderror
                        </div>
                        <div>
                            <x-input-label :value="__('Quantity')" />
                            <x-text-input type="text" class="mt-1 block w-full" required
                                wire:model.live="items.{{ $index }}.quantity" />
                            @error('items.' . $index . '.quantity')
                                <span class="text-red-500">{{ $message }}</span>
                                <x-input-error class="mt-2" :messages="$message" />
                            @enderror
                        </div>
                        <div>
                            <x-input-label :value="__('Unit')" />
                            <select wire:model.live="items.{{ $index }}.unit" required
                                class="w-full text-gray-900 border-red-300 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm mt-1 uppercase">
                                <option value="">Select One</option>
                                @foreach ($unitOptions as $unit)
                                    <option value="{{ $unit }}">{{ $unit }}</option>
                                @endforeach
                            </select>
                            @error('items.' . $index . '.unit')
                                <span class="text-red-500">{{ $message }}</span>
                                <x-input-error class="mt-2" :messages="$message" />
                            @enderror
                        </div>
                        <div>
                            <x-input-label :value="__('Vehicle No')" />
                            <x-text-input type="text" class="mt-1 block w-full" required
                                wire:model.live="items.{{ $index }}.vehicle_no" />
                            @error('items.' . $index . '.vehicle_no')
                                <span class="text-red-500">{{ $message }}</span>
                                <x-input-error class="mt-2" :messages="$message" />
                            @enderror
                        </div>
                        <div>
                            <x-input-label :value="__('Client Unit Price')" />
                            <x-price-input type="text" class="mt-1 block w-full" required
                                wire:model.live="items.{{ $index }}.client_unit_price" />
                            @error('items.' . $index . '.client_unit_price')
                                <span class="text-red-500">{{ $message }}</span>
                                <x-input-error class="mt-2" :messages="$message" />
                            @enderror
                        </div>
                        <div>
                            <x-input-label :value="__('Client VAT in %')" />
                            <x-price-input type="text" class="mt-1 block w-full" required
                                wire:model.live="items.{{ $index }}.client_vat" />
                            @error('items.' . $index . '.client_vat')
                                <span class="text-red-500">{{ $message }}</span>
                                <x-input-error class="mt-2" :messages="$message" />
                            @enderror
                        </div>
                    </div>
                    <div class="inline-flex gap-5 items-center">
                        <p class="text-gray-900 dark:text-white ">Total: <span class="font-bold">AED
                                {{ $item['client_total_price'] ?? 0 }}</span></p>
                        <p class="text-gray-900 dark:text-white">Total With VAT: <span class="font-bold">AED
                                {{ $item['client_total_price_vat'] ?? 0 }}</span></p>
                    </div>
                    @foreach ($item['suppliers'] as $sIndex => $supplier)
                        <div class="border-t border-b border-dashed rounded-lg border-slate-500 py-5 mt-6"
                            wire:key="supplier-{{ $index }}-{{ $sIndex }}">
                            <div class="md:grid grid-cols-5 gap-5 mb-6">
                                <div>
                                    <x-input-label :value="__('Supplier Name')" />
                                    <select required
                                        wire:model.live="items.{{ $index }}.suppliers.{{ $sIndex }}.supplier_id"
                                        class="w-full text-gray-900 border-red-300 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm mt-1">
                                        <option value="">Select Supplier</option>
                                        @foreach ($suppliers as $sup)
                                            <option value="{{ $sup->id }}">{{ $sup->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <x-input-label :value="__('Supplier Invoice')" />
                                    <x-text-input type="text" class="mt-1 block w-full" required
                                        wire:model.live="items.{{ $index }}.suppliers.{{ $sIndex }}.supplier_invoice" />
                                    @error('items.' . $index . '.suppliers.' . $sIndex . '.supplier_invoice')
                                        <span class="text-red-500">{{ $message }}</span>
                                        <x-input-error class="mt-2" :messages="$message" />
                                    @enderror
                                </div>
                                <div>
                                    <x-input-label :value="__('Supplier Unit Price')" />
                                    <x-price-input type="text" class="mt-1 block w-full" required
                                        wire:model.live="items.{{ $index }}.suppliers.{{ $sIndex }}.supplier_unit_price" />
                                    @error('items.' . $index . '.suppliers.' . $sIndex . '.supplier_unit_price')
                                        <span class="text-red-500">{{ $message }}</span>
                                        <x-input-error class="mt-2" :messages="$message" />
                                    @enderror
                                </div>
                                <div>
                                    <x-input-label :value="__('Quantity')" />
                                    <x-text-input type="text" class="mt-1 block w-full" required
                                        wire:model.live="items.{{ $index }}.suppliers.{{ $sIndex }}.supplier_quantity" />
                                    @error('items.' . $index . '.suppliers.' . $sIndex . '.supplier_quantity')
                                        <span class="text-red-500">{{ $message }}</span>
                                        <x-input-error class="mt-2" :messages="$message" />
                                    @enderror
                                </div>
                                <div>
                                    <x-input-label :value="__('Supplier VAT in %')" />
                                    <x-price-input type="text" class="mt-1 block w-full" required
                                        wire:model.live="items.{{ $index }}.suppliers.{{ $sIndex }}.supplier_vat" />
                                    @error('items.' . $index . '.suppliers.' . $sIndex . '.supplier_vat')
                                        <span class="text-red-500">{{ $message }}</span>
                                        <x-input-error class="mt-2" :messages="$message" />
                                    @enderror
                                </div>
                            </div>
                            <div class="inline-flex gap-5 items-center">
                                <p class="text-gray-900 dark:text-white ">Total: <span class="font-bold">AED
                                        {{ $supplier['supplier_total_price'] ?? 0 }}</span></p>
                                <p class="text-gray-900 dark:text-white">Total With VAT: <span class="font-bold">AED
                                        {{ $supplier['supplier_total_price_vat'] ?? 0 }}</span></p>
                                <x-red-button
                                    wire:click="removeSupplier({{ $index }}, {{ $sIndex }})">Remove
                                    Supplier</x-red-button>
                            </div>
                        </div>
                    @endforeach
                    <div class="mt-6">
                        <x-green-button wire:click="addSupplier({{ $index }})">Add Supplier</x-green-button>
                        @if (count($items) > 1)
                            <x-red-button wire:click="removeItem({{ $index }})">Remove Item</x-red-button>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
        <div class="mt-6">
            <x-green-button wire:click="addItem">Add More Item</x-green-button>
            <x-blue-button class="ml-2" wire:click="calculateTotals">Calculate Totals</x-blue-button>
            <x-primary-button class="ml-2">{{ __('Save Invoice') }}</x-primary-button>
        </div>
    </form>
</div>
