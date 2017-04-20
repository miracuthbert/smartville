<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    {{--<meta http-equiv="X-UA-Compatible" content="IE=edge">--}}
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{{ config('app.name') }}</title>

    {{--<link rel="stylesheet" href="{{ url('css/bootstrap.min.css') }}">--}}

    <style>
        * {
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }

        article, aside, details, figcaption, figure, footer, header, hgroup, main, menu, nav, section, summary {
            display: block;
        }

        :after, :before {
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }

        body {
            font-family: Helvetica;
            font-size: 14px;
            line-height: 1.42857143;
            color: #333;
            background-color: #fff;
        }

        hr {
            height: 0;
            -webkit-box-sizing: content-box;
            -moz-box-sizing: content-box;
            box-sizing: content-box;
        }

        hr {
            margin-top: 20px;
            margin-bottom: 20px;
            border: 0;
            border-top: 1px solid #eee;
        }

        .row:after, .row:before {
            display: table;
            content: " ";
        }

        .row:after {
            clear: both;
        }

        .row {
            margin-right: -15px;
            margin-left: -15px;
        }

        .col-md-1, .col-md-10, .col-md-11, .col-md-12, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9 {
            position: relative;
            min-height: 1px;
            padding-right: 15px;
            padding-left: 15px;
        }

        .col-md-1, .col-md-10, .col-md-11, .col-md-12, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9 {
            float: left
        }

        .col-md-12 {
            width: 100%
        }

        /*
        .col-md-11 {width: 91.66666667%}.col-md-10 {width: 83.33333333%}.col-md-9 {width: 75%}.col-md-8 {width: 66.66666667%}.col-md-7 {width: 58.33333333%}.col-md-6 {width: 50%}.col-md-5 {width: 41.66666667%}
        .col-md-3 {width: 25%}.col-md-2 {width: 16.66666667%}.col-md-1 {width: 8.33333333%}
         */
        .col-md-4 {
            width: 33.33333333%
        }

        .pull-right {
            float: right !important;
        }

        h1 .small, h1 small, h2 .small, h2 small, h3 .small, h3 small {
            font-size: 65%;
        }

        address {
            margin-bottom: 20px;
            font-style: normal;
            line-height: 1.42857143;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .page-break {
            page-break-after: always;
        }

        table {
            border-spacing: 0;
            border-collapse: collapse;
        }

        table > thead {
            vertical-align: middle;
        }

        table > thead > tr > th {
            padding: 8px 0px;
            line-height: 1.42857143;
            text-align: left;
            vertical-align: bottom;
            border-bottom: 2px solid #ddd;
        }

        table > thead > tr > td {
            padding: 8px 0px;
            line-height: 1.42857143;
            vertical-align: bottom;
            border-bottom: 2px solid #ddd;
        }

        table > tbody > tr:nth-of-type(odd) {
            background-color: #f9f9f9;
        }

        table > tbody > tr > td {
            padding: 4px 0px;
            line-height: 1.42857143;
            vertical-align: top;
            border-top: 1px solid #ddd;
        }

        .invoice {
            position: relative;
            background: #fff;
            border: 1px solid #f4f4f4;
            padding: 20px;
            margin: 10px 25px;
        }

        .page-header {
            margin: 10px 0 20px 0;
            font-size: 22px;
            border-bottom: 1px solid #eee;
        }

    </style>

</head>

<body>
<section class="invoice">
    <table style="width: 100%">
        <thead>
        <tr>
            <td colspan="2" class="col-md-6">
                <h2>
                    {{ $company->title }}
                </h2>
            </td>
            <td class="col-md-6 text-right">
                <strong>Invoice #{{ $rent->id }}</strong>
                <br>
                <strong>Sent On:</strong> {{ $rent->created_at->toDateString() }}
                <br>
                <strong>Payment Due:</strong> {{ $rent->date_due }}
                <br>
            </td><!-- /.col -->
            </td>
        </tr>
        <!-- /tr -->
        <tr>
            <!-- info row -->
            <td colspan="2" class="col-md-6" style="border-top: 1px solid #cccccc">
                From
                <address>
                    <strong>
                        {{ $company->address }}
                        <br>
                        {{ $company->state }}, {{ $company->city }} {{ $company->zipcode }}
                        <br>
                        <strong>Phone:</strong> (+{{ $code }}) {{ $company->phone }}
                    </strong>
                </address>
            </td><!-- /.col -->
            <td class="col-md-6 text-right" style="border-top: 1px solid #cccccc">
                To
                <address>
                    <strong>{{ $tenant->user->firstname . ' ' . $tenant->user->lastname }}</strong>
                    <br>
                    <strong>Property:</strong> {{ $property->title }}
                    <br>
                    Phone: {{ $tenant->user->phone }}
                    <br>
                    {{ $tenant->user->email }}
                </address>
            </td><!-- /.col -->
        </tr>
        <!-- /tr -->
        </thead>
        <!-- /thead -->
        <tbody>
        <tr>
            <td colspan="3">
                <h2 class="text-center"
                    style="padding-bottom: 9px; margin: 40px 0 20px; border-bottom: 1px solid #eee;">
                    RENT INVOICE
                </h2>
                <h3 class="text-center">Summary</h3>
                <table style="width: 100%; padding:20px 0 20px 0;">
                    <tbody>
                    <tr>
                        <td class="col-md-6">
                            <strong>Rent for</strong>
                        </td>
                        <td class="col-md-6 text-right">
                            {{ $rent->property->title }}
                        </td>
                    </tr>

                    <tr>
                        <td class="col-md-6">
                            <strong>From date</strong>
                        </td>
                        <td class="col-md-6 text-right">
                            {{ $rent->date_from }}
                        </td>
                    </tr>

                    <tr>
                        <td class="col-md-6">
                            <strong>To date</strong>
                        </td>
                        <td class="col-md-6 text-right">
                            {{ $rent->date_to }}
                        </td>
                    </tr>

                    <tr>
                        <td class="col-md-6">
                            <strong>Total</strong>
                        </td>
                        <td class="col-md-6 text-right">
                            {{ $currency }}. {{ $rent->amount }}
                        </td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <!-- /tr -->
{{--
        <tr>
            <td colspan="3">
                <h3 class="text-center">Payment Method</h3>
                <div class="text-center">
                    <strong>Paid by Credit Card</strong><br>
                </div>
            </td>
        </tr>
--}}
        <!-- /tr -->
        {{--
                <tr>
                    <td colspan="3">
                        <h3 class="text-center">Other Info</h3>
                        <div class="text-center">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut dicta eaque ipsa iusto
                            laboriosam nemo
                            non,
                            unde? Corporis dolorum earum harum in itaque omnis repudiandae. Facere incidunt ipsam itaque
                            maxime.
                        </div>
                    </td>
                </tr>
        --}}
                <!-- /tr -->
        </tbody>
        <!-- /tbody -->
    </table>
    <!-- /table -->
</section>
<!-- /.invoice -->
</body>
</html>