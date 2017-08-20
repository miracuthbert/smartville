@extends('layouts.rental.master')

@section('title')
    Rent Invoices
@endsection

@section('breadcrumb')
    <li>Rent</li>
    <li class="active">Invoices</li>
@endsection

@section('page-header')
    Add Rent Invoice
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12">
            @if(count($invoices) > 0)
                <form class="form-horizontal" name="create-rent-invoice" method="post"
                      action="{{ route('estate.rental.rent.store') }}" enctype="application/x-www-form-urlencoded"
                      autocomplete="off">
                    @include('partials.alerts.validation')

                    @include('partials.alerts.default')

                    <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">

                    <input type="hidden" name="_app" id="_app" value="{{ $app->id }}">

                    {{--Check if old request is not present--}}
                    @if(count(Request::old('property')) <= 0)
                        @foreach($invoices as $invoice)
                            <div class="invoice box">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="property" class="control-label">Property:</label>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <p class="form-static-control">
                                                {{ $invoice->title }}
                                            </p>
                                            <input type="hidden" name="property[]" id="property"
                                                   value="{{ $invoice->id }}">
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
                                                {{ $invoice->price->price != null ? $invoice->price->price : 0 }}
                                            </p>
                                            <input type="hidden" name="rent[]" class="form-control amount"
                                                   id="amount"
                                                   value="{{ $invoice->price->price != null ? $invoice->price->price : 0 }}"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="rent_from_date" class="control-label">From date:</label>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group input-group">
                                            <input type="text" name="rent_from_date[]"
                                                   class="form-control rent_from" placeholder="rent from date" required>

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

                                    <div class="col-md-2">
                                        <div class="form-group input-group">
                                            <input type="number" name="duration[]" class="form-control rent_duration"
                                                   id="rent_duration" min="1" value="1">
                                            <span class="input-group-addon">
                                                month(s)
                                            </span>
                                        </div>
                                    </div>

                                    <div class="col-md-3 col-md-offset-1">
                                        <div class="form-group">
                                            <input type="text" name="rent_date_to[]" class="form-control rent_date_to"
                                                   id="rent_date_to" value="" readonly required>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-md-offset-4">
                                        <div class="form-group">
                                            <p class="help-block">Change duration to assign date above</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="control-label">Rent due:</label>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group input-group">
                                            <input type="text" name="rent_due[]" class="form-control rent_due"
                                                   placeholder="rent due date" required>
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
                                            <select name="rent_status[]" class="form-control" id="rent_status">
                                                <option value="0">Pending</option>
                                                <option value="1">Paid</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="total" class="control-label">Total:</label>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" name="rent_total[]" class="form-control rent_total"
                                                   id="rent_total"
                                                   value="{{ $invoice->price->price }}"
                                                   readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        @foreach($invoices as $invoice)
                            @for($i = 0; $i < count(Request::old('property')); $i++)
                                @if($invoice->id == Request::old('property')[$i])
                                    <div class="invoice box">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="property" class="control-label">Property:</label>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <p class="form-static-control">
                                                        {{ $invoice->title }}
                                                    </p>
                                                    <input type="hidden" name="property[]" id="property"
                                                           value="{{ $invoice->id }}">
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
                                                        {{ $invoice->price->price != null ? $invoice->price->price : 0 }}
                                                    </p>
                                                    <input type="hidden" name="rent[]" class="form-control amount"
                                                           id="amount"
                                                           value="{{ $invoice->price->price != null ? $invoice->price->price : 0 }}"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="rent_from_date" class="control-label">From date:</label>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group input-group">
                                                    <input type="text" name="rent_from_date[]"
                                                           class="form-control rent_from" placeholder="rent from date"
                                                           value="{{ Request::old('rent_from_date')[$i] }}"
                                                           required>

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

                                            <div class="col-md-2">
                                                <div class="form-group input-group">
                                                    <input type="number" name="duration[]"
                                                           class="form-control rent_duration"
                                                           id="rent_duration" min="1"
                                                           value="{{ Request::old('duration')[$i] }}">
                                                    <span class="input-group-addon">
                                                        month(s)
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="col-md-3 col-md-offset-1">
                                                <div class="form-group">
                                                    <input type="text" name="rent_date_to[]"
                                                           class="form-control rent_date_to"
                                                           id="rent_date_to"
                                                           value="{{ Request::old('rent_date_to')[$i] }}"
                                                           readonly required>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-md-offset-4">
                                                <div class="form-group">
                                                    <p class="help-block">Change duration to assign date above</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="control-label">Rent due:</label>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group input-group">
                                                    <input type="text" name="rent_due[]" class="form-control rent_due"
                                                           value="{{ Request::old('rent_due')[$i] }}"
                                                           required>
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
                                                    <select name="rent_status[]" class="form-control" id="rent_status">
                                                        <option value="0">Pending</option>
                                                        <option value="1">Paid</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="total" class="control-label">Total:</label>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" name="rent_total[]"
                                                           class="form-control rent_total"
                                                           id="rent_total"
                                                           value="{{ Request::old('rent_total')[$i] }}"
                                                           readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endfor
                        @endforeach
                    @endif
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box">
                                <div class="pull-right">
                                    <button type="submit" name="btnAddTntRent" role="button"
                                            class="btn btn-success btn-lg" {{ $app->subscribed != 1 ? 'disabled' : '' }}>
                                        Create <i class="fa fa-check-square-o"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
            @endif
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
{{--<div class="invoice box">--}}
{{--<div class="row">--}}
{{--<div class="col-md-4">--}}
{{--<label for="group" class="control-label">Group:</label>--}}
{{--</div>--}}

