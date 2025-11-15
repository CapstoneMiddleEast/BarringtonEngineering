<div>
    <div class="py-6 bg-gray-200 dark:bg-gray-800">
        <div class="sm:px-6 lg:px-8">
            <div class="bg-gray-100 dark:bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-center">
                    <x-h1>
                        {{ __('Budgets') }}
                    </x-h1>
                </div>
            </div>
        </div>
    </div>
    <x-session-message :type="session('type', 'info')" />
    @can('manage budgets')
        <div class="pb-6 bg-gray-200 dark:bg-gray-800">
            <div class="sm:px-6 lg:px-8">
                <div class="bg-gray-100 dark:bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    @if ($errors->any())
                        <x-error-alert :errors="$errors" />
                    @endif
                    <form wire:submit.prevent="submit" enctype="multipart/form-data">
                        <h3 class="text-lg font-bold mb-4">Add New Budget</h3>
                        <div class="md:grid grid-cols-3 gap-5">
                            <div>
                                <x-input-label :value="__('Project name')" />
                                <x-text-input wire:model.live="project_name" type="text" class="mt-1 block w-full"
                                    required />
                                <x-input-error class="mt-2" :messages="$errors->get('project_name')" />
                            </div>
                            <div>
                                <x-input-label :value="__('Upload Excel File')" required />
                                <x-text-input wire:model.live="file" type="file"
                                    class="mt-1 block w-full block mt-1 block w-full text-sm text-gray-900 border-red-300 border rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" />
                                <x-input-error class="mt-2" :messages="$errors->get('file')" />
                            </div>
                            <div>
                                <x-input-label :value="__('Submit')" class="invisible" />
                                <x-primary-button class="mt-1">Submit</x-primary-button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endcan
    <div class="pb-6 bg-gray-200 dark:bg-gray-800">
        <div class="sm:px-6 lg:px-8">
            <div class="bg-gray-100 dark:bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="relative overflow-x-auto sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right dark:text-white text-gray-900 font-medium">
                        <thead class="text-xs text-white uppercase bg-gray-400 dark:bg-gray-800">
                            <tr>
                                <th scope="col" class="px-6 py-3">ID</th>
                                <th scope="col" class="px-6 py-3">Project Name</th>
                                <th scope="col" class="px-6 py-3">Date & Time</th>
                                <th scope="col" class="px-6 py-3">Updated File</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($budgets->isNotEmpty())
                                @foreach ($budgets as $item)
                                    <tr
                                        class="bg-gray-200 border-b border-gray-300 dark:border-gray-900 dark:bg-gray-700">
                                        <td class="px-6 py-4">{{ $item->id }}</td>
                                        <td class="px-6 py-4 text-nowrap">{{ $item->project_name }}</td>
                                        <td class="px-6 py-4">{{ formatted_date_time($item->updated_at) }}</td>
                                        <td class="px-6 py-4 inline-flex items-center">
                                            <x-link href="{{ Storage::url($item->file_path) }}" target="_blank">Show
                                                Document</x-link>
                                            @can('manage budgets')
                                                <x-blue-button class="ml-2 mr-2"
                                                    wire:click="openModal({{ $item->id }})">Update File</x-blue-button>
                                                <x-red-button
                                                    wire:click='openConfirmModal({{ $item->id }})'>Delete</x-red-button>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="pt-8">{{ $budgets->links() }}</div>
            </div>
        </div>
    </div>
    @if ($showConfirmModal)
        <livewire:components.confirm-model />
    @endif
    {{-- Modal --}}
    @if ($showModal)
        <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
            <div class="w-full max-w-md p-6 bg-white rounded-lg shadow-sm dark:bg-gray-700">
                <h3 class="text-lg font-bold mb-4">Update Excel File</h3>
                <x-text-input wire:model="newFile" type="file"
                    class="mt-1 block w-full block mt-1 block w-full text-sm text-gray-900 border-red-300 border rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" />
                @error('newFile')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror

                <div class="flex gap-2 justify-end space-x-2 mt-4">
                    <x-gray-button wire:click="$set('showModal', false)">Cancel
                        File</x-gray-button>
                    <x-green-button wire:click="updateFile">Update</x-green-button>
                </div>
            </div>
        </div>
    @endif
</div>
