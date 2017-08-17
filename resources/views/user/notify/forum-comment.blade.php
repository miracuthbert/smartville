<li class="list-group-item">
    <header>
        <p>
            <i class="fa {{ NotificationIcon($notification->data['type']) }} fa-fw"></i>
            A new comment has been added to
            <b>{{ str_limit($notification->data['title'], 60) }}</b>
            <em class="pull-right"> by {{ $notification->data['name'] }}</em>
        </p>
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

                <a href="{{ route('forum.show', ['id' => $notification->data['id'], '#comment'.$notification->data['comment_id'], 'read' => $notification->id]) }}"
                   class="btn btn-primary">
                    View comment
                    <i class="fa {{ NotificationIcon($notification->data['type']) }} fa-fw"></i>
                </a>
            </div>
        </div>
    </footer>
</li>
