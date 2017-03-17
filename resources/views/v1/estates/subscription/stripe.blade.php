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

                        <div id="charge-error"
                             class="alert alert-danger {{ !Session::has('error') ? 'hidden' : '' }}">
                            {{ Session::get('error') }}
                        </div>

                        <form action="{{ route('estate.subscription.subscribe') }}" method="post"
                              enctype="application/x-www-form-urlencoded" id="stripeSubscription">

                            {{ csrf_field() }}

                            <input type="hidden" name="_id" id="_id" value="{{ $app->id }}">

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <label for="plan">Select a subscription plan:</label>
                                            <select name="plan" id="plan" class="form-control">
                                                @foreach($plans as $plan)
                                                    <option value="{{ $plan->id }}" data-price="{{ $plan->price }}">
                                                        {{ $plan->title }} ($.{{ $plan->price }}) - {{ $plan->limit }}
                                                        tenants
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
                                </div>

                                <div class="col-lg-6">
                                    <div id="cc-info">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="name">Name:</label>
                                                    <input type="text" name="name" id="name" class="form-control"
                                                           required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="address">Address:</label>
                                                    <input type="text" name="address" id="address" class="form-control"
                                                           required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="card-name">Card Holder Name:</label>
                                                    <input type="text" name="card-name" id="card-name"
                                                           class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="card-number">Credit Card Number:</label>
                                                    <input type="text" name="card-number" id="card-number"
                                                           class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="card-expiry-month">Expiration Month:</label>
                                                    <input type="text" name="card-expiry-month" id="card-expiry-month"
                                                           class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="card-expiry-year">Expiration Year:</label>
                                                    <input type="text" name="card-expiry-year" id="card-expiry-year"
                                                           class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="card-cvc">CVC:</label>
                                                    <input type="text" name="card-cvc" id="card-cvc"
                                                           class="form-control" required>
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
        $subscription = '{{ route('estate.subscription.subscribe') }}';
    </script>
    <script type="text/javascript" src="https://js.stripe.com/v2"></script>
    <script src="{{ url('js/stripe.js') }}"></script>
@endsection