<li class="list-group-item">
    <header class="clearfix">
        <i class="fa {{ NotificationIcon($notification->data['type']) }} fa-fw"></i>

        <span>
            You have received a new invoice for
            <b>{{ str_limit($notification->data['title'], 60) }} bill</b>
            <em> by {{ $notification->data['from'] }}</em>
        </span>
    </header>

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

                <a href="{{ route('tenant.bill', ['id' => $notification->data['invoice_id'], 'read' => $notification->id]) }}"
                   class="btn btn-primary">
                    View invoice
                    <i class="fa {{ NotificationIcon($notification->data['type']) }} fa-fw"></i>
                </a>
            </div>
        </div>
    </footer>
</li>