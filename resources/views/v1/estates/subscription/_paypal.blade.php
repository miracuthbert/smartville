@extends('layouts.estates')

@section('title')
    App Subscription
@endsection

@section('page-header')
    App Subscription
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            @include('includes.alerts.default')
            @include('includes.alerts.validation')

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
                                        <input type="text" name="properties" min="1" id="plan-properties"
                                               class="form-control">
                                        <span class="input-group-addon">properties</span>
                                    </div>
                                    <input type="hidden" name="plan" id="plan" value="-1">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="row" id="planDetails">
                            @foreach($plans as $plan)
                                <div class="col-lg-12 plan-wrapper text-center" id="{{ $plan->id }}"
                                        {{ Request::old('plan') == $plan->id ? '' : 'style=display:none;'  }}>
                                    <h3>Plan details:</h3>
                                    <h2>
                                        {{ $plan->title }}
                                    </h2>

                                    <h1>$.
                                        <span class="amount">
                                            {{ $plan->price }}
                                        </span>
                                        <small>
                                            {{ $plan->duration_type }}
                                        </small>
                                    </h1>

                                    <h3>Summary:</h3>
                                    <p>{{ $plan->summary }}</p>

                                    <h3>
                                        {{ $plan->minimum }} - {{ $plan->limit }}
                                        <small>properties</small>
                                    </h3>

                                    <input type="hidden" name="price" class="price" value="{{ $plan->price }}">

                                    <input type="hidden" name="_properties" class="_properties"
                                           min="{{ $plan->minimum }}" max="{{ $plan->limit }}" value="{{ $plan->id }}">
                                </div>
                            @endforeach
                        </div>

                        <div id="cc-info" class="hidden">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="company">Company details:</label>
                                        <address>
                                            <h3>
                                                {{ $company->title }}
                                            </h3>
                                            <strong>
                                                {{ $company->zipcode }} -
                                                {{ $company->address }}
                                            </strong>
                                            <br>
                                            <strong>
                                                {{ $company->city }},
                                                {{ $company->country }}
                                            </strong>
                                        </address>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Paid via:</label>
                                        <input type="hidden" name="name" id="name" class="form-control"
                                               value="{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}"
                                               required>
                                        <input type="hidden" name="email" id="email" class="form-control"
                                               value="{{ Auth::user()->email }}" required>
                                        <p>
                                            {{ Auth::user()->firstname }} {{ Auth::user()->lastname }}
                                            <br>
                                            {{ Auth::user()->email }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="box">
                        <div class="col-lg-12">
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
