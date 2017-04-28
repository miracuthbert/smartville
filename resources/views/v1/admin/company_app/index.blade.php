@extends('layouts.admin')

@section('title')
    Company Apps
@endsection

@section('breadcrumb')
    <li class="active">Company Apps</li>
@endsection

@section('page-header')
    <i class="fa fa-laptop"></i> Company Apps

    <div class="pull-right">
        <div class="btn-group btn-group-sm">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                Actions
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu pull-right">
                <li>
                    <a href="{{ route('admin_company_app.index', ['sort' => 'subscribed', 'on_trial' => 1]) }}">
                        On Trial Subscriptions
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin_company_app.index', ['sort' => 'subscribed', 'on_trial' => 0]) }}">
                        Normal Subscriptions
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin_company_app.index') }}">
                        All
                    </a>
                </li>
            </ul>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    @if($sort == "subscribed" && $trial)
                        <div class="list-group">
                            @forelse($app_trials as $app_trial)
                                <div class="list-group-item">
                                    <div class="row">
                                        <div class="col-sm-5">
                                            <p>
                                                {{ $loop->first ? $categories->firstItem() : ($app_trials->firstItem() + $loop->index) }}
                                                .
                                                {{ $app_trial->app->company->title }} -
                                                <small>{{ $app_trial->app->product->title }}</small>
                                                <span class="badge" data-toggle="tooltip" title="properties">
                                                {{ count($app_trial->app->properties) }}
                                                </span>
                                            </p>
                                        </div>
                                        <div class="col-sm-3">
                                            <p>
                                                Trial ends at
                                                <span class="text-muted small">
                                                    <em>{{ $app_trial->trial_ends_at->toDateTimeString() }}</em>
                                                </span>
                                            </p>
                                        </div>
                                        <div class="col-sm-1 text-right">
                                            <p>
                                                <span class="visible-xs-inline">
                                                    {{ AppStatusText($app_trial->app->status) }}
                                                </span>
                                                <span data-toggle="tooltip"
                                                      title="{{ AppStatusText($app_trial->app->status) }}">
                                                    <i class="{{ AppStatusIcon($app_trial->app->status) }}"></i>
                                                </span>
                                            </p>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="pull-right">
                                                <div class="btn-group btn-group-sm">
                                                    <a href="{{ route('admin_company_app.show', ['admin_company_app' => $app_trial->app->id]) }}"
                                                       class="btn btn-primary">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="list-group-item">
                                    <h4 class="list-group-text">
                                        No apps on trial.
                                    </h4>
                                </div>
                            @endforelse
                        </div>
                    @elseif($sort == "subscribed" && !$trial)
                        <div class="list-group">
                            @forelse($app_subscribers as $app_subscriber)
                                <a href="{{ route('admin_company_app.show', ['admin_company_app' => $app_subscriber->id]) }}"
                                   class="list-group-item">
                                    <div class="row">
                                        <div class="col-sm-5">
                                            {{ $loop->first ? $app_subscribers->firstItem() : ($app_subscribers->firstItem() + 1) }}.
                                            {{ $app_subscriber->company->title }} -
                                            <small>{{ $app_subscriber->product->title }}</small>
                                            <span class="badge pull-left" data-toggle="tooltip" title="properties">
                                            {{ $app_subscriber->properties_count }}
                                            </span>
                                        </div>
                                        <div class="col-sm-3">
                                            Subs. ends at
                                            <span class="text-muted small">
                                                <em>
                                                    {{ $app_subscriber->paypal_active()->first()->ends_at->toDateTimeString() }}
                                                </em>
                                            </span>
                                        </div>
                                        <div class="col-sm-1 text-right">
                                            <p>
                                                <span class="visible-xs-inline">{{ AppStatusText($app->status) }}</span>
                                                <span data-toggle="tooltip"
                                                      title="{{ AppStatusText($app->status) }}">
                                                    <i class="{{ AppStatusIcon($app->status) }}"></i>
                                                </span>
                                            </p>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="pull-right">
                                                <div class="btn-group btn-group-sm">
                                                    <a href="{{ route('admin_company_app.show', ['admin_company_app' => $app_trial->id]) }}"
                                                       class="btn btn-primary">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                </div>
                                            </div>
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
                            @else
                                <div class="list-group">
                                    @forelse($apps as $app)
                                        <div class="list-group-item">
                                            <div class="row">
                                                <div class="col-sm-5">
                                                    <p>
                                                        {{ $loop->first ? $apps->firstItem() : ($apps->firstItem() + 1) }}
                                                        .
                                                        {{ $app->company->title }} -
                                                        <small>{{ $app->product->title }}</small>
                                                        <span class="badge" data-toggle="tooltip" title="properties">
                                                            {{ $app->properties_count }}
                                                        </span>
                                                    </p>
                                                </div>
                                                <div class="col-sm-2">
                                                    <p>
                                                        {{ $app->subscribed && $app->is_trial == 1 ? 'On Trial' : $app->subscribed ? 'Normal Subscription' : 'Not Subscribed' }}
                                                    </p>
                                                </div>
                                                <div class="col-sm-2 text-right">
                                                    <p>
                                                        <span class="visible-xs-inline">{{ AppStatusText($app->status) }}</span>
                                                        <span data-toggle="tooltip"
                                                              title="{{ AppStatusText($app->status) }}">
                                                            <i class="{{ AppStatusIcon($app->status) }}"></i>
                                                        </span>
                                                    </p>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="pull-right">
                                                        <div class="btn-group btn-group-sm">
                                                            <a href="{{ route('admin_company_app.show', ['admin_company_app' => $app->id]) }}"
                                                               class="btn btn-primary">
                                                                <i class="fa fa-eye"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="list-group-item">
                                            <h4 class="list-group-text">
                                                No apps found.
                                            </h4>
                                        </div>
                                    @endforelse
                                </div>
                            @endif
                        </div>
                </div>
                <!-- /.panel-body -->
                <div class="panel-footer">
                    @if($sort == "subscribed" && $trial)
                        <div class="row">
                            <div class="col-sm-6">
                                <p>
                                    Showing {{ $app_trials->firstItem() }} to {{ $app_trials->lastItem() }} of
                                    {{ $app_trials->total() }}
                                </p>
                            </div>
                            <div class="col-sm-6">
                                <div class="pull-right">
                                    {{ $app_trials->links() }}
                                </div>
                            </div>
                        </div>
                    @elseif($sort == "subscribed" && !$trial)
                        <div class="row">
                            <div class="col-sm-6">
                                <p>
                                    Showing {{ $app_subscribers->firstItem() }}
                                    to {{ $app_subscribers->lastItem() }} of
                                    {{ $app_subscribers->total() }}
                                </p>
                            </div>
                            <div class="col-sm-6">
                                <div class="pull-right">
                                    {{ $app_subscribers->links() }}
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="row">
                            <div class="col-sm-6">
                                <p>
                                    Showing {{ $apps->firstItem() }} to {{ $apps->lastItem() }} of
                                    {{ $apps->total() }}
                                </p>
                            </div>
                            <div class="col-sm-6">
                                <div class="pull-right">
                                    {{ $apps->links() }}
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <!-- /.panel-footer -->
            </div>
            <!-- /.panel-default -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
@endsection