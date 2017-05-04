@extends('v1.layouts.tenant')

@section('title')
    Rent Invoice
@endsection

@section('breadcrumb')
    <li>Rent</li>
    <li>
        <a href="{{ route('tenant.rents', ['id' => $tenant->id]) }}">Invoices</a>
    </li>
    <li>{{ $rent->property->title }}</li>
    <li class="active">Invoice</li>
@endsection

@section('page-header')
    <h2>
        {{ $rent->property->title }} Rent Invoice for {{ MonthName($rent->date_from) }} - {{ MonthName($rent->date_to) }}
    </h2>
    <hr>
@endsection

@section('content')
    <form name="update-rent-form" method="post" action="#"
          enctype="application/x-www-form-urlencoded" autocomplete="off">

        <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">

        <input type="hidden" name="_app" id="_app" value="{{ $app->id }}">

        <input type="hidden" name="id" id="id" value="{{ $rent->id }}">

        @include('includes.alerts.validation')

        @include('includes.alerts.default')
    </form>

    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <strong>Rent Details</strong>

            <div class="pull-right">
                <a href="{{ route('tenant.rent.download.pdf', ['id' => $rent->id]) }}" class="btn btn-primary btn-sm"
                   data-toggle="tooltip" title="save as pdf">
                    <i class="fa fa-file-pdf-o"></i>
                    Save As PDF
                </a>
            </div>
        </div>
        <div class="panel-body">
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
                            {{ $rent->date_from->toDateString() }}
                        </td>
                    </tr>
                    <tr>
                        <td class="col-md-6">To date</td>
                        <td class="col-md-6 text-right">
                            {{ $rent->date_to->toDateString() }}
                        </td>
                    </tr>
                    </tbody>
                    <tfoot>
                    <tr>
                        <td class="col-md-6">Total</td>
                        <td class="col-md-6 text-right">
                            {{ $currency }}. {{ $rent->amount }}
                        </td>
                    </tr>
                    <tr>
                        <td class="col-md-6">Rent due</td>
                        <td class="col-md-6 text-right">
                            {{ $rent->date_due->toDateString() }}
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
                        <span class="{{ PayStatusLabel($rent->status) }}">
                        {{ PayStatusText($rent->status) }}
                        </span>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection