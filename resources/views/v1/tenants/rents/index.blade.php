@extends('layouts.tenant')

@section('title')
    Rent Invoices
@endsection

@section('breadcrumb')
    <li>Rent</li>
    <li>Invoices</li>
@endsection

@section('page-header')
    Rent Invoices
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Rent</div>
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
                            Sorry, {{ Auth::user()->firstname }}. No rent invoices found.
                        </p>
                    @endif
                </div>
                @if(count($rents) > 0)
                    <div class="panel-footer">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="pagination">
                                    <p></p>
                                    <p class="label label-default">
                                        Rent invoices : {{ $rents->total() }}
                                    </p>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="pull-right">
                                    {{ $rents->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection


