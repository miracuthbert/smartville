<li class="list-group-item">
    <div class="clearfix">
        <div class="list-group-item-text">
            <i class="fa {{ NotificationIcon($notification->data['type']) }} fa-fw"></i>
            <strong>{{ $notification->data['title'] }}</strong>
        </div>
        <div class="pull-right">
            <div class="btn-group btn-group-xs">
                <a href="{{ route('estate.rental.notification.read', ['id' => $notification->id, 'app'=> $app->id]) }}"
                   class="btn {{ ToggleButtonRead($notification->read_at) }}">
                    {{ ToggleRead($notification->read_at) }}
                </a>

                {{--<a href="#"--}}
                   {{--class="btn btn-link">--}}
                    {{--View message--}}
                {{--</a>--}}

                <a href="{{ route('estate.rental.notification.delete', ['id' => $notification->id, 'app'=> $app->id]) }}"
                   class="btn btn-default" data-toggle="tooltip" title="remove">
                    <i class="fa fa-times-circle-o"></i>
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