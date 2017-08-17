@extends('layouts.admin')

@section('title')
    Documentation - Manuals
@endsection


@section('breadcrumb')
    <li>Documentation</li>
    <li>Manual</li>
    <li>{{ $manual->title }}</li>
    <li class="active">Table Of Contents</li>
@endsection

@section('page-header')
    <small>
        {{ $manual->title }} Manual - Table Of Contents
    </small>

    <div class="pull-right">
        @include('admin.documentation.manual.chapter_options')
                <!-- chapter options -->
        <a href="{{ route('manual.edit', ['manual' => $manual->id]) }}" class="btn btn-primary btn-sm">
            Edit <i class="fa fa-edit"></i>
        </a>
        <a href="{{ route('manual.show', ['manual' => $manual->id]) }}" class="btn btn-default btn-sm">
            Preview <i class="fa fa-eye"></i>
        </a>
        <!-- manual options -->
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            @include('partials.alerts.default')

            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="clearfix">
                        <strong>{{ title_case($status != null ? $status : 'All') }} Chapters</strong>
                        <div class="pull-right">
                            <div class="btn-group btn-group-sm">
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"
                                        aria-expanded="false">
                                    Actions <i class="caret"></i>
                                </button>
                                <ul class="dropdown-menu pull-right">
                                    <li class="dropdown-header">Sort by</li>
                                    <li>
                                        <a href="{{ route('manchapter.index', ['manual' => $manual->id, 'status' => 'active']) }}">Active</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('manchapter.index', ['manual' => $manual->id, 'status' => 'disabled']) }}">Disabled</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('manchapter.index', ['manual' => $manual->id, 'status' => 'trashed']) }}">Trashed</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('manchapter.index', ['manual' => $manual->id]) }}">All</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="list-group manuals">
                        @forelse($chapters as $chapter)
                            <div class="list-group-item list-group-item-{{ $chapter->status == 1 ? 'success' : '' }}">
                                <header class="clearfix">
                                    <strong class="list-group-item-heading">
                                        {{ $loop->iteration }} . {{ $chapter->title }}
                                    </strong>
                                    <!-- heading -->
                                    <div class="pull-right">
                                        <div class="btn-group btn-group-sm">
                                            <button type="button" class="btn btn-default dropdown-toggle"
                                                    data-toggle="dropdown" aria-expanded="false">
                                                Chapter
                                                <i class="caret"></i>
                                            </button>
                                            <ul class="dropdown-menu pull-right">
                                                @if($status != "trashed")
                                                    <li>
                                                        <a href="{{ route('manchapter.show', ['manchapter' => $chapter->id]) }}">
                                                            Preview
                                                            <i class="fa fa-eye pull-right"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('manchapter.edit', ['manchapter' => $chapter->id]) }}">
                                                            Edit
                                                            <i class="fa fa-edit pull-right"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('manchapter.delete', ['manchapter' => $chapter->id]) }}">
                                                            Remove
                                                            <i class="fa fa-times-circle-o pull-right"></i>
                                                        </a>
                                                    </li>
                                                @else
                                                    <li>
                                                        <a href="{{ route('manchapter.restore', ['manchapter' => $chapter->id]) }}">
                                                            Restore
                                                            <i class="fa fa-refresh pull-right"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('manchapter.destroy', ['manchapter' => $chapter->id]) }}">
                                                            Delete
                                                            <i class="fa fa-trash pull-right"></i>
                                                        </a>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                        <!-- chapter options -->
                                        <div class="btn-group btn-group-sm">
                                            <button type="button" class="btn btn-default dropdown-toggle"
                                                    data-toggle="dropdown" aria-expanded="false">
                                                Pages
                                                <i class="caret"></i>
                                            </button>
                                            <ul class="dropdown-menu pull-right">
                                                <li>
                                                    <a href="{{ route('manpage.create', ['manchapter' => $chapter->id]) }}">
                                                        Add New
                                                    </a>
                                                </li>
                                                <li role="separator" class="divider"></li>
                                                <li class="dropdown-header">Pages</li>
                                                @forelse($chapter->pages as $page)
                                                    <li>
                                                        <a href="{{ route('manpage.edit', ['manpage' => $page->id]) }}">
                                                            {{ $page->title }}
                                                        </a>
                                                    </li>
                                                @empty
                                                    <li class="text-center">No pages found</li>
                                                @endforelse
                                                <li role="separator" class="divider"></li>
                                                <li>
                                                    <a href="{{ route('manpage.index', ['manchapter' => $manual->id]) }}">
                                                        View All
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <!-- manual pages options -->
                                    </div>
                                </header>
                                <!-- /header -->
                                <p class="clearfix">
                                    <strong>Created:</strong> {{ $chapter->created_at->diffForHumans() }}
                                    <a href="{{ route('manchapter.status', ['manchapter' => $chapter->id]) }}"
                                       class="btn btn-default btn-sm pull-right" data-toggle="tooltip"
                                       title="{{ AppStatusToggleText($chapter->status) }}">
                                        <i class="{{ AppStatusIcon($chapter->status) }}"></i>
                                    </a>
                                </p>
                            </div>
                            <!-- /chapter.list-group-item -->
                        @empty
                            <p class="lead">No {{ $status }} chapters found.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection