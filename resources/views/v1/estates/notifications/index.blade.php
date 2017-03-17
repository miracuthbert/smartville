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
                            @foreach ($_notifications as $notification)
                                @if(ToggleRead($notification->data['type']))
                                    <li class="list-group-item clearfix">
                                        <i class="fa {{ NotificationIcon($notification->data['type']) }} fa-fw"></i>
                                        <b>{{ $notification->data['title'] }}</b>

                                        <em> by {{ $notification->data['name'] }}</em>

                                        <div class="btn-group btn-group-xs pull-right">
                                            <a href="{{ route('admin.notification.read', ['id' => $notification->id]) }}"
                                               class="btn {{ ToggleButtonRead($notification->read_at) }}">
                                                {{ ToggleRead($notification->read_at) }}
                                            </a>

                                            <a href="{{ route(NotificationRoute($notification->data['type']), ['id' => $notification->data['id']]) }}"
                                               class="btn btn-link">
                                                View message
                                            </a>
                                        </div>

                                        <div class="clearfix"></div>

                                    <span class="pull-right text-muted small">
                                        <em>
                                            {{ $notification->created_at->diffForHumans() }}
                                        </em>
                                    </span>
                                    </li>
                                @endif
                            @endforeach
                        </div>
                        <!-- /.list-group -->
                        <p class="lead">
                            {{ count($_notifications) == 0 ? 'You have no notifications' : ''  }}
                        </p>
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