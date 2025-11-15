<!DOCTYPE html>
<html>

<head>
    <title>Sales Enquiry Report</title>
    <style>
        body {
            font-family: Century Gothic, sans-serif;
            font-style: italic;
        }

        .content {
            margin: 50px 0px 20px;
            margin-top: 30px;
            font-family: Century Gothic, sans-serif;
            font-style: italic;
        }

        .logo {
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

        .pb-5 {
            padding-bottom: 5px;
        }

        .pb-10 {
            padding-bottom: 10px;
        }

        .pb-20 {
            padding-bottom: 20px;
        }

        .pb-30 {
            padding-bottom: 30px;
        }

        .address {
            font-size: 13px;
            font-family: Century Gothic, sans-serif;
            font-style: italic;
        }

        .address1 {
            font-size: 13px;
            font-style: italic;
        }

        .heading {
            padding: 3px;
            font-size: 17px;
            background-color: #C0C0C0;
            font-weight: bold;
            text-align: center;
            font-style: italic;
        }

        .itemTable {
            margin-top: 10px;
            width: 100%;
            border-top: 1px solid #000;
            border-left: 1px solid #000;
            font-family: Century Gothic, sans-serif;
            font-style: italic;
        }

        .itemTable th,
        .itemTable td {
            padding: 5px;
            border-right: 1px solid #000;
            border-bottom: 1px solid #000;
            font-family: Century Gothic, sans-serif;
            font-style: italic;
        }

        .text-c {
            text-align: center;
        }

        .text-r {
            text-align: right;
        }

        .text-l {
            text-align: left;
        }
    </style>
</head>
@php
    $logo = base64_encode(file_get_contents(public_path('images/logoBB.png')));
    $seal = base64_encode(file_get_contents(public_path('images/barringtonSeal.jpg')));
@endphp

<body>
    <div class="content">
        <table>
            <tr>
                <td style="width: 350px">
                    <img src="data:image/png;base64,{{ $logo }}" alt="Company Logo" style="width: 200px;">
                </td>
                <td>
                    <table class="address">
                        <tr>
                            <td class="p-5" style="width: 100px;text-align:right;margin-top:0px;display:block">Address:
                            </td>
                            <td class="p-5">Office No. 201, 2nd floor, <br>P1809 ADCP Tower Hamdan Street, <br>Abu
                                Dhabi, UAE
                            </td>
                        </tr>
                        <tr>
                            <td class="p-5" style="width: 100px;text-align:right">Contact No:</td>
                            <td class="p-5">02-5860774/ 050 142 2807</td>
                        </tr>
                        <tr>
                            <td class="p-5" style="width: 100px;text-align:right; margin-top:3px;display:block">
                                Email:</td>
                            <td class="p-5">
                                <p><a style="color:#063dd4;" href="mailto:contacts@csme.ae"
                                        target="_blank">contacts@csme.ae</a>
                                </p>
                                <p style="padding-top: 2px;"><a style="color:#063dd4;"
                                        href="mailto:capstonemiddleast@gmail.com"
                                        target="_blank">capstonemiddleast@gmail.com</a></p>
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
                <td style="font-size:26px;" class="heading">QUOTATION</td>
            </tr>
        </table>
        <table style="margin-top: 5px;width:100%;border:2px solid #000;" cellpadding="1" class="address">
            <tr>
                <td style="width:420px;" class="p-5">
                    <p style="font-weight: bold;">Attention To :</p>
                    <p style="padding-top: 2px;font-weight: bold;">{{ $item->contact_person }}</p>
                    <p style="padding-top: 2px;">{{ $item->client_name }}</p>
                </td>
                <td style="text-align: right;">
                    <table style="width: 280px;">
                        <tr>
                            <td class="p-5" style="width: 100px;text-align:right;font-weight: bold;">Qtn. No:</td>
                            <td class="p-5" style="font-weight: bold;">{{ $item->quotation_no }}</td>
                        </tr>
                        <tr>
                            <td class="p-5" style="width: 100px;text-align:right;font-weight: bold;">Date:</td>
                            <td class="p-5">{{ formatted_date($item->date_sent_quotation_to_client) }}</td>
                        </tr>
                        <tr>
                            <td class="p-5" style="width: 100px;text-align:right;font-weight: bold;">Terms:</td>
                            <td class="p-5">See details below</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <table style="margin-top: 10px;width:100%;" cellspacing="0" cellpadding="0" class="address1">
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
                    @if ($item->notes)
                        <p class="address1 pb-20"><strong>Notes : {{ $item->notes }}</strong></p>
                    @endif
                    <p><strong>LOCATION: {{ $item->delivery_point }}</strong></p>
                </td>
            </tr>
            <tr class="total address text-r">
                <td colspan="4" rowspan="3"></td>
                <td class="text-l">GROSS AMOUNT</td>
                <td>{{ number_format($grossAmount, 2) }}</td>
            </tr>
            <tr class="address text-r">
                <td class="text-l">DISCOUNT</td>
                <td>-</td>
            </tr>
            <tr class="address text-r">
                <td class="text-l">PRICE AFTER DISC.</td>
                <td>-</td>
            </tr>
            @php
                $vat = $grossAmount * 0.05;
                $netAmount = $grossAmount + $vat;
            @endphp
            <tr class="total address text-r">
                <td colspan="4" style="text-align: left">AMOUNT DUE IN WORDS:</td>
                <td class="text-l">VAT 5%</td>
                <td>{{ number_format($vat, 2) }}</td>
            </tr>
            <tr class="total address text-r">
                <td colspan="4" style="text-transform:uppercase;  text-align: left ; font-weight: bold">
                    @numToWords($netAmount)</td>
                <td class="text-l"><strong>NET AMOUNT DUE</strong></td>
                <td><strong>{{ number_format($netAmount, 2) }}</strong></td>
            </tr>
        </table>
        <table style="margin-top: 30px;width:100%;" cellspacing="0" cellpadding="0" class="itemTable">
            <tr>
                <td>
                    <p class="address1 pb-10"><strong>TERMS OF SALE AND OTHER COMMENTS:</strong></p>
                    <p class="address1 pb-5">Price Validity: This offer is valid for acceptance
                        till <strong>{{ formatted_date($item->price_validity) }}</strong> and thereafter subject to our
                        reconfirmation.</p>
                    <p class="address1 pb-5">Delivery Validity of supply till
                        <strong>{{ formatted_date($item->delivery_validity) }}</strong> and the order is subject to
                        review and
                        reconfirmation by us after expiry of price validity.
                    </p>
                    <p class="address1 pb-5">Transportation: Materials to be delivered in the Site.
                    </p>
                    <p class="address1 pb-5">Damages & Delay: Any damages cased on truck by the client will be charged.
                        If material offloading take more than 45 minutes, client will be charged. </p>
                    <p class="address1 pb-5">Delivery Schedule: To be discussed and agreed with
                        Project
                        Team and Managers.</p>
                    <p class="address1 pb-20"><strong>Payment Terms : {{ $item->payment_terms }}</strong></p>
                    <p class="address1 pb-20"><strong>Note: CLIENT SHALL ARRANGE PROPER WAY TO ENTER
                            THE
                            TRUCKS FOR OFFLOADING
                            AND GATE PASS IF NECESSARY.</strong></p>
                    <p class="address1 p-5">WE ASSURE YOU OUR BEST SERVICE AT ALL TIME(24 x7)</p> 
                </td>
            </tr>
        </table>
        <table style="margin-top: 10px;width:100%;" cellspacing="0" cellpadding="0">
            <tr>
                <td style="width: 400px">
                    <table cellspacing="0" cellpadding="0"> 
                        <tr>
                            <td>
                                <p class="address pb-5">Thanks and Regards</p>
                                <p class="address"><strong>BARRINGTON VENTURES</strong></p>
                                <p class="address">A Subsidiary of Capstone Middle East</p>
                            </td>
                            <td>
                                <img src="data:image/png;base64,{{ $seal }}" alt="Company Seal"
                                    width="75" height="75">
                            </td>
                        </tr>
                    </table>
                </td>
                <td class="text-c">
                    <p class="address1 pb-5">For any clarification and negotiation please feel free to
                        contact the below concern person:</p>
                    <p class="address1 pb-5"><strong>{{ $item->foocontact1 }}</strong></p>
                    <p class="address1 pb-5"><strong>{{ $item->foocontact2 }}</strong></p>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>
