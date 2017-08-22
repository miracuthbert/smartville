@extends('layouts.rental.master')

@section('title', 'Edit Billing Service')

@section('breadcrumb')
    <li>Bills</li>
    <li>
        <a href="{{ route('rental.bills.services.index', [$app]) }}">Services</a>
    </li>
    <li class="active">Edit Billing Service</li>
@endsection

@section('page-header')
    Edit Billing Service
@endsection

@section('content')

    <p class="lead">You can edit and save changes of the billing service</p>

    <div class="row">
        <div class="col-lg-12">

            <form name="create-bill-form" method="post"
                  action="{{ route('rental.bills.services.update', [$app, $service]) }}"
                  enctype="application/x-www-form-urlencoded"
                  autocomplete="off">

                @include('partials.alerts.validation')

                <p class="help-block">Fields with an asterisk(*) are required</p>

                {{ csrf_field() }}
                {{ method_field('PUT') }}

                <input type="hidden" name="_app" value="{{ $app->id }}" id="_app"/>

                <input type="hidden" name="id" value="{{ $service->id }}" id="id"/>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="bill_name">Bill name: <span class="text-danger">*</span></label>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="bill_name" class="form-control"
                                   placeholder="gym, water, cleaning, maintenance" id="bill_name" maxlength="30"
                                   value="{{ old('bill_name') != null ? old('bill_name') : $service->title }}"
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
                            <input type="text" name="bill_summary" class="form-control" placeholder="bill summary"
                                   id="bill_summary"
                                   maxlength="160"
                                   value="{{ old('bill_summary') != null ? old('bill_summary') : $service->summary }}"/>
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
                                  id="bill_details">{{ old('bill_details') != null ? old('bill_details') : $service->description }}</textarea>
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
                                       value="0" {{ $service->bill_plan == 0 ? 'checked' : '' }}/>
                                Fixed
                            </label>
                            <label for="billDependent" class="radio-inline">
                                <input type="radio" name="billing_plan" id="billDependent"
                                       value="1" {{ $service->bill_plan == 1 ? 'checked' : '' }}/>
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
                                        {{ $service->properties == 0 ? 'checked' : '' }}/> Selected
                            </label>
                            <label for="billAll" class="radio-inline">
                                <input type="radio" name="billing_properties" id="billAll"
                                       value="1" {{ $service->properties == 1 ? 'checked' : '' }}/> All
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
                                   value="{{ old('billing_interval') != null ? old('billing_interval') : $service->billing_interval }}"
                                   id="billing_interval" min="1" required readonly/>
                        </div>
                        <div class="col-md-1">
                            <label>per</label>
                        </div>
                        <div class="col-md-3">
                            <select name="bill_interval_type" id="bill_interval_type" class="form-control">
                                <option value="week" {{ $service->interval_type == "week" ? 'selected' : '' }}>Week
                                </option>
                                <option value="month" {{ $service->interval_type == "month" ? 'selected' : '' }}>Month
                                </option>
                                <option value="year" {{ $service->interval_type == "year" ? 'selected' : '' }}>Year
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
                                   value="{{ old('billing_reminder') != null ? old('billing_reminder') : $service->billing_reminder }}"
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
                                   value="{{ old('billing_amount') != null ? old('billing_amount') : $service->billing_amount }}"
                                   required {{ $service->tenantBills()->count() ? 'readonly' : '' }}/>
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
                                       value="0" {{ $service->status == 0 ? 'checked' : '' }}/> Disabled
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="status" id="active"
                                       value="1" {{ $service->status == 1 ? 'checked' : '' }}/> Active
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" name="btnUpdateBillService"
                            class="btn btn-primary" {{ $app->subscribed != 1 ? 'disabled' : '' }}>
                        Update
                    </button>
                </div>
            </form>
        </div><!-- /.col-lg-12 -->
    </div><!-- /.row -->

    <script>
        CKEDITOR.replace('ckeditor');
    </script>
@endsection
