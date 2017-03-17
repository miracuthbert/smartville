@extends('layouts.tenant')

@section('title')
    Leases
@endsection

@section('breadcrumb')
    <li class="active">Leases</li>
@endsection

@section('page-header')
    Leases
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Leases</div>
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
                                                    <i class="fa fa-arrow-right"></i>
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
@endsection


