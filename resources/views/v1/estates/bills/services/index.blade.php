@extends('layouts.estates')

@section('title')
    Services
@endsection

@section('breadcrumb')
    <li>Bills</li>
    <li class="active">
        Services
    </li>
@endsection

@section('page-header')
    Billing Services
@endsection

@section('content')

    @include('includes.alerts.default')

    <p class="text-muted">You can edit, disable or remove any of the billing services below</p>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                    <strong>{{ title_case($sort) }} Billing Services</strong>
                    <div class="pull-right">
                        <div class="btn-group btn-group-sm">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                <strong class="text-right">Actions
                                    <span class="caret"></span>
                                </strong>
                            </button>
                            <ul class="dropdown-menu pull-right">
                                <li>
                                    <a href="{{ route('estate.rental.bills.services', ['id' => $app->id, 'sort' => 'all']) }}">All</a>
                                </li>
                                <li>
                                    <a href="{{ route('estate.rental.bills.services', ['id' => $app->id, 'sort' => 'trashed']) }}">Trashed</a>
                                </li>
                                <li>
                                    <a href="{{ route('estate.rental.bills.services', ['id' => $app->id, 'sort' => 'active']) }}">Active</a>
                                </li>
                                <li>
                                    <a href="{{ route('estate.rental.bills.services', ['id' => $app->id, 'sort' => 'disabled']) }}">Disabled</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    @if(count($bills) > 0)
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
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($bills as $bill)
                                    <tr>
                                        <td>{{ $bill->id }}</td>
                                        <td>{{ $bill->title }}</td>
                                        <td>{{ BillPlan($bill->bill_plan) }}</td>
                                        <td>{{ $bill->billing_interval }} {{ $bill->interval_type }}</td>
                                        <td>{{ $bill->billing_amount }}</td>
                                        {{--<td>{{ AutoBilling($bill->auto_billing) }}</td>--}}
                                        <td>{{ BillingProperties($bill->properties) }}</td>
                                        <td>
                                            <a href="{{ route('estate.rental.bills.service.status', ['id' => $bill->id]) }}"
                                               role="button"
                                               class="btn btn-default btn-xs" data-toggle="tooltip"
                                               title="{{ AppStatusToggleText($bill->status) }}">
                                                <i class="{{ AppStatusIcon($bill->status) }}"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-xs">
                                                @if($sort != "trashed")
                                                    <a href="{{ route('estate.rental.bills.service.edit', ['id' => $bill->id]) }}"
                                                       role="button" class="btn btn-primary" data-toggle="tooltip"
                                                       title="edit">
                                                        <i class="fa fa-edit"></i>
                                                    </a>

                                                    <a href="{{ route('estate.rental.bills.service.delete', ['id' => $bill->id]) }}"
                                                       role="button" class="btn btn-warning" data-toggle="tooltip"
                                                       title="trash">
                                                        <i class="fa fa-remove"></i>
                                                    </a>
                                                @else
                                                    <a href="{{ route('estate.rental.bills.service.restore', ['id' => $bill->id]) }}"
                                                       role="button" class="btn btn-success" data-toggle="tooltip"
                                                       title="restore">
                                                        <i class="fa fa-refresh"></i>
                                                    </a>

                                                    <a href="{{ route('estate.rental.bills.service.destroy', ['id' => $bill->id]) }}"
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
                        <p class="text-info">No {{ $sort != "all" ? $sort : '' }} billing services found.</p>
                    @endif
                </div>
            </div>

        </div>
    </div>

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit bill invoice</h4>
                </div>
                <div class="modal-body">
                    <form name="create-bill-form" method="post" action="" enctype="application/x-www-form-urlencoded"
                          autocomplete="off">

                        <input type="hidden" name="site-url" value="url" id="site-url"/>

                        <input type="hidden" name="estate-id" value="-1" id="estate-id"/>


                        <div class="form-group">
                            <label for="bill-type">Bill name:</label>
                            <input type="text" name="bill-type" class="form-control"
                                   placeholder="gym, water, cleaning, mainteinance" id="bill-type" maxlength="30"/>
                        </div>

                        <div class="form-group">
                            <label for="bill-desc">Bill details:</label>
                            <textarea type="text" name="bill-desc" class="form-control" placeholder="bill info"
                                      class="desc-box" id="bill-desc" maxlength="140"></textarea>
                        </div>

                        <div class="form-group">
                            <p><label>Does bill depend on a previous value:</label></p>

                            <label for="billIndependent" class="radio-inline">
                                <input type="radio" name="billPlan" id="billIndependent" value="0" checked="checked"/>
                                No
                            </label>

                            <label for="billDependent" class="radio-inline">
                                <input type="radio" name="billPlan" id="billDependent" value="1"/> Yes
                            </label>
                        </div>

                        <div class="form-group">
                            <label for="bill-interval">Bill interval (duration in months):</label>
                            <input type="number" name="bill-interval" class="form-control" value="1" id="bill-interval"
                                   min="1" range="3" max="18"/>
                        </div>

                        <div class="form-group">
                            <label for="bill-amount">Bill amount:</label>
                            <input type="number" name="bill-amount" class="form-control" value="0" id="bill-amount"
                                   min="0" range="10" max="1000000"/>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="">Save changes</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <script>
        CKEDITOR.replace('property_desc');
    </script>
@endsection
