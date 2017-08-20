@if($notification->data['type'] == "subscription")

@elseif($notification->data['type'] === "create_bill_invoices") {{-- create bill invoices --}}
    @if($notification->read_at != null)
        <li>
            <a href="{{ route('rental.bills.generate', [$app, 'service' => $notification->data['billing_id']]) }}"
               class="btn btn-default btn-sm" data-toggle="tooltip" title="Create invoices">
                Create invoices
            </a>
        </li>
    @else
        <li>
            <a href="{{ route('rental.bills.generate', [$app, 'service' => $notification->data['billing_id'], 'notify' => $notification->id]) }}"
               class="btn btn-default btn-sm" data-toggle="tooltip" title="Create invoices">
                Create invoices
            </a>
        </li>
    @endif

@elseif($notification->data['type'] === "pending_bills_invoices")   {{-- pending bill invoice --}}
    @if($notification->read_at != null)
        <li>
            <a href="{{ route('rental.bills.index', [$app, 'sort' => 'pending', 'service' => $notification->data['billing_id'], 'today' => $notification->data['is_today'], 'date' => $notification->created_at->toDateString()]) }}"
               class="btn btn-default btn-sm" data-toggle="tooltip" title="View invoices">
                View invoices
            </a>
        </li>
    @else
        <li>
            <a href="{{ route('rental.bills.index', [$app, 'sort' => 'pending', 'service' => $notification->data['billing_id'], 'notify' => $notification->id, 'today' => $notification->data['is_today'], 'date' => $notification->created_at->toDateString()]) }}"
               class="btn btn-default btn-sm" data-toggle="tooltip" title="View invoices">
                View invoices
            </a>
        </li>
    @endif

@elseif($notification->data['type'] === "pending_rent_invoices")    {{-- pending rent invoice --}}
    @if($notification->read_at != null)
        <li>
            <a href="{{ route('rental.rents.index', [$app, 'sort' => 'pending', 'today' => $notification->data['is_today'], 'date' => $notification->created_at->toDateString()]) }}"
               class="btn btn-default btn-sm" data-toggle="tooltip" title="View invoices">
                View invoices
            </a>
        </li>
    @else
        <li>
            <a href="{{ route('rental.rents.index', [$app, 'sort' => 'pending', 'notify' => $notification->id, 'today' => $notification->data['is_today'], 'date' => $notification->created_at->toDateString()]) }}"
               class="btn btn-default btn-sm" data-toggle="tooltip" title="View invoices">
                View invoices
            </a>
        </li>
    @endif
@endif
