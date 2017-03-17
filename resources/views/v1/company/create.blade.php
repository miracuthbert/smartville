@extends('layouts.company')

@section('title')
    SmartVille - Create New {{ $app }}
@endsection

@section('content')

    @include('includes.headers.home.primary')

    <section class="section-top">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <nav id="breadcrumb">
                        <ul class="breadcrumb">
                            <li>{{ config('app.name') }}</li>
                            <li>App</li>
                            <li>Create</li>
                            <li class="active">{{ title_case($app) }}</li>
                        </ul>
                    </nav>
                    <!-- / #breadcrumb -->
                </div>
                <!-- / .col-md-12 -->
            </div>
            <!-- / .row -->
        </div>
        <!-- / .container -->
    </section>
    <!-- / .section-top -->

    <section class="section-top">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <section class="section-pad">
                        <form method="post" action="{{ route('app.store') }}" enctype="application/x-www-form-urlencoded" autocomplete="off">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <h1 class="page-header">Create New {{ title_case($app) }}</h1>

                                        <p class="help-block">
                                            Fields with an asterisk (<span class="text-danger">*</span>) are required.
                                        </p>

                                        <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">

                                        <input type="hidden" name="_app" id="_app" value="{{ $app_data->id }}">

                                        <input type="hidden" name="_role" id="_role" value="3">

                                        @include('includes.alerts.error')

                                        @include('includes.alerts.validation')
                                    </div>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('company') ? 'has-error' : '' }}">
                                        <label for="company">Company name: <span class="text-danger">*</span></label>
                                        <input type="text" name="company" class="form-control" id="company"
                                               value="{{ Request::old('company') }}" required
                                               autofocus>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('country') ? 'has-error' : '' }}">
                                        <label for="name">Country: <span class="text-danger">*</span></label>
                                        <select name="country" class="form-control" id="country" required>
                                            <option>Pick a country</option>
                                            @foreach($countries as $country)
                                                <option value="{{ $country }}">
                                                    {{ $country }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('city') ? 'has-error' : '' }}">
                                        <label for="name">City:</label>
                                        <input type="text" name="city" class="form-control" id="city"
                                               value="{{ Request::old('city') }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('zipcode') ? 'has-error' : '' }}">
                                        <label for="name">Zipcode:</label>
                                        <input type="text" name="zipcode" class="form-control" id="zipcode"
                                               value="{{ Request::old('zipcode') }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('state') ? 'has-error' : '' }}">
                                        <label for="state">State:</label>
                                        <input type="text" name="state" class="form-control" id="state"
                                               value="{{ Request::old('state') }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('address') ? 'has-error' : '' }}">
                                        <label for="address">Street (or address):</label>
                                        <input type="text" name="address" class="form-control" id="address"
                                               value="{{ Request::old('address') }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('phone') ? 'has-error' : '' }}">
                                        <label for="phone">Phone: <span class="text-danger">*</span></label>
                                        <input type="text" name="phone" class="form-control" id="phone"
                                               value="{{ Request::old('phone') }}" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('email') ? 'has-error' : '' }}">
                                        <label for="email">Email: <span class="text-danger">*</span></label>
                                        <input type="email" name="email" class="form-control" id="email" value="{{ Request::old('email') }}" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row hidden">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="clearfix">
                                            <label>Status:
                                                <span class="text-danger">*</span>
                                            </label>
                                        </div>

                                        <label class="radio-inline">
                                            <input type="radio" name="status" id="disabled" value="0">Disabled
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="status" id="active" value="1" checked>Active
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                    </div>
                                </div>
                            </div>

                            <div class="row hidden">
                                <hr>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h3>Subscription plan</h3>
                                        <select name="subscription_plan" id="subscription_plan" class="form-control">
                                            <option>Select a plan</option>
                                            @foreach($app_data->plansActive as $plan)
                                                <option value="{{ $plan->id }}">{{ $plan->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for=""></label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="terms" id="terms" value="1" required>
                                            I agree to the
                                            <a href="#" title="terms of use" class="btn btn-link btn-xs">
                                                Terms of use
                                            </a>
                                            and
                                            <a href="#" title="privacy policy" class="btn btn-link btn-xs">
                                                Privacy policy
                                            </a>
                                            of this site.
                                            <span class="text-danger">*</span>
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success btn-lg" id="btnCreateApp" disabled>
                                            Create App
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!-- / form -->
                    </section>
                    <!-- / .section-pad -->
                </div>
                <!-- / .col-md-12 -->
            </div>
            <!-- / .row -->
        </div>
        <!-- / .container -->
    </section>
    <!-- / .section-top -->

    @include('includes.footers.default')

@endsection