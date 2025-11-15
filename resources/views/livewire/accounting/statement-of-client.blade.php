<div>
    <form wire:submit.prevent="loadSOA">
        <div class="md:grid grid-cols-4 gap-5">
            <div>
                <x-input-label :value="__('Client Name')" />
                <select required wire:model="client_id" required
                    class="w-full text-gray-900 border-red-300 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm mt-1">
                    <option value="">Select client</option>
                    @foreach ($clients as $cli)
                        <option value="{{ $cli->id }}">{{ $cli->name }}</option>
                    @endforeach
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('client_id')" />
            </div>
            <div>
                <x-input-label :value="__('From Date')" />
                <x-text-input type="date" class="mt-1 block w-full" required wire:model="from_date" />
                <x-input-error class="mt-2" :messages="$errors->get('from_date')" />
            </div>
            <div>
                <x-input-label :value="__('To Date')" />
                <x-text-input type="date" class="mt-1 block w-full" required wire:model="to_date" />
                <x-input-error class="mt-2" :messages="$errors->get('to_date')" />
            </div>
            <div class="mt-7">
                <x-primary-button>{{ __('Generate SOA') }}</x-primary-button>
            </div>
        </div>
    </form>
    <div class="md:grid grid-cols-4 gap-5 mb-6">
        <div class="col-start-2 col-span-2">
            <button type="button" wire:click.stop="selectDates('1m')"><x-badge.green>Last
                    Month</x-badge.green></button>
            <button type="button" wire:click="selectDates('3m')"><x-badge.green>Last 3 Months</x-badge.green></button>
            <button type="button" wire:click="selectDates('6m')"><x-badge.green>Last 6 Months</x-badge.green></button>
            <button type="button" wire:click="selectDates('1y')"><x-badge.green>Last Year</x-badge.green></button>
        </div>
    </div>
    @if ($client_id && count($rows))
        <div class="overflow-x-auto p-6 bg-white text-black">
            <div class="grid grid-cols-6 gap-4 mb-8">
                <div class="col-start-1 col-end-3 text-sm">
                    <p class="mt-1 font-bold px-5 py-2 bg-red-500 text-white">Bill To :</p>
                    <p class="mt-1 font-bold text-lg px-5">{{ $client->name }}</p>
                    @if ($client->place)
                        <p class="mt-1 font-bold px-5">{{ $client->place }}
                        </p>
                    @endif
                    @if ($client->tel)
                        <p class="mt-1 font-bold px-5">Tel: {{ $client->tel }}
                        </p>
                    @endif
                    @if ($client->fax)
                        <p class="mt-1 font-bold px-5">Fax: {{ $client->fax }}
                        </p>
                    @endif
                    @if ($client->trn)
                        <p class="mt-1 font-bold px-5">TRN No:
                            {{ $client->trn }}
                    @endif
                    </p>
                </div>
                <div class="col-end-7 col-span-2 text-sm">
                    <p class="mt-1 font-bold px-5 py-2 bg-red-500 text-white">Account Summary</p>
                    <table class="text-sm w-full">
                        <tr>
                            <td class="py-1 px-5">Opening Balance</td>
                            <td>AED</td>
                            <td>{{ number_format($opening_balance, 2) }}</td>
                        </tr>
                        <tr>
                            <td class="py-1 px-5">Debits</td>
                            <td>AED</td>
                            <td>{{ number_format($total_invoices, 2) }}</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="py-1 px-5">Credits</td>
                            <td>AED</td>
                            <td>{{ number_format($total_payments, 2) }}</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="py-1 px-5">Total Due</td>
                            <td>AED</td>
                            <td>{{ number_format($closing_balance, 2) }}</td>
                            <td></td>
                        </tr>
                    </table>
                </div>
            </div>
            <table class="soa-tabel mb-6 text-sm">
                <thead class="bg-red-500 text-white">
                    <tr>
                        <th>Date</th>
                        <th>Ref / Description</th>
                        <th>INV/Chq Ref No</th>
                        <th>LPO No</th>
                        <th>Debit</th>
                        <th>Credit</th>
                        <th>Balance</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td></td>
                        <td>Opening Balance</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="text-right">{{ number_format($opening_balance, 2) }}</td>
                    </tr>
                    @foreach ($rows as $row)
                        <tr>
                            <td>{{ formatted_date($row['date']) }}</td>
                            <td>{{ $row['description'] }}</td>
                            <td>{{ $row['ref'] }}</td>
                            <td>{{ $row['lpo_no'] }}</td>
                            <td class="text-right">{{ $row['debit'] ? 'AED ' . number_format($row['debit'], 2) : '' }}
                            </td>
                            <td class="text-right">
                                {{ $row['credit'] ? 'AED ' . number_format($row['credit'], 2) : '' }}
                            </td>
                            <td class="text-right">
                                {{ $row['balance'] ? 'AED ' . number_format($row['balance'], 2) : '' }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="2"><strong>@numToWords($closing_balance) Only</strong></td>
                        <td colspan="3" class="text-right"><strong>NET AMOUNT DUE</strong></td>
                        <td colspan="2" class="text-right"><strong>AED
                                {{ number_format($closing_balance, 2) }}</strong></td>
                    </tr>
                </tbody>
            </table>
            <style>
                .soa-tabel {
                    width: 100%;
                    border: 1px solid #000;
                }

                .soa-tabel th,
                .soa-tabel td {
                    padding: 10px;
                    min-width: 125px;
                    border: 1px solid #000;
                }
            </style>
        </div>
    @elseif($client_id)
        <x-session-message :type="session('type', 'error')" :message="session('message', 'No transactions found for the selected period.')" />
    @endif
</div>
