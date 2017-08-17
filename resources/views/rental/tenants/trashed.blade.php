@foreach($tenants as $tenant)
    <div class="panel panel-default }}">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion"
                   href="#collapse{{ $tenant->tenant->id }}"
                   aria-expanded="false" class="collapsed">
                    {{ $tenant->tenant->user->firstname }} {{ $tenant->tenant->user->lastname }} Leases
                    <i class="caret pull-right"></i>
                </a>
            </h4>
        </div>
    </div>
    <div id="collapse{{ $tenant->tenant->id }}" class="panel-collapse collapse" aria-expanded="false">
        <div class="panel-body">
            @if(count($tenant) > 0)
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Property</th>
                            <th>Lease</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{ $tenant->id }}</td>
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
                                    <a href="{{ route('estate.lease.restore', ['id' => $tenant->id]) }}"
                                       role="button"
                                       class="btn btn-success" data-toggle="tooltip"
                                       title="restore lease">
                                        <span class="fa fa-refresh"></span>
                                    </a>
                                    <a href="{{ route('estate.lease.destroy', ['id' => $tenant->id]) }}"
                                       role="button" class="btn btn-danger"
                                       data-toggle="tooltip"
                                       title="delete completely">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-info">{{ $tenant->tenant->user->firstname }} has no leases.</p>
            @endif
        </div>
    </div>
    </div>
@endforeach