<x-app-layout>
    <div class="py-6 bg-gray-200 dark:bg-gray-800">
        <div class="sm:px-6 lg:px-8">
            <div class="bg-gray-100 dark:bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-center">
                    <x-h1>
                        {{ __('Print preview') }}
                    </x-h1>
                    <div>
                        <x-btn-red-link href="{{ route('sales_enquiries.view', $item->id) }}">
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
            @if ($errors->any())
                <x-error-alert :errors="$errors" />
            @endif
        </div>
    </div>
    <div class="pb-6 bg-gray-200 dark:bg-gray-800">
        <div class="sm:px-6 lg:px-8">
            <div class="bg-gray-100 dark:bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('sales_enquiries.print', $item->id) }}" method="post">
                    @csrf
                    <div class="content-wrapper dark:text-black">
                        <div class="content">
                            <table>
                                <tr>
                                    <td style="width: 60%;">
                                        <img class="logo" src="{{ asset('/images/logoBB.png') }}"
                                            alt="" />
                                    </td>
                                    <td>
                                        <table class="address">
                                            <tr>
                                                <td class="p-5 mt-0 block" style="width: 100px;text-align:right">
                                                    Address:</td>
                                                <td class="p-5 ">Office No. 201, 2nd floor, P1809 ADCP Tower Hamdan
                                                    Street,
                                                    Abu Dhabi, UAE
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="p-5" style="width: 100px;text-align:right">Contact No:
                                                </td>
                                                <td class="p-5">02-5860774/050 142 2807</td>
                                            </tr>
                                            <tr>
                                                <td class="p-5 mt-0 block" style="width: 100px;text-align:right">Email:
                                                </td>
                                                <td class="p-5">
                                                    <p style="color:#063dd4; text-decoration:underline;"><a
                                                            href="mailto:contacts@csme.ae"
                                                            target="_blank">contacts@csme.ae</a>
                                                    </p>
                                                    <p
                                                        style="padding-top: 2px; color:#063dd4; text-decoration:underline;">
                                                        <a href="mailto:capstonemiddleast@gmail.com"
                                                            target="_blank">capstonemiddleast@gmail.com</a>
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="p-5" style="width: 100px;text-align:right">TRN No:</td>
                                                <td class="p-5"><strong>105102106900003</strong></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                            <table style="margin-top: 5px;width:100%;" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td style="font-size:26px;font-weight: bold;" class="heading">QUOTATION</td>
                                </tr>
                            </table>
                            <table style="margin-top: 5px;width:100%;border:2px solid #000;" cellpadding="1"
                                class="address">
                                <tr>
                                    <td style="width: 60%;" class="p-5">
                                        <p style="font-weight: bold;">Attention To :</p>
                                        <p style="padding-top: 2px;font-weight: bold;">{{ $item->contact_person }}</p>
                                        <p style="padding-top: 2px;">{{ $item->client_name }}</p>
                                    </td>
                                    <td style="text-align: right;">
                                        <table>
                                            <tr>
                                                <td class="p-5"
                                                    style="width: 100px;text-align:right;font-weight: bold;">
                                                    Qtn.
                                                    No: </td>
                                                <td class="p-5" style="text-align: left;font-weight: bold;">
                                                    {{ $item->quotation_no }}</td>
                                            </tr>
                                            <tr>
                                                <td class="p-5"
                                                    style="width: 100px;text-align:right;font-weight: bold;">
                                                    Date:</td>
                                                <td class="p-5" style="text-align: left;">
                                                    {{ formatted_date($item->date_sent_quotation_to_client) }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="p-5" style="width: 100px;text-align:right;">
                                                    Terms:</td>
                                                <td class="p-5" style="text-align: left;">See details below</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                            <table style="margin-top: 10px;width:100%;" cellspacing="0" cellpadding="0"
                                class="address1">
                                <tr>
                                    <td>We are pleased to furnish our best price for the following materials.</td>
                                </tr>
                            </table>
                            <table cellspacing="0" cellpadding="0" class="itemTable">
                                <tr class="address1">
                                    <th>SN</th>
                                    <th>GOODS/SERVICES DESCRIPTION</th>
                                    <th>UNITS</th>
                                    <th>QTY</th>
                                    <th>UNIT PRICE</th>
                                    <th>AMOUNT</th>
                                </tr>
                                @php $grossAmount = 0; @endphp
                                @foreach ($item->itemCodes as $key => $code)
                                    @php
                                        $amount = $code->pivot->quantity * $code->pivot->selling_price;
                                        $grossAmount += $amount;
                                    @endphp
                                    <tr class="address">
                                        <td class="text-c">{{ $key + 1 }}</td>
                                        <td>
                                            @if ($code->description != 'Transportation' && $code->description != 'Laying Screed on Finished Roofs')
                                                Supply of
                                            @endif{{ $code->description }}
                                        </td>
                                        <td class="text-c">{{ strtoupper($code->pivot->unit) }}</td>
                                        <td class="text-c">{{ number_format($code->pivot->quantity, 2) }}</td>
                                        <td class="text-r">{{ number_format($code->pivot->selling_price, 2) }}</td>
                                        <td class="text-r">{{ number_format($amount, 2) }}</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="6" style="height: 50px;" class="address1">
                                        <div class="flex">
                                            <p class="address1 mt-2 w-24"><strong>Notes :</strong></p>
                                            <x-text-input name="notes" type="text"
                                                class="mt-1 ml-2 items-center text-xs w-full" value="" />
                                        </div>
                                        <strong>LOCATION: {{ $item->delivery_point }}</strong>
                                    </td>
                                </tr>
                                <tr class="total address text-r">
                                    <td colspan="4" rowspan="3"></td>
                                    <td>GROSS AMOUNT</td>
                                    <td>{{ number_format($grossAmount, 2) }}</td>
                                </tr>
                                <tr class="address text-r">
                                    <td>DISCOUNT</td>
                                    <td>-</td>
                                </tr>
                                <tr class="address text-r">
                                    <td>PRICE AFTER DISC.</td>
                                    <td>-</td>
                                </tr>
                                @php
                                    $vat = $grossAmount * 0.05;
                                    $netAmount = $grossAmount + $vat;
                                @endphp
                                <tr class="total address text-r">
                                    <td colspan="4" style="text-align: left">AMOUNT DUE IN WORDS:</td>
                                    <td>VAT 5%</td>
                                    <td>{{ number_format($vat, 2) }}</td>
                                </tr>
                                <tr class="total address text-r">
                                    <td colspan="4"
                                        style="text-transform: uppercase;text-align: left;font-weight:bold">
                                        @numToWords($netAmount)</td>
                                    <td><strong>NET AMOUNT DUE</strong></td>
                                    <td><strong>{{ number_format($netAmount, 2) }}</strong></td>
                                </tr>
                            </table>
                            <table cellspacing="0" cellpadding="0" class="itemTable address1">
                                <tr>
                                    <td>
                                        <p class="address1"><strong>TERMS OF SALE AND OTHER COMMENTS:</strong></p>
                                        <div class="flex">
                                            <p class="address1 mt-2">Price Validity: This offer is valid for acceptance
                                                till </p>
                                            <x-text-input name="price_validity" type="date"
                                                class="mt-1 ml-2 mr-2 items-center text-xs" required
                                                value="CASH ON DELIVERY" />
                                            <p class="address1 mt-2"> and thereafter subject to our reconfirmation.</p>
                                        </div>
                                        <div class="flex flex-wrap">
                                            <p class="address1 mt-2">Delivery Validity of supply till </p>
                                            <x-text-input name="delivery_validity" type="date"
                                                class="mt-1 ml-2 mr-2 items-center text-xs" required
                                                value="CASH ON DELIVERY" />
                                            <p class="address1 mt-2"> and the order is subject to review and
                                                reconfirmation by us after expiry of price validity.</p>
                                        </div>
                                        <p class="address1 mt-2">Transportation: Materials to be delivered in the Site.
                                        </p>
                                        <p class="address1 mt-2">Damages & Delay: Any damages cased on truck by the
                                            client will be charged.
                                            If material offloading take more than 45 minutes, client will be charged.
                                        </p>
                                        <p class="address1 mt-2">Delivery Schedule: To be discussed and agreed with
                                            Project
                                            Team and Managers.</p>
                                        <div class="flex">
                                            <p class="address1 mt-2"><strong>Payment Terms :</strong>
                                                {{ $item->payment_terms }}</p>
                                        </div>
                                        <p class="address1 mt-2"><strong>Note: CLIENT SHALL ARRANGE PROPER WAY TO ENTER
                                                THE
                                                TRUCKS FOR OFFLOADING
                                                AND GATE PASS IF NECESSARY.</strong></p>
                                        <p class="address1 mt-2">WE ASSURE YOU OUR BEST SERVICE AT ALL TIME(24 x7)</p>
                                    </td>
                                </tr>
                            </table>
                            <table class="mt-5">
                                <tr>
                                    <td style="width: 60%;">
                                        <img width="85" height="74"
                                            src="{{ asset('/images/barringtonSeal.jpg') }}" />
                                        <p class="address">Thanks and Regards</p>
                                        <p class="address"><strong>BARRINGTON VENTURES</strong></p>
                                        <p class="text-xs">A Subsidiary of Capstone Middle East</p>
                                    </td>
                                    <td class="text-c">
                                        <p class="address">For any clarification and negotiation please feel free to
                                            contact the below concern person:</p>
                                        <x-text-input name="contact1" type="text"
                                            class="mt-1 ml-2 items-center text-xs block w-full" required
                                            value="{{ $item->author?->name ?? '' }}{{ $item->author?->phone_number ? ' - ' . $item->author->phone_number : '' }}" />
                                        <x-text-input name="contact2" type="text"
                                            class="mt-1 ml-2 items-center text-xs block w-full"
                                            value="{{ $item->assignedSalesPerson?->name ?? '' }}{{ $item->assignedSalesPerson?->phone_number ? ' - ' . $item->assignedSalesPerson->phone_number : '' }}" />
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="p-6 text-white text-center">
                        <x-primary-button>{{ __('Print') }}</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <style>
        .content-wrapper {
            font-family: "Century Gothic", sans-serif;
            font-style: italic;
            max-width: 1010px;
            margin: 0 auto;
            padding: 30px;
            background-color: #fff;
            font-family: Century Gothic, sans-serif;
            overflow: scroll;
        }

        .content {
            margin: 50px 0px 20px;
            width: 950px
        }

        .content-wrapper .logo {
            width: 200px;
            height: auto;
        }

        p {
            margin: 0;
            font-family: "Century Gothic", sans-serif;
            font-style: italic;
        }

        .p-5 {
            padding: 2px;
        }

        .address {
            font-size: 13px;
        }

        .address1 {
            font-size: 15px;
        }

        .heading {
            padding: 3px;
            font-size: 16px;
            background-color: #C0C0C0;
            font-weight: bold;
            text-align: center;
        }

        .itemTable {
            margin-top: 10px;
            width: 100%;
            border-top: 1px solid #000;
            border-left: 1px solid #000;
        }

        .itemTable th,
        .itemTable td {
            padding: 5px;
            border-right: 1px solid #000;
            border-bottom: 1px solid #000;
        }

        .text-c {
            text-align: center;
        }

        .text-r {
            text-align: right;
        }
    </style>
</x-app-layout>
