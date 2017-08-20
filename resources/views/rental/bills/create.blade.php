@extends('layouts.rental.master')

@section('title')
    Invoices for {{ title_case($bill->title) }}
@endsection

@section('breadcrumb')
    <li>Bills</li>
    <li>
        <a href="{{ route('estate.rental.bills.generate', ['id' => $app->id]) }}">Generate</a>
    </li>
    <li>{{ title_case($bill->title) }}</li>
    <li class="active">Invoices</li>
@endsection

@section('page-header')
    Invoices for {{ title_case($bill->title) }}
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            @if(count($properties) > 0)
                <form class="form-horizontal" name="create-rent-invoice" method="post"
                      action="{{ route('estate.rental.bills.invoices.store') }}"
                      enctype="application/x-www-form-urlencoded"
                      autocomplete="off">
                    @include('partials.alerts.default')
                    @include('partials.alerts.validation')

                    {{ csrf_field() }}

                    <input type="hidden" name="_app" id="_app" value="{{ $app->id }}">

                    <input type="hidden" name="_bill" id="_bill" value="{{ $bill->id }}">

                    <input type="hidden" name="bill_plan" id="bill_plan" value="{{ $bill->bill_plan }}">

                    <section class="box-all">
                        @foreach($properties as $invoice)
                            <div class="box invoice">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="property" class="control-label">Property:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="form-static-control">
                                                {{ $invoice->title }}
                                            </p>
                                            <input type="hidden" name="property[]" id="property"
                                                   value="{{ $invoice->id }}">
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
                                                {{ $bill->title != null ? $bill->title : '' }}
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
                                                {{ $bill->billing_amount != null ? $bill->billing_amount : '' }}
                                            </p>
                                            <input type="hidden" name="bill_amount[]"
                                                   class="form-control amount"
                                                   id="amount"
                                                   value="{{ $bill->billing_amount != null ? $bill->billing_amount : 0 }}"/>
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
                                                {{ $bill->billing_interval }}/{{ $bill->interval_type }}
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                @if($bill->bill_plan == 1)
                                    <div class="form-group">
                                        <div class="row">

                                            <div class="col-md-4">
                                                <label>Previous usage:</label>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" name="previous_usage[]"
                                                           class="form-control previous_reading"
                                                           value="{{ Request::old('previous_usage')[$loop->index] != null ? Request::old('previous_usage')[$loop->index] : 0 }}"
                                                           required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Current usage:</label>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" name="current_usage[]"
                                                           class="form-control current_reading"
                                                           value="{{ Request::old('current_usage')[$loop->index] != null ? Request::old('current_usage')[$loop->index] : 0 }}"
                                                           placeholder="current usage" required>
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
                                                <input type="text" name="bill_from_date[]"
                                                       class="form-control bill_from"
                                                       value="{{ Request::old('bill_from_date')[$loop->index] != null ? Request::old('bill_from_date')[$loop->index] : $from_date }}"
                                                       placeholder="bill from date" required>

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
                                                <input type="text" name="bill_to_date[]"
                                                       class="form-control bill_date_to" id="bill_to_date"
                                                       value="{{ Request::old('bill_to_date')[$loop->index] != null ? Request::old('bill_to_date')[$loop->index] : $to_date }}"
                                                       readonly required>

                                                <input type="hidden" name="duration[]"
                                                       class="form-control bill_duration" min="1"
                                                       value="{{ $bill->billing_interval }}">
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
                                                <input type="text" name="bill_due[]"
                                                       class="form-control date-selector bill_due"
                                                       placeholder="bill due date"
                                                       value="{{ Request::old('bill_due')[$loop->index] != null ? Request::old('bill_due')[$loop->index] : $due_date }}"
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
                                                <select name="bill_status[]" class="form-control bill_status">
                                                    <option value="0">Pending</option>
                                                    <option value="1">Paid</option>
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
                                                <input type="text" name="bill_total[]" class="form-control bill_total"
                                                       value="{{ Request::old('bill_total')[$loop->index] != null ? Request::old('bill_total')[$loop->index] : $bill->billing_amount }}"
                                                       readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="box">
                                        <button type="submit" name="btnAddBills" role="button"
                                                class="btn btn-success btn-lg"
                                                {{ $app->subscribed != 1 ? 'disabled' : '' }}>
                                            <i class="fa fa-check-square-o"></i>
                                            Create
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </form>
            @endif
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $urlGroupRentProperties = '{{ route('estate.rental.rent.group.properties') }}';
        $urlRentProperty = '{{ route('estate.rental.rent.group.property') }}';
        $urlDateGenerator = '{{ route('parse.date') }}';
        $app = '{{ $app->id }}';

        //        CKEDITOR.replace('property_desc');
    </script>
@endsection
