<x-app-layout>
    <div class="py-6 bg-gray-200 dark:bg-gray-800">
        <div class="sm:px-6 lg:px-8">
            <div class="bg-gray-100 dark:bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-center">
                    <x-h1>
                        {{ __('Add new user') }}
                    </x-h1>
                    <div>
                        <x-btn-red-link href="{{ route('users.index') }}">
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
            <form action="{{ route('users.store') }}" method="post">
                @csrf
                <div class="md:grid grid-cols-2 gap-8">
                    <div class="bg-gray-100 dark:bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                        <div class="p-6 text-white">
                            <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-5">
                                {{ __('Basic Information') }}
                            </h2>
                            <div class="mb-5">
                                <x-input-label for="name" :value="__('Name')" />
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                                    required autofocus autocomplete="name" value="{{ old('name') }}" />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>
                            <div class="mb-5">
                                <x-input-label for="email" :value="__('Email Id')" />
                                <x-text-input id="email" name="email" type="text" class="mt-1 block w-full"
                                    required autofocus autocomplete="email" value="{{ old('email') }}" />
                                <x-input-error class="mt-2" :messages="$errors->get('email')" />
                            </div>
                            <div class="mb-5">
                                <x-input-label for="password" :value="__('Password')" />
                                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password"
                                    required autocomplete="new-password" />
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>
                            <div class="mb-5">
                                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                                <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                                    name="password_confirmation" required autocomplete="new-password" />
                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                            </div>
                            <div class="mb-5">
                                <x-input-label for="phone_number" :value="__('Phone Number')" />
                                <x-phone-input id="phone_number" name="phone_number" type="text"
                                    class="mt-1 block w-full" required autofocus autocomplete="phone_number"
                                    value="{{ old('phone_number') }}" />
                                <x-input-error class="mt-2" :messages="$errors->get('phone_number')" />
                            </div>
                            <div class="mb-5">
                                <x-input-label for="whatsapp_number" :value="__('Whatsapp Number')" />
                                <x-phone-input id="whatsapp_number" name="whatsapp_number" type="text"
                                    class="mt-1 block w-full" required autofocus autocomplete="whatsapp_number"
                                    value="{{ old('whatsapp_number') }}" />
                                <x-input-error class="mt-2" :messages="$errors->get('whatsapp_number')" />
                            </div>
                            <div class="mb-5">
                                <x-input-label for="address" :value="__('Address')" />
                                <x-text-area id="address" name="address" class="mt-1 block w-full" rows="4"
                                    autofocus autocomplete="address">{{ old('address') }}</x-text-area>
                                <x-input-error class="mt-2" :messages="$errors->get('address')" />
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-100 dark:bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                        <div class="p-6 text-white">
                            <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-5">
                                {{ __('Job and Role Details') }}
                            </h2>
                            <div class="mb-5">
                                <x-input-label for="about" :value="__('Profile Info')" />
                                <x-text-area id="about" name="about" class="mt-1 block w-full" rows="4"
                                    autofocus autocomplete="about">{{ old('about') }}</x-text-area>
                                <x-input-error class="mt-2" :messages="$errors->get('about')" />
                            </div>
                            <div class="mb-5">
                                <x-input-label for="job_title" :value="__('Job Title')" />
                                <x-text-input id="job_title" name="job_title" type="text" class="mt-1 block w-full"
                                    required autofocus autocomplete="job_title" value="{{ old('job_title') }}" />
                                <x-input-error class="mt-2" :messages="$errors->get('job_title')" />
                            </div>
                            <div class="mb-5">
                                <x-input-label for="department" :value="__('Department')" />
                                <x-text-input id="department" name="department" type="text"
                                    class="mt-1 block w-full" required autofocus autocomplete="department"
                                    value="{{ old('department') }}" />
                                <x-input-error class="mt-2" :messages="$errors->get('department')" />
                            </div>
                            <div class="mb-5 relative">
                                <x-input-label for="join_date" :value="__('Join Date')" />
                                <x-date-input id="join_date" name="join_date" type="text"
                                    class="mt-1 block w-full" required autofocus autocomplete="join_date"
                                    value="{{ old('join_date') }}" />
                                <x-input-error class="mt-2" :messages="$errors->get('join_date')" />
                            </div>
                            <div class="mb-5">
                                <x-input-label for="employee_id" :value="__('Employee Id')" />
                                <x-text-input id="employee_id" name="employee_id" type="text"
                                    class="mt-1 block w-full" required autofocus autocomplete="employee_id"
                                    value="{{ old('employee_id') }}" />
                                <x-input-error class="mt-2" :messages="$errors->get('employee_id')" />
                            </div>
                            <div class="mb-5">
                                <x-input-label for="availability_status" :value="__('Availability')" />
                                <select id="availability_status" name="availability_status" value=""
                                    class="w-full text-gray-900 border-red-300 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm">
                                    <option value="active">Active</option>
                                    <option value="leave">Leave</option>
                                    <option value="blocked">Blocked</option>
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('availability_status')" />
                            </div>
                            <div class="mb-5">
                                <x-input-label for="languages_spoken" :value="__('Languages Spoken')" />
                                <x-text-input id="languages_spoken" name="languages_spoken" type="text"
                                    class="mt-1 block w-full" required autofocus autocomplete="languages_spoken"
                                    value="{{ old('languages_spoken') }}" />
                                <x-input-error class="mt-2" :messages="$errors->get('languages_spoken')" />
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
