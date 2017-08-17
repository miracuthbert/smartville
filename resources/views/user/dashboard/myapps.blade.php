@extends('layouts.company.master')

@section('title')
    My Apps
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="section-top section-btm" id="myApps">
                @section('dashboard-title')
                    My App <sup class="badge">{{ count(Auth::user()->apps) }}</sup>
                @endsection

                @include('user.dashboard.header')

                <div class="row">
                    <div class="col-md-12">
                        <h3>Active Apps
                            <sup class="badge">{{ count($active_apps) }}</sup>
                        </h3>
                        <hr>

                        <div class="row">
                            @forelse($active_apps as $app)
                                @include('user.apps.default')
                            @empty
                                <p class="col-md-12 lead">No active apps found.</p>
                            @endforelse
                        </div><!-- /.row -->
                    </div>
                </div><!-- /.row --><!-- /active apps -->

                <!-- disabled apps -->
                <div class="row">
                    <div class="col-md-12">
                        <h3>Disabled apps
                            <sup class="badge">{{ count($disabled_apps) }}</sup>
                        </h3>
                        <hr>

                        <div class="row">
                            @forelse($disabled_apps as $app)
                                @include('user.apps.default-disabled')
                            @empty
                                <p class="col-md-12 lead">No apps disabled.</p>
                            @endforelse
                        </div><!-- /.row -->
                    </div>
                </div><!-- /.row -->

                <!-- trashed apps -->
                <div class="row">
                    <div class="col-md-12">
                        <h3>Trashed apps
                            <sup class="badge">{{ count($trashed_apps) }}</sup>
                        </h3>
                        <hr>

                        <div class="row">
                            @forelse($trashed_apps as $app)
                                @include('user.apps.default-trashed')
                            @empty
                                <p class="col-md-12 lead">No apps found in trash.</p>
                            @endforelse
                        </div><!-- /.row -->
                    </div>
                </div><!-- /.row -->
            </div>
        </div><!-- /.col-lg-12 -->
    </div><!-- /.row -->

@endsection