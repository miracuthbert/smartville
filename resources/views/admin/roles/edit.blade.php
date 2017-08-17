@extends('layouts.admin')

@section('title')
    Edit Role | Roles
@endsection

@section('breadcrumb')
    <li>Roles</li>
    <li>Role</li>
    <li class="active">Edit</li>
@endsection

@section('page-header')
    <i class="fa fa-universal-access"></i> Edit Role
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title">
                        <p>You can make changes to a role here</p>
                        <p class="text-warning">Do not change the alias to prevent conflicts</p>
                    </div>
                    <ul class="nav nav-pills">
                        <li>
                            <a href="{{ route('roles.show', ['role' => $role->id]) }}">View</a>
                        </li>
                        <li>
                            <a href="{{ route('roles.destroy', ['role' => $role->id]) }}">
                                {{ $role->status == 1 ? 'Disable' : 'Enable' }}
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="post"
                          action="{{ route('roles.update', ['role' => $role->id]) }}">

                        {{ method_field('put') }}
                        {{ csrf_field() }}

                        @include('partials.alerts.default')
                        @include('partials.alerts.validation')

                        <div class="form-group">
                            <label for="role" class="col-md-2 control-label">Role *</label>
                            <div class="col-md-6">
                                <input type="text" name="role" class="form-control" id="role"
                                       placeholder="Enter Role Title"
                                       value="{{ old('role') ? old('role') : $role->role }}"
                                       required autofocus>
                            </div>
                        </div><!-- /.form-group -->

                        <div class="form-group">
                            <label for="alias" class="col-md-2 control-label">Alias *</label>
                            <div class="col-md-6">
                                <input type="text" name="alias" class="form-control" id="alias"
                                       placeholder="Enter Role Alias"
                                       value="{{ old('alias') ? old('alias') : $role->alias }}"
                                       required>
                            </div>
                        </div><!-- /.form-group -->

                        <div class="form-group">
                            <label for="summary" class="col-md-2 control-label">Summary *</label>
                            <div class="col-md-6">
                                <input type="text" name="summary" class="form-control" id="summary"
                                       placeholder="Enter Role Summary"
                                       value="{{ old('summary') ? old('summary') : $role->summary }}"
                                       required>
                            </div>
                        </div><!-- /.form-group -->

                        <div class="form-group">
                            <label for="description" class="col-md-2 control-label">Description</label>
                            <div class="col-md-6">
                                <textarea name="description" class="form-control" id="description" row="8"
                                          placeholder="Enter Role Detailed Description">{{ old('description') ? old('description') : $role->desc }}</textarea>
                            </div>
                        </div><!-- /.form-group -->

                        <div class="form-group">
                            <label for="status" class="col-md-2 control-label">Status *</label>
                            <div class="col-md-6">
                                <select name="status" class="form-control" id="status">
                                    <option value="1" {{ !empty(old('status')) && old('status') == 1 ? 'selected' : $role->status === 1 ? 'selected' : '' }}>
                                        Active
                                    </option>
                                    <option value="0" {{ !empty(old('status')) && old('status') == 0 ? 'selected' : $role->status === 0 ? 'selected' : '' }}>
                                        Disabled
                                    </option>
                                </select>
                            </div>
                        </div><!-- /.form-group -->

                        <div class="form-group">
                            <label class="col-md-2 control-label">Actions</label>
                            <div class="col-md-8">
                                <div class="checkbox">
                                    <label class="control-label">
                                        <input type="checkbox" name="create" id="create"
                                               value="1" {{ $role->create == 1 ? 'checked' : '' }}>
                                        Create
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label class="control-label">
                                        <input type="checkbox" name="read" id="read"
                                               value="1" {{ $role->read == 1 ? 'checked' : '' }}>
                                        Read
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label class="control-label">
                                        <input type="checkbox" name="update" id="update"
                                               value="1" {{ $role->update == 1 ? 'checked' : '' }}>
                                        Update
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label class="control-label">
                                        <input type="checkbox" name="delete" id="delete"
                                               value="1" {{ $role->delete == 1 ? 'checked' : '' }}>
                                        Delete
                                    </label>
                                </div>
                            </div>
                        </div><!-- /.form-group -->

                        <div class="form-group">
                            <label class="col-md-2 control-label">Tables</label>
                            <div class="col-md-8">
                                <div class="checkbox">
                                    <label class="control-label">
                                        <input type="checkbox" name="check-all" id="check-all"
                                               data-target="check-table">
                                        Assign role to all tables
                                    </label>
                                </div>
                                @forelse(collect($tables)->chunk(3) as $_tables)
                                    <div class="row">
                                        @foreach($_tables as $table)
                                            <div class="col-md-3">
                                                <label for="{{ $table }}" class="checkbox-inline">
                                                    <input type="checkbox" name="tables[]" class="check-table"
                                                           id="{{ $table }}"
                                                           value="{{ $table }}" {{ role_table_check($table, $role->tables) }}>
                                                    {{ title_case($table) }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                @empty
                                    <h4>No tables found</h4>
                                @endforelse
                            </div>
                        </div><!-- /.form-group -->

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-2">
                                <button class="btn btn-primary">Update Role</button>
                            </div>
                        </div><!-- /.form-group -->
                    </form>
                </div>
            </div><!-- /.panel -->
        </div><!-- /.col-md-8 -->
    </div><!-- /.row -->
@endsection