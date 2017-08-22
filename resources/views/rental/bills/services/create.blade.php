@extends('layouts.rental.master')

@section('title', 'Add Billing Service')

@section('breadcrumb')
    <li>Billing</li>
    <li>Add Billing Service</li>
@endsection

@section('page-header')
    Add Billing Service
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <p class="lead">Fill in the fields below to create a new billing service</p>

            <form name="create-bill-service-form" method="post" action="{{ route('rental.bills.services.store', [$app]) }}"
                  enctype="application/x-www-form-urlencoded"
                  autocomplete="off">

                <p class="help-block">Fields with an asterisk(*) are required</p>

                @include('partials.alerts.validation')

                {{ csrf_field() }}

                <input type="hidden" name="_app" value="{{ $app->id }}" id="_app"/>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="bill_name">Bill name: <span class="text-danger">*</span></label>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="bill_name" class="form-control"
                                   placeholder="gym, water, cleaning, maintenance" id="bill_name" maxlength="30"
                                   value="{{ old('bill_name') != null ? old('bill_name') : '' }}"
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
                        <input type="text" name="bill_summary" class="form-control" placeholder="bill summary" id="bill_summary"
                                  maxlength="160" value="{{ old('bill_summary') != null ? old('bill_summary') : '' }}"/>
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
                                  id="bill_details">{{ old('bill_details') != null ? old('bill_details') : '' }}</textarea>
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
                                <input type="radio" name="billing_plan" id="billIndependent" value="0"
                                       checked="checked"/>
                                Fixed
                            </label>
                            <label for="billDependent" class="radio-inline">
                                <input type="radio" name="billing_plan" id="billDependent" value="1"/> Continous
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
                                       checked="checked"/>
                                Selected
                            </label>
                            <label for="billAll" class="radio-inline">
                                <input type="radio" name="billing_properties" id="billAll" value="1"/> All
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
                                   value="{{ old('billing_interval') != null ? old('billing_interval') : 1 }}"
                                   id="billing_interval" min="1" required readonly/>
                        </div>
                        <div class="col-md-1">
                            <label>per</label>
                        </div>
                        <div class="col-md-3">
                            <select name="bill_interval_type" id="bill_interval_type" class="form-control">
                                <option value="week">Week</option>
                                <option value="month" selected>Month</option>
                                <option value="year">Year</option>
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
                                   value="{{ old('billing_reminder') != null ? old('billing_reminder') : 1 }}"
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
                                   value="{{ old('billing_amount') != null ? old('billing_amount') : '0.00' }}"
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
                                <input type="radio" name="status" id="disabled" value="0"/> Disabled
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="status" id="active" value="1" checked/> Active
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" name="btnAddBill" role="button"
                            class="btn btn-success" {{ $app->subscribed != 0 ? 'disabled' : '' }}>
                        Save
                    </button>
                </div>

            </form>
        </div>
    </div>

    <script>
        CKEDITOR.replace('ckeditor');
    </script>
@endsection
