@extends('layouts.master')

@section('title')
    Welcome!
@endsection

@section('styles')
    <link href="{{ url('css/landing.css') }}" rel="stylesheet">
@endsection

@section('content')

    @include('partials.headers.default')

    <header><!-- Header -->
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <img class="img-circle" src="{{ url('images/sv_logo_00.jpg') }}"
                         alt="{{ config('app.name') }} logo">
                    @if(!Auth::check())
                        <div class="intro-text">
                            <span class="name">Welcome To {{ config('app.name') }}!</span>
                            <hr class="star-light">
                            <div class="skills">
                                <p>Get a <i>14 day</i> trial of our Rental Management App with<br>
                                    Lease Manager + Billing Service + Tenant Panel
                                </p>
                            </div>
                        </div>

                        <div class="clearfix">
                            <a href="{{ route('register') }}" class="page-scroll btn btn-xl btn-success">
                                <i class="fa fa-user-plus"></i>
                                Get Started
                            </a>
                            <a href="{{ route('login') }}" class="page-scroll btn btn-xl btn-primary">
                                Login
                                <i class="fa fa-sign-in"></i>
                            </a>
                        </div>
                    @else
                        <div class="intro-text">
                            <div class="name">
                                <i class="fa fa-star-o"></i>
                                Feature Coming Soon
                                <i class="fa fa-star-o"></i>
                            </div>

                            <hr class="star-light">

                            <div class="skills">
                                {{ $apps_coming->first()->title }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </header>
    <!-- /Header -->

    <!-- Services Section -->
    <section class="bg-white" id="services">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Services</h2>
                    <h3 class="section-subheading text-muted">What We Offer</h3>
                </div>
            </div>
            <div class="row text-center">
                @foreach($app_products as $app)
                    <div class="{{ count($app_products) <= 2 ? 'col-md-6' : 'col-md-4' }}">
                        <div class="clearfix">
                        <span class="fa-stack fa-4x">
                            <i class="fa fa-circle fa-stack-2x text-primary"></i>
                            <i class="fa {{ $app->icon }} fa-stack-1x fa-inverse"></i>
                        </span>
                        </div>
                        <h4 class="service-heading">{{ $app->title }}</h4>

                        <p class="text-muted">{{ $app->summary }}</p>

                        <p class="text-muted">
                            <a href="{{ route('app.create', ['app' => str_slug($app->title)]) }}"
                               class="btn btn-success btn-sm" data-toggle="tooltip"
                               title="Add {{ $app->title }}">
                                <i class="fa fa-plus"></i>
                                Get Started
                            </a>
                            {{--<a href="{{ route('register') }}" class="btn btn-success btn-sm">--}}
                            {{--<i class="fa fa-user-plus"></i>--}}
                            {{--Get Started--}}
                            {{--</a>--}}
                        </p>
                    </div>
                @endforeach
                @foreach($apps_coming as $app)
                    <div class="{{ count($apps_coming) <= 2 ? 'col-md-6' : 'col-md-4' }}">
                        <div class="clearfix">
                        <span class="fa-stack fa-4x">
                            <i class="fa fa-circle fa-stack-2x text-primary"></i>
                            <i class="fa {{ $app->icon }} fa-stack-1x fa-inverse"></i>
                        </span>
                        </div>
                        <h4 class="service-heading">{{ $app->title }}</h4>

                        <p class="text-muted">{{ $app->summary }}</p>

                        <p class="text-muted">
                            @if($app->mode == 0)
                                <span class="label label-warning">Coming Soon</span>
                            @endif
                        </p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    @include('partials.footers.default')

@endsection