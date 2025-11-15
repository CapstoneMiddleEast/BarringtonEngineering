<x-app-layout>
    <div class="py-6 bg-gray-200 dark:bg-gray-800">
        <div class="sm:px-6 lg:px-8">
            <div class="bg-gray-100 dark:bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-center">
                    <x-h1>
                        {{ __('Edit material request') }} #{{ $mrId }}
                    </x-h1>
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
                </div>
            </div>
        </div>
    </div>
    <div class="bg-gray-200 dark:bg-gray-800">
        <div class="sm:px-6 lg:px-8">
            <div class="bg-gray-100 dark:bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg p-6">
                @if ($reviewedBy && !$approvedBy)
                    @can('edit reviewed material request')
                        <livewire:material-request.material-request-form :mrId="$mrId" />
                    @else
                        <p class="text-red-600 font-semibold">
                            You do not have permission to edit a reviewed material request.
                        </p>
                    @endcan
                @elseif($approvedBy)
                    @can('edit approved material request')
                        <livewire:material-request.material-request-form :mrId="$mrId" />
                    @else
                        <p class="text-red-600 font-semibold">
                            You do not have permission to edit an approved material request.
                        </p>
                    @endcan
                @else
                    <livewire:material-request.material-request-form :mrId="$mrId" />
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
