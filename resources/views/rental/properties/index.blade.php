@extends('layouts.rental.master')

@section('title')
    Properties
@endsection

@section('breadcrumb')
    <li class="active">Properties</li>
@endsection

@section('page-header')
    Properties
@endsection

@section('content')

    @include('partials.alerts.default')

    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <strong>{{ title_case($sort) }} Properties</strong>
            <div class="pull-right">
                <div class="btn-group btn-group-sm">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"
                            aria-expanded="false">
                        <strong class="text-right">
                            Actions
                            <span class="caret"></span>
                        </strong>
                    </button>
                    <ul class="dropdown-menu pull-right">
                        <li class="dropdown-header">Switch layout to</li>
                        <li>
                            <a href="{{ route('estate.rental.properties', ['id' => $app->id, 'sort' => 'all', 'layout' => 'grid']) }}">
                                <i class="glyphicon glyphicon-th-large"></i>
                                Grid View
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('estate.rental.properties', ['id' => $app->id, 'sort' => 'all']) }}">
                                <i class="fa fa-list"></i>
                                List View
                            </a>
                        </li>
                        <li role="separator" class="divider"></li>
                        <li class="dropdown-header">Sort by</li>
                        @if($layout != null)
                            @include('estates.properties.layouts.menu_grid')
                        @else
                            @include('estates.properties.layouts.menu_default')
                        @endif
                    </ul>
                </div>
            </div>
        </div>
        <div class="panel-body">
            @if(count($properties) > 0)
                @if($layout == null)
                    @include('estates.properties.layouts.default')
                @else
                    @include('estates.properties.layouts.grid')
                @endif
            @else
                <p class="text-info">
                    No {{ $sort }} properties found.
                </p>
            @endif
        </div>
        @if(count($properties) > 0)
            <div class="panel-footer">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="pagination">
                            <p></p>
                            <p class="label label-default">
                                {{ title_case($sort) }} properties : {{ $properties->total() }}
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="pull-right">
                            {{ $properties->links() }}
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
    </div>

    @include('partials.modals.delete')

    <script>
        CKEDITOR.replace('property_desc');
    </script>
@endsection
