@extends('layouts.blank')

@section('content')

    <div class="table-responsive">
        <table class="table table-striped">
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
    </div>

    <div class="table-responsive">
        <table class="table table-striped">
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

@endsection