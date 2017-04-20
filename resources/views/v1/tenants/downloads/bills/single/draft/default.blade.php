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
    <link rel="stylesheet" href="{{ url('css/bootstrap.min.css') }}">
    <style>
        body {
            font-family: Helvetica;
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
        }

        .invoice-title h2, .invoice-title h3 {
            display: inline-block;
        }

        .table > tbody > tr > .no-line {
            border-top: none;
        }

        .table > thead > tr > .no-line {
            border-bottom: none;
        }

        .table > tbody > tr > .thick-line {
            border-top: 2px solid;
        }

        body > h1 {
            text-align: center;
            padding: 20px;
            border-bottom: 1px solid #cccccc;
        }

    </style>

</head>

<body>
<h1>Template 1</h1>
<section class="content content_content" style="width: 70%; margin: auto;">
    <section class="invoice">
        <!-- title row -->
        <div class="row">
            <div class="col-xs-12">
                <h2 class="page-header">
                    <i class="fa fa-globe"></i> Trust point Co.
                    <small class="pull-right">Date: 2017/01/09</small>
                </h2>
            </div><!-- /.col -->
        </div>
        <!-- info row -->
        <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
                From
                <address>
                    <strong>
                    </strong>
                </address>
            </div><!-- /.col -->
            <div class="col-sm-4 invoice-col">
                To
                <address>
                    <strong>
                        Shahid </strong>
                    <br>
                    Address:
                    Kollanpur <br>
                    Phone:
                    123456789 <br>
                    Email:ggggg@gmail.com
                </address>
            </div><!-- /.col -->
            <div class="col-sm-4 invoice-col">
                <b>Invoice #007612</b><br>
                <br>
                <b>Order ID:</b> 4F3S8J<br>
                <b>Payment Due:</b> 2/22/2014<br>
                <b>Account:</b> 968-34567
            </div><!-- /.col -->
        </div><!-- /.row -->

        <!-- Table row -->
        <div class="row">
            <div class="col-xs-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Qty</th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Sub Total</th>
                    </tr>
                    </thead>
                    <tbody>


                    <tr>
                        <td>2</td>
                        <td>18</td>
                        <td>12500</td>
                        <td>25000</td>
                    </tr>
                    </tbody>
                </table>
            </div><!-- /.col -->
        </div><!-- /.row -->

        <div class="row">
            <!-- accepted payments column -->
            <div class="col-md-12">
                <p class="lead">Amount Due 2/22/2014</p>
                <div class="table-responsive">
                    <table class="table">
                        <tbody>


                        <tr>
                            <th>Total:</th>
                            <td> 50000</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div><!-- /.col -->
        </div><!-- /.row -->

        <!-- this row will not appear when printing -->
        <div class="row no-print">
            <div class="col-xs-12">
                <a href="" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
                <button class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment</button>
                <button class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-download"></i>
                    Generate PDF
                </button>
            </div>
        </div>
    </section>
</section>

