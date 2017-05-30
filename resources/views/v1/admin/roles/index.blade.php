@extends('layouts.admin')

@section('title')
    Roles
@endsection

@section('breadcrumb')
    <li>Roles</li>
    <li>Role</li>
@endsection

@section('page-header')
    Roles
@endsection

@section('content')
    @include('includes.alerts.default')

    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">
                <h3>
                    <i class="fa fa-universal-access"></i>
                    Roles
                </h3>
            </div>
        </div>
        <div class="panel-body">
            <div class="list-group">
                @forelse($roles as $role)
                    <div class="list-group-item">
                        <div class="list-group-item-heading">
                            <h3>{{ $role->role }}</h3>
                            <h4>{{ $role->alias }}</h4>
                        </div>
                        <div class="list-group-item-text">
                            <ul class="nav nav-pills">
                                <li>
                                    <a href="{{ route('roles.show', ['role' => $role->id]) }}">View</a>
                                </li>
                                <li>
                                    <a href="{{ route('roles.edit', ['role' => $role->id]) }}">Edit</a>
                                </li>
                                <li>
                                    <a href="{{ route('roles.destroy', ['role' => $role->id]) }}">
                                        {{ $role->status == 1 ? 'Disable' : 'Enable' }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div><!-- /.list-group-item -->
                @empty
                    <div class="list-group-item">
                        <div class="list-group-item-heading">
                            <h4>No roles found.</h4>
                        </div>
                        <div class="list-group-item-text">
                            <p>Roles are very important, start by
                                <a href="{{ route('roles.create') }}">creating roles here</a>
                            </p>
                        </div>
                    </div><!-- /.list-group-item -->
                @endforelse
            </div><!-- /.list-group -->
        </div><!-- /.panel-body -->
    </div><!-- /.panel -->
@endsection