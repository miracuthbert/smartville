@extends('v1.layouts.master')

@section('title')
    Subscription Completed
@endsection

@section('breadcrumb')
    <li>Subscription</li>
    <li class="active">Completed</li>
@endsection

@section('page-header')
    Subscription Completed
@endsection

@section('content')
    @include('v1.includes.headers.home.default-static')

    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-lg-offset-3">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3>
                            Subscription Summary
                        </h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p class="lead">
                                    {{ $product->title }}
                                </p>
                            </div>
                            <div class="col-md-6 text-right">
                                <address class="lead">
                                    <strong>
                                        {{ $company->title }},
                                    </strong>
                                    <br>
                                    <strong>
                                        {{ $company->address }} -
                                        {{ $company->zipcode }}
                                    </strong>
                                    <br>
                                    <strong>
                                        {{ $company->city }},
                                        {{ $company->country }}
                                    </strong>
                                </address>
                            </div>
                        </div>

                        <hr>

                        <div class="lead">
                            <div class="row">
                                <div class="col-md-6">Plan</div>
                                <div class="col-md-6 text-right">{{ $plan->title }}</div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">Trial ends at</div>
                                <div class="col-md-6 text-right">{{ $subscription->trial_ends_at }}</div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">Subscription ends at</div>
                                <div class="col-md-6 text-right">{{ $subscription->ends_at }}</div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">Status</div>
                                <div class="col-md-6 text-right">{{ $app->subscribed == 1 ? 'Active' : '' }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <section class="clearfix">
                            <aside class="pull-left">
                                <a href="{{ route('user.dashboard') }}"
                                   class="btn btn-default">
                                    <i class="fa fa-user"></i>
                                    My Dashboard
                                </a>
                            </aside>
                            <aside class="pull-right">
                                <a href="{{ route('estate.dashboard', ['id' => $app->id]) }}"
                                   class="btn btn-primary fa-pull-right">
                                    App dashboard
                                    <i class="fa fa-chevron-circle-right"></i>
                                </a>
                            </aside>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('v1.includes.footers.default')
@endsection