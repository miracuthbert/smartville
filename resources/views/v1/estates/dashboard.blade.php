@extends('layouts.estates')

@section('title')
    Dashboard
@endsection

@section('breadcrumb')
    <li class="active">Dashboard</li>
@endsection

@section('page-header')
    Dashboard
@endsection

@section('stats')
    @include('includes.alerts.default')
    <div class="row">
        <div class="col-xs-6 col-sm-3"><!-- panel primary -->
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-sm-4">
                            <i class="fa fa-home fa-5x"></i>
                        </div>
                        <div class="col-sm-8 text-right">
                            <div class="huge">{{ $properties->total() }}</div>
                            <div>Properties</div>
                        </div>
                    </div>
                </div>
                <a href="{{ route('estate.rental.properties', ['id' => $app->id, 'sort' => 'all']) }}" class="">
                    <div class="panel-footer">
                        View all
                        <span class="glyphicon glyphicon-circle-arrow-right pull-right"></span>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-xs-6 col-sm-3"><!-- panel green -->
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-sm-4">
                            <i class="fa fa-users fa-5x"></i>
                        </div>
                        <div class="col-sm-8 text-right">
                            <div class="huge">{{ $tenants->total() }}</div>
                            <div>Tenants(Leases)</div>
                        </div>
                    </div>
                </div>
                <a href="{{ route('estate.rental.tenants', ['id' => $app->id, 'sort' => 'all', 'leases' => 1]) }}"
                   class="">
                    <div class="panel-footer">
                        View all
                        <span class="glyphicon glyphicon-circle-arrow-right pull-right"></span>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-xs-6 col-sm-3"><!-- panel red -->
            <div class="panel panel-red">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-sm-4">
                            <i class="fa fa-money fa-5x"></i>
                        </div>
                        <div class="col-sm-8 text-right">
                            <div class="huge">{{ $pm_bills->total() }}</div>
                            <div class="small">Pending Bills/Month</div>
                        </div>
                    </div>
                </div>
                <a href="{{ route('estate.rental.bills.tenants', ['id' => $app->id, 'sort' => 'pending', 'month' => 1]) }}"
                   class="">
                    <div class="panel-footer">
                        View all
                        <span class="glyphicon glyphicon-circle-arrow-right pull-right"></span>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-xs-6 col-sm-3"><!-- panel yellow -->
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-sm-4">
                            <i class="fa fa-credit-card fa-5x"></i>
                        </div>
                        <div class="col-sm-8 text-right">
                            <div class="huge">{{ $pm_rents->total() }}</div>
                            <div class="small">Pending Rent/Month</div>
                        </div>
                    </div>
                </div>
                <a href="{{ route('estate.rental.rents', ['id' => $app->id, 'sort' => 'pending', 'month' => 1]) }}"
                   class="">
                    <div class="panel-footer">
                        View all
                        <span class="glyphicon glyphicon-circle-arrow-right pull-right"></span>
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>
                        <i class="fa fa-money fa-fw"></i> Pending Bills
                        <span class="badge">{{ $p_bills->total() }}</span>
                    </h3>
                </div>
                <div class="panel-body">
                    <div class="list-group">
                        @forelse($p_bills->splice(0, 5) as $bill)
                            <a href="{{ route('estate.rental.bills.invoice.edit', ['id' => $bill->id]) }}"
                               class="list-group-item">
                                <p class="list-item-text">
                                    {{ $bill->property->title }} - {{ strtoupper($bill->bill->title) }}
                                    <br>
                                    {{ $bill->lease->tenant->user->firstname }}
                                    {{ $bill->lease->tenant->user->lastname }}
                                    <span class="pull-right">
                                        <i class="fa fa-chevron-right"></i>
                                    </span>
                                </p>
                            </a>
                        @empty
                            <div class="list-group-item">
                                No pending bills this month.
                            </div>
                        @endforelse
                    </div>
                    <a href="{{ route('estate.rental.bills.tenants', ['id' => $app->id, 'sort' => 'pending']) }}"
                       class="btn btn-default btn-block">
                        View all Pending Bills
                    </a>
                </div>
            </div>
        </div>
        <!-- /.col-lg-4 -->
        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>
                        <i class="fa fa-credit-card-alt fa-fw"></i> Pending Rent
                        <span class="badge">{{ $p_rents->total() }}</span>
                    </h3>
                </div>
                <div class="panel-body">
                    <div class="list-group">
                        @forelse($p_rents->splice(0, 5) as $rent)
                            <a href="{{ route('estate.rental.rent.edit', ['id' => $bill->id]) }}"
                               class="list-group-item">
                                <p class="list-item-text">
                                    {{ $rent->property->title }}
                                    <br>
                                    {{ $rent->lease->tenant->user->firstname }}
                                    {{ $rent->lease->tenant->user->lastname }}
                                    <span class="pull-right">
                                        <i class="fa fa-chevron-right"></i>
                                    </span>
                                </p>
                            </a>
                        @empty
                            <div class="list-group-item">
                                No pending bills this month.
                            </div>
                        @endforelse
                    </div>
                    <a href="{{ route('estate.rental.rents', ['id' => $app->id, 'sort' => 'pending']) }}"
                       class="btn btn-default btn-block">
                        View All Pending Rents
                    </a>
                </div>
            </div>
        </div>
        <!-- /.col-lg-4 -->
        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>
                        <i class="fa fa-bell fa-fw"></i>
                        Notifications
                        <span class="badge">{{ count($app->unreadNotifications) > 0 ? count($app->unreadNotifications) : '' }}</span>
                    </h3>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="list-group">
                        @forelse(collect($app->notifications)->splice(0, 5) as $notification)
                            <a href="{{ NotificationEstateRoute($notification, $app) }}"
                               class="list-group-item {{ $notification->read_at == null ? 'active' : '' }}">
                                <div>
                                    <i class="fa {{ NotificationIcon($notification->data['type']) }} fa-fw"></i>
                                        <span class="small">
                                            {{ str_limit($notification->data['title'], 20) }}
                                        </span>
                                        <span class="pull-right {{ $notification->read_at != null ? 'text-muted' : '' }} small">
                                            {{ $notification->created_at->diffForHumans() }}
                                        </span>
                                </div>
                            </a>
                        @empty
                            <div class="list-group-item">
                                Notifications will appear here.
                            </div>
                            <li class="divider"></li>
                        @endforelse
                    </div>
                    <!-- /.list-group -->
                    <a href="{{ route('estate.rental.notifications', ['id' => $app->id]) }}"
                       class="btn btn-default btn-block">
                        View All Alerts
                    </a>
                </div>
                <!-- /.panel-body -->
            </div>
        </div>
        <!-- /.col-lg-4 -->
    </div>

    <div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Modal title</h4>
                </div>
                <div class="modal-body">
                    <p>One fine body&hellip;</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="">Save changes</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    @include('includes.modals.delete')

@endsection