<h1>Template 2</h1>
<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="invoice-title">
                <h2>Invoice</h2>
                <h3 class="pull-right">Order # 12345</h3>
            </div>
            <hr>
            <div class="row">
                <div class="col-xs-6">
                    <address>
                        <strong>Billed To:</strong><br>
                        John Smith<br>
                        1234 Main<br>
                        Apt. 4B<br>
                        Springfield, ST 54321
                    </address>
                </div>
                <div class="col-xs-6 text-right">
                    <address>
                        <strong>Shipped To:</strong><br>
                        Jane Smith<br>
                        1234 Main<br>
                        Apt. 4B<br>
                        Springfield, ST 54321
                    </address>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6">
                    <address>
                        <strong>Payment Method:</strong><br>
                        Visa ending **** 4242<br>
                        jsmith@email.com
                    </address>
                </div>
                <div class="col-xs-6 text-right">
                    <address>
                        <strong>Order Date:</strong><br>
                        March 7, 2014<br><br>
                    </address>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><strong>Order summary</strong></h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-condensed">
                            <thead>
                            <tr>
                                <td><strong>Item</strong></td>
                                <td class="text-center"><strong>Price</strong></td>
                                <td class="text-center"><strong>Quantity</strong></td>
                                <td class="text-right"><strong>Totals</strong></td>
                            </tr>
                            </thead>
                            <tbody>
                            <!-- foreach ($order->lineItems as $line) or some such thing here -->
                            <tr>
                                <td>BS-200</td>
                                <td class="text-center">$10.99</td>
                                <td class="text-center">1</td>
                                <td class="text-right">$10.99</td>
                            </tr>
                            <tr>
                                <td>BS-400</td>
                                <td class="text-center">$20.00</td>
                                <td class="text-center">3</td>
                                <td class="text-right">$60.00</td>
                            </tr>
                            <tr>
                                <td>BS-1000</td>
                                <td class="text-center">$600.00</td>
                                <td class="text-center">1</td>
                                <td class="text-right">$600.00</td>
                            </tr>
                            <tr>
                                <td class="thick-line"></td>
                                <td class="thick-line"></td>
                                <td class="thick-line text-center"><strong>Subtotal</strong></td>
                                <td class="thick-line text-right">$670.99</td>
                            </tr>
                            <tr>
                                <td class="no-line"></td>
                                <td class="no-line"></td>
                                <td class="no-line text-center"><strong>Shipping</strong></td>
                                <td class="no-line text-right">$15</td>
                            </tr>
                            <tr>
                                <td class="no-line"></td>
                                <td class="no-line"></td>
                                <td class="no-line text-center"><strong>Total</strong></td>
                                <td class="no-line text-right">$685.99</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<h1>Template 3</h1>
