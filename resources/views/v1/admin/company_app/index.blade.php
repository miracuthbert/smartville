@extends('layouts.admin')

@section('title')
    Company Apps ({{ $sort == null ? "All" : title_case($sort) }})
@endsection

@section('breadcrumb')
    <li>Company Apps</li>
    <li class="active">{{ $sort == null ? "All" : title_case($sort) }}</li>
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
                <li class="dropdown-header">Subscriptions</li>
                <li class="{{ $sort == "subscriptions" ? "active" : "" }}">
                    <a href="{{ route('admin_company_app.index', ['sort' => 'subscriptions']) }}">
                        Paid Subscriptions
                    </a>
                </li>
                <li class="{{ $sort == "trials" ? "active" : "" }}">
                    <a href="{{ route('admin_company_app.index', ['sort' => 'trials']) }}">
                        Trial Subscriptions
                    </a>
                </li>
                <li role="separator" class="divider"></li>
                <li class="dropdown-header">Apps</li>
                <li class="{{ $sort == "subscribed" && $trial == 1 ? "active" : "" }}">
                    <a href="{{ route('admin_company_app.index', ['sort' => 'subscribed', 'on_trial' => 1]) }}">
                        On Trial Subscriptions
                    </a>
                </li>
                <li class="{{ $sort == "subscribed" && $trial == 0 ? "active" : "" }}">
                    <a href="{{ route('admin_company_app.index', ['sort' => 'subscribed', 'on_trial' => 0]) }}">
                        Paypal Subscriptions
                    </a>
                </li>
                <li role="separator" class="divider"></li>
                <li class="{{ $sort == null ?: "" }}">
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
                    <div class="table-responsive">
                        @if($sort == "trials")
                            @include('v1.admin.company_app.trials'){{-- Trial Subscriptions --}}
                        @elseif($sort == "subscribed" && $trial == 1)
                            @include('v1.admin.company_app.apps_on_trial'){{-- Apps On Trial --}}
                        @elseif($sort == "subscriptions")
                            @include('v1.admin.company_app.subscriptions'){{-- Paid Subscriptions --}}
                        @elseif($sort == "subscribed" && $trial == 0)
                            @include('v1.admin.company_app.apps_paid_subscriptions'){{-- Apps On Paid Subscriptions --}}
                        @else
                            @include('v1.admin.company_app.all')
                        @endif
                    </div><!-- /.table-responsive -->
                </div><!-- /.panel-body -->
                <div class="panel-footer">
                    @if($sort == "subscribed" && $trial)
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
                    @elseif($sort == "subscribed" && !$trial)
                        <div class="row">
                            <div class="col-sm-6">
                                <p>
                                    Showing {{ $apps->firstItem() }}
                                    to {{ $apps->lastItem() }} of
                                    {{ $apps->total() }}
                                </p>
                            </div>
                            <div class="col-sm-6">
                                <div class="pull-right">
                                    {{ $apps->links() }}
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
                </div><!-- /.panel-footer -->
            </div><!-- /.panel-default -->
        </div><!-- /.col-lg-12 -->
    </div><!-- /.row -->
@endsection