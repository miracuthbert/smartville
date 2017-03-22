@extends('v1.layouts.tenant')

@section('title')
    Dashboard
@endsection

@section('breadcrumb')
    <li class="active">Dashboard</li>
@endsection

@section('page-header')
    <h2><i class="fa fa-dashboard fa-fw"></i> Dashboard</h2>
    <hr>
@endsection

@section('content')
    <section id="lease-section">
        <div class="row">
            <div class="col-lg-12">
                <h4>
                    Leases
                    <a href="{{ route('tenant.leases', ['id' => $tenant->id]) }}"
                       class="btn btn-link btn-xs pull-right">
                        <i class="fa fa-chevron-right"></i>
                    </a>
                </h4>
                <div id="lease-wrapper">
                    @forelse($leases as $lease)
                        <div class="lease-wrap">
                            <div class="row">
                                <div class="col-sm-6">
                                    <p class="lead">
                                        {{ $lease->property->title }}
                                    </p>
                                </div>
                                <div class="col-sm-3 col-xs-6">
                                    <p class="lead">
                                        <abbr title="Moved in on" class="hidden-xs">In</abbr>
                                        <span class="visible-xs">Moved in on</span>
                                        <span class="text-muted small">{{ $lease->move_in }}</span>
                                    </p>
                                </div>
                                <div class="col-sm-3 col-xs-6">
                                    <p class="lead">
                                        <abbr title="Moved out on" class="hidden-xs">Out</abbr>
                                        <span class="visible-xs">Moved out on</span>
                                        <span class="text-muted small">
                                            {{ $lease->move_out != null ? $lease->move_out : '-' }}
                                        </span>
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <p class="lead">Lease duration
                                        <span class="text-muted small text-right-xs">
                                        {{ $lease->lease_duration }}
                                        {{ count($lease->lease_duration) > 1 ? 'months' : 'month' }}
                                    </span>
                                    </p>
                                </div>
                                <div class="col-sm-3 col-xs-6">
                                    <p>
                                        <span class="{{ PropertyStatusLabel($lease->status) }}">
                                         {{ LeaseStatusText($lease->status) }}
                                     </span>
                                    </p>
                                </div>
                                <div class="col-sm-3 col-xs-6">
                                    <div class="pull-right">
                                        <div class="btn-group btn-group-sm btn-group">
                                            <a href="{{ route('tenant.lease', ['id' => $lease->id]) }}"
                                               role="button"
                                               class="btn btn-primary" data-toggle="tooltip"
                                               title="view">
                                                View details
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-info">Sorry, {{ Auth::user()->firstname }}. No leases found.</p>
                    @endforelse
                </div>
                <!-- /#lease-wrapper -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /#lease-wrapper -->

    <section id="bill-section">
        <div class="row">
            <div class="col-lg-12">
                <h4>
                    Bill Invoices
                    <a href="{{ route('tenant.bills', ['id' => $tenant->id]) }}" class="btn btn-link btn-xs pull-right">
                        <i class="fa fa-chevron-right"></i>
                    </a>
                </h4>
                <hr>
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
    </section>
    <!-- /#bill-section -->

    <section id="rent-section">
        <div class="row">
            <div class="col-lg-12">
                <h4>Rent invoices
                    <a href="{{ route('tenant.rents', ['id' => $tenant->id]) }}" class="btn btn-link btn-xs pull-right">
                        <i class="fa fa-chevron-right"></i>
                    </a>
                </h4>
                <hr>
                <section id="invoices-wrapper">
                    @forelse($rents as $rent)
                        <blockquote class="invoice-wrap {{ RentStatusClass($rent->status) }}">
                            <div class="row">
                                <div class="col-sm-6">
                                    <p>
                                        {{ $rent->property->title }}
                                    </p>
                                </div>
                                <div class="col-sm-3 col-xs-6 text-center-xs">
                                    <p>
                                        <span class="text-muted">
                                            {{ MonthName($rent->date_from) }} - {{ MonthName($rent->date_to) }}
                                        </span>
                                    </p>
                                </div>
                                <div class="col-sm-3 col-xs-6 text-right text-center-xs">
                                    <p>{{ $currency }}.
                                            <span class="text-muted">
                                            {{ $rent->amount }}
                                        </span>
                                    </p>
                                </div>
                            </div>
                            <!-- /.row -->
                            <div class="row">
                                <div class="col-sm-6">
                                    <p>Payment due on
                                        <span class="text-muted small">
                                            {{ $rent->date_due }}
                                        </span>
                                    </p>
                                </div>
                                <div class="col-sm-3 col-xs-6">
                                    <p>
                                        <span class="{{ PayStatusLabel($rent->status) }}">
                                                {{ RentStatusText($rent->status) }}
                                        </span>
                                    </p>
                                </div>
                                <div class="col-sm-3 col-xs-6">
                                    <div class="pull-right">
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ route('tenant.rent', ['id' => $rent->id]) }}"
                                               role="button" class="btn btn-primary" data-toggle="tooltip"
                                               data-title="view">
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
                            Hey, {{ Auth::user()->firstname }}, looks like you have no pending rent.
                        </p>
                    @endforelse
                </section>
                <!-- /#invoices-wrapper -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /#rent-section -->
@endsection


