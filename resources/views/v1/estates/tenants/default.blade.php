@foreach($tenants as $tenant)
    <div class="panel {{ $tenant->status == 1 ? 'panel-info' : 'panel-default' }}">
        <div class="panel-heading">
            <div class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion"
                   href="#collapse{{ $tenant->id }}"
                   aria-expanded="false" class="collapsed">
                    {{ $tenant->user->firstname }} {{ $tenant->user->lastname }}
                    <div class="pull-right">
                        <i class="caret"></i>
                    </div>
                </a>
            </div>
        </div>
        <div id="collapse{{ $tenant->id }}" class="panel-collapse collapse" aria-expanded="false">
            <div class="panel-body">
                @if(count($tenant->leases) > 0)
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
                            @foreach($tenant->leases as $lease)
                                <tr>
                                    <td>{{ $lease->id }}</td>
                                    <td>
                                        {{ $lease->property->title }}
                                    </td>
                                    <td>
                                        {{ $lease->lease_duration }}
                                        {{ count($lease->lease_duration) > 1 ? 'months' : 'month' }}
                                    </td>
                                    <td>
                                        <span data-toggle="tooltip" title="{{ LeaseStatusText($lease->status) }}">
                                            <i class="{{ AppStatusIcon($lease->status) }}"></i>
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-xs">
                                            @if($sort != "trashed")
                                                <a href="{{ route('estate.rental.lease.edit', ['id' => $lease->id]) }}"
                                                   role="button" class="btn btn-primary" data-toggle="tooltip"
                                                   title="edit lease">
                                                    <span class="fa fa-edit"></span>
                                                </a>
                                                {{--<a href="{{ route('estate.rental.lease.delete', ['id' => $lease->id]) }}"--}}
                                                   {{--role="button" class="btn btn-warning" data-toggle="tooltip"--}}
                                                   {{--title="remove lease">--}}
                                                    {{--<i class="fa fa-remove"></i>--}}
                                                {{--</a>--}}
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-info">{{ $tenant->user->firstname }} has no leases.</p>
                @endif
            </div>
        </div>
    </div>
@endforeach
