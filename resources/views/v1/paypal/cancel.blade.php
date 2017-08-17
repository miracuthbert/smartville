@extends('v1.layouts.master')

@section('title')
    Subscription Cancelled
@endsection

@section('content')

    @include('v1.includes.headers.home.default-static')

    <div class="section-blank">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-lg-offset-3">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3>
                                Subscription Cancelled
                            </h3>
                        </div>
                        <div class="panel-body lead">
                            <p>Subscription process cancelled.</p>
                            <p>You can still subscribe by clicking the
                                <span class="text-info">Subscribe</span> button below.</p>
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
                                    <div class="btn-group">
                                        <a href="{{ route('estate.subscription.add', ['id' => $app->id]) }}"
                                           class="btn btn-info">
                                            <i class="fa fa-credit-card"></i>
                                            Subscribe now!
                                        </a>
                                        <a href="{{ route('estate.dashboard', ['id' => $app->id]) }}"
                                           class="btn btn-primary fa-pull-right">
                                            App dashboard
                                            <i class="fa fa-chevron-circle-right"></i>
                                        </a>
                                    </div>
                                </aside>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('partials')
@endsection