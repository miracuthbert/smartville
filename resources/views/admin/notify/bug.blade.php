@if($notification->data['type'] == "bug")
    <li class="list-group-item">
        <div class="clearfix">
            <i class="fa {{ NotificationIcon($notification->data['type']) }} fa-fw"></i>

            <b>{{ str_limit($notification->data['title'], 60) }}</b>

            <em> by {{ $notification->data['name'] }}</em>

            <div class="pull-right">
                <div class="btn-group btn-group-sm">
                    <a href="{{ route('admin.notification.read', ['id' => $notification->id]) }}"
                       class="btn {{ ToggleButtonRead($notification->read_at) }}">
                        {{ ToggleRead($notification->read_at) }}
                    </a>

                    <a href="{{ route('bugs.show', ['id' => $notification->data['id'], 'read' => $notification->id]) }}"
                       class="btn btn-primary">
                        View report
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
    </li>
@endif