{{--<div class="col-md-6">--}}
{{--<div class="form-group">--}}
{{--<select name="group[]" id="rent_group" class="form-control">--}}
{{--<option>Select a group</option>--}}
{{--<option></option>--}}
{{--@foreach($groups as $group)--}}
{{--<option value="{{ $group->id }}"--}}
{{--{{ Request::old('group') == $group->id ? 'selected' : ''}}>--}}
{{--{{ $group->title }}--}}
{{--</option>--}}
{{--@endforeach--}}
{{--</select>--}}
{{--<p class="help-block">Choose blank for properties with no group.</p>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}

{{--<div class="row">--}}
{{--<div class="col-md-4">--}}
{{--<label for="property" class="control-label">Property: {{ $invoice->title }}</label>--}}
{{--</div>--}}
{{--<div class="col-md-6">--}}
{{--<div class="form-group">--}}
{{--<select name="property[]" id="property" class="form-control">--}}
{{--<option>Select a group first</option>--}}
{{--</select>--}}
{{--</div>--}}

{{--<input type="hidden" name="amount" class="form-control" value="0" id="amount"--}}
{{--readonly/>--}}
{{--</div>--}}
{{--</div>--}}

{{--<div class="row">--}}
{{--<div class="col-md-4">--}}
{{--<label for="rent_from_date" class="control-label">From date:</label>--}}
{{--</div>--}}
{{--<div class="col-md-6">--}}
{{--<div class="form-group input-group">--}}
{{--<input type="text" name="rent_from_date[]"--}}
{{--class="form-control date-selector rent-from"--}}
{{--id="rent_from_date" placeholder="rent from date" required>--}}

{{--<span class="input-group-addon">--}}
{{--<i class="fa fa-calendar-plus-o"></i>--}}
{{--</span>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}

{{--<div class="row">--}}
{{--<div class="col-md-4">--}}
{{--<label for="rent_date_to" class="control-label">To date:</label>--}}
{{--</div>--}}

{{--<div class="col-md-2">--}}
{{--<div class="form-group input-group">--}}
{{--<input type="number" name="duration" class="form-control rent-duration" min="1"--}}
{{--value="1">--}}
{{--<span class="input-group-addon">--}}
{{--month(s)--}}
{{--</span>--}}
{{--</div>--}}
{{--</div>--}}

{{--<div class="col-md-3 col-md-offset-1">--}}
{{--<div class="form-group">--}}
{{--<input type="text" name="rent_date_to[]" class="form-control rent_date_to"--}}
{{--readonly--}}
{{--required>--}}
{{--</div>--}}
{{--</div>--}}

{{--<div class="col-md-6 col-md-offset-4">--}}
{{--<div class="form-group">--}}
{{--<p class="help-block">Change duration to assign date above</p>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}

{{--<div class="row">--}}
{{--<div class="col-md-4">--}}
{{--<label for="rent_due" class="control-label">Rent due:</label>--}}
{{--</div>--}}
{{--<div class="col-md-6">--}}
{{--<div class="form-group input-group">--}}
{{--<input type="text" name="rent_due[]" class="form-control date-selector"--}}
{{--id="rent_due"--}}
{{--required>--}}
{{--<span class="input-group-btn">--}}
{{--<button type="button" class="btn btn-default">--}}
{{--<i class="fa fa-calendar-plus-o"></i>--}}
{{--</button>--}}
{{--</span>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}

{{--<div class="row">--}}
{{--<div class="col-md-4">--}}
{{--<label for="rent_status" class="control-label">Payment status:</label>--}}
{{--</div>--}}
{{--<div class="col-md-6">--}}
{{--<div class="form-group">--}}
{{--<select name="rent_status[]" class="form-control" id="rent_status">--}}
{{--<option>Set status</option>--}}
{{--<option value="0">Pending</option>--}}
{{--<option value="1">Paid</option>--}}
{{--</select>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}

{{--<div class="row">--}}
{{--<div class="col-md-4">--}}
{{--<label for="total" class="control-label">Total:</label>--}}
{{--</div>--}}
{{--<div class="col-md-6">--}}
{{--<div class="form-group">--}}
{{--<input type="text" name="rent_total[]" class="form-control rent_total"--}}
{{--id="rent_total"--}}
{{--readonly>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
