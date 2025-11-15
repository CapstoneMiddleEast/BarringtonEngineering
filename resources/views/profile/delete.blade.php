<x-app-layout>
    <div class="py-6 bg-gray-200 dark:bg-gray-800">
        <div class="sm:px-6 lg:px-8">
            <div class="bg-gray-100 dark:bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-center">
                    <x-h1>{{ __('Delete Aaccount') }}</x-h1>
                    <div>
                        <x-btn-red-link href="{{ route('profile.view') }}">
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
    <x-session-message :type="session('type', 'info')" />
    <div class="pb-6">
        <div class="sm:px-6 lg:px-8">
            <div class="bg-gray-100 dark:bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
                    @csrf
                    @method('delete')

                    <h2 class="text-xl font-bold dark:text-white text-gray-900 mb-3">
                        {{ __('Are you sure you want to delete your account?') }}
                    </h2>

                    <p class="mt-1 dark:text-white text-gray-900 text-sm">
                        {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                    </p>

                    <div class="mt-6">
                        <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                        <x-text-input id="password" name="password" type="password" class="mt-1 block w-full"
                            placeholder="{{ __('Password') }}" />

                        <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
                    </div>

                    <div class="mt-6 flex justify-between items-center">
                        <x-btn-red-link href="{{ route('profile.view') }}" class="mb-2.5">
                            Cancel</x-btn-red-link>

                        <x-danger-button class="ms-0">
                            {{ __('Delete Account') }}
                        </x-danger-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
