@extends('v1.layouts.tenant')

@section('title')
    Bill Invoices
@endsection

@section('breadcrumb')
    <li>Bill</li>
    <li>Invoices</li>
@endsection

@section('page-header')
    <h2><i class="fa fa-credit-card fa-fw"></i> Bill Invoices</h2>
    <hr>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <section id="invoices-wrapper">
                @forelse($bills as $bill)
                    <blockquote class="invoice-wrap {{ BillStatusClass($bill->status) }}">
                        <div class="row">
                            <div class="col-sm-6">
                                <p>
                                    {{ $bill->property->title }}
                                    <span class="text-muted small">
                                            {{ $bill->bill->title }} invoice
                                        </span>
                                </p>
                            </div>
                            <div class="col-sm-3 col-xs-6">
                                <p>
                                        <span class="text-muted">
                                            {{ MonthName($bill->date_from) }} - {{ MonthName($bill->date_to) }}
                                        </span>
                                </p>
                            </div>
                            <div class="col-sm-3 col-xs-6 text-right text-center-xs">
                                <p>{{ $currency }}.
                                        <span class="text-muted">
                                            @if($bill->bill->bill_plan == 0)
                                                {{ $bill->unit_cost }}
                                            @else
                                                {{ BillTotal($bill->previous_usage, $bill->current_usage, $bill->unit_cost) }}
                                            @endif
                                        </span>
                                </p>
                            </div>
                        </div>
                        <!-- /.row -->
                        <div class="row">
                            <div class="col-sm-6">
                                <p>Payment due
                                    <span class="text-muted small">{{ $bill->date_due }}</span>
                                </p>
                            </div>
                            <div class="col-sm-3 col-xs-6">
                                <p>
                                        <span class="{{ PayStatusLabel($bill->status) }}">
                                            {{ BillStatusText($bill->status) }}
                                        </span>
                                </p>
                            </div>
                            <div class="col-sm-3 col-xs-6">
                                <div class="pull-right">
                                    <div class="btn-group btn-group-sm btn-group">
                                        <a href="{{ route('tenant.bill', ['id' => $bill->id]) }}"
                                           role="button" class="btn btn-primary" data-toggle="tooltip"
                                           title="view">
                                            View details
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.row -->
                    </blockquote>
                @empty
                    <p class="text-info">
                        Hey, {{ Auth::user()->firstname }}, looks like you have no pending bills.
                    </p>
                @endforelse
            </section>
            <!-- /#invoices-wrapper -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    @if(count($bills) > 0)
        <hr>
        <div class="row">
            <div class="col-sm-6 col-xs-5">
                <p class="lead label label-default">
                    Bill invoices : {{ $bills->total() }}
                </p>
            </div>
            <div class="col-sm-6 col-xs-7 text-right text-center-xs">
                <p class="label label-info">
                    Showing <strong>{{ $bills->firstItem() }}</strong> to <strong>{{ $bills->lastItem() }}</strong>
                    of <strong>{{ $bills->total() }}</strong>
                </p>
            </div>
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="pull-right">
                    {{ $bills->links() }}
                </div>
            </div>
        </div>
        <!-- /.row -->
    @endif
@endsection


