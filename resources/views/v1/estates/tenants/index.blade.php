@extends('layouts.estates')

@section('title')
    {{ title_case($sort) }} Tenants
@endsection

@section('breadcrumb')
    <li>Tenants</li>
    <li class="active">{{ title_case($sort) }}</li>
@endsection

@section('page-header')
    {{ title_case($sort) }} Tenants {{ $leases == 1 ? 'Leases' : '' }}
@endsection

@section('content')

    @include('includes.alerts.default')

    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="clearfix">
                <strong>{{ title_case($sort) }} Tenants {{ $leases == 1 ? 'Leases' : '' }}</strong>
                <div class="pull-right">
                    <div class="btn-group btn-group-sm">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"
                                aria-expanded="false">
                            <strong class="text-right">Actions
                                <span class="caret"></span>
                            </strong>
                        </button>
                        <ul class="dropdown-menu pull-right">
                            <li class="dropdown-header">Sort by Leases</li>
                            <li>
                                <a href="{{ route('estate.tenants', ['id' => $app->id, 'sort' => 'all', 'leases' => 1]) }}">
                                    All
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('estate.tenants', ['id' => $app->id, 'sort' => 'trashed', 'leases' => 1]) }}">
                                    Trashed
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('estate.tenants', ['id' => $app->id, 'sort' => 'active', 'leases' => 1]) }}">
                                    Active
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('estate.tenants', ['id' => $app->id, 'sort' => 'vacated', 'leases' => 1]) }}">
                                    Vacated
                                </a>
                            </li>
                            <li role="separator" class="divider"></li>
                            <li class="dropdown-header">Sort by Tenants</li>
                            <li>
                                <a href="{{ route('estate.tenants', ['id' => $app->id, 'sort' => 'all']) }}">All</a>
                            </li>
                            <li>
                                <a href="{{ route('estate.tenants', ['id' => $app->id, 'sort' => 'trashed']) }}">Trashed</a>
                            </li>
                            <li>
                                <a href="{{ route('estate.tenants', ['id' => $app->id, 'sort' => 'active']) }}">Active</a>
                            </li>
                            <li>
                                <a href="{{ route('estate.tenants', ['id' => $app->id, 'sort' => 'disabled']) }}">Vacated</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            @if(!$leases)
                <p class="text-muted">Click on a tenant below to view the leases</p>
            @endif
        </div>
        <div class="panel-body">
            @if($leases)
                @include('v1.estates.tenants.leases')
            @else
                @if(count($tenants) > 0)
                    <div class="panel-group" id="accordion">
                        @if($sort != "trashed")
                            @include('v1.estates.tenants.default')
                        @else
                            @include('v1.estates.tenants.trashed')
                        @endif
                    </div>
                @else
                    <p class="text-info">
                        No {{ $sort }} tenants found.
                    </p>
                @endif
            @endif
        </div>
        @if(count($tenants) > 0)
            <div class="panel-footer">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="pagination">
                            <p></p>
                            <p class="label label-default">
                                {{ title_case($sort) }} tenants : {{ $tenants->total() }}
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="pull-right">
                            {{ $tenants->links() }}
                        </div>
                    </div>
                </div>
            </div>
        @endif
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

    <script>
        CKEDITOR.replace('property_desc');
    </script>
@endsection
