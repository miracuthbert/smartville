@extends('layouts.rental.master')

@section('title', 'Bill Services')

@section('breadcrumb')
    <li>Bill</li>
    <li class="active">Services</li>
@endsection

@section('page-header')
    <i class="fa fa-cubes"></i> Bill Services ({{ isset($sort) ? title_case($sort) : 'All' }})
    <div class="pull-right">
        <div class="btn-group btn-group-sm">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                <strong class="text-right">Actions
                    <span class="caret"></span>
                </strong>
            </button>
            <ul class="dropdown-menu pull-right">
                <li>
                    <a href="{{ route('rental.bills.services.index', [$app]) }}">All</a>
                </li>
                <li>
                    <a href="{{ route('rental.bills.services.index', [$app, 'sort' => 'trashed']) }}">Trashed</a>
                </li>
                <li>
                    <a href="{{ route('rental.bills.services.index', [$app, 'sort' => 'active']) }}">Active</a>
                </li>
                <li>
                    <a href="{{ route('rental.bills.services.index', [$app, 'sort' => 'disabled']) }}">Disabled</a>
                </li>
            </ul>
        </div>
    </div>
@endsection

@section('content')

    <p class="text-muted">You can edit, disable or remove any of the billing services below.</p>

    <div class="row">
        <div class="col-lg-12">
            <div id="bills-wrapper">
                @if($billing_services->total() > 0)
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Bill</th>
                                <th>Dependent</th>
                                <th>Billing interval</th>
                                <th>Amount</th>
                                {{--<th>Auto-billing</th>--}}
                                <th>Properties</th>
                                <th>{{ isset($sort) && $sort == "trashed" ? 'Delete Time' : "Status"  }}</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($billing_services as $service)
                                <tr>
                                    <td>
                                        {{ $loop->first ? $billing_services->firstItem() : ($billing_services->firstItem() + $loop->index) }}
                                    </td>
                                    <td>{{ $service->title }}</td>
                                    <td>{{ BillPlan($service->bill_plan) }}</td>
                                    <td>{{ $service->billing_interval }} {{ $service->interval_type }}</td>
                                    <td>{{ $service->billing_amount }}</td>
                                    {{--<td>{{ AutoBilling($service->auto_billing) }}</td>--}}
                                    <td>{{ BillingProperties($service->properties) }}</td>
                                    <td>
                                        @if($sort != "trashed")
                                            <a href="#" role="button" class="btn btn-default btn-xs"
                                               data-toggle="tooltip"
                                               title="{{ AppStatusToggleText($service->status) }}"
                                               onclick="event.preventDefault();document.getElementById('service-status-{{ $service->id }}-form').submit()">
                                                <i class="{{ AppStatusIcon($service->status) }}"></i>
                                            </a>
                                            <form id="service-status-{{ $service->id }}-form"
                                                  action="{{ route('rental.bills.services.status', [$app, $service]) }}"
                                                  method="POST" style="display: none;">
                                                {{ csrf_field() }}
                                                {{ method_field('PUT') }}
                                            </form>
                                        @else
                                            {{ $service->deleted_at->diffForHumans() }}
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-xs">
                                            @if($sort != "trashed")
                                                <a href="{{ route('rental.bills.services.edit', [$app, $service]) }}"
                                                   role="button" class="btn btn-primary" data-toggle="tooltip"
                                                   title="edit">
                                                    <i class="fa fa-edit"></i>
                                                </a>

                                                <a href="#" role="button" class="btn btn-warning" data-toggle="tooltip"
                                                   title="trash"
                                                   onclick="event.preventDefault();document.getElementById('service-delete-{{ $service->id }}-form').submit()">
                                                    <i class="fa fa-remove"></i>
                                                </a>
                                                <form id="service-delete-{{ $service->id }}-form"
                                                      action="{{ route('rental.bills.services.delete', [$app, $service]) }}"
                                                      method="POST" style="display: none;">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                </form>
                                            @else
                                                <a href="#" role="button" class="btn btn-success" data-toggle="tooltip"
                                                   title="restore"
                                                   onclick="event.preventDefault();document.getElementById('service-restore-{{ $service->id }}-form').submit()">
                                                    <i class="fa fa-refresh"></i>
                                                </a>
                                                <form id="service-restore-{{ $service->id }}-form"
                                                      action="{{ route('rental.bills.services.restore', [$app, $service]) }}"
                                                      method="POST" style="display: none;">
                                                    {{ csrf_field() }}
                                                    {{ method_field('PUT') }}
                                                </form>

                                                <a href="#" role="button" class="btn btn-danger" data-toggle="tooltip"
                                                   title="delete"
                                                   onclick="event.preventDefault();document.getElementById('service-destroy-{{ $service->id }}-form').submit()">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                                <form id="service-destroy-{{ $service->id }}-form"
                                                      action="{{ route('rental.bills.services.destroy', [$app, $service]) }}"
                                                      method="POST" style="display: none;">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <hr>
                    <p><strong>Total</strong> ({{ isset($sort) ? title_case($sort) : 'All' }}
                        ): {{ $billing_services->total() }}</p>
                    {{ $billing_services->appends(['sort' => $sort])->links() }}
                @else
                    <p class="text-info">No {{ isset($sort) ? title_case($sort) : '' }} billing services found.</p>
                @endif
            </div>
        </div>
    </div>
@endsection
