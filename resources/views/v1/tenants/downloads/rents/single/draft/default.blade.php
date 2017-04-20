@extends('layouts.blank')

@section('content')

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <td class="col-md-6">
                    <h2>Invoice # {{ $rent->id }}</h2>
                    <p>
                        <strong>Billed to:</strong>
                        <br>
                        {{ $tenant->user->firstname . ' ' . $tenant->user->lastname }}
                        <br>
                        {{ $rent->property->title }}
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
            <thead>
            <tr>
                <th>Property</th>
                <th class="col-md-6 text-right">
                    {{ $rent->property->title }}
                </th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="col-md-6">Tenant</td>
                <td class="col-md-6 text-right">
                    {{ $rent->lease->tenant->user->firstname . $rent->lease->tenant->user->lastname }}
                </td>
            </tr>
            <tr>
                <td class="col-md-6">Rent</td>
                <td class="col-md-6 text-right">
                    {{ $rent->amount != null ? $rent->amount : 0 }}
                </td>
            </tr>
            <tr>
                <td class="col-md-6">From date</td>
                <td class="col-md-6 text-right">
                    {{ $rent->date_from }}
                </td>
            </tr>
            <tr>
                <td class="col-md-6">To date</td>
                <td class="col-md-6 text-right">
                    {{ $rent->date_to }}
                </td>
            </tr>
            </tbody>
            <tfoot>
            <tr>
                <td class="col-md-6">Total</td>
                <td class="col-md-6 text-right">
                    {{ $rent->amount }}
                </td>
            </tr>
            <tr>
                <td class="col-md-6">Rent due</td>
                <td class="col-md-6 text-right">
                    {{ $rent->date_due }}
                </td>
            </tr>
            </tfoot>
        </table>
    </div>
@endsection