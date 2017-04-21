@extends('layouts.estates')

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
    <section>
        <div class="row">
            <div class="col-lg-12">
                @include('includes.alerts.default')

                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="list-group">
                            @forelse($_notifications as $notification)
                                @if($notification->data['type'] == "subscription")
                                    @include('v1.estates.notifications.subscription')
                                @endif
                            @empty
                                <p class="lead">
                                    {{ count($_notifications) == 0 ? 'You have no notifications' : ''  }}
                                </p>
                            @endforelse
                        </div>
                        <!-- /.list-group -->
                    </div>
                    <!-- /.panel-body -->

                    <div class="panel-footer">
                        <b>Total notifications : {{ count($_notifications) }}</b>

                        <div class="pull-right">
                            {{ count($_notifications) > 0 ? $_notifications->links() : ''  }}
                        </div>
                    </div>
                    <!-- /.panel-footer -->
                </div>
            </div>
        </div>
    </section>
@endsection