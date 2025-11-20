<div>
    @if ($errors->any())
        <x-error-alert :errors="$errors" />
    @endif
    <form wire:submit.prevent="save" enctype="multipart/form-data">


        <div class="md:grid grid-cols-4 gap-5 mb-6">


            <div>


                <x-input-label for="company_id" :value="__('Company')" />


                <select wire:model.live="company_id"


                    class="w-full text-gray-900 border-red-300 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm mt-1">


                    <option value="">Select Company</option>


                    @foreach ($companies as $item)


                        <option value="{{ $item->id }}">{{ $item->name }}</option>


                    @endforeach


                </select>


                <x-input-error class="mt-2" :messages="$errors->get('company_id')" />


            </div>


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


        </div>


        <div class="mb-6">


            <x-input-label :value="__('Description')" />


            <x-text-input type="text" class="mt-1 block w-full" wire:model="description" />


            <x-input-error class="mt-2" :messages="$errors->get('description')" />


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