@extends('layouts.company')

@section('title')
    Apps
@endsection

@section('styles')
@endsection

@section('content')

    @include('includes.headers.home.primary')

    <div class="container">
        <section class="section-top section-btm section-pad" id="secHeader">
            @section('dashboard-title')
                <i class="fa fa-laptop"></i>
                Create a new app
            @endsection

            @include('v1.user.dashboard.header')

            <div class="row text-center">
                {{-- Populate this with database --}}
                @foreach($app_products as $app)
                    <div class="{{ count($app_products) <= 2 ? 'col-md-6' : 'col-md-4' }}">
                        <div class="clearfix">
                        <span class="fa-stack fa-4x">
                            <i class="fa fa-circle fa-stack-2x text-primary"></i>
                            <i class="fa {{ $app->icon }} fa-stack-1x fa-inverse"></i>
                        </span>
                        </div>
                        <h4 class="service-heading">{{ $app->title }}</h4>

                        <div class="clearfix">{!! $app->summary !!}</div>

                        <p class="text-muted">
                            <a href="{{ route('app.create', ['app' => str_slug($app->title)]) }}"
                               class="btn btn-success btn-sm" data-toggle="tooltip"
                               title="Add {{ $app->title }}">
                                Get Started
                                <i class="fa fa-chevron-right"></i>
                            </a>
                        </p>
                    </div>
                @endforeach
            </div>
        </section>
    </div>

    {{--<section class="section-blank bg-white" id="create">--}}
    {{--<div class="container">--}}
    {{--<div class="row">--}}
    {{--<div class="col-md-12">--}}
    {{--<h2 class="sub-header">Create a new app</h2>--}}
    {{--<hr>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="row text-center">--}}
    {{-- Populate this with database --}}
    {{--@foreach($app_products as $app)--}}
    {{--<div class="col-md-4">--}}
    {{--<div class="section bg-dark-gray white">--}}
    {{--<div class="panel-heading">--}}
    {{--<h3>{{ $app->title }}</h3>--}}
    {{--</div>--}}
    {{--<div class="panel-body">--}}
    {{--<p>{{ $app->summary }}</p>--}}
    {{--<div class="btn-group" role="group">--}}
    {{--<a href="#" class="btn btn-default">Read more...</a>--}}

    {{--<a href="{{ route('app.create', ['app' => str_slug($app->title)]) }}"--}}
    {{--class="btn btn-success" data-toggle="tooltip"--}}
    {{--title="Add {{ $app->title }}">--}}
    {{--<span class="glyphicon glyphicon-plus-sign"></span>--}}
    {{--</a>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--@endforeach--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</section>--}}

    @include('includes.footers.default')

@endsection