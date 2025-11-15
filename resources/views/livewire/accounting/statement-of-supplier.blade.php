<div>
    <form wire:submit.prevent="getSOA">
        <div class="md:grid grid-cols-4 gap-5 mb-6">
            <div>
                <x-input-label :value="__('Supplier Name')" />
                <select required wire:model="supplierId" required
                    class="w-full text-gray-900 border-red-300 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm mt-1">
                    <option value="">Select client</option>
                    @foreach ($suppliers as $supplier)
                        <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                    @endforeach
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('supplierId')" />
            </div>
            <div>
                <x-input-label :value="__('From Date')" />
                <x-text-input type="date" class="mt-1 block w-full" required wire:model="fromDate" />
                <x-input-error class="mt-2" :messages="$errors->get('fromDate')" />
            </div>
            <div>
                <x-input-label :value="__('To Date')" />
                <x-text-input type="date" class="mt-1 block w-full" required wire:model="toDate" />
                <x-input-error class="mt-2" :messages="$errors->get('toDate')" />
            </div>
            <div class="mt-7">
                <x-primary-button>{{ __('Generate SOA') }}</x-primary-button>
            </div>
        </div>
    </form>
</div>
