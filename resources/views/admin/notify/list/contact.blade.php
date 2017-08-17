@if($notification->data['type'] == "contact")
    <li>
        <a href="#">
            <div>
                <i class="fa {{ NotificationIcon($notification->data['type']) }} fa-fw"></i>
            <span class="small">
                    Message from {{ str_limit($notification->data['name'], 10) }}
            </span>
            <span class="pull-right text-muted small">
                {{ $notification->created_at->diffForHumans() }}
            </span>
            </div>
        </a>
    </li>
    <li class="divider"></li>
@endif