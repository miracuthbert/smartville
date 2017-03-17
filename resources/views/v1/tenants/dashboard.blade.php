@extends('layouts.tenant')

@section('title')
    Dashboard
@endsection

@section('breadcrumb')
    <li class="active">Dashboard</li>
@endsection

@section('page-header')
    Dashboard
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Leases
                    <a href="{{ route('tenant.leases', ['id' => $tenant->id]) }}" class="btn btn-link btn-xs pull-right">
                        <i class="fa fa-chevron-right"></i>
                    </a>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    @if(count($leases) > 0)
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Property</th>
                                    <th>Move In</th>
                                    <th>Move Out</th>
                                    <th>Lease</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($leases as $lease)
                                    <tr>
                                        <td>{{ $lease->id }}</td>
                                        <td>
                                            {{ $lease->property->title }}
                                        </td>
                                        <td>
                                            {{ $lease->move_in }}
                                        </td>
                                        <td>
                                            {{ $lease->move_out != null ? $lease->move_out : '-' }}
                                        </td>
                                        <td>
                                            {{ $lease->lease_duration }}
                                            {{ count($lease->lease_duration) > 1 ? 'months' : 'month' }}
                                        </td>
                                        <td>
                                            <p>
                                                <span data-toggle="tooltip"
                                                      title="{{ LeaseStatusText($lease->status) }}">
                                                    <i class="{{ AppStatusIcon($lease->status) }}"></i>
                                                </span>
                                            </p>
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-xs">
                                                <a href="{{ route('tenant.lease', ['id' => $lease->id]) }}"
                                                   role="button"
                                                   class="btn btn-primary" data-toggle="tooltip"
                                                   title="view">
                                                    View
                                                    <i class="fa fa-chevron-right"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.table-responsive -->
                    @else
                        <p class="text-info">Sorry, {{ Auth::user()->firstname }}. No leases found.</p>
                    @endif
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Bills
                    <a href="{{ route('tenant.bills', ['id' => $tenant->id]) }}" class="btn btn-link btn-xs pull-right">
                        <i class="fa fa-chevron-right"></i>
                    </a>
                </div>
                <div class="panel-body">
                    @if(count($bills) > 0)
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Property</th>
                                    <th>Bill</th>
                                    <th>Charge</th>
                                    <th>Date Due.</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($bills as $bill)
                                    <tr>
                                        <td>{{ $bill->id }}</td>
                                        <td>{{ $bill->property->title }}</td>
                                        <td>{{ $bill->bill->title }}</td>
                                        <td>
                                            @if($bill->bill->bill_plan == 0)
                                                {{ $bill->unit_cost }}
                                            @else
                                                {{ BillTotal($bill->previous_usage, $bill->current_usage, $bill->unit_cost) }}
                                            @endif
                                        </td>
                                        <td>{{ $bill->date_due }}</td>
                                        <td>
                                            <span role="button" data-toggle="tooltip"
                                                  title="{{ BillStatusText($bill->status) }}">
                                                <i class="{{ PayStatusIcon($bill->status) }}"></i>
                                            </span>
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-xs">
                                                <a href="{{ route('tenant.bill', ['id' => $bill->id]) }}"
                                                   role="button" class="btn btn-primary" data-toggle="tooltip"
                                                   title="view">
                                                    View
                                                    <i class="fa fa-chevron-right"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-info">Sorry, {{ Auth::user()->firstname }}. No bills found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Rent
                    <a href="{{ route('tenant.rents', ['id' => $tenant->id]) }}" class="btn btn-link btn-xs pull-right">
                        <i class="fa fa-chevron-right"></i>
                    </a>
                </div>
                <div class="panel-body">
                    @if(count($rents) > 0)
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Property</th>
                                    <th>From</th>
                                    <th>To</th>
                                    <th>Due</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($rents as $rent)
                                    <tr>
                                        <td>{{ $rent->id }}</td>
                                        <td>{{ $rent->property->title }}</td>
                                        <td>{{ MonthName($rent->date_from) }}</td>
                                        <td>
                                            {{ MonthName($rent->date_to) }}
                                        </td>
                                        <td>
                                            {{ $rent->date_due }}
                                        </td>
                                        <td>
                                            <span data-toggle="tooltip"
                                                  title="{{ RentStatusText($rent->status) }}">
                                                <i class="{{ PayStatusIcon($rent->status) }}"></i>
                                            </span>
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-xs">
                                                <a href="{{ route('tenant.rent', ['id' => $rent->id]) }}"
                                                   role="button" class="btn btn-primary" data-toggle="tooltip"
                                                   data-title="view">
                                                    View
                                                    <i class="fa fa-chevron-right"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-info">
                            Sorry, {{ Auth::user()->firstname }}. No rent invoices with found.
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection


