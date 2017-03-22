@extends('layouts.estates')

@section('title')
    Invoices for {{ title_case($bill->title) }}
@endsection

@section('breadcrumb')
    <li>
        Bills
    </li>
    <li>
        <a href="{{ route('estate.rental.bills.tenants', ['id' => $app->id, 'sort' => 'all']) }}">Invoices</a>
    </li>
    <li>{{ title_case($bill->bill->title) }}</li>
    <li>{{ $bill->property->title }}</li>
@endsection

@section('page-header')
    Invoice for {{ title_case($bill->bill->title) }}
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <form class="form-horizontal" name="create-rent-invoice" method="post"
                  action="{{ route('estate.rental.bills.invoice.update') }}" enctype="application/x-www-form-urlencoded"
                  autocomplete="off">
                @include('includes.alerts.validation')

                @include('includes.alerts.default')

                <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">

                <input type="hidden" name="_app" id="_app" value="{{ $app->id }}">

                <input type="hidden" name="_bill" id="_bill" value="{{ $bill->bill->id }}">

                <input type="hidden" name="id" id="id" value="{{ $bill->id }}">

                <input type="hidden" name="bill_plan" id="bill_plan" value="{{ $bill->bill->bill_plan }}">

                <section class="box-all">
                    <div class="invoice box">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="property" class="control-label">Property:</label>
                                </div>
                                <div class="col-md-6">
                                    <p class="form-static-control">
                                        {{ $bill->property->title }}
                                    </p>
                                    <input type="hidden" name="property" id="property"
                                           value="{{ $bill->property->id }}">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="group" class="control-label">Billing Service:</label>
                                </div>

                                <div class="col-md-6">
                                    <p class="form-static-control">
                                        {{ $bill->bill->title != null ? $bill->bill->title : '' }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="group" class="control-label">Billing Amount:</label>
                                </div>

                                <div class="col-md-6">
                                    <p class="form-static-control">
                                        {{ $bill->bill->billing_amount != null ? $bill->bill->billing_amount : '' }}
                                    </p>
                                    <input type="hidden" name="bill_amount"
                                           class="form-control amount"
                                           id="amount"
                                           value="{{ $bill->bill->billing_amount != null ? $bill->bill->billing_amount : 0 }}"/>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="group" class="control-label">Billed:</label>
                                </div>

                                <div class="col-md-6">
                                    <p class="form-control-static">
                                        {{ $bill->bill->billing_interval }}/{{ $bill->bill->interval_type }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        @if($bill->bill->bill_plan == 1)
                            <div class="form-group">
                                <div class="row">

                                    <div class="col-md-4">
                                        <label>Previous usage:</label>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" name="previous_usage"
                                                   class="form-control previous_reading"
                                                   value="{{ $bill->previous_usage }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Current usage:</label>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" name="current_usage"
                                                   class="form-control current_reading"
                                                   value="{{ $bill->current_usage }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="bill_from_date" class="control-label">From date:</label>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group input-group">
                                        <input type="text" name="bill_from_date"
                                               class="form-control bill_from"
                                               placeholder="bill from date" value="{{ $bill->date_from }}"
                                               required>

                                            <span class="input-group-addon">
                                                <i class="fa fa-calendar-plus-o"></i>
                                            </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="bill_to_date" class="control-label">To date:</label>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="bill_to_date"
                                               class="form-control bill_date_to"
                                               id="bill_to_date" value="{{ $bill->date_to }}" readonly
                                               required>

                                        <input type="hidden" name="duration"
                                               class="form-control bill_duration"
                                               min="1" value="{{ $bill->bill->billing_interval }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="control-label">Bill payment due:</label>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group input-group">
                                        <input type="text" name="bill_due"
                                               class="form-control bill_due"
                                               placeholder="bill due date" value="{{ $bill->date_due }}"
                                               required>
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-default">
                                                <i class="fa fa-calendar-plus-o"></i>
                                            </button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="bill_status" class="control-label">Payment status:</label>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <select name="bill_status" class="form-control bill_status">
                                            <option value="0" {{ $bill->status == 0 ? 'selected' : '' }}>Pending
                                            </option>
                                            <option value="1" {{ $bill->status == 1 ? 'selected' : '' }}>Paid</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="total" class="control-label">Total:</label>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        @if($bill->bill->bill_plan == 0)
                                            <input type="text" name="bill_total"
                                                   class="form-control bill_total"
                                                   value="{{ $bill->unit_cost }}" readonly>
                                        @else
                                            <input type="text" name="bill_total"
                                                   class="form-control bill_total"
                                                   value="{{ BillTotal($bill->previous_usage, $bill->current_usage, $bill->unit_cost) }}"
                                                   readonly>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="box-all">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"
                                id="btnUpdateBillInvoice" {{ $app->subscribed != 1 ? 'disabled' : '' }}>Update
                        </button>
                    </div>
                </section>
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
