@extends('layouts.admin')

@section('title')
    Dashboard
@endsection

@section('breadcrumb')
    <li class="active">Dashboard</li>
@endsection

@section('page-header')
    Dashboard
@endsection

@section('stats')
    <div class="row">
        <div class="col-lg-3 col-sm-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-users fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{ $users->total() }}</div>
                            <div>New Users!</div>
                        </div>
                    </div>
                </div>
                <a href="{{ route('admin.users', ['sort' => 'new']) }}">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-shopping-cart fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{ $app_trials->total() }}</div>
                            <div>App Trials!</div>
                        </div>
                    </div>
                </div>
                <a href="{{ route('admin_company_app.index', ['sort' => 'subscribed', 'on_trial' => 1]) }}">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-credit-card fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{ $app_subscribers->total() }}</div>
                            <div>App Subscribers!</div>
                        </div>
                    </div>
                </div>
                <a href="{{ route('admin_company_app.index', ['sort' => 'subscribed', 'on_trial' => 0]) }}">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="panel panel-red">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-bug fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{ $bugs->total() }}</div>
                            <div>Bugs!</div>
                        </div>
                    </div>
                </div>
                <a href="{{ route('bugs.index') }}">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <!-- /.row -->
@endsection

@section('content')
    <section id="apps">
        <div class="row">
            <div class="col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-credit-card-alt-o fa-fw"></i> Apps on trial
                        <span class="badge pull-right">{{ $app_trials->total() }}</span>
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="list-group">
                            @forelse($app_trials as $app_trial)
                                <a href="{{ route('admin_company_app.show', ['admin_company_app' => $app_trial->id]) }}"
                                   class="list-group-item">
                                    <div class="row">
                                        <div class="col-sm-8">
                                        <span class="badge" data-toggle="tooltip" title="properties">
                                        {{ count($app_trial->app->properties) }}
                                    </span>
                                            {{ $app_trial->app->company->title }}
                                        </div>
                                        <div class="col-sm-4">
                                        <span class="pull-right text-muted small">
                                            <em>{{ $app_trial->trial_ends_at->toDateTimeString() }}</em>
                                        </span>
                                        </div>
                                    </div>
                                </a>
                            @empty
                                <div class="list-group-item">
                                    <h4 class="list-group-text">
                                        No apps on trial.
                                    </h4>
                                </div>
                            @endforelse
                        </div>
                        <!-- /.list-group -->
                        <a href="{{ route('admin_company_app.index', ['sort' => 'subscribed', 'on_trial' => 1]) }}"
                           class="btn btn-default btn-block">View All</a>
                    </div>
                    <!-- /.panel-body -->
                </div>
            </div>
            <!-- /.col-lg-6 -->
            <div class="col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-credit-card fa-fw"></i> Apps subscribed
                        <span class="badge pull-right">{{ $app_subscribers->total() }}</span>
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="list-group">
                            @forelse($app_subscribers as $app_subscriber)
                                <a href="{{ route('admin_company_app.show', ['admin_company_app' => $app_subscriber->id]) }}"
                                   class="list-group-item">
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <span class="badge pull-left" data-toggle="tooltip" title="properties">
                                            {{ $app_subscriber->properties_count }}
                                            </span>
                                            {{ $app_subscriber->company->title }}
                                        </div>
                                        <div class="col-sm-4">
                                            <span class="pull-right text-muted small">
                                                <em>
                                                    {{--{{ $app_subscriber->paypal_active()->first()->ends_at->toDateTimeString() }}--}}
                                                </em>
                                            </span>
                                        </div>
                                    </div>
                                </a>
                            @empty
                                <div class="list-group-item">
                                    <h4 class="list-group-text">
                                        No subscribed apps.
                                    </h4>
                                </div>
                            @endforelse
                        </div>
                        <!-- /.list-group -->
                        <a href="{{ route('admin_company_app.index', ['sort' => 'subscribed', 'on_trial' => 0]) }}"
                           class="btn btn-default btn-block">View All</a>
                    </div>
                    <!-- /.panel-body -->
                </div>
            </div>
            <!-- /.col-lg-6 -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /#apps -->

    <section id="users">
        <div class="row">
            <div class="col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-sign-in fa-fw"></i> Logged In Users
                        <span class="badge pull-right">{{ $logged_users->total() }}</span>
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="list-group">
                            @forelse($logged_users as $user)
                                <a href="{{ route('admin.user.edit', ['id' => $user->id]) }}" class="list-group-item">
                                    <i class="fa fa-user fa-fw"></i> {{ $user->firstname }} {{ $user->lastname }}
                                    <span class="pull-right text-muted small"><em>{{ $user->last_login_at->diffForHumans() }}</em>
                                    </span>
                                </a>
                            @empty
                                <div class="list-group-item">
                                    <h4 class="list-group-text">
                                        No logged in users found.
                                    </h4>
                                </div>
                            @endforelse
                        </div>
                        <!-- /.list-group -->
                        {{--<a href="#" class="btn btn-default btn-block">View All Alerts</a>--}}
                    </div>
                    <!-- /.panel-body -->
                </div>
            </div>
            <!-- /.col-lg-6 -->
            <div class="col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-globe fa-fw"></i> Companies
                        <span class="badge pull-right">{{ $companies->total() }}</span>
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="list-group">
                            @forelse($companies as $company)
                                <a href="{{ route('admin_company.show', ['admin_company' => $company->id]) }}"
                                   class="list-group-item">
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <span class="badge" data-toggle="tooltip" title="company apps">
                                                {{ $company->apps_count }}
                                            </span>
                                            <span>
                                                {{ $company->title }} - <small>{{ $company->country }}</small>
                                            </span>
                                        </div>
                                        <!-- /.col-sm-8 -->
                                        <div class="col-sm-4">
                                            <span class="pull-right text-muted small">
                                                <em>{{ $company->created_at->diffForHumans() }}</em>
                                            </span>
                                        </div>
                                        <!-- /.col-sm-4 -->
                                    </div>
                                </a>
                            @empty
                                <div class="list-group-item">
                                    <h4 class="list-group-text">
                                        No companies found.
                                    </h4>
                                </div>
                            @endforelse
                        </div>
                        <!-- /.list-group -->
                        <a href="{{ route('admin_company.index') }}" class="btn btn-default btn-block">View All</a>
                    </div>
                    <!-- /.panel-body -->
                </div>
            </div>
            <!-- /.col-lg-6 -->
        </div>
    </section>
    <!-- /#users -->
@endsection