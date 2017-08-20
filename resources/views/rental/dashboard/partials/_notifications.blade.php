<div class="panel panel-default">
    <div class="panel-heading">
        <h3>
            <i class="fa fa-bell fa-fw"></i>
            Notifications
            <span class="badge">{{ count($app->unreadNotifications) > 0 ? count($app->unreadNotifications) : '' }}</span>
        </h3>
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <div class="list-group">
            @forelse(collect($app->notifications)->splice(0, 5) as $notification)
                <a href="{{ NotificationEstateRoute($notification, $app) }}"
                   class="list-group-item {{ $notification->read_at == null ? 'active' : '' }}">
                    <div>
                        <i class="fa {{ NotificationIcon($notification->data['type']) }} fa-fw"></i>
                                        <span class="small">
                                            {{ str_limit($notification->data['title']) }}
                                        </span>
                                        <span class="pull-right {{ $notification->read_at != null ? 'text-muted' : '' }} small">
                                            {{ $notification->created_at->diffForHumans() }}
                                        </span>
                    </div>
                </a>
            @empty
                <div class="list-group-item">
                    Notifications will appear here.
                </div>
                <li class="divider"></li>
            @endforelse
        </div>
        <!-- /.list-group -->
        <a href="{{ route('rental.notifications.index', ['id' => $app->id]) }}"
           class="btn btn-default btn-block">
            View All Alerts
        </a>
    </div>
    <!-- /.panel-body -->
</div>