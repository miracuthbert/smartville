<div class="media">
    <div class="media-body">
        <h5>
            <strong><i class="fa {{ NotificationIcon($notification->data['type']) }} fa-fw"></i> {{ $notification->data['title'] }}
            </strong></h5>

        @if(isset($notification->data['message']))
            <p>{!! $notification->data['message'] !!}</p>
        @endif

        <ul class="list-inline">
            <li>
                <time>{{ $notification->created_at->diffForHumans() }}</time>
            </li>

            <li>
                <a href="{{ route('rental.notifications.read', [$app, $notification]) }}"
                   class="btn {{ ToggleButtonRead($notification->read_at) }} btn-sm">
                    {{ ToggleRead($notification->read_at) }}
                </a>
            </li>

            {{-- Update to laravel 5.4 to use slots in child views --}}
            @include('rental.notifications.partials._button_links')

            <li>
                <a href="{{ route('rental.notifications.delete', [$app, $notification]) }}"
                   class="btn btn-default btn-sm" data-toggle="tooltip" title="remove">
                    <i class="fa fa-times-circle-o"></i>
                </a>
            </li>
        </ul>

    </div>
</div>
<hr>