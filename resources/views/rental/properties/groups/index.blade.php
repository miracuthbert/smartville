@extends('layouts.rental.master')

@section('title', 'Property Groups')

@section('breadcrumb')
    <li>Property Groups</li>
    <li class="active">{{ isset($sort) ? title_case($sort) : 'All' }}</li>
@endsection

@section('page-header')
    Property Groups ({{ isset($sort) ? title_case($sort) : 'All' }})
    <span class="pull-right">
        <div class="btn-group btn-group-sm">
            <a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                <strong class="text-right">Actions
                    <span class="caret"></span>
                </strong>
            </a>
            <ul class="dropdown-menu pull-right">
                <li>
                    <a href="{{ route('rental.properties.groups.index', [$app]) }}">All</a>
                </li>
                <li>
                    <a href="{{ route('rental.properties.groups.index', [$app, 'sort' => 'trashed']) }}">In Trash</a>
                </li>
                <li>
                    <a href="{{ route('rental.properties.groups.index', [$app, 'sort' => 'active']) }}">Active</a>
                </li>
                <li>
                    <a href="{{ route('rental.properties.groups.index', [$app, 'sort' => 'disabled']) }}">Disabled</a>
                </li>
            </ul>
        </div>
    </span>
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12">
            @if($groups->total() > 0)
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Group</th>
                            <th>Location</th>
                            <th>{{ isset($sort) && $sort == "trashed" ? 'Delete Time' : "Status"  }}</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($groups as $group)
                            <tr>
                                <td>
                                    {{ $loop->first ? $groups->firstItem() : ($groups->firstItem() + $loop->index) }}</td>
                                <td>{{ $group->title }}</td>
                                <td>{{ $group->location }}</td>
                                <td>
                                    @if($sort != "trashed")
                                        <a href="#"
                                           class="btn btn-default btn-xs"
                                           data-toggle="tooltip" title="{{ AppStatusToggleText($group->status) }}"
                                           onclick="event.preventDefault(); document.getElementById('property-group-status-{{ $group->id }}-form').submit()">
                                            <i class="{{ AppStatusIcon($group->status) }}"></i>
                                        </a>
                                        <form id="property-group-status-{{ $group->id }}-form"
                                              action="{{ route('rental.properties.groups.status', [$app, $group]) }}"
                                              method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                            {{ method_field('PUT') }}
                                        </form>
                                    @else
                                        {{ $group->deleted_at->diffForHumans() }}
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group btn-group-xs">
                                        @if($sort != "trashed")
                                            <a href="{{ route('rental.properties.groups.edit', [$app, $group]) }}"
                                               role="button" class="btn btn-primary"
                                               data-toggle="tooltip" title="edit group">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="#"
                                               role="button" class="btn btn-warning"
                                               data-toggle="tooltip" title="move to trash"
                                               onclick="event.preventDefault(); document.getElementById('property-group-delete-{{ $group->id }}-form').submit()">
                                                <i class="fa fa-remove"></i>
                                            </a>
                                            <form id="property-group-delete-{{ $group->id }}-form"
                                                  action="{{ route('rental.properties.groups.delete', [$app, $group]) }}"
                                                  method="POST" style="display: none;">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                            </form>
                                        @else
                                            <a href="#"
                                               role="button" class="btn btn-success"
                                               data-toggle="tooltip" title="restore group"
                                               onclick="event.preventDefault(); document.getElementById('property-group-restore-{{ $group->id }}-form').submit()">
                                                <i class="fa fa-refresh"></i>
                                            </a>
                                            <form id="property-group-restore-{{ $group->id }}-form"
                                                  action="{{ route('rental.properties.groups.restore', [$app, $group]) }}"
                                                  method="POST" style="display: none;">
                                                {{ csrf_field() }}
                                                {{ method_field('PUT') }}
                                            </form>
                                            <a href="#"
                                               role="button" class="btn btn-danger"
                                               data-toggle="tooltip" title="delete completely"
                                               onclick="event.preventDefault(); document.getElementById('property-group-destroy-{{ $group->id }}-form').submit()">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                            <form id="property-group-destroy-{{ $group->id }}-form"
                                                  action="{{ route('rental.properties.groups.destroy', [$app, $group]) }}"
                                                  method="POST" style="display: none;">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <hr>
                <p class="label label-default">Groups ({{ isset($sort) ? title_case($sort) : 'All' }}
                    ): {{ $groups->total() }}</p>
                <hr>
                {{ $groups->appends(['sort' => $sort])->links() }}
            @else
                <p class="text-info">No {{ isset($sort) ? $sort. ' ' : ' ' }}groups found.</p>
            @endif
        </div>
    </div>

    @include('partials.modals.delete')

    <script>
        CKEDITOR.replace('ckeditor');
    </script>
@endsection
