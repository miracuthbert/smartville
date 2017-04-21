<li class="list-group-item">
    <div class="clearfix">
        <div class="list-group-item-text">
            <i class="fa {{ NotificationIcon($notification->data['type']) }} fa-fw"></i>
            <strong>{{ $notification->data['title'] }}</strong>
        </div>
        <div class="pull-right">
            <div class="btn-group btn-group-xs">
                <a href="#"
                   class="btn {{ ToggleButtonRead($notification->read_at) }}">
                    {{ ToggleRead($notification->read_at) }}
                </a>

                <a href="#"
                   class="btn btn-link">
                    View message
                </a>
            </div>
        </div>
        <p>
            {{ $notification->data['message'] }}
        </p>
    </div>
    <!-- /.pull-right -->

    <p class="text-right text-muted small">
        <em>
            {{ $notification->created_at->diffForHumans() }}
        </em>
    </p>
</li>