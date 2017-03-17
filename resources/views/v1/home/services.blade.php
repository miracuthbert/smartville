@extends('v1.layouts.master')

@section('title')
    App & Services
@endsection

@section('styles')
    <link href="{{ url('css/v1/home.css') }}" rel="stylesheet">
@endsection

@section('content')

    @include('v1.includes.headers.home.default-static')

    <section class="bg-white" id="services"><!-- Services Section -->
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Apps & Services</h2>
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

                        <p class="text-muted">{{ $app->summary }}
                            <a href="{{ route('service', ['id' => $app->id]) }}" class="btn btn-link">Read more...</a>
                        </p>

                        <p>
                            <a href="{{ route('app.create', ['app' => str_slug($app->title)]) }}"
                               class="btn btn-primary" data-toggle="tooltip"
                               title="Add {{ $app->title }}">
                                Get Started
                                <i class="fa fa-chevron-circle-right"></i>
                            </a>
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
                        <h4 class="service-heading">{{ $app->title }}
                            @if($app->mode == 0)
                                <span class="label label-warning">Coming Soon</span>
                            @endif
                        </h4>

                        <p class="text-muted">{{ $app->summary }}</p>

                    </div>
                @endforeach
            </div>
            <div class="hidden">
                <div class="col-md-4">
                    <div class="clearfix">
                        <span class="fa-stack fa-4x">
                            <i class="fa fa-circle fa-stack-2x text-primary"></i>
                            <i class="fa fa-building fa-stack-1x fa-inverse"></i>
                        </span>
                    </div>
                    <h4 class="service-heading">Hostel Management System</h4>

                    <p class="text-muted">Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac
                        cursus
                        commodo,
                        tortor
                        mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada
                        magna
                        mollis euismod. Donec sed odio dui. </p>

                    <p class="label label-warning">Coming Soon!</p>
                </div>
                <div class="col-md-4">
                    <div class="clearfix">
                        <span class="fa-stack fa-4x">
                            <i class="fa fa-circle fa-stack-2x text-primary"></i>
                            <i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>
                        </span>
                    </div>
                    <h4 class="service-heading">Property Finder & Booking Service</h4>

                    <p class="text-muted">Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget
                        quam.
                        Vestibulum
                        id ligula
                        porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris
                        condimentum nibh,
                        ut fermentum massa justo sit amet risus.</p>

                    <p class="label label-warning">Coming Soon!</p>
                </div>
            </div>
        </div>
    </section>

    @include('includes.footers.default')

@endsection