<div bgcolor='#e4e4e4' text='#ff6633' link='#666666' vlink='#666666' alink='#ff6633'
     style='margin:0;font-family:Arial,Helvetica,sans-serif;border-bottom:1'>
    <table background='' bgcolor='#e4e4e4' width='100%' style='padding:20px 0 20px 0' cellspacing='0' border='0'
           align='center' cellpadding='0'>
        <tbody>
        <tr>
            <td>
                <table width='620' border='0' align='center' cellpadding='0' cellspacing='0' bgcolor='#FFFFFF'
                       style='border-radius: 5px;'>
                    <tbody>
                    <tr>
                        <td>
                            <table width='620' border='0' cellspacing='0' cellpadding='0'
                                   style='border-bottom:solid 1px #e5e5e5'>
                                <tbody>
                                <tr>
                                    <td align='left' valign='top' style='padding:0px 5px 0px 5px'>
                                        <table height='20px' width='100%' border='0' cellpadding='0' cellspacing='0'>
                                            <tbody>

                                            <tr>
                                                <td height='10px' valign='top'
                                                    style='color:#404041;font-size:13px;padding:5px 5px 0px 20px'>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td valign='top'
                                                    style='color:#404041;font-size:13px;padding:5px 5px 0px 20px'>
                                                    <strong>Order number:</strong>
                                                    12345
                                                </td>
                                            </tr>

                                            <tr>
                                                <td valign='top'
                                                    style='color:#404041;font-size:13px;padding:5px 5px 0px 20px'>
                                                    <strong>Date:</strong>
                                                    25 August 2014
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                    <td align='left' valign='top' style='padding:0px 5px 0px 5px'>
                                        <table height='146' width='100%' border='0' cellpadding='3' cellspacing='3'
                                               style='border-right:solid 1px #e5e5e5'>
                                            <tbody>
                                            <tr>
                                                <td height='16' valign='top'
                                                    style='color:#404041;font-size:13px;padding:15px 5px 0px 5px'>
                                                    <strong>Company Address:</strong>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td valign='top'
                                                    style='color:#404041;font-size:12px;padding:0px 5px 0px 5px'>
                                                    <p>
                                                        21 Random street<br>
                                                        Random Area<br>
                                                        Random Town<br>
                                                        1234<br>
                                                    </p>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td height='16' valign='top'
                                                    style='color:#404041;font-size:13px;padding:0px 5px 0px 5px'>
                                                    <strong>Tel:</strong>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td valign='top'
                                                    style='color:#404041;font-size:12px;padding:0px 5px 0px 5px'>
                                                    <p>
                                                        <a href='tel:061%937%0266%' value='+27619370266'
                                                           target='_blank'>123 456 7891</a><br>
                                                    </p>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td height='16' valign='top'
                                                    style='color:#404041;font-size:13px;padding:0px 5px 0px 5px'>
                                                    <strong>Email:</strong>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td valign='top'
                                                    style='color:#404041;font-size:12px;padding:0px 5px 0px 5px'>
                                                    <p>
                                                        <a href='mailto:info@preview.co.za'>info@preview.com</a><br>
                                                    </p>

                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                    <td align='left' valign='top' style='padding:0px 5px 0px 5px'>
                                        <table height='146' width='100%' border='0' cellpadding='3' cellspacing='3'>
                                            <tbody>
                                            <tr>
                                                <td height='16' valign='top'
                                                    style='color:#404041;font-size:13px;padding:15px 5px 0px 5px'>
                                                    <strong>Order by:</strong>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td valign='top'
                                                    style='color:#404041;font-size:12px;padding:0px 5px 0px 5px'>
                                                    <p>
                                                        Customer Name<br>
                                                        <br>
                                                    </p>

                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                    <td align='left' valign='top' style='padding:0px 5px 0px 0px'>
                                        <table height='140' width='100%' border='0' cellpadding='3' cellspacing='3'>
                                            <tbody>
                                            <tr>
                                                <td height='16' valign='top'
                                                    style='color:#404041;font-size:13px;padding:15px 5px 0px 5px'>
                                                    <strong>Deliver to:</strong>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td valign='top'
                                                    style='color:#404041;font-size:12px;line-height:16px;padding:0px 5px 0px 5px'>
                                                    <p>
                                                        Customer Street<br>
                                                        Customer Area<br>
                                                        Customer Town<br>
                                                        1234<br>
                                                    </p>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td valign='top' style='color:#404041;line-height:16px;padding:25px 20px 0px 20px'>
                            <p>
                                <section
                                        style='position: relative;clear: both;margin: 5px 0;height: 1px;border-top: 1px solid #cbcbcb;margin-bottom: 25px;margin-top: 10px;text-align: center;'>
                                    <h3 align='center'
                                        style='margin-top: -12px;background-color: #FFF;clear: both;width: 180px;margin-right: auto;margin-left: auto;padding-left: 15px;padding-right: 15px; font-family: arial,sans-serif;'>
                                        <span>TAX INVOICE</span>
                                    </h3>
                                </section>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td valign='top'
                            style='color:#404041;font-size:12px;line-height:16px;padding:25px 20px 0px 20px'>
                            <p>
                                <span><h2 style='color: #848484; font-family: arial,sans-serif; font-weight: 200;'>Hello
                                        from Company,</h2></span>
                            </p>
                            <p>
                                Thanks for shopping at <a href='company.com<' target='_blank'>company.com</a>.<br>
                                <br>We have received your order and we will notify you as soon as we have received your
                                payment.
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td style='color:#404041;font-size:12px;line-height:16px;padding:10px 16px 20px 18px'>
                            <table width='100%' border='0' cellpadding='0' cellspacing='0'
                                   style='border-radius:5px;border:solid 1px #e5e5e5'>
                                <tbody>
                                <tr>
                                    <td>
                                        <table width='570' border='0' cellspacing='0' cellpadding='0'>
                                            <tbody>
                                            <tr>
                                                <td width='15'> 
                                                </td>
                                                <td colspan='5' align='left' valign='top'
                                                    style='color:#404041;font-size:12px;line-height:16px;padding:5px 10px 3px 5px;border-bottom:solid 1px #e5e5e5'>
                                                    <strong>Product</strong>
                                                </td>
                                                <td width='85' align='right'
                                                    style='color:#404041;font-size:12px;line-height:16px;padding:5px 10px 3px 5px;border-bottom:solid 1px #e5e5e5'>
                                                    <strong>Quantity</strong>
                                                </td>
                                                <td width='60' align='right'
                                                    style='color:#404041;font-size:12px;line-height:16px;padding:5px 10px 3px 5px;border-bottom:solid 1px #e5e5e5'>
                                                    <strong>Total</strong>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width='15'> 
                                                </td>
                                                <td colspan='5' align='left' valign='top'
                                                    style='color:#404041;font-size:12px;line-height:16px;padding:5px 5px 3px 5px;border-bottom:dashed 1px #e5e5e5'>
                                                    Samsung SL-C410W Colour Laser Printer
                                                </td>
                                                <td width='85' align='right' valign='top'
                                                    style='color:#404041;font-size:12px;line-height:16px;padding:5px 5px 3px 5px;border-bottom:dashed 1px #e5e5e5'>
                                                    1
                                                </td>
                                                <td width='60' align='right' valign='top'
                                                    style='color:#404041;font-size:12px;line-height:16px;padding:5px 5px 3px 5px;border-bottom:dashed 1px #e5e5e5'>
                                                    $1,234.00
                                                </td>
                                            </tr>


                                            <tr>
                                                <td width='15'> 
                                                </td>
                                                <td width='100' align='left' valign='top'
                                                    style='color:#404041;font-size:12px;padding:10px 0px 0px 5px'>
                                                    <strong>Seller:</strong>
                                                </td>
                                                <td colspan='4' align='left' valign='top' width='115'
                                                    style='color:#ff6600;font-size:12px;padding:10px 5px 0px 5px'>
                                                    <a href='http://company.com' target='_blank'>company.com</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width='15'> 
                                                </td>
                                                <td width='100' align='left' valign='top'
                                                    style='color:#404041;font-size:12px;padding:5px 5px 0px 5px'>
                                                    <strong>Delivery method:</strong>
                                                </td>
                                                <td colspan='4' align='left' valign='top'
                                                    style='color:#404041;font-size:12px;padding:5px 5px 0px 5px'>
                                                    Courier
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width='15'> 
                                                </td>
                                                <td width='100' valign='top'
                                                    style='color:#404041;font-size:12px;padding:5px 5px 5px 5px'>
                                                    <strong>Delivery time:</strong>
                                                </td>
                                                <td colspan='4' align='left' valign='top'
                                                    style='color:#404041;font-size:12px;padding:5px 5px 5px 5px'>
                                                    1 - 2 Working Days
                                                </td>
                                                <td width='85' align='right'> 
                                                </td>
                                                <td width='60' align='right'> 
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>

                    <tr align='left'>
                        <td style='color:#404041;font-size:12px;line-height:16px;padding:10px 16px 20px 18px'>
                            <table width='0' border='0' align='left' cellpadding='0' cellspacing='0'>

                                <span><h2 style='color: #848484; font-family: arial,sans-serif; font-weight: 200;'>
                                        Banking Details</h2></span>

                                <tbody>
                                <tr>
                                    <td width='0' align='left' valign='top'
                                        style='color:#404041;font-size:12px;line-height:16px;padding:0px 0px 3px 0px'>
                                        <strong>Bank:</strong>
                                    </td>
                                    <td width='0' align='right' valign='top'
                                        style='color:#404041;font-size:12px;line-height:16px;padding:0px 5px 3px 5px'>
                                        Bank 1
                                    </td>
                                </tr>

                                <tr>
                                    <td align='left' valign='top'
                                        style='color:#404041;font-size:12px;line-height:16px;padding:5px 0px 3px 0px;'>
                                        <strong>Account Number:</strong>
                                    </td>
                                    <td width='62' align='right' valign='top'
                                        style='color:#404041;font-size:12px;line-height:16px;padding:5px 5px 3px 5px;'>
                                        123456789
                                    </td>
                                </tr>
                                <tr>
                                    <td align='left' valign='top'
                                        style='color:#404041;font-size:12px;line-height:16px;padding:5px 0px 3px 0px;'>
                                        <strong>Branch:</strong>
                                    </td>
                                    <td width='120' align='right' valign='top'
                                        style='color:#404041;font-size:12px;line-height:16px;padding:5px 5px 3px 5px;'>
                                        Bank Area
                                    </td>
                                </tr>

                                </tbody>

                                <tbody>
                                <tr>
                                    <td width='0' align='left' valign='top'
                                        style='color:#404041;font-size:12px;line-height:16px;padding:15px 0px 3px 0px'>
                                        <strong>Bank:</strong>
                                    </td>
                                    <td width='0' align='right' valign='top'
                                        style='color:#404041;font-size:12px;line-height:16px;padding:15px 5px 3px 5px'>
                                        Bank 2
                                    </td>
                                </tr>

                                <tr>
                                    <td align='left' valign='top'
                                        style='color:#404041;font-size:12px;line-height:16px;padding:5px 0px 3px 0px;'>
                                        <strong>Account Number:</strong>
                                    </td>
                                    <td width='62' align='right' valign='top'
                                        style='color:#404041;font-size:12px;line-height:16px;padding:5px 5px 3px 5px;'>
                                        123456789
                                    </td>
                                </tr>
                                <tr>
                                    <td align='left' valign='top'
                                        style='color:#404041;font-size:12px;line-height:16px;padding:5px 0px 3px 0px;'>
                                        <strong>Branch:</strong>
                                    </td>
                                    <td width='120' align='right' valign='top'
                                        style='color:#404041;font-size:12px;line-height:16px;padding:5px 5px 3px 5px;'>
                                        Bank Branch
                                    </td>
                                </tr>

                                </tbody>

                                <tbody>
                                <tr>
                                    <td width='0' align='left' valign='top'
                                        style='color:#404041;font-size:12px;line-height:16px;padding:15px 0px 3px 0px'>
                                        <strong>Bank:</strong>
                                    </td>
                                    <td width='0' align='right' valign='top'
                                        style='color:#404041;font-size:12px;line-height:16px;padding:15px 5px 3px 5px'>
                                        Bank 3
                                    </td>
                                </tr>

                                <tr>
                                    <td align='left' valign='top'
                                        style='color:#404041;font-size:12px;line-height:16px;padding:5px 0px 3px 0px;'>
                                        <strong>Account Number:</strong>
                                    </td>
                                    <td width='62' align='right' valign='top'
                                        style='color:#404041;font-size:12px;line-height:16px;padding:5px 5px 3px 5px;'>
                                        123456789
                                    </td>
                                </tr>
                                <tr>
                                    <td align='left' valign='top'
                                        style='color:#404041;font-size:12px;line-height:16px;padding:5px 0px 3px 0px;'>
                                        <strong>Branch:</strong>
                                    </td>
                                    <td width='120' align='right' valign='top'
                                        style='color:#404041;font-size:12px;line-height:16px;padding:5px 5px 3px 5px;'>
                                        Bank Branch
                                    </td>
                                </tr>

                                </tbody>
                            </table>

                            <table width='0' border='0' align='right' cellpadding='0' cellspacing='0'>
                                <tbody>
                                <tr>
                                    <td width='0' align='left' valign='top'
                                        style='color:#404041;font-size:12px;line-height:16px;padding:15px 0px 3px 0px'>
                                        <strong>VAT</strong>
                                    </td>
                                    <td width='0' align='right' valign='top'
                                        style='color:#404041;font-size:12px;line-height:16px;padding:15px 5px 3px 5px'>
                                        $123.00
                                    </td>
                                </tr>
                                <tr>
                                    <td width='0' align='left' valign='top'
                                        style='color:#404041;font-size:12px;line-height:16px;padding:15px 0px 3px 0px'>
                                        <strong>Sub-total:</strong>
                                        <span style='font-size:11px;color:#666666'>(VAT included)</span>
                                    </td>
                                    <td width='0' align='right' valign='top'
                                        style='color:#404041;font-size:12px;line-height:16px;padding:15px 5px 3px 5px'>
                                        $1,234.00
                                    </td>
                                </tr>
                                <tr>
                                    <td align='left' valign='top'
                                        style='color:#404041;font-size:12px;line-height:16px;padding:5px 0px 3px 0px'>
                                        <strong>Delivery costs:</strong>
                                    </td>
                                    <td width='62' align='right' valign='top'
                                        style='color:#404041;font-size:12px;line-height:16px;padding:5px 5px 3px 5px'>
                                        $0.00
                                    </td>
                                </tr>

                                <tr>
                                    <td align='left' valign='top'
                                        style='color:#404041;font-size:12px;line-height:16px;padding:5px 0px 3px 0px;border-bottom:solid 1px #999999'>
                                        <strong>Order discount:</strong>
                                    </td>
                                    <td width='62' align='right' valign='top'
                                        style='color:#404041;font-size:12px;line-height:16px;padding:5px 5px 3px 5px;border-bottom:solid 1px #999999'>
                                        $0.00
                                    </td>
                                </tr>
                                <tr>
                                    <td align='left' valign='bottom'
                                        style='color:#404041;font-size:13px;line-height:16px;padding:5px 0px 3px 0px'>
                                        <strong>Grand Total:</strong>
                                    </td>
                                    <td width='62' align='right' valign='bottom'
                                        style='color:#339933;font-size:13px;line-height:16px;padding:5px 5px 3px 5px'>
                                        <strong>$1,234.00</strong>
                                    </td>
                                </tr>
                                </tbody>


                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <table width='550' border='0' cellspacing='0' cellpadding='0'>
                                <tbody>
                                <tr>
                                    <td style='color:#404041;font-size:12px;line-height:16px;padding:15px 5px 5px 10px'>
                                        For more information on your order please call us on<strong> <a
                                                    href='tel:123 467 8961' value='+123 467 8961' target='_blank'>123
                                                467 8961</a></strong>, or mail us at
                                        <a href='mailto:orders@company.com'>orders@company.com</a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <table width='510' border='0' cellspacing='0' cellpadding='0'>
                                <tbody>
                                <tr>
                                    <td style='color:#404041;font-size:12px;line-height:16px;padding:5px 15px 10px 10px'>
                                        <p>
                                            Kind regards,<br>
                                            <strong>The <a href='#' target='_blank'>company.com</a> team</strong>
                                        </p>
                                    </td>
                                </tr>

                                </tbody>
                            </table>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        </tbody>
    </table>
