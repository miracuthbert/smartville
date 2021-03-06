@extends('layouts.company.master')

@section('title')
    Apps
@endsection

@section('content')

    <section class="section-top section-btm" id="secHeader">
        @section('dashboard-title')
            <i class="fa fa-laptop"></i>
            Create a new app
        @endsection

        @include('user.dashboard.header')

        <div class="row text-center">
            {{-- Populate this with database --}}
            @foreach($app_products as $app)
                <div class="col-md-6">
                    <div class="clearfix">
                        <span class="fa-stack fa-4x">
                            <i class="fa fa-circle fa-stack-2x text-primary"></i>
                            <i class="fa {{ $app->icon }} fa-stack-1x fa-inverse"></i>
                        </span>
                    </div>
                    <h4 class="service-heading">{{ $app->title }}</h4>

                    <div class="clearfix">{!! $app->summary !!}</div>

                    <p>
                        <a href="{{ route('service', ['id' => $app->id]) }}" class="btn btn-default">
                            Learn more <i class="fa {{ $app->icon }}"></i>
                        </a>
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

@endsection