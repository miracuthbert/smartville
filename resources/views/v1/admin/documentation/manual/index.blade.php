@extends('layouts.admin')

@section('title')
    Documentation - Manuals
@endsection

@section('styles')
    <style>
        input[type=number] {
            width: 70px;
        }
    </style>
@endsection

@section('breadcrumb')
    <li>Documentation</li>
    <li class="active">Manuals</li>
@endsection

@section('page-header')
    <i class="fa fa-book"></i> Manuals
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <form method="post" action="{{ route('manual.pages') }}">
                @include('includes.alerts.default')

                {{ csrf_field() }}

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="clearfix">
                            <strong>{{ title_case($status != null ? $status : 'All') }} Manuals</strong>
                            <div class="pull-right">
                                <div class="btn-group btn-group-sm">
                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"
                                            aria-expanded="false">
                                        Actions <i class="caret"></i>
                                    </button>
                                    <ul class="dropdown-menu pull-right">
                                        <li class="dropdown-header">Sort by</li>
                                        <li>
                                            <a href="{{ route('manual.index', ['status' => 'active']) }}">Active</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('manual.index', ['status' => 'disabled']) }}">Disabled</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('manual.index', ['status' => 'trashed']) }}">Trashed</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('manual.index') }}">All</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="btn-group btn-group-sm">
                                    <button type="submit" class="btn btn-primary">
                                        Update Pages
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        @if(count($manuals) > 0)
                            <div class="list-group manuals">
                                @foreach($_manuals as $manual)
                                    <div class="list-group-item list-group-item-{{ $manual->status == 1 ? 'success' : '' }}">
                                        <header class="clearfix">
                                            <strong class="list-group-item-heading">
                                                <label>
                                                    <input type="number" name="index[]"
                                                           id="{{ $manual->index ? $manual->index : $loop->iteration }}"
                                                           class="form-control index"
                                                           value="{{ $manual->index ? $manual->index : $loop->iteration }}">
                                                </label>
                                                . {{ $manual->title }}
                                            </strong>
                                            <!-- heading -->
                                            <div class="pull-right">
                                                <div class="btn-group btn-group-sm">
                                                    <button type="button" class="btn btn-default dropdown-toggle"
                                                            data-toggle="dropdown" aria-expanded="false">
                                                        Manual
                                                        <i class="caret"></i>
                                                    </button>
                                                    <ul class="dropdown-menu pull-right">
                                                        @if($status != "trashed")
                                                            <li>
                                                                <a href="{{ route('manual.show', ['manual' => $manual->id]) }}">
                                                                    Preview
                                                                    <i class="fa fa-eye pull-right"></i>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="{{ route('manual.edit', ['manual' => $manual->id]) }}">
                                                                    Edit
                                                                    <i class="fa fa-edit pull-right"></i>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="{{ route('manual.delete', ['manual' => $manual->id]) }}">
                                                                    Remove
                                                                    <i class="fa fa-times-circle-o pull-right"></i>
                                                                </a>
                                                            </li>
                                                        @else
                                                            <li>
                                                                <a href="{{ route('manual.restore', ['manual' => $manual->id]) }}">
                                                                    Restore
                                                                    <i class="fa fa-refresh pull-right"></i>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="{{ route('manual.destroy', ['manual' => $manual->id]) }}">
                                                                    Delete
                                                                    <i class="fa fa-times-trash pull-right"></i>
                                                                </a>
                                                            </li>
                                                        @endif
                                                    </ul>
                                                </div>
                                                <!-- manual options -->
                                                <div class="btn-group btn-group-sm">
                                                    <button type="button" class="btn btn-default dropdown-toggle"
                                                            data-toggle="dropdown" aria-expanded="false">
                                                        Chapters
                                                        <i class="caret"></i>
                                                    </button>
                                                    <ul class="dropdown-menu pull-right">
                                                        <li>
                                                            <a href="{{ route('manchapter.create', ['manual' => $manual->id]) }}">
                                                                Add New
                                                            </a>
                                                        </li>
                                                        <li role="separator" class="divider"></li>
                                                        <li class="dropdown-header">Chapters</li>
                                                        @forelse($manual->chapters as $chapter)
                                                            <li>
                                                                <a href="{{ route('manchapter.edit', ['manchapter' => $chapter->id]) }}">
                                                                    {{ $chapter->title }}
                                                                </a>
                                                            </li>
                                                        @empty
                                                            <li class="text-center">No chapters found</li>
                                                        @endforelse
                                                        <li role="separator" class="divider"></li>
                                                        <li>
                                                            <a href="{{ route('manchapter.index', ['manual' => $manual->id]) }}">
                                                                View All
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <!-- chapter options -->
                                            </div>
                                            <input type="hidden" name="manual[]" class="manual" value="{{ $manual->id }}">
                                        </header>
                                        <!-- /header -->
                                        <p class="clearfix">
                                            <strong>Created:</strong> {{ $manual->created_at->diffForHumans() }}
                                            <a href="{{ route('manual.status', ['manual' => $manual->id]) }}"
                                               class="btn btn-default btn-sm pull-right" data-toggle="tooltip"
                                               title="{{ AppStatusToggleText($manual->status) }}">
                                                <i class="{{ AppStatusIcon($manual->status) }}"></i>
                                            </a>
                                        </p>
                                    </div>
                                    <!-- /manual.list-group-item -->
                                @endforeach
                            </div>
                        @else
                            <p class="lead">No {{ $status }} manuals found.</p>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
@endsection