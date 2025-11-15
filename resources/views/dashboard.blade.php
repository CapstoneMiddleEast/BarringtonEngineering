<x-app-layout>
    <div class="py-6 bg-gray-200 dark:bg-gray-800">
        <div class="sm:px-6 lg:px-8">
            <div class="bg-gray-100 dark:bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <x-h1>Welcome back, {{ Auth::user()->name }}</x-h1>
            </div>
        </div>
    </div>
    @if ($pendingEnquiriesCount > 0)
        @include('partials.pending-enquiries-alert-model', [
            'pendingEnquiriesCount' => $pendingEnquiriesCount,
        ])
    @endif
    <div class="sm:px-6 lg:px-8">
        <div class="bg-gray-100 dark:bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg mb-6 p-6">
            @include('partials.sales-chart')
        </div>
    </div>
</x-app-layout>
