<li class="list-group-item">
    <header class="clearfix">
        <i class="fa {{ NotificationIcon($notification->data['type']) }} fa-fw"></i>

        <span>
            <b>{{ $notification->data['title'] }}</b>
        </span>
    </header>
    <p>
        {{ $notification->data['message'] }}
    </p>
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
                    <a href="{{ route('tenant.rent', ['id' => $notification->data['rent_id']]) }}"
                       class="btn btn-default" data-toggle="tooltip" title="View Invoice">
                        View
                        <i class="fa {{ NotificationIcon($notification->data['type']) }} fa-fw"></i>
                    </a>
                @else
                    <a href="{{ route('tenant.rent', ['id' => $notification->data['rent_id'], 'read' => $notification->id]) }}"
                       class="btn btn-default" data-toggle="tooltip" title="View Invoice">
                        View
                        <i class="fa {{ NotificationIcon($notification->data['type']) }} fa-fw"></i>
                    </a>
                @endif
            </div>
        </div>
    </footer>
</li>