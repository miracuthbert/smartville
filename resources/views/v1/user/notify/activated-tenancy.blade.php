<li class="list-group-item">
    <header class="clearfix">
        <i class="fa {{ NotificationIcon($notification->data['type']) }} fa-fw"></i>

        <span>
            <b>{{ str_limit($notification->data['title']) }}</b>
        </span>
    </header>

    <p>{{ $notification->data['message'] }}</p>

    <footer class="clearfix">
        <span class="text-muted small">
            {{ $notification->created_at->diffForHumans() }}
        </span>

        <div class="pull-right">
            <div class="btn-group btn-group-xs">
                <a href="{{ route('user.notification.read', ['id' => $notification->id]) }}"
                   class="btn {{ ToggleButtonRead($notification->read_at) }}">
                    {{ ToggleRead($notification->read_at) }}
                    <i class="fa fa-check-square"></i>
                </a>

                @if($notification->read_at != null)
                    <a href="{{ route('tenant.dashboard', ['id' => $notification->data['tenant_id']]) }}"
                       class="btn btn-default" data-toggle="tooltip" title="Go to tenant panel">
                        Tenant Panel
                        <i class="fa fa-dashboard fa-fw"></i>
                    </a>
                @else
                    <a href="{{ route('tenant.dashboard', ['id' => $notification->data['tenant_id'], 'read' => $notification->id]) }}"
                       class="btn btn-default" data-toggle="tooltip" title="Go to tenant panel">
                        Tenant Panel
                        <i class="fa fa-dashboard fa-fw"></i>
                    </a>
                @endif
            </div>
        </div>
    </footer>

</li>