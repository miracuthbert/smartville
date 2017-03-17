@extends('layouts.master')

@section('title')
    Subscription Completed
@endsection

@section('styles')
    <link href="{{ url('css/sb-admin-2.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    @include('includes.headers.plain')

    <section class="section-blank section-btm">
        <div class="section-blank">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-3 col-xs-12">
                        <div class="panel panel-green">
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
                                                {{ $company->title }}
                                            </strong>
                                            <br>
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
                                </div>

                                <hr>

                                <div class="lead">
                                    <div class="row">
                                        <div class="col-md-6">Plan</div>
                                        <div class="col-md-6">{{ 'plan title' }}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">Trial ends at</div>
                                        <div class="col-md-6">{{ 'trial end' }}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">Subscription ends at</div>
                                        <div class="col-md-6">{{ 'subscription end' }}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">Status</div>
                                        <div class="col-md-6">{{ 'status' }}</div>
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
                                           class="btn btn-success fa-pull-right">
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
        </div>
    </section>

    @include('includes.footers.default')
@endsection