@extends('layouts.admin')

@section('title')
    Notifications
@endsection

@section('breadcrumb')
    <li class="active">Notifications</li>
@endsection

@section('page-header')
    <i class="fa fa-bell fa-fw"></i> Notifications
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            @include('includes.alerts.default')

            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="list-group">
                        @forelse ($notifications as $notification)
                            @include('v1.admin.notify.contact')
                            @include('v1.admin.notify.bug')
                        @empty
                            <p class="lead">
                                {{ count($notifications) == 0 ? 'You have no notifications' : ''  }}
                            </p>
                        @endforelse
                    </div>
                    <!-- /.list-group -->
                </div>
                <!-- /.panel-body -->

                <div class="panel-footer">
                    <div class="clearfix">
                        <strong>Total notifications : {{ count($notifications) }}</strong>

                        <div class="pull-right">
                            {{ count($notifications) > 0 ? $notifications->links() : ''  }}
                        </div>
                    </div>
                    <p class="text-muted">To view personal notifications
                        <a href="{{ route('user.notifications') }}" class="btn btn-primary btn-sm">Go here
                            <i class="fa fa-chevron-right"></i>
                        </a>
                    </p>
                </div>
                <!-- /.panel-footer -->
            </div>
        </div>
    </div>
    </div>
@endsection