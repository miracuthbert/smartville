@if(count($tenants) > 0)
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th>#</th>
                <th>Tenant</th>
                <th>Property</th>
                <th>Lease</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($tenants as $tenant)
                <tr>
                    <td>
                        {{ $loop->first ? $tenants->firstItem() : ($tenants->firstItem() + $loop->index) }}
                    </td>
                    <td>
                        {{ $tenant->tenant->user->firstname . ' ' . $tenant->tenant->user->lastname }}
                    </td>
                    <td>
                        {{ $tenant->property->title }}
                    </td>
                    <td>
                        {{ $tenant->lease_duration }}
                        {{ count($tenant->lease_duration) > 1 ? 'months' : 'month' }}
                    </td>
                    <td>
                    <span data-toggle="tooltip"
                          title="{{ LeaseStatusText($tenant->status) }}">
                        <i class="{{ AppStatusIcon($tenant->status) }}"></i>
                    </span>
                    </td>
                    <td>
                        <div class="btn-group btn-group-xs">
                            @if($sort != "trashed")
                                <a href="{{ route('estate.rental.lease.edit', ['id' => $tenant->id]) }}" role="button"
                                   class="btn btn-primary" data-toggle="tooltip" title="edit lease">
                                    <span class="fa fa-edit"></span>
                                </a>
                                {{--<a href="{{ route('estate.rental.lease.delete', ['id' => $tenant->id]) }}" role="button"--}}
                                   {{--class="btn btn-warning" data-toggle="tooltip" title="remove lease">--}}
                                    {{--<i class="fa fa-remove"></i>--}}
                                {{--</a>--}}
                            @else
                                <a href="{{ route('estate.rental.lease.restore', ['id' => $tenant->id]) }}" role="button"
                                   class="btn btn-success" data-toggle="tooltip" title="restore lease">
                                    <span class="fa fa-refresh"></span>
                                </a>
                                <a href="{{ route('estate.rental.lease.destroy', ['id' => $tenant->id]) }}" role="button"
                                   class="btn btn-danger" data-toggle="tooltip" title="delete completely">
                                    <i class="fa fa-trash"></i>
                                </a>
                            @endif
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@else
    <p class="text-info">
        No {{ $sort }} leases found.
    </p>
@endif

