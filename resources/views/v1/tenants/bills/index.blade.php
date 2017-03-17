@extends('layouts.tenant')

@section('title')
    Bill Invoices
@endsection

@section('breadcrumb')
    <li>Bill</li>
    <li>Invoices</li>
@endsection

@section('page-header')
    Bill Invoices
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Bills</div>
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
                @if(count($bills) > 0)
                    <div class="panel-footer">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="pagination">
                                    <p></p>
                                    <p class="label label-default">
                                        Bill invoices : {{ $bills->total() }}
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
        </div>
    </div>
@endsection


