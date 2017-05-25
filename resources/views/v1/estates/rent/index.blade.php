@extends('layouts.estates')

@section('title')
    Rent Invoices
@endsection

@section('breadcrumb')
    <li>Rent</li>
    <li>Invoices</li>
    <li class="active">{{ title_case($sort) }}</li>
@endsection

@section('page-header')
    {{ title_case($sort) }} Rent Invoices
@endsection

@section('content')

    @include('includes.alerts.default')

    <div class="row">
        <div class="col-lg-12">
            <form action="{{ route(RentDeleteRoute($sort)) }}" method="get" id="rent-invoices-form">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="clearfix">
                            <strong>Sorted by:
                                <span class="label label-default">{{ !empty(title_case($sort)) ? title_case($sort) . ";" : '' }}</span>
                                <span class="label label-default">{{ !empty($today) ? $today . ";" : '' }}</span>
                                <span class="label label-default">{{ $month != null ? MonthName($month) . ";" : '' }}</span>
                            </strong>
                            <div class="pull-right">
                                <div class="btn-group btn-group-sm">
                                    <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                                            aria-expanded="false">
                                        <strong class="text-right">
                                            Export Rent
                                            <span class="caret"></span>
                                        </strong>
                                    </button>
                                    <ul class="dropdown-menu pull-right">
                                        <li class="dropdown-header">To PDF</li>
                                        <li>
                                            <a href="{{ route('estate.rental.rents.report.pdf', ['id' => $app->id, 'sort' => $sort, $query_string]) }}">Current</a>
                                        </li>
                                        <li role="separator" class="divider"></li>
                                        <li>
                                            <a href="{{ route('estate.rental.rents.report.pdf', ['id' => $app->id, 'sort' => 'paid']) }}">Paid</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('estate.rental.rents.report.pdf', ['id' => $app->id, 'sort' => 'pending']) }}">Pending</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('estate.rental.rents.report.pdf', ['id' => $app->id, 'sort' => 'trashed']) }}">Trashed</a>
                                        </li>
                                        <li role="separator" class="divider"></li>
                                        <li>
                                            <a href="{{ route('estate.rental.rents.report.pdf', ['id' => $app->id, 'sort' => 'all']) }}">All</a>
                                        </li>
                                    </ul>
                                </div>

                                <div class="btn-group btn-group-sm">
                                    <button type="button" class="btn btn-default dropdown-toggle"
                                            data-toggle="dropdown">
                                        <strong>
                                            More Actions
                                            <span class="caret"></span>
                                        </strong>
                                    </button>
                                    <ul class="dropdown-menu pull-right">
                                        <li class="dropdown-header">Sort by</li>
                                        <li>
                                            <a href="{{ route('estate.rental.rents', ['id' => $app->id, 'sort' => 'all']) }}">
                                                All</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('estate.rental.rents', ['id' => $app->id, 'sort' => 'trashed']) }}">
                                                Trashed</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('estate.rental.rents', ['id' => $app->id, 'sort' => 'paid']) }}">
                                                Paid</a>
                                        </li>
                                        <li role="separator" class="divider"></li>
                                        <li>
                                            <a href="{{ route('estate.rental.rents', ['id' => $app->id, 'sort' => 'pending']) }}">
                                                Pending</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('estate.rental.rents', ['id' => $app->id, 'sort' => 'pending', 'today' => 1]) }}">
                                                Pending Today</a>
                                        </li>
                                        <li role="separator" class="divider"></li>
                                        <li class="dropdown-header">Bulk Actions</li>
                                        @if($sort != "trashed")
                                            <li>
                                                <a href="#" id="" data-toggle="modal" data-target="#deleteConfirmation">
                                                    Move To Trash
                                                </a>
                                            </li>
                                        @else
                                            <li>
                                                <a href="#" id="" data-toggle="modal" data-target="#deleteConfirmation">
                                                    Bulk Delete
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <p class="text-muted">You can edit, disable or remove any of the rent invoices below</p>
                    </div>
                    <div class="panel-body">
                        @if(count($rents) > 0)
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>
                                            <input type="checkbox" name="select-all" class="select-box-all">
                                        </th>
                                        <th>Property</th>
                                        <th>Tenant</th>
                                        <th>For</th>
                                        <th>Amount</th>
                                        <th>Due</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($rents as $rent)
                                        <tr>
                                            <td>
                                                <label>
                                                    <input type="checkbox" name="rent[]" id="{{ $rent->id }}"
                                                           class="select-box" value="{{ $rent->id }}">
                                                </label>
                                            </td>
                                            <td>{{ $rent->property->title }}</td>
                                            <td>
                                                {{ $rent->lease->tenant->user->firstname }}
                                                {{ $rent->lease->tenant->user->lastname }}
                                            </td>
                                            <td>
                                                {{ MonthName($rent->date_from) }} - {{ MonthName($rent->date_to) }}
                                            </td>
                                            <td>{{ $rent->amount }}</td>
                                            <td>
                                                {{ $rent->date_due->toDateString() }}
                                            </td>
                                            <td>
                                                <a href="{{ route('estate.rental.rent.status', ['id' => $rent->id]) }}"
                                                   class="btn btn-default btn-xs" data-toggle="tooltip"
                                                   title="{{ RentStatusText($rent->status) }}">
                                                    <i class="{{ PayStatusIcon($rent->status) }}"></i>
                                                </a>
                                            </td>
                                            <td>
                                                <div class="btn-group btn-group-xs">
                                                    @if($sort != "trashed")
                                                        <a href="{{ route('estate.rental.rent.edit', ['id' => $rent->id]) }}"
                                                           role="button" class="btn btn-primary" data-toggle="tooltip"
                                                           data-title="view/edit">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        <a href="{{ route('estate.rental.rent.delete', ['id' => $rent->id]) }}"
                                                           role="button" class="btn btn-warning" data-toggle="tooltip"
                                                           title="trash">
                                                            <i class="fa fa-remove"></i>
                                                        </a>
                                                    @else
                                                        <a href="{{ route('estate.rental.rent.restore', ['id' => $rent->id]) }}"
                                                           role="button" class="btn btn-success" data-toggle="tooltip"
                                                           data-title="restore">
                                                            <i class="fa fa-refresh"></i>
                                                        </a>
                                                        <a href="{{ route('estate.rental.rent.destroy', ['id' => $rent->id]) }}"
                                                           role="button" class="btn btn-danger" data-toggle="tooltip"
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
                            <p class="text-info">
                                No {{ $sort != 'all' ? $sort : '' }} rent invoices found.
                            </p>
                        @endif
                    </div>
                    <div class="panel-footer">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="pagination">
                                    <p>Showing {{ $rents->firstItem() }} to {{ $rents->lastItem() }} of
                                        {{ $rents->total() }}
                                    </p>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="pull-right">
                                    {{ $rents->appends([$query_string])->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- delete confirmation modal -->
    @include('includes.modals.rent-delete')

@endsection