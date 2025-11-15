<x-app-layout>
    <div class="py-6 bg-gray-200 dark:bg-gray-800">
        <div class="sm:px-6 lg:px-8">
            <div class="bg-gray-100 dark:bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-center">
                    <x-h1>
                        {{ __('Add new supplier') }}
                    </x-h1>
                    <div>
                        <x-btn-red-link href="{{ route('suppliers.index') }}">
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
            <div class="bg-gray-100 dark:bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-white">
                    <form action="{{ route('suppliers.store') }}" method="post">
                        @csrf
                        <div class="mb-5">
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                                required autofocus autocomplete="name" value="{{ old('name') }}" />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>
                        <div class="mb-5">
                            <x-input-label for="place" :value="__('Place')" />
                            <x-text-input id="place" name="place" type="text" class="mt-1 block w-full"
                                autofocus autocomplete="place" value="{{ old('place') }}" />
                            <x-input-error class="mt-2" :messages="$errors->get('place')" />
                        </div>
                        <div class="mb-5">
                            <x-input-label for="tel" :value="__('Tel')" />
                            <x-text-input id="tel" name="tel" type="text" class="mt-1 block w-full"
                                autofocus autocomplete="tel" value="{{ old('tel') }}" />
                            <x-input-error class="mt-2" :messages="$errors->get('tel')" />
                        </div>
                        {{-- <div class="mb-5">
                            <x-input-label for="fax" :value="__('Fax')" />
                            <x-text-input id="fax" name="fax" type="text" class="mt-1 block w-full"
                                autofocus autocomplete="fax" value="{{ old('fax') }}" />
                            <x-input-error class="mt-2" :messages="$errors->get('fax')" />
                        </div> --}}
                        <div class="mb-5">
                            <x-input-label for="trn" :value="__('TRN No')" />
                            <x-text-input id="trn" name="trn" type="text" class="mt-1 block w-full"
                                autofocus autocomplete="trn" value="{{ old('trn') }}" />
                            <x-input-error class="mt-2" :messages="$errors->get('trn')" />
                        </div>
                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Save') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
