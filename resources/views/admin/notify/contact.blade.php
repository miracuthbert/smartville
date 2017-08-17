@if($notification->data['type'] == "contact")
    <div class="list-group-item">
        <div class="clearfix">
            <i class="fa {{ NotificationIcon($notification->data['type']) }} fa-fw"></i>

            <b>{{ $notification->data['title'] }}</b>

            <em> by {{ $notification->data['name'] }}</em>

            <div class="pull-right">
                <div class="btn-group btn-group-sm">
                    <a href="{{ route('admin.notification.read', ['id' => $notification->id]) }}"
                       class="btn {{ ToggleButtonRead($notification->read_at) }}">
                        {{ ToggleRead($notification->read_at) }}
                    </a>

                    <a href="{{ route(NotificationRoute($notification->data['type']), ['id' => $notification->data['id'], 'read' => $notification->id]) }}"
                       class="btn btn-primary">
                        View message
                        <i class="fa {{ NotificationIcon($notification->data['type']) }} fa-fw"></i>
                    </a>
                </div>
            </div>
        </div>

        <p class="text-muted small text-right">
            <em>
                {{ $notification->created_at->diffForHumans() }}
            </em>
        </p>
    </div>
@endif