@extends('layouts.admin')

@section('title')
    {{ $role->role }} | Roles
@endsection

@section('breadcrumb')
    <li>Roles</li>
    <li>Role</li>
    <li class="active">{{ $role->role }}</li>
@endsection

@section('page-header')
    <i class="fa fa-universal-access"></i> {{ $role->role }}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title">
                        <p>Showing full details of {{ $role->role }}</p>
                        <p class="text-warning">Do not change the alias to prevent conflicts</p>
                    </div>
                    <ul class="nav nav-pills">
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
                <div class="panel-body">
                    <h2>Alias:
                        <small>{{ $role->alias }}</small>
                    </h2>

                    <h3>Actions</h3>
                    <dl>
                        <dt>Create</dt>
                        <dd>{{ $role->create == 1 ? 'Allowed' : 'Denied' }}</dd>
                        <dt>Read</dt>
                        <dd>{{ $role->read == 1 ? 'Allowed' : 'Denied' }}</dd>
                        <dt>Update</dt>
                        <dd>{{ $role->update == 1 ? 'Allowed' : 'Denied' }}</dd>
                        <dt>Delete</dt>
                        <dd>{{ $role->delete == 1 ? 'Allowed' : 'Denied' }}</dd>
                    </dl>

                    <h3>Tables</h3>
                    <p>A list tables that user can perform actions on:</p>
                    <div class="row">
                        @forelse(collect($role->tables)->chunk(3) as $_tables)
                            <div class="col-md-4">
                                <ul>
                                    @foreach($_tables as $table)
                                        <li>{{ $table }}</li>
                                    @endforeach
                                </ul>
                            </div><!-- /.col-md-4 -->
                        @empty
                            <h4>No tables assigned yet to this role</h4>
                            <p>Start <a href="{{ route('roles.edit', ['role' => $role->id]) }}">Assigning Table</a> now!
                            </p>
                        @endforelse
                    </div><!-- /.row -->
                </div><!-- /.panel-body -->
            </div><!-- /.panel -->
        </div><!-- /.col-md-8 -->
    </div><!-- /.row -->
@endsection