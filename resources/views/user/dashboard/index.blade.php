@extends('layouts.company.master')

@section('title')
    My Dashboard
@endsection

@section('content')

    <div class="section-top" id="myApps">
        @section('dashboard-title')
            <span class="fa fa-dashboard"></span>
            My Dashboard
        @endsection

        @include('user.dashboard.header')

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-primary">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-laptop fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div>Are you a property manager, owner or landlord and would like to manage
                                    your properties, click the link below and choose which app you would like to
                                    create and get started.
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('user.dashboard', ['section' => 'apps-new']) }}">
                        <div class="panel-footer">
                            <span class="pull-left">Get started</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div><!-- /.col-lg-12 -->
        </div><!-- /.row -->
        <hr>

        <div class="row">
            <div class="col-lg-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="sub-header">
                            <i class="fa fa-home"></i>
                            Tenancies
                            <span class="badge">{{ count(Auth::user()->tenancies) }}</span>
                        </h3>
                    </div>
                    <div class="panel-body">
                        <div class="list-group">
                            @forelse(Auth::user()->tenancies as $tenancy)
                                <div class="list-group-item">
                                    <div class="list-group-item-heading">
                                        @if($tenancy->company->company->avatar != null)
                                            <img src="{{ url($tenancy->company->company->avatar->data['thumbUrl']) }}"
                                                 alt="{{ $tenancy->company->company->avatar->data['alt'] }}"
                                                 class="img-thumbnail">
                                        @else
                                            <img src="{{ url('images/site/logos/thumbs/default.jpg') }}"
                                                 alt="default logo" class="img-thumbnail">
                                        @endif

                                        <strong>{{ $tenancy->company->company->title }}</strong>
                                    </div><!-- /.list-group-item-heading -->
                                    <div class="list-group-item-text">
                                        <hr>
                                        <a href="{{ route('tenant.dashboard', ['id' => $tenancy->id]) }}"
                                           class="btn-block">
                                            <div class="clearfix">
                                                <span class="pull-left">Go to tenant panel</span>
                                                <div class="pull-right">
                                                    <i class="fa fa-chevron-right"></i>
                                                </div>
                                            </div>
                                        </a>
                                    </div><!-- /.list-group-item-text -->
                                </div>
                            @empty
                                <div class="list-group-item">
                                    <div class="list-group-item-heading">
                                        <h4>No tenancies found</h4>
                                    </div>
                                    <div class="list-group-item-text">
                                        <p>Properties you leased will appear here</p>
                                    </div>
                                </div>
                            @endforelse
                        </div><!-- /.list-group -->
                    </div><!-- /.panel-body -->
                </div><!-- /.panel-default -->
            </div><!-- /.col-lg-4 -->
            <div class="col-lg-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="sub-header">
                            <i class="fa fa-laptop"></i>
                            My Apps
                            <span class="badge">{{ count(Auth::user()->apps) }}</span>
                        </h3>
                        <p>To access more app options, go to 'My Apps' section.</p>
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="list-group">
                            @forelse($user_apps as $app)
                                <a href="{{ $app->app->status === 1 ? route(AppDashRoute($app->app->product->slug), [$app->app]) : route('company.app.status', ['id' => $app->app]) }}"
                                   class="list-group-item"
                                   title="{{ $app->app->status === 1 ? 'Go to app dashboard' : 'App will be enabled first' }}">
                                    <div class="list-item-text">
                                        <i class="fa fa-bell fa-2x"></i>
                                        <sup class="badge">{{ count($app->app->unreadNotifications) > 0 ? count($app->app->unreadNotifications) : '' }}</sup>
                                        <strong>
                                            {{ $app->app->company->title }}
                                        </strong>
                                            <span class="pull-right">
                                                <i class="fa fa-chevron-right"></i>
                                            </span>
                                    </div>
                                </a>
                            @empty
                                <div class="list-group-item">
                                    You have not created or been added to any app.
                                </div>
                            @endforelse
                        </div>
                        <!-- /.list-group -->
                        <a href="{{ route('user.dashboard', ['section' => 'apps']) }}"
                           class="btn btn-default btn-block" title="View all your apps">
                            View All
                        </a>
                    </div>
                    <!-- /.panel-body -->
                </div>
            </div><!-- /.col-lg-4 -->
            <div class="col-lg-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="sub-header">
                            <i class="fa fa-bell fa-fw"></i>
                            Notifications
                            <span class="badge">{{ count($unread_notifications) > 0 ? count($unread_notifications) : '' }}</span>
                        </h3>
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="list-group">
                            @forelse ($notifications as $notification)
                                <a href="{{ NotificationUserRoute($notification, Auth::user()) }}"
                                   class="list-group-item">
                                    <i class="fa {{ NotificationIcon($notification->data['type']) }} fa-fw"></i>
                                    {{ $notification->data['title'] }}
                                    <span class="pull-right text-muted small">
                                        <em>{{ $notification->created_at->diffForHumans() }}</em>
                                    </span>
                                </a>
                            @empty
                                <div class="list-group-item">
                                    <i class="fa fa-bell fa-fw"></i> Your notifications will appear here
                                </div>
                            @endforelse
                        </div>
                        <!-- /.list-group -->
                        <a href="{{ route('user.notifications') }}" class="btn btn-default btn-block">View All
                            Alerts</a>
                    </div>
                    <!-- /.panel-body -->
                </div>
            </div><!-- /.col-lg-4 -->
        </div><!-- /.row -->
    </div><!-- /#myApps -->

@endsection