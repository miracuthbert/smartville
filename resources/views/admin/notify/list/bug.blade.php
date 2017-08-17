@if($notification->data['type'] == "bug")
    <li>
        <a href="#">
            <div class="small">
                <i class="fa {{ NotificationIcon($notification->data['type']) }} fa-fw"></i>
                Bug reported by {{ str_limit($notification->data['name'], 10) }}
                <span class="pull-right text-muted">{{ $notification->created_at->diffForHumans() }}</span>
            </div>
        </a>
    </li>
    <li class="divider"></li>
@endif