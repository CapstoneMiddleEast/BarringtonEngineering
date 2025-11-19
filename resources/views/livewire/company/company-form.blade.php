<div>
    @if ($errors->any())
        <x-error-alert :errors="$errors" />
    @endif
    <form wire:submit.prevent="save" enctype="multipart/form-data">
        <div class="md:grid grid-cols-4 gap-5 mb-6">
            <div>
                <x-input-label :value="__('Code')" />
                <x-text-input type="text" class="mt-1 block w-full" required wire:model="code" />
                <x-input-error class="mt-2" :messages="$errors->get('code')" />
            </div>
            <div>
                <x-input-label :value="__('Name')" />
                <x-text-input type="text" class="mt-1 block w-full" required wire:model="name" />
               <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>
            <div class="col-span-2">
                <x-input-label :value="__('Description')" />
                <x-text-input type="text" class="mt-1 block w-full" wire:model="description" />
                <x-input-error class="mt-2" :messages="$errors->get('description')" />
            </div>
        </div>
        <div class="md:grid grid-cols-4 gap-5 mb-6">
            <div>
                <x-input-label :value="__('TRN No')" />
                <x-text-input type="text" class="mt-1 block w-full" required wire:model="cmp_trnno" />
                <x-input-error class="mt-2" :messages="$errors->get('cmp_trnno')" />
            </div>
            <div>
               <x-input-label :value="__('Contact Person')" />
                <x-text-input type="text" class="mt-1 block w-full" required wire:model="cmp_contact_person" />
                <x-input-error class="mt-2" :messages="$errors->get('cmp_contact_person')" />
            </div>
            <div>
                <x-input-label :value="__('Contact No')" />
                <x-text-input type="text" class="mt-1 block w-full" wire:model="cmp_contact_no" />
                <x-input-error class="mt-2" :messages="$errors->get('cmp_contact_no')" />
            </div>
            <div>
               <x-input-label :value="__('License No')" />
                <x-text-input type="text" class="mt-1 block w-full" required wire:model="cmp_license_no" />
                <x-input-error class="mt-2" :messages="$errors->get('cmp_license_no')" />
            </div>
        </div>
        <div class="md:grid grid-cols-2 gap-5 mb-6">
            <div class="flex items-center">
                @if ($originalLogoPath)
                    <div class="pr-5">
                        <img src="{{ Storage::url($originalLogoPath) }}" alt="Logo"
                            class="h-12 w-12 object-cover rounded">
                    </div>
                @endif
                <div>
                    <x-input-label :value="__('Logo')" required />
                    <x-text-input wire:model.live="cmp_logo" type="file"
                        class="mt-1 block w-full block mt-1 block w-full text-sm text-gray-900 border-red-300 border rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" />
                    <x-input-error class="mt-2" :messages="$errors->get('cmp_logo')" />
                </div>
            </div>
            <div class="flex items-center">
                @if ($originalLicensePath)
                    <div class="pr-5">
                        <a href="{{ Storage::url($originalLicensePath) }}" target="_blank" rel="noopener noreferrer">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="#C81E1E" class="w-8 h-8">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 0 1-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 0 1 1.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 0 0-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 0 1-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H9.75" />
                            </svg>
                        </a>
                    </div>
                @endif
                <div>
                  <x-input-label :value="__('License Document')" required />
                    <x-text-input wire:model.live="cmp_license_document" type="file"
                        class="mt-1 block w-full block mt-1 block w-full text-sm text-gray-900 border-red-300 border rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" />
                    <x-input-error class="mt-2" :messages="$errors->get('cmp_license_document')" />
                </div>
            </div>
        </div>
        <div class="md:grid grid-cols-2 gap-5 mb-6">
            <div>
                <x-input-label :value="__('Address 1')" />
                <x-text-input type="text" class="mt-1 block w-full" required wire:model="cmp_address1" />
             <x-input-error class="mt-2" :messages="$errors->get('cmp_address1')" />
            </div>
            <div>
                <x-input-label :value="__('Address 2')" />
                <x-text-input type="text" class="mt-1 block w-full" wire:model="cmp_address2" />
                <x-input-error class="mt-2" :messages="$errors->get('cmp_address2')" />
            </div>
        </div>
        <div class="flex items-center gap-2 col-span-2">
       <input type="checkbox" wire:model="is_active"
          class="w-4 h-4 text-red-600 bg-gray-400/50 border-red-300 rounded focus:ring-red-500 dark:focus:ring-red-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:border-red-500 checked:bg-red-500" />
      <label>Active</label>
        </div>
        <div class="mt-6">
            <x-primary-button class="mr-2">{{ __('Save') }}</x-primary-button>
        </div>
    </form>
</div>