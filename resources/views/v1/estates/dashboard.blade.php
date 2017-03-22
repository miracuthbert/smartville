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

    <h4 class="">Stats</h4>
    <div class="row">
        <div class="col-xs-6 col-sm-3"><!-- panel red -->
            <div class="panel panel-red">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-money fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{ $p_bills != null ? count($p_bills) : 0 }}</div>
                            <div>Pending Bills</div>
                        </div>
                    </div>
                </div>
                <a href="{{ route('estate.rental.bills.tenants', ['id' => $app->id, 'sort' => 'pending']) }}" class="">
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
                        <div class="col-sm-3">
                            <i class="fa fa-credit-card fa-5x"></i>
                        </div>
                        <div class="col-sm-9 text-right">
                            <div class="huge">{{ $p_rents != null ? count($p_rents) : 0 }}</div>
                            <div>Pending Rent</div>
                        </div>
                    </div>
                </div>
                <a href="{{ route('estate.rental.rents', ['id' => $app->id, 'sort' => 'pending']) }}" class="">
                    <div class="panel-footer">
                        View all
                        <span class="glyphicon glyphicon-circle-arrow-right pull-right"></span>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-xs-6 col-sm-3 hidden"><!-- panel primary -->
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-9">
                            <h4>Label</h4>
                            <p class="">Something else</p>
                        </div>
                    </div>
                </div>
                <a href="#" class="">
                    <div class="panel-footer">
                        View all
                        <span class="glyphicon glyphicon-circle-arrow-right pull-right"></span>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-xs-6 col-sm-3 hidden"><!-- panel success -->
            <div class="panel panel-success">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-9">
                            <h4>Label</h4>
                            <p class="">Something else</p>
                        </div>
                    </div>
                </div>
                <a href="#" class="">
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

    <div class="panel panel-default hidden">
        <div class="panel-heading">
            <h2 class="sub-header">Section</h2>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Header</th>
                        <th>Header</th>
                        <th>Header</th>
                        <th>Header</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>1,008</td>
                        <td>Fusce</td>
                        <td>nec</td>
                        <td>tellus</td>
                        <td>sed</td>
                        <td>
                            <a href="#" role="button" class="btn btn-primary btn-xs"
                               data-toggle="modal" data-target="#modal-edit">
                                <span class="glyphicon glyphicon-edit"></span>
                            </a>
                            <a href="#" role="button" class="btn btn-danger btn-xs" data-toggle="modal"
                               data-target="#modal-delete">
                                <span class="glyphicon glyphicon-trash"></span>
                            </a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
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