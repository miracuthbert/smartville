@extends('layouts.admin')

@section('title')
    Create New Role | Roles
@endsection

@section('breadcrumb')
    <li>Roles</li>
    <li>Role</li>
    <li class="active">Create</li>
@endsection

@section('page-header')
    Create New Role
@endsection

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">
                <p>Create a new role by filling form below</p>
            </div>
        </div>
        <div class="panel-body">
            <form class="form-horizontal" role="form" method="post" action="{{ route('roles.store') }}">

                {{ csrf_field() }}

                @include('includes.alerts.default')
                @include('includes.alerts.validation')

                <div class="form-group">
                    <label for="role" class="col-md-2 control-label">Role *</label>
                    <div class="col-md-6">
                        <input type="text" name="role" class="form-control" id="role"
                               placeholder="Enter Role Title" value="{{ old('role') }}" required autofocus>
                    </div>
                </div><!-- /.form-group -->

                <div class="form-group">
                    <label for="alias" class="col-md-2 control-label">Alias *</label>
                    <div class="col-md-6">
                        <input type="text" name="alias" class="form-control" id="alias"
                               placeholder="Enter Role Alias" value="{{ old('alias') }}" required>
                    </div>
                </div><!-- /.form-group -->

                <div class="form-group">
                    <label for="summary" class="col-md-2 control-label">Summary *</label>
                    <div class="col-md-6">
                        <input type="text" name="summary" class="form-control" id="summary"
                               placeholder="Enter Role Summary" value="{{ old('summary') }}" required>
                    </div>
                </div><!-- /.form-group -->

                <div class="form-group">
                    <label for="description" class="col-md-2 control-label">Description</label>
                    <div class="col-md-6">
                        <textarea name="description" class="form-control" id="description" row="8"
                                  placeholder="Enter Role Detailed Description">{{ old('description') }}</textarea>
                    </div>
                </div><!-- /.form-group -->

                <div class="form-group">
                    <label for="status" class="col-md-2 control-label">Status *</label>
                    <div class="col-md-6">
                        <select name="status" class="form-control" id="status">
                            <option value="1" {{ !empty(old('status')) && old('status') == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ !empty(old('status')) && old('status') == 0 ? 'selected' : '' }}>Disabled</option>
                        </select>
                    </div>
                </div><!-- /.form-group -->

                <div class="form-group">
                    <label class="col-md-2 control-label">Actions</label>
                    <div class="col-md-8">
                        <div class="checkbox">
                            <label class="control-label">
                                <input type="checkbox" name="create" id="create"
                                       value="1" {{ old('create') == 1 ? 'checked' : '' }}>
                                Create
                            </label>
                        </div>
                        <div class="checkbox">
                            <label class="control-label">
                                <input type="checkbox" name="read" id="read"
                                       value="1" {{ old('read') == 1 ? 'checked' : '' }}>
                                Read
                            </label>
                        </div>
                        <div class="checkbox">
                            <label class="control-label">
                                <input type="checkbox" name="update" id="update"
                                       value="1" {{ old('update') == 1 ? 'checked' : '' }}>
                                Update
                            </label>
                        </div>
                        <div class="checkbox">
                            <label class="control-label">
                                <input type="checkbox" name="delete" id="delete"
                                       value="1" {{ old('delete') == 1 ? 'checked' : '' }}>
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
                                <input type="checkbox" name="check-all" id="check-all" data-target="check-table">
                                Assign role to all tables
                            </label>
                        </div>
                        @forelse(collect($tables)->chunk(3) as $_tables)
                            <div class="row">
                                @foreach($_tables as $table)
                                    <div class="col-md-3">
                                        <label for="{{ $table }}" class="checkbox-inline">
                                            <input type="checkbox" name="tables[]" class="check-table" id="{{ $table }}"
                                                   value="{{ $table }}">
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
                    <div class="col-md-6 col-md-offset-4">
                        <button class="btn btn-success">Create Role</button>

                    </div>
                </div><!-- /.form-group -->
            </form>
        </div>
    </div><!-- /.panel -->
@endsection