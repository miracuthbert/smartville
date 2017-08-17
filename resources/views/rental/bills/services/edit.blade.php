@extends('layouts.estates')

@section('title')
    {{ $bill->title }} Billing Service
@endsection

@section('breadcrumb')
    <li>Bills</li>
    <li>
        <a href="{{ route('estate.rental.bills.services', ['id' => $app->id, 'sort' => 'all']) }}">Services</a>
    </li>
    <li>{{ $bill->title }} Billing Service</li>
@endsection
@section('page-header')
    {{ $bill->title }} Billing Service
@endsection

@section('content')

    <p class="lead">You can edit and save changes of the billing service</p>

    <div class="row">
        <div class="col-lg-12">

            <form name="create-bill-form" method="post" action="{{ route('estate.rental.bills.service.update') }}"
                  enctype="application/x-www-form-urlencoded"
                  autocomplete="off">
                @include('partials.alerts.default')

                @include('partials.alerts.validation')

                <p class="help-block">Fields with an asterisk(*) are required</p>

                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="_token"/>

                <input type="hidden" name="_app" value="{{ $app->id }}" id="_app"/>

                <input type="hidden" name="id" value="{{ $bill->id }}" id="id"/>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="bill_name">Bill name: <span class="text-danger">*</span></label>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="bill_name" class="form-control"
                                   placeholder="gym, water, cleaning, maintenance" id="bill_name" maxlength="30"
                                   value="{{ Request::old('bill_name') != null ? Request::old('bill_name') : $bill->title }}"
                                   required autofocus/>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="bill_summary">Bill summary: <span class="text-danger">*</span></label>
                        </div>
                        <div class="col-md-6">
                        <textarea type="text" name="bill_summary" class="form-control" placeholder="bill summary"
                                  rows="3" id="bill_summary"
                                  maxlength="255">{{ Request::old('bill_summary') != null ? Request::old('bill_summary') : $bill->summary }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="bill_details">Bill details:</label>
                        </div>
                        <div class="col-md-6">
                        <textarea type="text" name="bill_details" class="form-control" placeholder="bill details"
                                  rows="5"
                                  id="bill_details">{{ Request::old('bill_details') != null ? Request::old('bill_details') : $bill->description }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Bill plan
                                <span class="text-danger">*</span>
                            </label>
                        </div>
                        <div class="col-md-6">
                            <label for="billIndependent" class="radio-inline">
                                <input type="radio" name="billing_plan" id="billIndependent"
                                       value="0" {{ $bill->bill_plan == 0 ? 'checked' : '' }}/>
                                Fixed
                            </label>
                            <label for="billDependent" class="radio-inline">
                                <input type="radio" name="billing_plan" id="billDependent"
                                       value="1" {{ $bill->bill_plan == 1 ? 'checked' : '' }}/>
                                Continous
                            </label>

                            <p class="help-block">Choose 'Continous' if bill depends on a previous value</p>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Bill properties:
                                <span class="text-danger">*</span>
                            </label>
                        </div>
                        <div class="col-md-6">
                            <label for="billSelected" class="radio-inline">
                                <input type="radio" name="billing_properties" id="billSelected" value="0"
                                        {{ $bill->properties == 0 ? 'checked' : '' }}/> Selected
                            </label>
                            <label for="billAll" class="radio-inline">
                                <input type="radio" name="billing_properties" id="billAll"
                                       value="1" {{ $bill->properties == 1 ? 'checked' : '' }}/> All
                            </label>

                            <p class="help-block">Choose 'All' if billing should be done for all properties</p>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="billing_interval">
                                Billing interval:
                                <span class="text-danger">*</span>
                            </label>
                        </div>
                        <div class="col-md-2">
                            <input type="number" name="billing_interval" class="form-control"
                                   value="{{ Request::old('billing_interval') != null ? Request::old('billing_interval') : $bill->billing_interval }}"
                                   id="billing_interval" min="1" required readonly/>
                        </div>
                        <div class="col-md-1">
                            <label>per</label>
                        </div>
                        <div class="col-md-3">
                            <select name="bill_interval_type" id="bill_interval_type" class="form-control">
                                <option value="week" {{ $bill->interval_type == "week" ? 'selected' : '' }}>Week
                                </option>
                                <option value="month" {{ $bill->interval_type == "month" ? 'selected' : '' }}>Month
                                </option>
                                <option value="year" {{ $bill->interval_type == "year" ? 'selected' : '' }}>Year
                                </option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="billing_reminder">Billing reminder on:</label>
                        </div>
                        <div class="col-md-3">
                            <input type="number" name="billing_reminder" class="form-control" id="billing_reminder"
                                   min="1" max="31"
                                   value="{{ Request::old('billing_reminder') != null ? Request::old('billing_reminder') : $bill->billing_reminder }}"
                                   required>
                        </div>
                        <div class="col-md-3">
                            <p class="form-static-control">of every month</p>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="billing_amount">
                                Billing amount:
                                <span class="text-danger">*</span>
                            </label>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="billing_amount" class="form-control" id="billing_amount"
                                   value="{{ Request::old('billing_amount') != null ? Request::old('billing_amount') : $bill->billing_amount }}"
                                   required/>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Bill status:
                                <span class="text-danger">*</span>
                            </label>
                        </div>
                        <div class="col-md-6">
                            <label class="radio-inline">
                                <input type="radio" name="status" id="disabled"
                                       value="0" {{ $bill->status == 0 ? 'checked' : '' }}/> Disabled
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="status" id="active"
                                       value="1" {{ $bill->status == 1 ? 'checked' : '' }}/> Active
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" name="btnUpdateBillService" role="button" class="btn btn-primary btn-lg">
                        Update
                    </button>
                </div>

            </form>

        </div>

    </div>

    {{--<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">--}}
    {{--<div class="modal-dialog">--}}
    {{--<div class="modal-content">--}}
    {{--<div class="modal-header">--}}
    {{--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span--}}
    {{--aria-hidden="true">&times;</span></button>--}}
    {{--<h4 class="modal-title">Edit bill invoice</h4>--}}
    {{--</div>--}}
    {{--<div class="modal-body">--}}
    {{--<form name="create-bill-form" method="post" action="" enctype="application/x-www-form-urlencoded"--}}
    {{--autocomplete="off">--}}

    {{--<input type="hidden" name="site-url" value="url" id="site-url"/>--}}

    {{--<input type="hidden" name="estate-id" value="-1" id="estate-id"/>--}}


    {{--<div class="form-group">--}}
    {{--<label for="bill-type">Service name:</label>--}}
    {{--<input type="text" name="bill-type" class="form-control"--}}
    {{--placeholder="gym, water, cleaning, mainteinance" id="bill-type" maxlength="30"/>--}}
    {{--</div>--}}

    {{--<div class="form-group">--}}
    {{--<label for="bill-desc">Service details:</label>--}}
    {{--<textarea type="text" name="bill-desc" class="form-control" placeholder="bill info"--}}
    {{--class="desc-box" id="bill-desc" maxlength="140"></textarea>--}}
    {{--</div>--}}

    {{--<div class="form-group">--}}
    {{--<p><label>Does bill depend on a previous value:</label></p>--}}

    {{--<label for="billIndependent" class="radio-inline">--}}
    {{--<input type="radio" name="bill_plan" id="billIndependent" value="0" checked="checked"/>--}}
    {{--No--}}
    {{--</label>--}}

    {{--<label for="billDependent" class="radio-inline">--}}
    {{--<input type="radio" name="bill_plan" id="billDependent" value="1"/> Yes--}}
    {{--</label>--}}
    {{--</div>--}}

    {{--<div class="form-group">--}}
    {{--<label for="bill-interval">Service billing interval (duration in months):</label>--}}
    {{--<input type="number" name="bill-interval" class="form-control" value="1" id="bill-interval"--}}
    {{--min="1" range="3" max="18"/>--}}
    {{--</div>--}}

    {{--<div class="form-group">--}}
    {{--<label for="bill-amount">Service billing amount:</label>--}}
    {{--<input type="number" name="bill-amount" class="form-control" value="0" id="bill-amount"--}}
    {{--min="0" range="10" max="1000000"/>--}}
    {{--</div>--}}

    {{--</form>--}}
    {{--</div>--}}
    {{--<div class="modal-footer">--}}
    {{--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>--}}
    {{--<button type="button" class="btn btn-primary" id="">Save changes</button>--}}
    {{--</div>--}}
    {{--</div><!-- /.modal-content -->--}}
    {{--</div><!-- /.modal-dialog -->--}}
    {{--</div><!-- /.modal -->--}}

    <script>
        CKEDITOR.replace('property_desc');
    </script>
@endsection
