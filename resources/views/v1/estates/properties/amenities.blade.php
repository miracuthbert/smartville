@extends('layouts.estates')

@section('title')
    Amenities
@endsection

@section('breadcrumb')
    <li class="active">Amenities</li>
@endsection

@section('page-header')
    Amenities
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12 col-sm-8">

            @include('includes.alerts.default')

            <h3>
                All
                <span class="badge">{{ count($app->amenities) }}</span>
            </h3>
            @if(count($app->amenities) > 0)
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Amenity</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($app->amenities as $amenity)
                            <tr>
                                <td>{{ $amenity->id }}</td>
                                <td>{{ $amenity->title }}</td>
                                <td>
                                    <a href="{{ route('estate.amenity.status', ['id' => $amenity->id]) }}"
                                       class="btn btn-default btn-xs" data-toggle="tooltip"
                                       title="{{ AppStatusToggleText($amenity->status) }}">
                                        <span class="{{ AppStatusIcon($amenity->status) }}"></span>
                                    </a>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-xs">
                                        <a href="{{ route('estate.amenity.edit', ['id' => $amenity->id]) }}"
                                           role="button" class="btn btn-primary" data-toggle="tooltip" title="edit">
                                            <span class="fa fa-edit"></span>
                                        </a>
                                        <a href="{{ route('estate.amenity.delete', ['id' => $amenity->id]) }}"
                                           role="button" class="btn btn-warning" data-toggle="tooltip"
                                           title="move to trash">
                                            <span class="fa fa-remove"></span>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-success">
                    No amenities found.
                </div>
            @endif

            <h3>
                <i class="fa fa-trash"></i>
                Trashed
                <span class="badge">{{ count($app->amenitiesTrashed) }}</span>
            </h3>
            @if(count($app->amenitiesTrashed) > 0)
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Amenity</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($app->amenitiesTrashed as $amenity)
                            <tr>
                                <td>{{ $amenity->id }}</td>
                                <td>{{ $amenity->title }}</td>
                                <td>
                                    <a href="{{ route('estate.amenity.status', ['id' => $amenity->id]) }}"
                                       class="btn btn-default btn-xs" data-toggle="tooltip"
                                       title="{{ AppStatusToggleText($amenity->status) }}">
                                        <span class="{{ AppStatusIcon($amenity->status) }}"></span>
                                    </a>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-xs">
                                        <a href="{{ route('estate.amenity.restore', ['id' => $amenity->id]) }}"
                                           role="button" class="btn btn-success" data-toggle="tooltip"
                                           title="restore amenity">
                                            <span class="fa fa-refresh"></span>
                                        </a>
                                        <a href="{{ route('estate.amenity.destroy', ['id' => $amenity->id]) }}"
                                           role="button" class="btn btn-danger" data-toggle="tooltip"
                                           title="delete completely">
                                            <span class="fa fa-trash"></span>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-success">
                    No amenities in trash.
                </div>
            @endif
        </div>

        <div class="col-xs-12 col-sm-4">

            <h1>Add amenity:</h1>

            <form name="add-amenity-form" method="post" action="{{ route('estate.amenity.store') }}"
                  enctype="application/x-www-form-urlencoded"
                  autocomplete="off">

                @include('includes.alerts.validation')

                <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">

                <input type="hidden" name="_app" id="_app" value="{{ $app->id }}">

                <div class="form-group{{ $errors->has('title') ? 'has-error' : '' }}">
                    <label for="title">Amenity title:</label>
                    <input type="text" name="title" class="form-control" placeholder="amenity title"
                           id="title" maxlength="50" value="{{ Request::old('title') }}" required autofocus/>
                </div>

                <div class="form-group{{ $errors->has('description') ? 'has-error' : '' }}">
                    <label for="description">Amenity description:</label>
                    <textarea name="description" class="form-control" rows="3" cols="5" id="desc"
                              placeholder="description">{{ Request::old('description') }}</textarea>
                </div>

                <div class="form-group">
                    <p><label>Amenity status:</label></p>
                    <label class="radio-inline">
                        <input type="radio" name="status" id="disable" value="0"> Disabled
                    </label>

                    <label class="radio-inline">
                        <input type="radio" name="status" id="active" value="1" checked> Active
                    </label>
                </div>

                <div class="form-group">
                    <button type="submit" name="btnAddAmenity" role="button" class="btn btn-success btn-sm">Save
                    </button>
                </div>
            </form>

        </div>
    </div>

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit amenity:</h4>
                </div>
                <div class="modal-body">
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
