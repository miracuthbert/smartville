@extends('layouts.company')

@section('title')
    App & Services
@endsection

@section('styles')
    {{--<link href="{{ url('css/v1/home.css') }}" rel="stylesheet">--}}
    @endsection

    @section('content')

    @include('v1.includes.headers.home.default-static')

    <section class="bg-white box" id="services">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="section-heading">Apps & Services</h2>
                </div>
            </div>

            <h3 class="page-header"><i class="fa fa-laptop"></i> Apps</h3>

            <div class="row text-center" id="apps">
                @forelse($app_products as $app)
                    <div class="{{ count($app_products) < 3 ? 'col-md-6' : 'col-md-4' }}">
                        <header class="clearfix">
                            <span class="fa-stack fa-4x">
                                <i class="fa fa-circle fa-stack-2x text-primary"></i>
                                <i class="fa {{ $app->icon }} fa-stack-1x fa-inverse"></i>
                            </span>
                            <!-- /icon -->
                            <h4 class="service-heading">{{ $app->title }}
                                @if(!$app->mode == 1)
                                    <small data-toggle="tooltip"
                                           title="{{ AppModeInfo($app->mode) }}">
                                        <span class="label label-warning">Beta</span>
                                    </small>
                                @endif
                            </h4>
                            <!-- /title -->
                        </header>
                        <!-- /header -->
                        <hr>
                        <section class="clearfix summary">
                            {!! $app->summary !!}
                        </section>
                        <!-- /summary -->
                        <hr>

                        <div class="text-muted">
                            <a href="{{ route('service', ['id' => $app->id]) }}" class="btn btn-default">
                                Learn more <i class="fa {{ $app->icon }}"></i>
                            </a>

                            <a href="{{ route('app.create', ['app' => str_slug($app->title)]) }}"
                               class="btn btn-primary" data-toggle="tooltip"
                               title="Add {{ $app->title }}">
                                Get Started
                                <i class="fa fa-chevron-circle-right"></i>
                            </a>
                        </div>
                        <!-- /links -->

                        @if($loop->count > 1 && $loop->last)
                            <hr class="hidden-md hidden-lg hidden-sm">
                        @endif
                    </div><!-- /.col-md-* -->
                    <p></p>

                @empty
                    <p class="text-muted">Sorry, some error occured. Reload page.</p>
                @endforelse
            </div><!-- /.row#apps -->

            <h3 class="page-header"><i class="fa fa-hourglass-half"></i> Coming Soon</h3>

            <div class="row text-center" id="apps-soon">
                @forelse($apps_coming as $app)
                    <div class="{{ count($apps_coming) < 3 ? 'col-md-6' : 'col-md-4' }}">
                        <header>
                            <span class="fa-stack fa-4x">
                                <i class="fa fa-circle fa-stack-2x text-primary"></i>
                                <i class="fa {{ $app->icon }} fa-stack-1x fa-inverse"></i>
                            </span>
                            <!-- /icon -->

                            <h4 class="service-heading">{{ $app->title }}
                                @if($app->mode == 0)
                                    <span class="label label-warning">Coming Soon</span>
                                @endif
                            </h4>
                            <!-- /title -->
                        </header>
                        <!-- /header -->
                        <hr>

                        <section class="clearfix summary">
                            {!! $app->summary !!}
                        </section>
                        <!-- /summary -->
                        <hr>

                        <p class="text-muted">
                            <a href="{{ route('service', ['id' => $app->id]) }}" class="btn btn-default">
                                Learn more <i class="fa {{ $app->icon }}"></i>
                            </a>
                        </p>
                        <!-- /links -->

                        @if($loop->count > 1 && $loop->last)
                            <hr class="hidden-md hidden-lg hidden-sm">
                        @endif

                    </div><!-- /.col-md-* -->
                    <p></p>

                @empty
                    <p class="text-muted">Sorry, some error occured. Reload page.</p>
                @endforelse
            </div><!-- /.row#apps-soon -->

        </div><!-- /.container -->
    </section><!-- /#services -->

    @include('includes.footers.default')

@endsection