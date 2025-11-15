<x-app-layout>
    <div class="py-6 bg-gray-200 dark:bg-gray-800">
        <div class="sm:px-6 lg:px-8">
            <div class="bg-gray-100 dark:bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-center">
                    <x-h1>{{ __('All employees') }}</x-h1>
                </div>
            </div>
        </div>
    </div>
    <x-session-message :type="session('type', 'info')" />
    <div class="pb-8">
        <div class="sm:px-6 lg:px-8">
            <div class="bg-gray-100 dark:bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-white">
                    <div class="relative overflow-x-auto sm:rounded-lg">
                        <table
                            class="w-full text-xs md:text-sm text-left rtl:text-right dark:text-white text-gray-900 font-medium">
                            <thead class="text-xs text-white uppercase bg-gray-400 dark:bg-gray-800">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Employee Name</th>
                                    <th scope="col" class="px-6 py-3">Job Title</th>
                                    <th scope="col" class="px-6 py-3">Employee Code</th>
                                    <th scope="col" class="px-6 py-3">Employee Phone</th>
                                    <th scope="col" class="px-6 py-3">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($list->isNotEmpty())
                                    @foreach ($list as $user)
@if($user->roles->first()->name != 'Super Admin')
 <tr
                                            class="bg-gray-200 border-b border-gray-300 dark:border-gray-900 dark:bg-gray-700">
                                            <td
                                                class="items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                                <a href="{{ route('users.view', $user->id) }}"
                                                    class="flex items-center">
                                                    <span class="ps-3">
                                                        <span
                                                            class="text-xs md:text-base font-semibold block">{{ $user->name }}</span>
                                                        <span
                                                            class="font-normal text-gray-600 dark:text-gray-200 block">
                                                            {{ $user->email }}</span>
                                                    </span>
                                                </a>
                                            </td>
                                            <td class="px-6 py-4">{{ $user->job_title }}</td>
                                            <td class="px-6 py-4">{{ $user->employee_id }}</td>
                                            <td class="px-6 py-4">{{ $user->phone_number }}</td>
                                           
                                            
                                            <td class="px-6 py-4">
                                                @if ($user->availability_status == 'active')
                                                    <x-badge.green>{{ $user->availability_status }}</x-badge>
                                                @endif
                                                @if ($user->availability_status == 'leave')
                                                    <x-badge.yellow>{{ $user->availability_status }}</x-badge>
                                                @endif
                                                @if ($user->availability_status == 'blocked')
                                                    <x-badge.red>{{ $user->availability_status }}</x-badge>
                                                @endif
                                            </td>
                                        </tr>
@endif

                                       
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="pt-8"></div>
                    {{ $list->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
