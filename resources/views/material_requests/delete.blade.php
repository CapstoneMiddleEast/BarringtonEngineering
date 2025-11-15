<x-app-layout>
    <div class="py-6 bg-gray-200 dark:bg-gray-800">
        <div class="sm:px-6 lg:px-8">
            <div class="bg-gray-100 dark:bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-center">
                    <x-h1>
                        {{ __('Delete Material Request') }}
                    </x-h1>
                </div>
            </div>
        </div>
    </div>
    <div class="pb-8">
        <div class="sm:px-6 lg:px-8">
            <div class="bg-gray-100 dark:bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-white">
                    <h2 class="text-xl font-bold dark:text-white text-gray-900 mb-3">
                        {{ __('Are you want to delete the record from Material Request?') }}
                    </h2>
                    <p class="mt-1 text-red-500 ">
                        ID: {{ $item->id }}
                    </p>
                    <div class="flex justify-between items-center mt-8">
                        <div>
                            <x-btn-red-link href="{{ route('material_requests.index') }}">
                                <svg class="w-[18px] h-[18px] text-white mr-2" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                    viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2.2" d="M5 12h14M5 12l4-4m-4 4 4 4" />
                                </svg>
                                Back</x-btn-red-link>
                        </div>
                        <form action="{{ route('material_requests.destroy', $item->id) }}" method="post">
                            @csrf
                            <x-danger-button class="ms-3">
                                {{ __('Confirm & Delete') }}
                            </x-danger-button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
