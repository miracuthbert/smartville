@extends('layouts.admin')

@section('title')
    {{ title_case($sort) }} Apps
@endsection

@section('breadcrumb')
    <li class="active">{{ title_case($sort) }} Apps</li>
@endsection

@section('page-header')
    {{ title_case($sort)  }} Apps
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            @include('includes.alerts.default')

            <div class="panel panel-default">
                <div class="panel-heading">
                    APPS
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    @if($apps->total() > 0)
                        <div class="table-responsive">
                            <table width="100%" class="table table-striped table-hover"
                                   id="dataTable-apps">
                                <thead>
                                <tr>
                                    <th>#.</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Monetization</th>
                                    <th>Mode</th>
                                    <th>Version</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($apps as $app)
                                    <tr class="">
                                        <td>{{ $app->id }}</td>
                                        <td>{{ $app->title }}</td>
                                        <td>{{ $app->category->title }}</td>
                                        <td>{{ $app->monetization->title }}</td>
                                        <td class="center">{{ AppModeText($app->mode) }}</td>
                                        <td class="center">{{ $app->version_name }} {{ $app->version_no }}</td>
                                        <td class="center">
                                            <div class="btn-group btn-group-xs" role="group">
                                                <a role="button"
                                                   href="{{ route('admin.app.status', ['id' => $app->id]) }}"
                                                   class="{{ AppStatusButton($app->status) }}" data-toggle="tooltip"
                                                   title="{{ AppStatusToggleText($app->status) }}">
                                                    <span class="{{ AppStatusIcon($app->status) }}"></span>
                                                </a>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-xs" role="group">
                                                @if($sort != "trashed")
                                                    <a href="{{ route('admin.app.view', ['id' => $app->id]) }}"
                                                       class="btn btn-default" data-toggle="tooltip"
                                                       title="View">
                                                        <span class="fa fa-eye"></span>
                                                    </a>
                                                    <a href="{{ route('admin.app.edit', ['id' => $app->id]) }}"
                                                       class="btn btn-primary" data-toggle="tooltip"
                                                       title="Edit">
                                                        <span class="fa fa-edit"></span>
                                                    </a>
                                                    <a href="{{ route('admin.app.delete', ['id' => $app->id]) }}"
                                                       class="btn btn-warning" data-toggle="tooltip"
                                                       title="Remove">
                                                        <span class="fa fa-remove"></span>
                                                    </a>
                                                @else
                                                    <a href="{{ route('admin.app.restore', ['id' => $app->id]) }}"
                                                       class="btn btn-success" data-toggle="tooltip"
                                                       title="Restore app">
                                                        <span class="fa fa-refresh"></span>
                                                    </a>
                                                    <a href="{{ route('admin.app.destroy', ['id' => $app->id]) }}"
                                                       class="btn btn-danger" data-toggle="tooltip"
                                                       title="Delete completely">
                                                        <span class="fa fa-remove"></span>
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
                    @else
                        <p class="text-warning">No {{ $sort }} apps found.</p>
                    @endif
                </div>
                <!-- /.panel-body -->
                @if($apps->total() > 0)
                    <div class="panel-footer">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="dataTables_info" id="dataTables-example_info" role="status"
                                     aria-live="polite">
                                    Showing #. {{ $apps->firstItem() }} to {{ $apps->lastItem() }}
                                    of {{ $apps->total() }} entries
                                </div>
                            </div>
                            <div class="col-sm-6">
                                @if(collect($apps->links()) != null)
                                    {{ $apps->links() }}
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- /.panel-footer -->
                @endif
            </div>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
@endsection