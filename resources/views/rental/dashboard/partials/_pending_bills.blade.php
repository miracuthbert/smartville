<div class="panel panel-default">
    <div class="panel-heading">
        <h3>
            <i class="fa fa-money fa-fw"></i> Pending Bills
            <span class="badge">{{ $p_bills->total() }}</span>
        </h3>
    </div>
    <div class="panel-body">
        <div class="list-group">
            @forelse($p_bills as $bill)
                <a href="{{ route('estate.rental.bills.invoice.edit', [$bill]) }}"
                   class="list-group-item">
                    <p class="list-item-text">
                        {{ $bill->property->title }} - {{ strtoupper($bill->bill->title) }}
                        <br>
                        {{ $bill->lease->tenant->user->firstname }}
                        {{ $bill->lease->tenant->user->lastname }}
                        <span class="pull-right">
                                        <i class="fa fa-chevron-right"></i>
                                    </span>
                    </p>
                </a>
            @empty
                <div class="list-group-item">
                    No pending bills this month.
                </div>
            @endforelse
        </div>
        <a href="{{ route('estate.rental.bills.tenants', ['id' => $app->id, 'sort' => 'pending']) }}"
           class="btn btn-default btn-block">
            View all Pending Bills
        </a>
    </div>
</div>