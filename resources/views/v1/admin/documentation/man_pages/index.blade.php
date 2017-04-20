@extends('layouts.admin')

@section('title')
    Docs | Manuals | {{ $manual->title }}
@endsection


@section('breadcrumb')
    <li>Docs</li>
    <li>
        <a href="{{ route('manual.show', ['manual' => $manual->id]) }}">
            {{ $manual->title }}
        </a>
    </li>
    <li>
        <a href="{{ route('manchapter.show', ['manchapter' => $chapter->id]) }}">
            {{ $chapter->title }}
        </a>
    </li>
    <li>Pages</li>
@endsection

@section('page-header')
    <small>
        {{ $chapter->title }} - Pages
    </small>

    <div class="pull-right">
        @include('v1.admin.documentation.man_pages.chapters')
        <!-- chapters options -->
        @include('v1.admin.documentation.man_pages.pages')
        <!-- chapter pages options -->
        <a href="{{ route('manchapter.edit', ['manchapter' => $chapter->id]) }}" class="btn btn-primary btn-sm"
           data-toggle="tooltip" title="edit chapter">
            Edit <i class="fa fa-edit"></i>
        </a>
        <!-- chapter edit -->
        <a href="{{ route('manchapter.show', ['manchapter' => $chapter->id]) }}" class="btn btn-default btn-sm"
           data-toggle="tooltip" title="preview chapter">
            Preview <i class="fa fa-eye"></i>
        </a>
        <!-- chapter preview -->
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            @include('includes.alerts.default')

            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="clearfix">
                        <strong>{{ title_case($status != null ? $status : 'All') }} Pages</strong>
                        <div class="pull-right">
                            <div class="btn-group btn-group-sm">
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"
                                        aria-expanded="false">
                                    Actions <i class="caret"></i>
                                </button>
                                <ul class="dropdown-menu pull-right">
                                    <li class="dropdown-header">Sort by</li>
                                    <li>
                                        <a href="{{ route('manpage.index', ['manchapter' => $chapter->id, 'status' => 'active']) }}">Active</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('manpage.index', ['manchapter' => $chapter->id, 'status' => 'disabled']) }}">Disabled</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('manpage.index', ['manchapter' => $chapter->id, 'status' => 'trashed']) }}">Trashed</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('manpage.index', ['manchapter' => $chapter->id]) }}">All</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="list-group manuals">
                        @forelse($pages as $page)
                            <div class="list-group-item list-group-item-{{ $page->status == 1 ? 'success' : '' }}">
                                <header class="clearfix">
                                    <strong class="list-group-item-heading">
                                        {{ $loop->iteration }} . {{ $page->title }}
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
                                                        <a href="{{ route('manpage.show', ['manpage' => $page->id]) }}">
                                                            Preview
                                                            <i class="fa fa-eye pull-right"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('manpage.edit', ['manpage' => $page->id]) }}">
                                                            Edit
                                                            <i class="fa fa-edit pull-right"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('manpage.delete', ['manpage' => $page->id]) }}">
                                                            Remove
                                                            <i class="fa fa-times-circle-o pull-right"></i>
                                                        </a>
                                                    </li>
                                                @else
                                                    <li>
                                                        <a href="{{ route('manpage.restore', ['manpage' => $page->id]) }}">
                                                            Restore
                                                            <i class="fa fa-refresh pull-right"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('manpage.destroy', ['manpage' => $page->id]) }}">
                                                            Delete
                                                            <i class="fa fa-trash pull-right"></i>
                                                        </a>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                        <!-- page options -->
                                    </div>
                                </header>
                                <!-- /header -->
                                <p class="clearfix">
                                    <strong>Created:</strong> {{ $page->created_at->diffForHumans() }}
                                    <a href="{{ route('manpage.status', ['manpage' => $page->id]) }}"
                                       class="btn btn-default btn-sm pull-right" data-toggle="tooltip"
                                       title="{{ AppStatusToggleText($page->status) }}">
                                        <i class="{{ AppStatusIcon($page->status) }}"></i>
                                    </a>
                                </p>
                            </div>
                            <!-- /chapter.list-group-item -->
                        @empty
                            <p class="lead">No {{ $status }} pages found.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection