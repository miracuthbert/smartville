@extends('v1.layouts.tenant')

@section('title')
    Bill Invoice
@endsection

@section('breadcrumb')
    <li>Bill</li>
    <li>
        <a href="{{ route('tenant.bills', ['id' => $tenant->id]) }}">Invoices</a>
    </li>
    <li>{{ $bill->property->title }}</li>
    <li class="active">Invoice</li>
@endsection

@section('page-header')
    <h2>
        {{ $bill->bill->title }} Invoice for
        <small>
            {{ MonthName($bill->date_from) }} - {{ MonthName($bill->date_to) }}
        </small>
    </h2>
    <hr>
@endsection

@section('content')
    <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">

    <input type="hidden" name="_app" id="_app" value="{{ $app->id }}">

    <input type="hidden" name="_bill" id="_bill" value="{{ $bill->bill->id }}">

    <input type="hidden" name="id" id="id" value="{{ $bill->id }}">

    <input type="hidden" name="bill_plan" id="bill_plan" value="{{ $bill->bill->bill_plan }}">

    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <strong>Bill Details</strong>

            <div class="pull-right">
                <a href="{{ route('tenant.bill.download.pdf', ['id' => $bill->id]) }}" class="btn btn-primary btn-sm"
                   data-toggle="tooltip" title="save as pdf">
                    <strong class="text-right">
                        <i class="fa fa-file-pdf-o"></i>
                        Save As PDF
                    </strong>
                </a>
            </div>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th class="col-md-6">
                            <strong>Property</strong>
                        </th>
                        <th class="col-md-6 text-right">
                            {{ $bill->property->title }}
                        </th>
                    </tr>
                    </thead>
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
                                <strong>Total charged units</strong>
                            </td>
                            <td class="col-md-6 text-right">
                                {{ BillTotalUnits($bill->previous_usage, $bill->current_usage) }}
                            </td>
                        </tr>
                        <tr>
                            <td class="col-md-6">
                                <strong>Charge per unit</strong>
                            </td>
                            <td class="col-md-6 text-right">
                                {{ $currency }}. {{ $bill->bill->billing_amount != null ? $bill->bill->billing_amount : '' }}
                            </td>
                        </tr>
                        <tr>
                            <td class="col-md-6">
                                <strong>Total amount</strong>
                            </td>
                            <td class="col-md-6 text-right">
                                {{ $currency }}.
                                {{ BillTotal($bill->previous_usage, $bill->current_usage, $bill->bill->billing_amount) }}
                            </td>
                        </tr>
                    @else
                        <tr>
                            <td class="col-md-6">
                                <strong>Total amount</strong>
                            </td>
                            <td class="col-md-6 text-right">
                                {{ $currency }}. {{ $bill->unit_cost != null ? $bill->unit_cost : 0 }}
                            </td>
                        </tr>
                    @endif

                    </tbody>
                    <tfoot>
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
        <div class="panel-footer">
            <div class="row">
                <div class="col-lg-12 text-right">
                    <p>
                        <strong>Payment status:</strong>
                        <span class="{{ PayStatusLabel($bill->status) }}">
                        {{ PayStatusText($bill->status) }}
                        </span>
                    </p>
                </div>
            </div>
        </div>
    </div>

@endsection