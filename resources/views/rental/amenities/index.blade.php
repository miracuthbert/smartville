@extends('layouts.rental.master')

@section('title', 'Amenities')

@section('breadcrumb')
    <li class="active">Amenities</li>
@endsection

@section('page-header')
    <i class="fa fa-th-large"></i> {{ isset($sort) ? title_case($sort) : 'All' }} Amenities <sup
            class="badge">{{ $amenities->total() }}</sup>
    <span class="pull-right">
        <div class="btn-group btn-group-sm">
            @if($sort == 'trashed')
                <a class="btn btn-default" href="{{ route('rental.amenities.index', [$app]) }}">All</a>
            @else
                <a class="btn btn-default" href="{{ route('rental.amenities.index', [$app, 'sort' => 'trashed']) }}">In
                    Trash</a>
            @endif
        </div>
    </span>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div id="amenities-wrapper">
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
                                        @if($sort != 'trashed')
                                            <a href="{{ route('rental.amenities.status', [$app, $amenity]) }}"
                                               class="btn btn-default btn-xs" data-toggle="tooltip"
                                               title="{{ AppStatusToggleText($amenity->status) }}">
                                                <span class="{{ AppStatusIcon($amenity->status) }}"></span>
                                            </a>
                                        @else
                                            {{ $amenity->deleted_at->diffForHumans() }}
                                        @endif
                                    </p>
                                </div>
                                <div class="col-sm-2 col-xs-12">
                                    @if($sort == 'trashed')
                                        <div class="pull-right">
                                            <div class="btn-group btn-group-xs">
                                                <a href="{{ route('rental.amenities.restore', [$app, $amenity]) }}"
                                                   role="button" class="btn btn-success" data-toggle="tooltip"
                                                   title="restore amenity">
                                                    <span class="fa fa-refresh"></span>
                                                </a>
                                                <a href="#"
                                                   role="button" class="btn btn-danger" data-toggle="tooltip"
                                                   title="delete completely"
                                                   onclick="event.preventDefault();document.getElementById('amenity-destroy-{{ $amenity->id }}-form').submit()">
                                                    <span class="fa fa-trash"></span>
                                                </a>
                                                <form id="amenity-destroy-{{ $amenity->id }}-form"
                                                      action="{{ route('rental.amenities.destroy', [$app, $amenity]) }}"
                                                      method="POST" style="display: none;">
                                                    {{ csrf_field() }}
                                                    {{ method_field('delete') }}
                                                </form>
                                            </div>
                                        </div>
                                    @else
                                        <div class="pull-right">
                                            <div class="btn-group btn-group-xs">
                                                <a href="{{ route('rental.amenities.edit', [$app, $amenity]) }}"
                                                   role="button" class="btn btn-primary" data-toggle="tooltip"
                                                   title="edit">
                                                    <span class="fa fa-edit"></span>
                                                </a>
                                                <a href="#"
                                                   role="button" class="btn btn-warning" data-toggle="tooltip"
                                                   title="move to trash"
                                                   onclick="event.preventDefault();document.getElementById('amenity-delete-{{ $amenity->id }}-form').submit()">
                                                    <span class="fa fa-remove"></span>
                                                </a>
                                                <form id="amenity-delete-{{ $amenity->id }}-form"
                                                      action="{{ route('rental.amenities.delete', [$app, $amenity]) }}"
                                                      method="POST" style="display: none;">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                </form>
                                            </div>
                                        </div>
                                    @endif
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
                <hr>
                <p><strong>Total ({{ isset($sort) ? title_case($sort) : 'All' }}):</strong> {{ $amenities->total() }}
                </p>
                {{ $amenities->appends(['sort' => $sort])->links() }}
            </div>
        </div>
    </div>
@endsection
