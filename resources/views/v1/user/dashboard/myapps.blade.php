@extends('layouts.company')

@section('title')
    My Apps
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
                        <i class="fa fa-laptop"></i>
                        My Apps
                        <span class="badge">{{ count(Auth::user()->apps) }}</span>
                    @endsection

                    @include('v1.user.dashboard.header')

                    @if(count(Auth::user()->apps) > 0)
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
                                <p class="lead">Seems like you have no apps. Apps you create or added to will appear
                                    here.</p>
                                <hr>
                                <div class="clearfix box">Are you a property manager, owner or landlord and would like
                                    to
                                    manage your properties, click the link below and choose which app you would like to
                                    create and get started.
                                    <br>
                                    <br>
                                    <hr>
                                    <p>
                                        <a href="{{ route('user.dashboard', ['section' => 'apps-new']) }}"
                                           class="btn btn-default pull-right">
                                            Get started <i class="fa fa-chevron-right"></i>
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @include('includes.footers.default')

@endsection