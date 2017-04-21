@if(ToggleRead($notification->data['type']))
    <li class="list-group-item clearfix">
        <i class="fa {{ NotificationIcon($notification->data['type']) }} fa-fw"></i>
        <b>{{ $notification->data['title'] }}</b>

        <em> by {{ $notification->data['name'] }}</em>

        <div class="btn-group btn-group-xs pull-right">
            <a href="#"
               class="btn {{ ToggleButtonRead($notification->read_at) }}">
                {{ ToggleRead($notification->read_at) }}
            </a>

            <a href="#"
               class="btn btn-link">
                View message
            </a>
        </div>

        <p class="text-right text-muted small">
            <em>
                {{ $notification->created_at->diffForHumans() }}
            </em>
        </p>
    </li>
@endif
