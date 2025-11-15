<aside
    class="w-64 min-w-64 bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-100 shadow-md min-h-screen hidden md:block fixed inset-0 overflow-y-auto"
    aria-label="Sidebar">
    <div class="p-6 pt-10">
        <a href="{{ route('dashboard') }}">
            <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
        </a>
    </div>

    <nav class="mt-4 p-6 space-y-4">
        {{-- Top-level link (Dashboard) --}}
        <div>
            <x-nav-link href="{{ route('dashboard') }}" :active="request()->is('dashboard')">
                Dashboard
            </x-nav-link>
        </div>

        {{-- PEOPLE group --}}
        @php
            // mark open if current route matches any of these children
            $peopleOpen =
                request()->is('dashboard/employees*') ||
                request()->is('dashboard/users*') ||
                request()->is('dashboard/roles*') ||
                request()->is('dashboard/permissions*');
        @endphp

        <div x-data="{ open: {{ $peopleOpen ? 'true' : 'false' }} }" class="border-t border-gray-200 dark:border-neutral-800 pt-3">
            <button @click="open = !open" :aria-expanded="open"
                class="w-full flex items-center justify-between px-3 py-2 text-left text-sm font-semibold text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 rounded">
                <span class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        class="w-5 h-5" stroke="#EE3849" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                    </svg>

                    <span>Configuration</span>
                </span>

                <svg x-show="!open" class="w-4 h-4 transform transition-transform" viewBox="0 0 24 24" fill="none"
                    stroke="#EE3849" stroke-width="2">
                    <path d="M6 9l6 6 6-6"></path>
                </svg>
                <svg x-show="open" class="w-4 h-4 rotate-180 transform transition-transform" viewBox="0 0 24 24"
                    fill="none" stroke="#EE3849" stroke-width="2">
                    <path d="M6 9l6 6 6-6"></path>
                </svg>
            </button>

            <div x-show="open" x-collapse class="mt-2 space-y-1 pl-4">
                <x-nav-link href="{{ route('users.list') }}" :active="request()->is('dashboard/employees*')">
                    All employees
                </x-nav-link>

                @can('user view')
                    <x-nav-link href="{{ route('users.index') }}" :active="request()->is('dashboard/users*')">
                        Users
                    </x-nav-link>
                @endcan

                @can('view role')
                    <x-nav-link href="{{ route('roles.index') }}" :active="request()->is('dashboard/roles*')">
                        Roles
                    </x-nav-link>
                @endcan

                @can('view permission')
                    <x-nav-link href="{{ route('permissions.index') }}" :active="request()->is('dashboard/permissions*')">
                        Permissions
                    </x-nav-link>
                @endcan
            </div>
        </div>

        {{-- RESOURCES group --}}
        @php
            $resourcesOpen =
                request()->is('dashboard/budgets*') ||
                request()->is('dashboard/item_codes*') ||
                request()->is('dashboard/clients*') ||
                request()->is('dashboard/suppliers*');
        @endphp

        <div x-data="{ open: {{ $resourcesOpen ? 'true' : 'false' }} }" class="border-t border-gray-200 dark:border-neutral-800 pt-3">
            <button @click="open = !open" :aria-expanded="open"
                class="w-full flex items-center justify-between px-3 py-2 text-left text-sm font-semibold text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 rounded">
                <span class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        class="w-5 h-5" stroke="#EE3849" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m16.5 0v3.75m-16.5-3.75v3.75m16.5 0v3.75C20.25 16.153 16.556 18 12 18s-8.25-1.847-8.25-4.125v-3.75m16.5 0c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125" />
                    </svg>

                    <span>Resources</span>
                </span>

                <svg x-show="!open" class="w-4 h-4 transform transition-transform" viewBox="0 0 24 24" fill="none"
                    stroke="#EE3849" stroke-width="2">
                    <path d="M6 9l6 6 6-6"></path>
                </svg>
                <svg x-show="open" class="w-4 h-4 rotate-180 transform transition-transform" viewBox="0 0 24 24"
                    fill="none" stroke="#EE3849" stroke-width="2">
                    <path d="M6 9l6 6 6-6"></path>
                </svg>
            </button>

            <div x-show="open" x-collapse class="mt-2 space-y-1 pl-4">
                <x-nav-link href="{{ route('budgets.index') }}" :active="request()->is('dashboard/budgets*')">
                    Budgets
                </x-nav-link>

                @can('view item code')
                    <x-nav-link href="{{ route('item_codes.index') }}" :active="request()->is('dashboard/item_codes*')">
                        Item Codes
                    </x-nav-link>
                @endcan

                @can('view client')
                    <x-nav-link href="{{ route('clients.index') }}" :active="request()->is('dashboard/clients*')">
                        Clients
                    </x-nav-link>
                @endcan

                @can('view supplier')
                    <x-nav-link href="{{ route('suppliers.index') }}" :active="request()->is('dashboard/suppliers*')">
                        Suppliers
                    </x-nav-link>
                @endcan
            </div>
        </div>

        {{-- OPERATIONS group --}}
        @php
            $operationsOpen =
                request()->is('dashboard/sales_enquiries*') ||
                request()->is('dashboard/material_requests*') ||
                request()->is('dashboard/invoices*') ||
                request()->is('dashboard/payments*') ||
                request()->is('dashboard/soa/*');
        @endphp

        <div x-data="{ open: {{ $operationsOpen ? 'true' : 'false' }} }" class="border-t border-gray-200 dark:border-neutral-800 pt-3">
            <button @click="open = !open" :aria-expanded="open"
                class="w-full flex items-center justify-between px-3 py-2 text-left text-sm font-semibold text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 rounded">
                <span class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        class="w-5 h-5" stroke="#EE3849" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 17.25v1.007a3 3 0 0 1-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0 1 15 18.257V17.25m6-12V15a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 15V5.25m18 0A2.25 2.25 0 0 0 18.75 3H5.25A2.25 2.25 0 0 0 3 5.25m18 0V12a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 12V5.25" />
                    </svg>

                    <span>Operations</span>
                </span>

                <svg x-show="!open" class="w-4 h-4 transform transition-transform" viewBox="0 0 24 24" fill="none"
                    stroke="#EE3849" stroke-width="2">
                    <path d="M6 9l6 6 6-6"></path>
                </svg>
                <svg x-show="open" class="w-4 h-4 rotate-180 transform transition-transform" viewBox="0 0 24 24"
                    fill="none" stroke="#EE3849" stroke-width="2">
                    <path d="M6 9l6 6 6-6"></path>
                </svg>
            </button>

            <div x-show="open" x-collapse class="mt-2 space-y-1 pl-4">
                @can('view sales enquiry')
                    <x-nav-link href="{{ route('sales_enquiries.index') }}" :active="request()->is('dashboard/sales_enquiries*')">
                        Sales Enquiries
                    </x-nav-link>
                @endcan

                @can('view material request')
                    <x-nav-link href="{{ route('material_requests.index') }}" :active="request()->is('dashboard/material_requests*')">
                        Material Requests
                    </x-nav-link>
                @endcan

                @can('view invoice')
                    <x-nav-link href="{{ route('invoices.index') }}" :active="request()->is('dashboard/invoices*')">
                        Invoices
                    </x-nav-link>
                @endcan

                @can('view payment')
                    <x-nav-link href="{{ route('payments.index') }}" :active="request()->is('dashboard/payments*')">
                        Accounts Receivable
                    </x-nav-link>
                @endcan

                @can('view client soa')
                    <x-nav-link href="{{ route('soa.client') }}" :active="request()->is('dashboard/soa/client*')">
                        SOA (Client)
                    </x-nav-link>
                @endcan

                @can('view supplier soa')
                    <x-nav-link href="{{ route('soa.supplier') }}" :active="request()->is('dashboard/soa/supplier*')">
                        SOA (Supplier)
                    </x-nav-link>
                @endcan
            </div>
        </div>
    </nav>
</aside>