</div>

<h1>Template 4</h1>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="invoice-title">
                <h2>Order #12345</h2>
                <hr>
            </div>
            <div class="row">
                <div class="col-xs-6">
                    <address>
                        <strong>Billed To:</strong><br>
                        John Smith<br>
                        1234 Main<br>
                        Apt. 4B<br>
                        Springfield, ST 54321
                    </address>
                </div>
                <div class="col-xs-6 text-right">
                    <address>
                        <strong>Shipped To:</strong><br>
                        Jane Smith<br>
                        1234 Main<br>
                        Apt. 4B<br>
                        Springfield, ST 54321
                    </address>
                </div>
            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><strong>Order placed on 01/23/2017</strong></h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-condensed">
                            <thead>
                            <tr>
                                <td><strong>Product</strong></td>
                                <td class="text-center"><strong>Price</strong></td>
                                <td class="text-center"><strong>Quantity</strong></td>
                                <td class="text-center"><strong>Order Status</strong></td>
                            </tr>
                            </thead>
                            <tbody>
                            <!-- foreach ($order->lineItems as $line) or some such thing here -->
                            <tr>
                                <td class="col-md-3">
                                    <div class="media">
                                        <a class="thumbnail pull-left" href="#"> <img class="media-object" src="http://lorempixel.com/460/250/" style="width: 72px; height: 72px;"> </a>
                                        <div class="media-body">
                                            <h4 class="media-heading"> Product Name</h4>
                                            <h5 class="media-heading"> Product Code</h5>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">$10.99</td>
                                <td class="text-center">1</td>
                                <td>
                                    <div class="col-md-13">
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                                                <span class="sr-only">60% Complete</span>
                                            </div>
                                            <span class="progress-type">Packaging</span>
                                            <span class="progress-completed">61%</span>
                                        </div>
                                    </div>

                                </td>
                            </tr>
                            <tr>
                                <td class="col-md-3">
                                    <div class="media">
                                        <a class="thumbnail pull-left" href="#"> <img class="media-object" src="http://lorempixel.com/460/250/" style="width: 72px; height: 72px;"> </a>
                                        <div class="media-body">
                                            <h4 class="media-heading"> Product Name</h4>
                                            <h5 class="media-heading"> Product Code</h5>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">$10.99</td>
                                <td class="text-center">1</td>
                                <td>
                                    <div class="col-md-13">
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                                                <span class="sr-only">60% Complete</span>
                                            </div>
                                            <span class="progress-type">Packaging</span>
                                            <span class="progress-completed">60%</span>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="col-md-4">
                <h3 class="text-center">Order Summary</h3><hr>
                <div class="pull-left"><h4>Subtotal</h4> </div>
                <div class="pull-right"><h4 class="text-right">$11.99</h4></div>
                <div class="clearfix"></div>
                <div class="pull-left"><h4>Tax</h4> </div>
                <div class="pull-right"><h4 class="text-right">$1.99</h4></div>
                <div class="clearfix"></div>
                <div class="pull-left"><h4>Order Total</h4> </div>
                <div class="pull-right"><h4 class="text-right">$13.50</h4></div>
                <div class="clearfix"></div>
            </div>
            <div class="col-md-4 offset-md-1">
                <h3 class="text-center">Payment Type</h3><hr>
                <div class="text-center">
                    <strong>Paid by Credit Card</strong><br>
                </div>
            </div>
            <div class="col-md-4 offset-md-2">
                <h3 class="text-center">Other Info</h3><hr>
                <address>
                    <strong>Billed To:</strong><br>
                    John Smith<br>
                    1234 Main<br>
                    Apt. 4B<br>
                    Springfield, ST 54321
                </address>
            </div>
        </div>
    </div>
