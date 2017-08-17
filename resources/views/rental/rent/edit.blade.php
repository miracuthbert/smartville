@extends('layouts.estates')

@section('title')
    Rent Invoice
@endsection

@section('breadcrumb')
    <li>Rent</li>
    <li>
        <a href="{{ route('estate.rental.rents', ['id' => $app->id, 'sort' => 'all']) }}">Invoices</a>
    </li>
    <li>{{ $rent->property->title }}</li>
    <li class="active">Invoice</li>
@endsection

@section('page-header')
    {{ $rent->property->title }} Invoice for {{ MonthName($rent->date_from) }} - {{ MonthName($rent->date_to) }}
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12">

            <form name="update-rent-form" method="post" action="{{ route('estate.rental.rent.update') }}"
                  enctype="application/x-www-form-urlencoded" autocomplete="off">

                {{ csrf_field() }}

                <input type="hidden" name="_app" id="_app" value="{{ $app->id }}">

                <input type="hidden" name="id" id="id" value="{{ $rent->id }}">

                @include('partials.alerts.validation')

                @include('partials.alerts.default')

                <div class="invoice box">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="property" class="control-label">Property:</label>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <p class="form-static-control">
                                    {{ $rent->property->title }}
                                </p>
                                <input type="hidden" name="property" id="property"
                                       value="{{ $rent->property_id }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <label for="tenant" class="control-label">Tenant:</label>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <p class="form-static-control">
                                    {{ $rent->lease->tenant->user->firstname }}
                                    {{ $rent->lease->tenant->user->lastname }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <label for="group" class="control-label">Rent:</label>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <p class="form-static-control">
                                    {{ $rent->amount != null ? $rent->amount : 0 }}
                                </p>
                                <input type="hidden" name="rent" class="form-control amount"
                                       id="amount"
                                       value="{{ $rent->amount != null ? $rent->amount : 0 }}"/>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <label for="rent_from_date" class="control-label">From date:</label>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group input-group">
                                <input type="text" name="rent_from_date" class="form-control rent_from"
                                       value="{{ $rent->date_from->toDateString() }}" required>
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar-plus-o"></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <label for="rent_date_to" class="control-label">To date:</label>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="hidden" name="duration" class="form-control rent_duration"
                                       id="rent_duration" value="1">
                                <input type="text" name="rent_to_date" class="form-control rent_date_to"
                                       id="rent_date_to" value="{{ $rent->date_to->toDateString() }}" readonly required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <label class="control-label">Rent due:</label>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group input-group">
                                <input type="text" name="rent_due" class="form-control rent_due"
                                       value="{{ $rent->date_due->toDateString() }}" required>
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-default">
                                                <i class="fa fa-calendar-plus-o"></i>
                                            </button>
                                        </span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <label for="rent_status" class="control-label">Payment status:</label>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <select name="rent_status" class="form-control" id="rent_status">
                                    <option value="0" {{ $rent->status == 0 ? 'selected' : '' }}>Pending</option>
                                    <option value="1" {{ $rent->status == 1 ? 'selected' : '' }}>Paid</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="bill_paid_at">Paid at:</label>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <p class="form-static-control">
                                        {{ $rent->paid_at != null ? $bill->paid_at->toDateTimeString() : '' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <label for="total" class="control-label">Total:</label>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" name="rent_total" class="form-control rent_total" id="rent_total"
                                       value="{{ $rent->amount }}" readonly>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="box">
                            <button type="submit" name="btnUpdateRentInvoice"
                                    class="btn btn-primary" {{ $app->subscribed != 1 ? 'disabled' : '' }}>
                                Update
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        $urlGroupRentProperties = '{{ route('estate.rental.rent.group.properties') }}';
        $urlRentProperty = '{{ route('estate.rental.rent.group.property') }}';
        $urlDateGenerator = '{{ route('parse.date') }}';
        $app = '{{ $app->id }}';

        CKEDITOR.replace('property_desc');
    </script>
@endsection