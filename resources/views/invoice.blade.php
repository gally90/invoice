<!DOCTYPE html>
<html>
@php
$webicon = '<svg viewBox="0 0 32 32" fill="#383a3d">
<path d="M16 0c-8.837 0-16 7.163-16 16s7.163 16 16 16 16-7.163 16-16-7.163-16-16-16zM16 30c-1.967 0-3.84-0.407-5.538-1.139l7.286-8.197c0.163-0.183 0.253-0.419 0.253-0.664v-3c0-0.552-0.448-1-1-1-3.531 0-7.256-3.671-7.293-3.707-0.188-0.188-0.442-0.293-0.707-0.293h-4c-0.552 0-1 0.448-1 1v6c0 0.379 0.214 0.725 0.553 0.894l3.447 1.724v5.871c-3.627-2.53-6-6.732-6-11.489 0-2.147 0.484-4.181 1.348-6h3.652c0.265 0 0.52-0.105 0.707-0.293l4-4c0.188-0.188 0.293-0.442 0.293-0.707v-2.419c1.268-0.377 2.61-0.581 4-0.581 2.2 0 4.281 0.508 6.134 1.412-0.13 0.109-0.256 0.224-0.376 0.345-1.133 1.133-1.757 2.64-1.757 4.243s0.624 3.109 1.757 4.243c1.139 1.139 2.663 1.758 4.239 1.758 0.099 0 0.198-0.002 0.297-0.007 0.432 1.619 1.211 5.833-0.263 11.635-0.014 0.055-0.022 0.109-0.026 0.163-2.541 2.596-6.084 4.208-10.004 4.208z"></path>
</svg>';
$phoneicon = '<svg viewBox="0 0 32 32" fill="#383a3d">
<path d="M22 20c-2 2-2 4-4 4s-4-2-6-4-4-4-4-6 2-2 4-4-4-8-6-8-6 6-6 6c0 4 4.109 12.109 8 16s12 8 16 8c0 0 6-4 6-6s-6-8-8-6z"></path>
</svg>';
$mailicon = '<svg viewBox="0 0 32 32" fill="#383a3d">
<path d="M29 4h-26c-1.65 0-3 1.35-3 3v20c0 1.65 1.35 3 3 3h26c1.65 0 3-1.35 3-3v-20c0-1.65-1.35-3-3-3zM12.461 17.199l-8.461 6.59v-15.676l8.461 9.086zM5.512 8h20.976l-10.488 7.875-10.488-7.875zM12.79 17.553l3.21 3.447 3.21-3.447 6.58 8.447h-19.579l6.58-8.447zM19.539 17.199l8.461-9.086v15.676l-8.461-6.59z"></path>
</svg>';
@endphp
<head>
    <title>{{ config('invoice.business_name') }} Invoice</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        @font-face {
            font-family: 'Nunito';
            font-weight: bold;
            src: url('{{ storage_path('fonts/Nunito/Nunito-Bold.ttf')}}') format('truetype');
        }

        @font-face {
            font-family: 'Nunito';
            font-weight: 600;
            src: url('{{ storage_path('fonts/Nunito/Nunito-SemiBold.ttf')}}') format('truetype');
        }

        @font-face {
            font-family: 'Nunito';
            src: url('{{ storage_path('fonts/Nunito/Nunito-Regular.ttf')}}') format('truetype');
        }

        page {
            size: A4;
        }

        html {
            height: 100%;
        }

        body {
            font-family: 'Nunito', sans-serif;
            line-height: 1rem;
            color: #383a3d;
        }

        .table-heading td {
            padding: 1rem 10px;
            font-size: small;
        }

        .table-heading:first-child {
            padding-left: 50px;
        }

        table {
            border-collapse: collapse;
            border-spacing: 0;
            border: 0;
            width: 100%;
        }

  

        @media print {
            footer {
                page-break-after: always;
            }
        }

    </style>
</head>