</div>

<h1>Template 5</h1>
<section class="invoice">
    <div style="display: block; width: 100%">
        <table style="width: 100%; background-color:#ECF0F1;">
            <thead>
            <tr>
                <td class="col-md-6">
                    <h2>Invoice # {{ $bill->id }}</h2>
                    <p>
                        <strong>Billed to:</strong>
                        <br>
                        {{ $tenant->user->firstname . ' ' . $tenant->user->lastname }}
                        <br>
                        {{ $bill->property->title }}
                    </p>
                </td>
                <td class="col-md-6 text-right">
                    <h2>{{ $company->title }}</h2>
                    <p>
                        {{ $company->address }}
                        <br>
                        {{ $company->state }}, {{ $company->city }} {{ $company->zipcode }}
                        <br>
                        <strong title="Phone">P:</strong> (+{{ $company->country }}) {{ $company->phone }}
                    </p>
                </td>
            </tr>
            </thead>
        </table>

        <div style="display: block; width: 100%; border-top: 1px solid #CCCCCC">
            <table style="width: 100%; padding:20px 0 20px 0;">
                <tbody>
                <tr>
                    <td class="col-md-6">
                        <strong>Billed for</strong>
                    </td>
                    <td class="col-md-6 text-right">
                        {{ title_case($bill->bill->title) }}
                    </td>
                </tr>

                <tr>
                    <td class="col-md-6">
                        <strong>From date</strong>
                    </td>
                    <td class="col-md-6 text-right">
                        {{ $bill->date_from }}
                    </td>
                </tr>

                <tr>
                    <td class="col-md-6">
                        <strong>To date</strong>
                    </td>
                    <td class="col-md-6 text-right">
                        {{ $bill->date_to }}
                    </td>
                </tr>

                @if($bill->bill->bill_plan == 1)
                    <tr>
                        <td class="col-md-6">
                            <strong>Previous usage</strong>
                        </td>
                        <td class="col-md-6 text-right">
                            {{ $bill->previous_usage }}
                        </td>
                    </tr>
                    <tr>
                        <td class="col-md-6">
                            <strong>Current usage</strong>
                        </td>
                        <td class="col-md-6 text-right">
                            {{ $bill->current_usage }}
                        </td>
                    </tr>

                    <tr>
                        <td class="col-md-6">
                            <strong>Billing Amount</strong>
                        </td>
                        <td class="col-md-6 text-right">
                            {{ BillTotalUnits($bill->previous_usage, $bill->current_usage) }} &times;
                            {{ $bill->bill->billing_amount != null ? $bill->bill->billing_amount : '' }}
                        </td>
                    </tr>
                @endif

                </tbody>
                <tfoot>
                <tr>
                    <td class="col-md-6">
                        <strong>Total</strong>
                    </td>
                    <td class="col-md-6 text-right">
                        @if($bill->bill->bill_plan == 0)
                            {{ $bill->unit_cost }}
                        @else
                            {{ BillTotal($bill->previous_usage, $bill->current_usage, $bill->unit_cost) }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="col-md-6">
                        <strong>Payment due</strong>
                    </td>
                    <td class="col-md-6 text-right">
                        {{ $bill->date_due }}
                    </td>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
</section>

<h1>Template 6</h1>
<section class="invoice">
    <!-- title row -->
    <div class="row">
        <div class="col-xs-12">
            <h2 class="page-header">
                {{ $company->title }}
                <small class="pull-right">
                    <b>Invoice #{{ $bill->id }}</b><br>
                </small>
            </h2>
        </div><!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
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
        </div><!-- /.col -->
        <div class="col-sm-4 invoice-col">
            To
            <address>
                <strong>{{ $tenant->user->firstname . ' ' . $tenant->user->lastname }}</strong>
                <br>
                Phone: {{ $tenant->user->phone }}
                <br>
                {{ $tenant->user->email }}
            </address>
        </div><!-- /.col -->
        <div class="col-sm-4 invoice-col">
            <br>
            <b>Property:</b> {{ $bill->property->title }}<br>
            <b>Sent On:</b> {{ $bill->created_at->toDateString() }}<br>
            <b>Payment Due:</b> {{ $bill->date_due }}<br>
        </div><!-- /.col -->
    </div><!-- /.row -->

    <div class="row">
        <div class="col-md-12">
            <div class="col-md-4">
                <h3 class="text-center">Order Summary</h3><hr>
                <div class="pull-left"><h4>Subtotal</h4> </div>
                <div class="pull-right"><h4 class="text-right">$11.99</h4></div>
                <div class="clearfix"></div>
                <div class="pull-left"><h4>Tax</h4> </div>
                <div class="pull-right"><h4 class="text-right">$1.99</h4></div>
                <div class="clearfix"></div>
                <div class="pull-left"><h4>Order Total</h4> </div>
                <div class="pull-right"><h4 class="text-right">$13.50</h4></div>
                <div class="clearfix"></div>
            </div>
            <div class="col-md-4 offset-md-1">
                <h3 class="text-center">Payment Type</h3><hr>
                <div class="text-center">
                    <strong>Paid by Credit Card</strong><br>
                </div>
            </div>
            <div class="col-md-4 offset-md-2">
                <h3 class="text-center">Other Info</h3><hr>
                <address>
                    <strong>Billed To:</strong><br>
                    John Smith<br>
                    1234 Main<br>
                    Apt. 4B<br>
                    Springfield, ST 54321
                </address>
            </div>
        </div>
    </div>

</section>
</body>
</html>