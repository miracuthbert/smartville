<div class="panel panel-default">
    <div class="panel-heading">
        <h3>
            <i class="fa fa-credit-card-alt fa-fw"></i> Pending Rent
            <span class="badge">{{ $p_rents->total() }}</span>
        </h3>
    </div>
    <div class="panel-body">
        <div class="list-group">
            @forelse($p_rents as $rent)
                <a href="{{ route('estate.rental.rent.edit', [$rent]) }}"
                   class="list-group-item">
                    <p class="list-item-text">
                        {{ $rent->property->title }}
                        <br>
                        {{ $rent->lease->tenant->user->firstname }}
                        {{ $rent->lease->tenant->user->lastname }}
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
        <a href="{{ route('estate.rental.rents', ['id' => $app->id, 'sort' => 'pending']) }}"
           class="btn btn-default btn-block">
            View All Pending Rents
        </a>
    </div>
</div>