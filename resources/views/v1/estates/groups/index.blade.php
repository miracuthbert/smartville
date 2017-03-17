@extends('layouts.estates')

@section('title')
    Property Groups
@endsection

@section('breadcrumb')
    <li>Property Groups</li>
    <li class="active">{{ title_case($sort) }}</li>
@endsection

@section('page-header')
    Property Groups
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12">

            @include('includes.alerts.default')

            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-9">
                            <h4>{{ title_case($sort) }} Groups</h4>
                        </div>
                        <div class="col-md-3">
                            <nav>
                                <ul class="nav">
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                            <strong class="text-right">Sorted by: {{ title_case($sort) }}
                                                <span class="caret"></span>
                                            </strong>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a href="{{ route('estate.groups.index', ['id' => $app->id, 'sort' => 'all']) }}">All</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('estate.groups.index', ['id' => $app->id, 'sort' => 'trashed']) }}">Trashed</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('estate.groups.index', ['id' => $app->id, 'sort' => 'active']) }}">Active</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('estate.groups.index', ['id' => $app->id, 'sort' => 'disabled']) }}">Disabled</a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    @if(count($groups) > 0)
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Group</th>
                                    <th>Location</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($groups as $group)
                                    <tr>
                                        <td>{{ $group->id }}</td>
                                        <td>{{ $group->title }}</td>
                                        <td>{{ $group->location }}</td>
                                        <td>
                                            <a href="{{ route('estate.group.status', ['id' => $group->id]) }}"
                                               class="btn btn-default btn-xs"
                                               data-toggle="tooltip" title="{{ AppStatusToggleText($group->status) }}">
                                                <i class="{{ AppStatusIcon($group->status) }}"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <nav class="btn-group btn-group-xs">
                                                @if($sort != "trashed")
                                                    <a href="{{ route('estate.group.edit', ['id' => $group->id]) }}"
                                                       role="button" class="btn btn-primary"
                                                       data-toggle="tooltip" title="edit group">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <a href="{{ route('estate.group.delete', ['id' => $group->id]) }}"
                                                       role="button" class="btn btn-warning"
                                                       data-toggle="tooltip" title="move to trash">
                                                        <i class="fa fa-remove"></i>
                                                    </a>
                                                @else
                                                    <a href="{{ route('estate.group.restore', ['id' => $group->id]) }}"
                                                       role="button" class="btn btn-success"
                                                       data-toggle="tooltip" title="restore group">
                                                        <i class="fa fa-refresh"></i>
                                                    </a>
                                                    <a href="{{ route('estate.group.destroy', ['id' => $group->id]) }}"
                                                       role="button" class="btn btn-danger"
                                                       data-toggle="tooltip" title="delete completely">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                @endif
                                            </nav>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-info">
                            No {{ $sort }} groups found.
                        </p>
                    @endif
                </div>
                @if(count($groups) > 0)
                    <div class="panel-footer">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="pagination">
                                    <p></p>
                                    <p class="label label-default">
                                        {{ title_case($sort) }} groups : {{ $groups->total() }}
                                    </p>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="pull-right">
                                    {{ $groups->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!--modal snippet -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit record:</h4>
                </div>
                <div class="modal-body">
                    <p>Record details here&hellip;</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="">Save changes</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    </div>

    @include('includes.modals.delete')

    <script>
        CKEDITOR.replace('property_desc');
    </script>
@endsection
