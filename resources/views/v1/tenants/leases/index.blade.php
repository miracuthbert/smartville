@extends('v1.layouts.tenant')

@section('title')
    Leases
@endsection

@section('breadcrumb')
    <li class="active">Leases</li>
@endsection

@section('page-header')
    <h2><i class="fa fa-pencil-square"></i> Leases</h2>
    <hr>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
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

    @if(count($leases) > 0)
        <hr>
        <div class="row">
            <div class="col-sm-6 col-xs-5">
                <p class="lead label label-default">
                    Leases: {{ $leases->total() }}
                </p>
            </div>
            <div class="col-sm-6 col-xs-7 text-right text-center-xs">
                <p class="label label-info">
                    Showing <strong>{{ $leases->firstItem() }}</strong> to <strong>{{ $leases->lastItem() }}</strong>
                    of <strong>{{ $leases->total() }}</strong>
                </p>
            </div>
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="pull-right">
                    {{ $leases->links() }}
                </div>
            </div>
        </div>
        <!-- /.row -->
    @endif
@endsection


