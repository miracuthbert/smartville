@extends('layouts.blank')

@section('styles')
    <style>
        .page-break {
            page-break-before: always;
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1 class="page-header text-right">
                Report For {{ title_case($sort) }} Bills
            </h1>

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <td colspan="2" class="text-right">
                            {{ $company->title }}<br>
                            {{ $company->address }}<br>
                            {{ $company->state }}, {{ $company->city }} {{ $company->zipcode }}<br>
                            {{ $company->phone }}
                        </td>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    @foreach($bills->chunk(15) as $_bills)
        <div class="row">
            <div class="col-md-12">
                <table class="table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Property</th>
                        <th>Tenant</th>
                        <th>Bill</th>
                        <th>Amount</th>
                        <th>Date Due.</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($_bills as $bill)
                        <tr>
                            <td>
                                {{ $bill->id }}
                            </td>
                            <td>{{ $bill->property->title }}</td>
                            <td>
                                {{ $bill->lease->tenant->user->firstname }}
                                {{ $bill->lease->tenant->user->lastname }}
                            </td>
                            <td>{{ $bill->bill->title }}</td>
                            <td>
                                @if($bill->bill->bill_plan == 0)
                                    {{ $bill->unit_cost }}
                                @else
                                    {{ BillTotal($bill->previous_usage, $bill->current_usage, $bill->unit_cost) }}
                                @endif
                            </td>
                            <td>{{ $bill->date_due }}</td>
                            <td>{{ BillStatusText($bill->status) }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <hr>

                <p class="lead text-right">
                    Report generated by:
                    <br>
                    <strong>{{ config('app.name') }}, Inc</strong>
                    <br>
                    <strong>www.smartville.co</strong>
                </p>
            </div>
        </div>
        <div class="page-break"></div>
    @endforeach


@endsection