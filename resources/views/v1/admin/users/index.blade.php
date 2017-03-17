@extends('layouts.admin')

@section('title')
    Users
@endsection

@section('breadcrumb')
    <li>Users</li>
    <li class="active">{{ $sort != null ? title_case($sort) : 'All' }}</li>
@endsection

@section('page-header')
    Users
@endsection

@section('stats')
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-user-plus fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{ count($new_users) > 0 ? $new_users->total() : 0 }}</div>
                            <div>New Users!</div>
                        </div>
                    </div>
                </div>
                <a href="{{ route('admin.users', ['sort' => 'new']) }}">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-users fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{ count($total_users) > 0 ? $total_users->total() : 0 }}</div>
                            <div>Total Users!</div>
                        </div>
                    </div>
                </div>
                <a href="{{ route('admin.users') }}">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-red">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="icon icon-blocked fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{ count($trashed_users) > 0 ? $trashed_users->total() : 0 }}</div>
                            <div>Trashed Users!</div>
                        </div>
                    </div>
                </div>
                <a href="{{ route('admin.users', ['sort' => 'trashed']) }}">
                    <div class="panel-footer">
                        <span class="pull-left">View Trashed</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection

@section('content')
    @include('includes.alerts.default')

    <section>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>{{ $sort != null ? title_case($sort) : 'All' }} Users</h4>
                    </div>
                    <!-- /.panel-heading -->
                    @if(count($users) > 0)
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>Last login</th>
                                        <th>Joined</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($users as $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td>{{ $user->firstname }}</td>
                                            <td>{{ $user->lastname }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->last_login_at != null ? $user->last_login_at->diffForHumans() : '' }}</td>
                                            <td>{{ $user->created_at->diffForHumans() }}</td>
                                            <td>
                                                <div class="btn-group btn-group-xs">
                                                    @if($sort != "trashed")
                                                        <a role="button"
                                                           href="{{ route('admin.user.edit', ['id' => $user->id]) }}"
                                                           class="btn btn-primary" data-toggle="tooltip" title="View">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        <a role="button"
                                                           href="{{ route('admin.user.delete', ['id' => $user->id]) }}"
                                                           class="btn btn-warning"
                                                           data-toggle="tooltip" title="Block">
                                                            <i class="icon icon-blocked"></i>
                                                        </a>
                                                    @else
                                                        <a role="button"
                                                           href="{{ route('admin.user.restore', ['id' => $user->id]) }}"
                                                           class="btn btn-success"
                                                           data-toggle="tooltip" title="Restore">
                                                            <i class="fa fa-refresh"></i>
                                                        </a>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                        <div class="panel-footer">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="box">
                                        <p>
                                            <strong># of {{ $sort != null ? title_case($sort) : 'All' }} Users:</strong>
                                            {{ $users->total() }}
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <span class="pull-right">
                                        {{ $users->links() }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!-- /.panel-footer -->
                    @else
                        <div class="panel-body">
                            <p class="lead">No users found.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection