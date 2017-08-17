@extends('layouts.company.master')

@section('title')
    App & Services
@endsection

@section('content')

    <section class="bg-white" id="services">
        <div class="row text-center">
            <div class="col-lg-12">
                <h2 class="section-heading">Apps</h2>
                <hr class="star-primary">

                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="text-center">Live Apps</h3>
                        <hr style="width: 15%; border-top: 5px solid #16A085;">

                        <div class="row text-center" id="apps">
                            @forelse($app_products as $app)
                                <div class="{{ count($app_products) < 3 ? 'col-md-6' : 'col-md-4' }}">
                                    <div class="clearfix app-header">
                                        <div class="fa-stack fa-4x">
                                            <i class="fa fa-circle fa-stack-2x text-primary"></i>
                                            <i class="fa {{ $app->icon }} fa-stack-1x fa-inverse"></i>
                                        </div><!-- /icon -->
                                        <h4>{{ $app->title }}
                                            @if(!$app->mode == 1)
                                                <small data-toggle="tooltip"
                                                       title="{{ AppModeInfo($app->mode) }}">
                                                    <span class="label label-warning">Beta</span>
                                                </small>
                                            @endif
                                        </h4><!-- /title -->
                                    </div><!-- /header -->
                                    <hr>

                                    <div class="clearfix summary">
                                        {!! $app->summary !!}
                                    </div><!-- /summary -->
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
                                    </div><!-- /links -->

                                    @if($loop->count > 1 && $loop->last)
                                        <hr class="hidden-md hidden-lg hidden-sm">
                                    @endif
                                </div><!-- /.col-md-* -->
                                <p class="visible-xs"></p>

                            @empty
                                <p class="text-muted">Sorry, some error occured. Reload page.</p>
                            @endforelse
                        </div><!-- /.row#apps -->
                    </div><!-- /.col-lg-12 -->
                </div><!-- /.row -->

                @if($apps_coming->count())
                    <div class="section-top"></div>
                    <div class="row">
                        <div class="col-lg-12">
                            <h3 class="text-center">Coming Soon</h3>
                            <hr style="width: 15%; border-top: 5px solid #3494DB;">
                            <div class="row text-center" id="apps-soon">
                                @forelse($apps_coming as $app)
                                    <div class="{{ count($apps_coming) < 3 ? 'col-md-6' : 'col-md-4' }}">
                                        <div class="clearfix app-header">
                                            <div class="fa-stack fa-4x">
                                                <i class="fa fa-circle fa-stack-2x text-primary"></i>
                                                <i class="fa {{ $app->icon }} fa-stack-1x fa-inverse"></i>
                                            </div><!-- /icon -->

                                            <h4 class="service-heading">{{ $app->title }}
                                                @if($app->mode == 0)
                                                    <span class="label label-warning">Coming Soon</span>
                                                @endif
                                            </h4><!-- /title -->
                                        </div><!-- /header -->
                                        <hr>

                                        <div class="clearfix summary">
                                            {!! $app->summary !!}
                                        </div><!-- /summary -->
                                        <hr>

                                        <p class="text-muted">
                                            <a href="{{ route('service', ['id' => $app->id]) }}"
                                               class="btn btn-default">
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
                        </div><!-- /.col-lg-12 -->
                    </div><!-- /.row -->
                @endif
            </div><!-- /.col-lg-12 -->
        </div><!-- /.row -->
    </section><!-- /#services -->

@endsection