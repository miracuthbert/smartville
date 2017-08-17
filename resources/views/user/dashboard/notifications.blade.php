@extends('layouts.company.master')

@section('title')
    Notifications
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                <i class="fa fa-bell fa-fw"></i> Notifications
            </h1>

            @include('partials.alerts.default')

            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="list-group">
                        @forelse ($notifications as $notification)
                            @if($notification->data['type'] == "forum")
                                @include('user.notify.forum-comment')
                            @elseif($notification->data['type'] == "tenant_bill_invoice")
                                @include('user.notify.tenant-bill')
                            @elseif($notification->data['type'] == "tenant_rent_invoice")
                                @include('user.notify.tenant-rent-invoice')
                            @elseif($notification->data['type'] == "activated_tenancy")
                                @include('user.notify.activated-tenancy')
                            @endif
                        @empty
                            <p class="lead">You have no notifications</p>
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
                    <div class="clearfix">
                        <p>
                            @if(Auth::user()->root)
                                <a href="{{ route('admin.notifications') }}" class="btn btn-default">
                                    View Root notifications <i class="fa fa-bell"></i>
                                </a>
                            @elseif(Auth::user()->admin)
                                <a href="{{ route('admin.notifications') }}" class="btn btn-default">
                                    View Admin notifications <i class="fa fa-bell"></i>
                                </a>
                            @endif
                        </p>
                    </div>
                </div>
                <!-- /.panel-footer -->
            </div>
        </div>
    </div>

@endsection

