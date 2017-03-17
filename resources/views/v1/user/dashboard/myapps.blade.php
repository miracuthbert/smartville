@extends('layouts.company')

@section('title')
    My Dashboard
@endsection

@section('styles')
@endsection

@section('content')

    @include('includes.headers.home.primary')

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-top section-btm" id="myApps">
                    @section('dashboard-title')
                        <span class="glyphicon glyphicon-dashboard"></span>
                        My Apps
                        <span class="badge">{{ count(Auth::user()->companies) }}</span>
                    @endsection

                    @include('v1.user.dashboard.header')

                    @if(count(Auth::user()->companies) > 0)
                        <div class="row">
                            <div class="col-md-12">
                                <p class="lead">Active Apps
                                    <span class="badge">{{ count($active_apps) }}</span>
                                </p>
                            </div>
                            <div class="col-md-12">
                                @if(count($active_apps) > 0)
                                    <div class="row">
                                        @foreach($active_apps as $app)
                                            @include('v1.user.apps.default')
                                        @endforeach
                                    </div>
                                @else
                                    <p class="lead">No active apps found.</p>
                                @endif
                            </div>
                        </div>
                        <!-- /.row --><!-- /active apps -->
                        <hr>

                        <!-- disabled apps -->
                        <div class="row">
                            <div class="col-md-12">
                                <p class="lead">Disabled apps
                                    <span class="badge">{{ count($disabled_apps) }}</span>
                                </p>
                            </div>
                            <div class="col-md-12">
                                @if(count($disabled_apps) > 0)
                                    <div class="row">
                                        @foreach($disabled_apps as $app)
                                            @include('v1.user.apps.default-disabled')
                                        @endforeach
                                    </div>
                                @else
                                    <p class="lead">No disabled apps found.</p>
                                @endif
                            </div>
                        </div>
                        <!-- /.row -->
                        <hr>

                        <!-- trashed apps -->
                        <div class="row">
                            <div class="col-md-12">
                                <p class="lead">Trashed apps
                                    <span class="badge">{{ count($trashed_apps) }}</span>
                                </p>
                            </div>
                            <div class="col-md-12">
                                @if(count($trashed_apps) > 0)
                                    <div class="row">
                                        @foreach($trashed_apps as $app)
                                            @include('v1.user.apps.default-trashed')
                                        @endforeach
                                    </div>
                                @else
                                    <p class="lead">No deleted apps found.</p>
                                @endif
                            </div>
                        </div>
                        <!-- /.row -->
                    @else
                        <div class="row">
                            <div class="col-md-12">
                                <p class="lead">Apps you create or added to will appear here.</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @include('includes.footers.default')

@endsection