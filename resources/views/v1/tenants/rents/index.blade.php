@extends('v1.layouts.tenant')

@section('title')
    Rent Invoices
@endsection

@section('breadcrumb')
    <li>Rent</li>
    <li>Invoices</li>
@endsection

@section('page-header')
    <h2><i class="fa fa-credit-card-alt fa-fw"></i> Rent Invoices</h2>
    <hr>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
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
        </div>
    </div>

    @if(count($rents) > 0)
        <hr>
        <div class="row">
            <div class="col-sm-6 col-xs-5">
                <p class="lead label label-default">
                    Rent invoices : {{ $rents->total() }}
                </p>
            </div>
            <div class="col-sm-6 col-xs-7 text-right text-center-xs">
                <p class="label label-info">
                    Showing <strong>{{ $rents->firstItem() }}</strong> to <strong>{{ $rents->lastItem() }}</strong>
                    of <strong>{{ $rents->total() }}</strong>
                </p>
            </div>
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="pull-right">
                    {{ $rents->links() }}
                </div>
            </div>
        </div>
        <!-- /.row -->
    @endif
@endsection
