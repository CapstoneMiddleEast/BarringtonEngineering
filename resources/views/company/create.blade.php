<x-app-layout>
    <div class="py-6 bg-gray-200 dark:bg-gray-800">
        <div class="sm:px-6 lg:px-8">
            <div class="bg-gray-100 dark:bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-center">
                    <x-h1>
                        {{ __('Add new companies') }}
                    </x-h1>
                    <div>
                        <x-btn-red-link href="{{ route('company.index') }}">
                            <svg class="w-[18px] h-[18px] text-white mr-2" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2.2" d="M5 12h14M5 12l4-4m-4 4 4 4" />
                            </svg>
                            Back</x-btn-red-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="pb-8">
        <div class="sm:px-6 lg:px-8">
            <form action="{{ route('company.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
               
                <div class="md:grid grid-cols-2 gap-8">
                    <div class="bg-gray-100 dark:bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                        <div class="p-6 text-white">
                            <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-5">
                                {{ __('Basic Information') }}
                            </h2>

                            <div class="mb-5">
                                <x-input-label for="code" :value="__('Company Code')" />
                                <x-text-input id="code" name="code" type="text"
                                    class="mt-1 block w-full" required autofocus autocomplete="code"
                                    value="{{ old('code') }}" />
                                <x-input-error class="mt-2" :messages="$errors->get('code')" />
                            </div>

                            <div class="mb-5">
                                <x-input-label for="name" :value="__('Company Name')" />
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                                    required autofocus autocomplete="name" value="{{ old('name') }}" />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>
                                <div class="mb-5">
                                <x-input-label for="about" :value="__('Description')" />
                                <x-text-area id="about" name="company_description" class="mt-1 block w-full" rows="4"
                                    autofocus autocomplete="about">{{ old('about') }}</x-text-area>
                                <x-input-error class="mt-2" :messages="$errors->get('about')" />
                            </div>

                             <div class="mb-5">
                                <x-input-label for="cmp_trn_no" :value="__('Company TRN No')" />
                                <x-text-input id="cmp_trn_no" name="cmp_trn_no" type="text" class="mt-1 block w-full"
                                    required autofocus autocomplete="cmp_trn_no" value="{{ old('cmp_trn_no') }}" />
                                <x-input-error class="mt-2" :messages="$errors->get('cmp_trn_no')" />
                            </div>
                             <div class="mb-5">
                                <x-input-label for="cmp_licence_no" :value="__('Company Licence No')" />
                                <x-text-input id="cmp_licence_no" name="cmp_licence_no" type="text" class="mt-1 block w-full"
                                    required autofocus autocomplete="cmp_licence_no" value="{{ old('cmp_licence_no') }}" />
                                <x-input-error class="mt-2" :messages="$errors->get('cmp_licence_no')" />
                            </div>
                                 <div class="mb-5">
                                <x-input-label for="name" :value="__('Contact Person')" />
                                <x-text-input id="name" name="cmp_contact_person" type="text" class="mt-1 block w-full"
                                    required autofocus autocomplete="cmp_contact_person" value="{{ old('cmp_contact_person') }}" />
                                <x-input-error class="mt-2" :messages="$errors->get('cmp_contact_person')" />
                            </div>
 
                            <div class="mb-5">
                                <x-input-label for="phone_number" :value="__('Phone Number')" />
                                <x-phone-input id="phone_number" name="cmp_contact_no" type="text"
                                    class="mt-1 block w-full" required autofocus autocomplete="phone_number"
                                    value="{{ old('phone_number') }}" />
                                <x-input-error class="mt-2" :messages="$errors->get('phone_number')" />
                            </div>

                    <div class="">
                        <x-input-label for="company_logo" :value="__('Company Logo')" />
                        <input
                            class="block mt-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                            id="cmp_logo" type="file" name="cmp_logo" required>
                        <x-input-error class="mt-2" :messages="$errors->get('cmp_logo')" />
                    </div>

                    <div class="">
                        <x-input-label for="company_Doc" :value="__('Company Document')" />
                        <input
                            class="block mt-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                            id="company_Doc" type="file" name="cmp_doc" required>
                        <x-input-error class="mt-2" :messages="$errors->get('company_Doc')" />
                    </div>
                        </div>
                    </div>
                    <div class="bg-gray-100 dark:bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                        <div class="p-6 text-white">
                            <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-5">
                                {{ __('More Details') }}
                            </h2>
                            <div class="mb-5">
                                <x-input-label for="about" :value="__('Address 1')" />
                                <x-text-area id="about" name="cmp_address1" class="mt-1 block w-full" rows="4"
                                    autofocus autocomplete="about">{{ old('about') }}</x-text-area>
                                <x-input-error class="mt-2" :messages="$errors->get('about')" />
                            </div>
                              <div class="mb-5">
                                <x-input-label for="about" :value="__('Address 2')" />
                                <x-text-area id="about" name="cmp_address2" class="mt-1 block w-full" rows="4"
                                autofocus autocomplete="about">{{ old('about') }}</x-text-area>
                            <x-input-error class="mt-2" :messages="$errors->get('about')" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-100 dark:bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-white">
                        <x-primary-button>{{ __('Save') }}</x-primary-button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
