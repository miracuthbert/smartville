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
                <a href="#" class="btn btn-default btn-sm" data-toggle="tooltip" title="remove"
                   onclick="event.preventDefault(); document.getElementById('rental-notifications-delete-form').submit();">
                    <i class="fa fa-times-circle-o"></i>
                </a>

                <form id="rental-notifications-delete-form"
                      action="{{ route('rental.notifications.delete', [$app, $notification]) }}" method="POST"
                      style="display: none;">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                </form>
            </li>
        </ul>

    </div>
</div>
<hr>