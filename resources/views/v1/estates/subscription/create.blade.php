@extends('layouts.master')

@section('title')
    App Subscription
@endsection

@section('content')
    @include('includes.headers.default')
    <section class="section-blank section-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-pad">
                        <h1 class="page-header">Subscribe:</h1>

                        <form action="{{ route('estate.subscription.store') }}" method="post"
                              enctype="application/x-www-form-urlencoded">

                            {{ csrf_field() }}

                            <div class="row">
                                <div class="col-lg-6">
                                    <h3>Choose a Plan:</h3>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <select name="plan" id="plan" class="form-control">
                                                <option>Choose a plan</option>
                                                @foreach($plans as $plan)
                                                    <option value="{{ $plan->id }}" data-price="{{ $plan->price }}">
                                                        {{ $plan->title }} ($.{{ $plan->price }})
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <hr>

                                    <div class="row" id="planDetails">
                                        @foreach($plans as $plan)
                                            <div class="col-lg-12 plan-wrapper" id="{{ $plan->id }}"
                                                 style="display: none">
                                                <h4>Plan details:</h4>
                                                <p class="lead">
                                                    {{ $plan->title }} ($.{{ $plan->price }})
                                                </p>

                                                <h4>Summary:</h4>
                                                <p>{{ $plan->summary }}</p>

                                                <h4>Max properties:
                                                    <small>30</small>
                                                </h4>
                                            </div>
                                        @endforeach
                                    </div>

                                    <div class="row">
                                        <div id="paypal" class="col-lg-12" aria-live="assertive" style="">
                                        </div>
                                        <div class="col-lg-12">
                                            <button type="button" id="cc" class="btn btn-default btn-lg"
                                                    title="Click to pay by Credit Card">
                                                Pay By Credit Card
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div id="cc-info" style="display: none">
                                        <h3>Card Details:</h3>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="number">Credit Card Number:</label>
                                                    <div id="number" class="form-control"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="expiration-month">Expiration Month:</label>
                                                    <div id="expiration-month" class="form-control"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="expiration-year">Expiration Year:</label>
                                                    <div id="expiration-year" class="form-control"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="cvc">Secret Code (CVC):</label>
                                                    <div id="cvc" class="form-control"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="section-top">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <button type="submit" class="btn btn-primary btn-lg" id="btnSubscribe">
                                            Subscribe
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('includes.footers.default')
@endsection

@section('scripts')
    <script>
        $clientToken = '{{ $clientToken }}';
        $subscription = '{{ route('estate.subscription.store') }}';
    </script>
    <script src="{{ url('js/braintree.js') }}"></script>
    <script src="https://js.braintreegateway.com/v2/braintree.js"></script>
@endsection