@extends('layouts.estates')

@section('title')
    {{ title_case($sort) }} Tenants
@endsection

@section('breadcrumb')
    <li>Tenants</li>
    <li class="active">{{ title_case($sort) }}</li>
@endsection

@section('page-header')
    {{ title_case($sort) }} Tenants
@endsection

@section('content')

    @include('includes.alerts.default')

    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <strong>{{ title_case($sort) }} Tenants</strong>
            <div class="pull-right">
                <div class="btn-group btn-group-sm">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <strong class="text-right">Actions
                            <span class="caret"></span>
                        </strong>
                    </button>
                    <ul class="dropdown-menu pull-right">
                        <li class="dropdown-header">Sort by</li>
                        <li>
                            <a href="{{ route('estate.tenants', ['id' => $app->id, 'sort' => 'all']) }}">All</a>
                        </li>
                        <li>
                            <a href="{{ route('estate.tenants', ['id' => $app->id, 'sort' => 'trashed']) }}">Trashed</a>
                        </li>
                        <li>
                            <a href="{{ route('estate.tenants', ['id' => $app->id, 'sort' => 'active']) }}">Active</a>
                        </li>
                        <li>
                            <a href="{{ route('estate.tenants', ['id' => $app->id, 'sort' => 'disabled']) }}">Vacated</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="panel-body">
            @if(count($tenants) > 0)
                <div class="panel-group" id="accordion">
                    @if($sort != "trashed")
                        @foreach($tenants as $tenant)
                            <div class="panel {{ $tenant->status == 1 ? 'panel-green' : 'panel-default' }}">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordion"
                                                   href="#collapse{{ $tenant->id }}"
                                                   aria-expanded="false" class="collapsed">
                                                    {{ $tenant->user->firstname }} {{ $tenant->user->lastname }} Leases
                                                </a>
                                            </h4>
                                        </div>
                                        <div class="col-md-3">

                                        </div>
                                    </div>
                                </div>
                                <div id="collapse{{ $tenant->id }}" class="panel-collapse collapse"
                                     aria-expanded="false">
                                    <div class="panel-body">
                                        @if(count($tenant->leases) > 0)
                                            <div class="table-responsive">
                                                <table class="table table-striped">
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
                                                            <span data-toggle="tooltip"
                                                                  title="{{ LeaseStatusText($lease->status) }}">
                                                                <i class="{{ AppStatusIcon($lease->status) }}"></i>
                                                            </span>
                                                            </td>
                                                            <td>
                                                                <div class="btn-group btn-group-xs">
                                                                    @if($sort != "trashed")
                                                                        <a href="{{ route('estate.lease.edit', ['id' => $lease->id]) }}"
                                                                           role="button"
                                                                           class="btn btn-primary" data-toggle="tooltip"
                                                                           title="edit lease">
                                                                            <span class="fa fa-edit"></span>
                                                                        </a>
                                                                        <a href="{{ route('estate.lease.delete', ['id' => $lease->id]) }}"
                                                                           role="button" class="btn btn-warning"
                                                                           data-toggle="tooltip"
                                                                           title="remove lease">
                                                                            <i class="fa fa-remove"></i>
                                                                        </a>
                                                                    @else
                                                                        <a href="{{ route('estate.lease.restore', ['id' => $lease->id]) }}"
                                                                           role="button"
                                                                           class="btn btn-success" data-toggle="tooltip"
                                                                           title="restore lease">
                                                                            <span class="fa fa-refresh"></span>
                                                                        </a>
                                                                        <a href="{{ route('estate.lease.destroy', ['id' => $lease->id]) }}"
                                                                           role="button" class="btn btn-danger"
                                                                           data-toggle="tooltip"
                                                                           title="delete completely">
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
                                            <p class="text-info">{{ $tenant->user->firstname }} has no leases.</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        @include('v1.estates.tenants.trashed')
                    @endif
                </div>
            @else
                <p class="text-info">
                    No {{ $sort }} tenants found.
                </p>
            @endif
        </div>
        @if(count($tenants) > 0)
            <div class="panel-footer">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="pagination">
                            <p></p>
                            <p class="label label-default">
                                {{ title_case($sort) }} tenants : {{ $tenants->total() }}
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="pull-right">
                            {{ $tenants->links() }}
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!--modal snippet -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit record:</h4>
                </div>
                <div class="modal-body">
                    <p>Record details here&hellip;</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="">Save changes</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <script>
        CKEDITOR.replace('property_desc');
    </script>
@endsection
