<div>
    @if ($errors->any())
        <x-error-alert :errors="$errors" />
    @endif
    <form wire:submit.prevent="save" enctype="multipart/form-data">
        <div class="bg-gray-100 dark:bg-gray-800 shadow-sm sm:rounded-lg mb-6">
            <div class="p-6 text-white">
                <div class="md:grid grid-cols-5 gap-5 pr-12">
                    <x-input-label class="col-span-2" :value="__('Item Code')" />
                    <x-input-label :value="__('Quantity (Unit)')" />
                    <x-input-label :value="__('Buying Price')" />
                    <x-input-label :value="__('Selling Price')" />
                </div>
                @foreach ($itemCodeData as $index => $item)
                    <div class="md:grid grid-cols-5 gap-5 pr-12 mb-2 relative" wire:key="item-{{ $index }}">
                        <div class="col-span-2">
                            <div wire:cloak>
                                <livewire:components.item-select
                                    wire:model.live="itemCodeData.{{ $index }}.item_code"
                                    :wire:key="'select-'.$index" />
                            </div>
                            @error('itemCodeData.' . $index . '.item_code')
                                <span class="text-red-500">{{ $message }}</span>
                                <x-input-error class="mt-2" :messages="$message" />
                            @enderror
                        </div>
                        <div class="flex gap-5">
                            <div>
                                <x-text-input type="text" class="mt-1 block w-full" required
                                    wire:model.live="itemCodeData.{{ $index }}.quantity" />
                                @error('itemCodeData.' . $index . '.quantity')
                                    <span class="text-red-500">{{ $message }}</span>
                                    <x-input-error class="mt-2" :messages="$message" />
                                @enderror
                            </div>
                            <div>
                                <select wire:model.live="itemCodeData.{{ $index }}.unit" required
                                    class="w-24 text-gray-900 border-red-300 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm mt-1 uppercase">
                                    <option value="">Select One</option>
                                    @foreach ($unitOptions as $unit)
                                        <option value="{{ $unit }}">{{ $unit }}</option>
                                    @endforeach
                                </select>
                                @error('itemCodeData.' . $index . '.unit')
                                    <span class="text-red-500">{{ $message }}</span>
                                    <x-input-error class="mt-2" :messages="$message" />
                                @enderror
                            </div>
                        </div>
                        <div>
                            <x-price-input type="text" class="mt-1 block w-full" required
                                wire:model.live="itemCodeData.{{ $index }}.buying_price" />
                            @error('itemCodeData.' . $index . '.buying_price')
                                <span class="text-red-500">{{ $message }}</span>
                                <x-input-error class="mt-2" :messages="$message" />
                            @enderror
                        </div>
                        <div>
                            <x-price-input type="text" class="mt-1 block w-full" required
                                wire:model.live="itemCodeData.{{ $index }}.selling_price" />
                            @error('itemCodeData.' . $index . '.selling_price')
                                <span class="text-red-500">{{ $message }}</span>
                                <x-input-error class="mt-2" :messages="$message" />
                            @enderror
                        </div>
                        @if (count($itemCodeData) > 1)
                            <x-badge.trash-icon class="mr-0 absolute right-0 top-2 cursor-pointer"
                                wire:click="removeItem({{ $index }})" />
                        @endif
                    </div>
                @endforeach
                <div class="mt-6">
                    <x-green-button wire:click="addItem">Add More Item</x-green-button>
                </div>
            </div>
        </div>
        <div class="bg-gray-100 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
            <div class="p-6 text-white">
                <div class="md:grid grid-cols-4 gap-5 mb-5">
                    <div>
                        <x-input-label :value="__('Date Received')" />
                        <x-text-input type="date" class="mt-1 block w-full" required
                            wire:model.live="inquiry_date_received" />
                        <x-input-error class="mt-2" :messages="$errors->get('inquiry_date_received')" />
                    </div>
                    <div>
                        @if ($users->isNotEmpty())
                            <x-input-label :value="__('Assigned sales person')" />
                            <select wire:model="assigned_sales_person_id"
                                class="w-full text-gray-900 border-red-300 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm mt-1">
                                <option value="">Select One</option>
                                @foreach ($users as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('assigned_sales_person_id')" />
                        @endif
                    </div>
                    <div>
                        <x-input-label :value="__('Quotation revision')" />
                        <select wire:model.live="quotation_revision"
                            class="w-full text-gray-900 border-red-300 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm mt-1">
                            <option value="">None</option>
                            @foreach ($revisions as $revision)
                                <option value="{{ $revision }}">{{ $revision }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <x-input-label for="date_sent_quotation_to_client" :value="__('Date quotation sent')" />
                        <x-text-input type="date" class="mt-1 block w-full"
                            wire:model.live="date_sent_quotation_to_client" />
                        <x-input-error class="mt-2" :messages="$errors->get('date_sent_quotation_to_client')" />
                    </div>
                </div>
                <div class="md:grid grid-cols-4 gap-5 mb-5">
                    <div class="col-span-3">
                        <x-input-label :value="__('Delivery point')" />
                        <x-text-input wire:model.live="delivery_point" type="text" class="mt-1 block w-full"
                            required />
                        <x-input-error class="mt-2" :messages="$errors->get('delivery_point')" />
                    </div>
                    <div>
                        <x-input-label :value="__('Quotation status')" />
                        <select wire:model.live="quotation_status"
                            class="w-full text-gray-900 border-red-300 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm mt-1">
                            <option value="">Select One</option>
                            @foreach ($status as $stat)
                                <option value="{{ $stat }}">{{ $stat }}</option>
                            @endforeach
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('quotation_status')" />
                    </div>
                </div>
                <div class="md:grid grid-cols-4 gap-5 mb-5">
                    <div>
                        <x-input-label :value="__('Client name')" />
                        <x-text-input wire:model.live="client_name" type="text" class="mt-1 block w-full" required />
                        <x-input-error class="mt-2" :messages="$errors->get('client_name')" />
                    </div>
                    <div>
                        <x-input-label :value="__('Contact person')" />
                        <x-text-input wire:model.live="contact_person" type="text" class="mt-1 block w-full"
                            required />
                        <x-input-error class="mt-2" :messages="$errors->get('contact_person')" />
                    </div>
                    <div>
                        <x-input-label :value="__('Email Id')" />
                        <x-text-input wire:model.live="email" type="text" class="mt-1 block w-full" />
                        <x-input-error class="mt-2" :messages="$errors->get('email')" />
                    </div>
                    <div>
                        <x-input-label for="contact_no" :value="__('Contact Number')" />
                        <x-phone-input wire:model.live="contact_no" type="text" class="mt-1 block w-full" required />
                        <x-input-error class="mt-2" :messages="$errors->get('contact_no')" />
                    </div>
                </div>
                <div class="md:grid grid-cols-4 gap-5">
                    <div class="col-span-3">
                        <x-input-label :value="__('Remark')" />
                        <x-text-input wire:model.live="remark" type="text" class="mt-1 block w-full" />
                        <x-input-error class="mt-2" :messages="$errors->get('remark')" />
                    </div>
                    <div>
                        <x-input-label :value="__('Payment Terms')" />
                        <x-text-input wire:model.live="payment_terms" type="text" class="mt-1 block w-full" />
                        <x-input-error class="mt-2" :messages="$errors->get('payment_terms')" />
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-gray-100 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
            <div class="p-6 text-white">
                <div class="md:grid grid-cols-4 gap-5">
                    <div>
                        <x-input-label :value="__('Follow up date')" />
                        <x-text-input type="date" class="mt-1 block w-full"
                            wire:model.live="date_follow_up_to_client" />
                        <x-input-error class="mt-2" :messages="$errors->get('date_follow_up_to_client')" />
                    </div>
                    <div class="col-span-3">
                        <x-input-label :value="__('Follow up')" />
                        <x-text-input wire:model.live="follow_up" type="text" class="mt-1 block w-full" />
                        <x-input-error class="mt-2" :messages="$errors->get('follow_up')" />
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-gray-100 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
            <div class="p-6 text-white">
                <div class="md:grid grid-cols-4 gap-5">
                    <div>
                        <x-input-label :value="__('Lpo received')" />
                        <select wire:model.live="lpo_received"
                            class="w-full text-gray-900 border-red-300 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm mt-1">
                            <option value="">Select One</option>
                            <option value="YES">YES</option>
                            <option value="NO">NO</option>
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('lpo_received')" />
                    </div>
                    <div>
                        <x-input-label :value="__('Lpo Number')" />
                        <x-text-input wire:model.live="lpo_received_text" type="text" class="mt-1 block w-full" />
                        <x-input-error class="mt-2" :messages="$errors->get('lpo_received_text')" />
                    </div>
                    <div>
                        <x-input-label :value="__('Lpo Document')" />
                        <x-text-input wire:model.live="lpo_doc" type="file"
                            class="mt-1 block w-full block mt-1 block w-full text-sm text-gray-900 border-red-300 border rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400   " />
                        <x-input-error class="mt-2" :messages="$errors->get('lpo_doc')" />
                        @if ($lpo_doc)
                            <x-link href="{{ Storage::url($lpo_doc) }}" target="_blank">Show
                                Uploaded LPO Document</x-link>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-6">
            <x-primary-button>{{ $mode === 'update' ? 'Update' : 'Create' }} Enquiry</x-primary-button>
        </div>
    </form>
</div>
