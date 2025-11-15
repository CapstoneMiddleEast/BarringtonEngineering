<div>
    <form wire:submit.prevent="save">
        <div class="md:grid grid-cols-4 gap-5 mb-6">
            <div>
                <x-input-label :value="__('Paid Date')" />
                <x-text-input type="date" class="mt-1 block w-full" required wire:model="paid_at" />
                <x-input-error class="mt-2" :messages="$errors->get('paid_at')" />
            </div>
            <div>
                <x-input-label :value="__('Invoice Number')" />
                <select required wire:model.live="invoice_id"
                    class="w-full text-gray-900 border-red-300 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm mt-1">
                    <option value="">Select invoice</option>
                    @foreach ($invoices as $inv)
                        <option value="{{ $inv->id }}">{{ $inv->invoice_no }}</option>
                    @endforeach
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('invoice_id')" />
            </div>
            <div>
                <x-input-label :value="__('Client Name')" />
                <select required wire:model="client_id" disabled readonly
                    class="w-full text-gray-900 border-red-300 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm mt-1 bg-gray-300">
                    <option value="">Select client</option>
                    @foreach ($clients as $client)
                        <option value="{{ $client->id }}">{{ $client->name }}</option>
                    @endforeach
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('client_id')" />
            </div>
            <div>
                <x-input-label :value="__('Amount')" />
                <x-price-input type="text" class="mt-1 block w-full" required wire:model="amount" />
                <x-input-error class="mt-2" :messages="$errors->get('amount')" />
            </div>
        </div>
        <div class="md:grid grid-cols-4 gap-5">
            <div>
                <x-input-label :value="__('Method')" />
                <select wire:model="method" required
                    class="w-full text-gray-900 border-red-300 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm mt-1 uppercase">
                    <option value="">Select One</option>
                    @foreach ($paymentOptions as $unit)
                        <option value="{{ $unit }}">{{ $unit }}</option>
                    @endforeach
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('method')" />
            </div>
            <div>
                <x-input-label :value="__('Txn/Ref No')" />
                <x-text-input type="text" class="mt-1 block w-full" wire:model="reference" />
                <x-input-error class="mt-2" :messages="$errors->get('reference')" />
            </div>
            <div class="col-span-2">
                <x-input-label :value="__('Notes')" />
                <x-text-input type="text" class="mt-1 block w-full" wire:model="notes" />
                <x-input-error class="mt-2" :messages="$errors->get('notes')" />
            </div>
        </div>
        <div class="mt-6">
            <x-primary-button>{{ __('Save Receipt') }}</x-primary-button>
        </div>
    </form>
</div>