<body style="padding: 0.8rem;">
    <img src="{{ asset(config('invoice.logo')) }}" style="max-width:250px;" />
    <br><br>
    <div style="font-size:90%; float:left; width:100%;">
        <table>
            <tr>
                <td style="width:70%; vertical-align:top; ">
                    {{ config('invoice.business_name') }}
                    <br>{{ config('invoice.address1') }}
                    @if(config('invoice.address2') != '' && config('invoice.address2') != null)<br>{{ config('invoice.address2') }}@endif
                    <br>{{ config('invoice.city') }}
                    <br>{{ config('invoice.postcode') }}
                    @if(config('invoice.vat_id') != '' && config('invoice.vat_id') != null)<br>VAT # {{ config('invoice.vat_id') }}@endif
                    <br>
                </td>

                <td style="width:30%; vertical-align:top; ">
                    <strong>Issued To:</strong><br>
                    {{ $invoice->to }}
                    <br>{{ $invoice->address1 }}<br>
                    {{ $invoice->city }}<br>
                    {{ $invoice->postcode }}<br>
                    <br><br><br><br>
                </td>
            </tr>
        </table>

        <table style="margin:1.5rem 0; font-size: large; font-weight:600; width: auto;">
            <tr>
                <td style="border-right: 2px solid lightgray; padding: 0 10px 0 0; ">
                    Invoice #{!! $invoice->number !!}</td>
                <td style="border-right: 2px solid lightgray; padding: 0 20px; ">{!! $invoice->start_date !!}</td>
                <td style="padding: 0 20px; ">{{ $invoice->status }}</td>
            </tr>
        </table>

        <table>
            <tr style="font-weight: bold; background:#f0f4f7; " class="table-heading">
                <td style="width:10%; padding-left: 20px;">Qty</td>
                <td style="width:60%;">Description</td>
                <td style="width:15%; text-align:right;">Unit Price</td>
                <td style="width:15%; text-align:right; padding-right: 20px;">Line Total</td>
            </tr>
            <tr>
                <td colspan="4" style="border-top:0.5px solid lightgray;">&nbsp;</td>
            </tr>

            @foreach($invoice->items as $i)
            <tr>
                <td style="padding-left: 20px;">{{ $i->qty }}</td>
                <td>{{ $i->name }}</td>
                <td style="text-align:right;">&pound;{!! number_format($i->price, 2) !!}</td>
                <td style="text-align:right; padding-right: 20px;">&pound;{!! number_format($i->line_total, 2) !!}</td>
            </tr>
            @endforeach

            <tr>
                <td colspan="4" style="border-bottom:1px solid lightgray;">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="4">&nbsp;</td>
            </tr>
            <tr>
                <td></td>
                <td style="text-align:right; font-weight:bold;">Subtotal &nbsp;</td>
                <td></td>
                <td style="text-align:right; padding-right: 20px;">&pound;{!! number_format($invoice->getNetTotal(), 2) !!}</td>
            </tr>
            <tr>
                <td></td>
                <td style="text-align:right; font-weight:bold;">VAT ({{ $invoice->tax_rate }}%) &nbsp;</td>
                <td></td>
                <td style="text-align:right; padding-right:20px;">&pound;{!! number_format($invoice->getTaxTotal(), 2) !!}
                </td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td colspan="2" style="border-bottom: 1px solid lightgray;">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="4">&nbsp;</td>
            </tr>
            <tr style="font-size: 120%;">
                <td></td>
                <td style="text-align:right; font-weight:bold;">Total &nbsp;</td>
                <td></td>
                <td style="text-align:right; font-weight:bold; padding-right:20px;">&pound;{!! number_format($invoice->getGrossTotal(), 2)
                    !!}</td>
            </tr>
        </table>

        <br>
        @if($invoice->message != null && $invoice->message != '')
        <br><br><br><br>
        <div style="text-align:center;">{!! $invoice->message !!}</div>
        @endif

        <footer
            style="position:fixed; bottom:3rem; left:0;  text-align: left; width: 100%; vertical-align:bottom; border-top: 1px solid lightgray; padding: 20px 0px; font-size: 80%;">
            <table style="text-align: center; vertical-align: middle">
                @if(config('invoice.website') != '' && config('invoice.website') != null)<td width="35%" style="border-right: 2px solid lightgray; padding: 5px 10px;"><img src="data:image/svg+xml;base64,{{ base64_encode($webicon) }}"  width="15px" height="15px" style="margin: 4px 10px 0 0;" />{{ config('invoice.website') }}</td>@endif
                @if(config('invoice.phone') != '' && config('invoice.phone') != null)<td width="25%" style="border-right: 2px solid lightgray; padding: 5px 10px; "><img src="data:image/svg+xml;base64,{{ base64_encode($phoneicon) }}"  width="15px" height="15px" style="margin: 4px 10px 0 0;" />{{ config('invoice.phone') }}</td>@endif
                @if(config('invoice.email') != '' && config('invoice.email') != null)<td width="40%" style="padding: 5px 10px; "><img src="data:image/svg+xml;base64,{{ base64_encode($mailicon) }}"  width="15px" height="15px" style="margin: 4px 10px 0 0;" />{{ config('invoice.email') }}</td>@endif
            </table>
        </footer>
    </div>
</body>

</html>
