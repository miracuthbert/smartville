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
        <div class="col-lg-12">

            @include('includes.alerts.default')

            <div class="box" id="amenities-wrapper">
                <h3>
                    All
                    <span class="badge">{{ count($app->amenities) }}</span>
                </h3>
                <hr>
                <div class="list-group">
                    @forelse($amenities as $amenity)
                        <div class="list-group-item">
                            <div class="row">
                                <div class="col-sm-8 col-xs-10">
                                    <p>
                                        {{ $loop->first ? $amenities->firstItem() : ($amenities->firstItem() + $loop->index) }}
                                        . {{ $amenity->title }}
                                    </p>
                                </div>
                                <div class="col-sm-2 col-xs-2">
                                    <p class="text-center-xs">
                                        <a href="{{ route('estate.rental.amenity.status', ['id' => $amenity->id]) }}"
                                           class="btn btn-default btn-xs" data-toggle="tooltip"
                                           title="{{ AppStatusToggleText($amenity->status) }}">
                                            <span class="{{ AppStatusIcon($amenity->status) }}"></span>
                                        </a>
                                    </p>
                                </div>
                                <div class="col-sm-2 col-xs-12">
                                    <div class="pull-right">
                                        <div class="btn-group btn-group-xs">
                                            <a href="{{ route('estate.rental.amenity.edit', ['id' => $amenity->id]) }}"
                                               role="button" class="btn btn-primary" data-toggle="tooltip" title="edit">
                                                <span class="fa fa-edit"></span>
                                            </a>
                                            <a href="{{ route('estate.rental.amenity.delete', ['id' => $amenity->id]) }}"
                                               role="button" class="btn btn-warning" data-toggle="tooltip"
                                               title="move to trash">
                                                <span class="fa fa-remove"></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="list-group-item">
                            <h4>
                                No amenities found
                            </h4>
                        </div>
                    @endforelse
                </div>
            </div>

            <h3>
                <i class="fa fa-trash"></i>
                Trashed
                <span class="badge">{{ count($app->amenitiesTrashed) }}</span>
            </h3>
            <div class="box" id="amenities-trashed">
                <div class="list-group">
                    @forelse($app->amenitiesTrashed as $amenity)
                        <div class="list-group-item">
                            <div class="row">
                                <div class="col-sm-8">
                                    {{ $loop->iteration }}. {{ $amenity->title }}
                                </div>
                                <div class="col-sm-2 col-xs-6">
                                    <p class="text-center-xs">
                                        <a href="{{ route('estate.rental.amenity.status', ['id' => $amenity->id]) }}"
                                           class="btn btn-default btn-xs" data-toggle="tooltip"
                                           title="{{ AppStatusToggleText($amenity->status) }}">
                                            <span class="{{ AppStatusIcon($amenity->status) }}"></span>
                                        </a>
                                    </p>
                                </div>
                                <div class="col-sm-2 col-xs-6">
                                    <div class="pull-right">
                                        <div class="btn-group btn-group-xs">
                                            <a href="{{ route('estate.rental.amenity.restore', ['id' => $amenity->id]) }}"
                                               role="button" class="btn btn-success" data-toggle="tooltip"
                                               title="restore amenity">
                                                <span class="fa fa-refresh"></span>
                                            </a>
                                            <a href="{{ route('estate.rental.amenity.destroy', ['id' => $amenity->id]) }}"
                                               role="button" class="btn btn-danger" data-toggle="tooltip"
                                               title="delete completely">
                                                <span class="fa fa-trash"></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="list-group-item">
                            <h4>
                                No amenities found in trash
                            </h4>
                        </div>
                    @endforelse
                </div>
            </div>
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
        CKEDITOR.replace('ckeditor');
    </script>
@endsection
