@extends('layouts.estates')

@section('title')
    Bills
@endsection

@section('breadcrumb')
    <li>Bills</li>
    <li>Invoices</li>
    <li class="active">{{ title_case($sort) }}</li>
@endsection

@section('page-header')
    Bills
@endsection

@section('content')

    @include('includes.alerts.default')
    <div class="row">
        <div class="col-lg-12">
            <form action="{{ route(BillDeleteRoute($sort)) }}" method="get" id="bills-invoice-form">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="clearfix">
                            <strong>Sorted by: {{ title_case($sort) }} Bills</strong>
                            <div class="pull-right">
                                <div class="btn-group btn-group-sm">
                                    <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                                            aria-expanded="false">
                                        <strong class="text-right">
                                            Export Bills
                                            <span class="caret"></span>
                                        </strong>
                                    </button>
                                    <ul class="dropdown-menu pull-right">
                                        <li class="dropdown-header">To PDF</li>
                                        <li>
                                            <a href="{{ route('estate.rental.bills.report.pdf', ['id' => $app->id, 'sort' => 'all']) }}">All</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('estate.rental.bills.report.pdf', ['id' => $app->id, 'sort' => 'trashed']) }}">Trashed</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('estate.rental.bills.report.pdf', ['id' => $app->id, 'sort' => 'paid']) }}">Paid</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('estate.rental.bills.report.pdf', ['id' => $app->id, 'sort' => 'pending']) }}">Pending</a>
                                        </li>
                                    </ul>
                                </div>

                                <div class="btn-group btn-group-sm">
                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"
                                            aria-expanded="false">
                                        <strong class="text-right"> More Actions
                                            <span class="caret"></span>
                                        </strong>
                                    </button>
                                    <ul class="dropdown-menu pull-right">
                                        <li class="dropdown-header">Sort by</li>
                                        <li>
                                            <a href="{{ route('estate.rental.bills.tenants', ['id' => $app->id, 'sort' => 'all']) }}">All</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('estate.rental.bills.tenants', ['id' => $app->id, 'sort' => 'trashed']) }}">Trashed</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('estate.rental.bills.tenants', ['id' => $app->id, 'sort' => 'paid']) }}">Paid</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('estate.rental.bills.tenants', ['id' => $app->id, 'sort' => 'pending']) }}">Pending</a>
                                        </li>
                                        <li role="separator" class="divider"></li>
                                        <li class="dropdown-header">Bulk Actions</li>
                                        @if($sort != "trashed")
                                            <li>
                                                <a href="#" id="btnBulkDelete" data-toggle="modal"
                                                   data-target="#deleteConfirmation">
                                                    Move To Trash
                                                </a>
                                            </li>
                                        @else
                                            <li>
                                                <a href="#" id="btnBulkDestroy" data-toggle="modal"
                                                   data-target="#deleteConfirmation">
                                                    Bulk Delete
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <p class="text-muted">You can edit, disable or remove any of the bills</p>
                    </div>
                    <div class="panel-body">
                        @if(count($bills) > 0)
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>
                                            <input type="checkbox" name="select-all" class="select-box-all">
                                        </th>
                                        <th>Property</th>
                                        <th>Bill</th>
                                        <th>Amount</th>
                                        <th>Date Due.</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($bills as $bill)
                                        <tr>
                                            <td>
                                                <label>
                                                    <input type="checkbox" name="bill[]" id="{{ $bill->id }}"
                                                           class="select-box" value="{{ $bill->id }}">
                                                </label>
                                            </td>
                                            <td>{{ $bill->property->title }}</td>
                                            <td>{{ $bill->bill->title }}</td>
                                            <td>
                                                @if($bill->bill->bill_plan == 0)
                                                    {{ $bill->unit_cost }}
                                                @else
                                                    {{ BillTotal($bill->previous_usage, $bill->current_usage, $bill->unit_cost) }}
                                                @endif
                                            </td>
                                            <td>{{ $bill->date_due->toDateString() }}</td>
                                            <td>
                                                <a href="{{ route('estate.rental.bills.invoice.status', ['id' => $bill->id]) }}"
                                                   role="button"
                                                   class="btn btn-default btn-xs" data-toggle="tooltip"
                                                   title="{{ BillStatusText($bill->status) }}">
                                                    <i class="{{ PayStatusIcon($bill->status) }}"></i>
                                                </a>
                                            </td>
                                            <td>
                                                <div class="btn-group btn-group-xs">
                                                    @if($sort != "trashed")
                                                        <a href="{{ route('estate.rental.bills.invoice.edit', ['id' => $bill->id]) }}"
                                                           role="button" class="btn btn-primary" data-toggle="tooltip"
                                                           title="edit">
                                                            <i class="fa fa-edit"></i>
                                                        </a>

                                                        <a href="{{ route('estate.rental.bills.invoice.delete', ['id' => $bill->id]) }}"
                                                           role="button" class="btn btn-warning" data-toggle="tooltip"
                                                           title="trash">
                                                            <i class="fa fa-remove"></i>
                                                        </a>
                                                    @else
                                                        <a href="{{ route('estate.rental.bills.invoice.restore', ['id' => $bill->id]) }}"
                                                           role="button" class="btn btn-success" data-toggle="tooltip"
                                                           title="restore">
                                                            <i class="fa fa-refresh"></i>
                                                        </a>

                                                        <a href="{{ route('estate.rental.bills.invoice.destroy', ['id' => $bill->id]) }}"
                                                           role="button" class="btn btn-danger" data-toggle="tooltip"
                                                           title="delete">
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
                            <p class="text-info">No {{ $sort != "all" ? $sort : '' }} bills found.</p>
                        @endif
                    </div>
                    @if(count($bills) > 0)
                        <div class="panel-footer">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="pagination">
                                        <p></p>
                                        <p class="label label-default">
                                            {{ title_case($sort) }} bill invoices : {{ $bills->total() }}
                                        </p>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="pull-right">
                                        {{ $bills->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </form>
        </div>
    </div>

    @include('includes.modals.bills-delete');
@endsection
