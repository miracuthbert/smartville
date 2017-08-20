@extends('layouts.rental.master')

@section('title')
    App Subscription
@endsection

@section('page-header')
    App Subscription
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            @include('partials.alerts.default')
            @include('partials.alerts.validation')

            <form action="{{ route('estate.subscribe.paypal.store') }}" method="post"
                  enctype="application/x-www-form-urlencoded" id="paypalSubscription">

                {{ csrf_field() }}

                <input type="hidden" name="_id" id="_id" value="{{ $app->id }}">

                <div class="row">
                    <div class="col-lg-6">
                        <div class="box">
                            <div class="row">
                                <div class="col-lg-12">
                                    <label>Company:</label>
                                    <p class="static-form-control">
                                        {{ $company->title }}
                                    </p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <label>App:</label>
                                    <p class="static-form-control">
                                        {{ $app->product->title }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="box">
                            <div class="row">
                                <div class="col-lg-12">
                                    <label for="plan">Enter number of properties:</label>
                                    <div class="form-group input-group">
                                        <span class="input-group-addon">
                                            <strong># of properties</strong>
                                        </span>
                                        <input type="text" name="properties" min="1" id="plan-properties"
                                               class="form-control" value="{{ Request::old('properties') }}" required>
                                        <div class="input-group-btn">
                                            <button type="button" class="btn btn-primary" id="btnSubsCalculate">Calculate</button>
                                        </div>
                                    </div>
                                    <span class="help-block"></span>
                                    <input type="hidden" name="plan" id="plan" value="{{ Request::old('plan') }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-lg-12" id="plan-wrapper" style="">
                                <div class="hidden">
                                    <h3>Plan details:</h3>
                                    <h2 class="heading"></h2>

                                    <h3>Summary:</h3>
                                    <div class="summary"></div>

                                    <h3>
                                        <span class="minimum"></span> - <span class="limit"></span>
                                        <small>properties</small>
                                    </h3>
                                </div>

                                <div id="amount-wrapper" style="display: {{ Request::old('properties') == null ? 'none' : ''}};">
                                    <h1> Total: $. <strong class="amount">{{ ceil(Request::old('properties') * Request::old('price')) }}</strong>
                                        <small><em class="duration">{{ Request::old('duration') }}</em></small>
                                    </h1>

                                    <input type="hidden" name="duration" class="duration" value="{{ Request::old('duration') }}">

                                    <input type="hidden" name="price" class="price" value="{{ Request::old('price') }}">
                                </div>

                                <input type="hidden" name="_properties" class="_properties">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="box">
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-primary btn-lg" id="btnSubscribe" disabled>
                                Subscribe
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </div>
@endsection

@section('scripts')
    <script>
        var $planUrl = '{{ route('estate.subscribe.plan') }}';
    </script>
@endsection
{{--<select name="plan" id="plan" class="form-control">--}}
{{--<option>Choose a plan</option>--}}
{{--@foreach($plans as $plan)--}}
{{--<option value="{{ $plan->id }}" data-price="{{ $plan->price }}"--}}
{{--{{ Request::old('plan') == $plan->id ? 'selected' : ''  }}>--}}
{{--{{ $plan->title }}--}}
{{--({{ $plan->duration }} {{ $plan->duration_type }} @--}}
{{--$.{{ $plan->price }}) for {{ $plan->limit }} tenants--}}
{{--</option>--}}
{{--@endforeach--}}
{{--</select>--}}
