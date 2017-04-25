<li class="list-group-item">
    <div class="row">
        <div class="col-sm-8">
            <div class="list-group-item-text">
                <i class="fa {{ NotificationIcon($notification->data['type']) }} fa-fw"></i>
                <strong>{{ $notification->data['title'] }}</strong>
            </div>
        </div>
        <!-- /.col-sm-8 -->
        <div class="col-sm-4">
            <div class="pull-right">
                <div class="btn-group btn-group-xs">
                    <a href="{{ route('estate.rental.notification.read', ['id' => $notification->id, 'app'=> $app->id]) }}"
                       class="btn {{ ToggleButtonRead($notification->read_at) }}">
                        {{ ToggleRead($notification->read_at) }}
                    </a>

                    @if($notification->read_at != null)
                        <a href="{{ route('estate.rental.bills.generate', ['id' => $app->id, 'service' => $notification->data['billing_id']]) }}"
                           class="btn btn-default" data-toggle="tooltip" title="Create invoices">
                            Create
                        </a>
                    @else
                        <a href="{{ route('estate.rental.bills.generate', ['id' => $app->id, 'service' => $notification->data['billing_id'], 'notify' => $notification->id]) }}"
                           class="btn btn-default" data-toggle="tooltip" title="Create invoices">
                            Create
                        </a>
                    @endif

                    <a href="{{ route('estate.rental.notification.delete', ['id' => $notification->id, 'app'=> $app->id]) }}"
                       class="btn btn-default" data-toggle="tooltip" title="remove">
                        <i class="fa fa-times-circle-o"></i>
                    </a>
                </div>
            </div>
            <!-- /.pull-right -->
        </div>
        <!-- /.col-sm-4 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-sm-12">
            <p>
                {{ $notification->data['message'] }}
            </p>
        </div>
    </div>
    <!-- /.row -->
    <p class="text-right text-muted small">
        <em>
            {{ $notification->created_at->diffForHumans() }}
        </em>
    </p>
</li>