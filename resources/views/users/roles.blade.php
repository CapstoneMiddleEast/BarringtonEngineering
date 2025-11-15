<x-app-layout>
    <div class="py-6 bg-gray-200 dark:bg-gray-800">
        <div class="sm:px-6 lg:px-8">
            <div class="bg-gray-100 dark:bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-center">
                    <x-h1>
                        {{ __('Assign roles to ') }} "{{ $user->name }}"
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
            <div class="bg-gray-100 dark:bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-white">
                    <form action="{{ route('users.designate', $user->id) }}" method="post">
                        @csrf
                        <div class="mb-5">
                            <x-input-label for="name" :value="__('Assign roles')" class="mb-5" />
                            @if ($roles->isNotEmpty())
                                <ul
                                    class="items-center w-full flex flex-wrap text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                    @foreach ($roles as $item)
                                        <li
                                            class="basis-full md:basis-1/4">
                                            <div class="flex items-center ps-3">
                                                <input type="checkbox" id="item-{{ $item->id }}" name="role[]"
                                                    {{ $hasRoles->contains($item->id) ? 'checked' : '' }}
                                                    value="{{ $item->name }}"
                                                    class="w-4 h-4 text-red-600 bg-gray-400/50 border-red-300 rounded focus:ring-red-500 dark:focus:ring-red-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:border-red-500 checked:bg-red-500">
                                                <label for="item-{{ $item->id }}"
                                                    class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $item->name }}</label>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Update') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
