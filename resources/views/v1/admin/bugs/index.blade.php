@extends('layouts.admin')

@section('title')
    Bugs
@endsection

@section('breadcrumb')
    <li>Bugs</li>
@endsection

@section('page-header')
    <i class="fa fa-bug"></i> Bugs
    <div class="pull-right">
        <button class="btn btn-default dropdown-toggle">
            Actions <span class="caret"></span>
        </button>
        <ul class="dropdown-menu pull-right">
            li>
        </ul>
    </div>
@endsection

@section('content')
    @include('includes.alerts.default')
    <div class="list-group">
        @forelse($rep_bugs as $bug)
            <div class="list-group-item">
                <div class="list-group-item-heading">
                    <a href="{{ route('bugs.show', ['bug' => $bug->id]) }}">
                        <h4>{{ str_limit($bug->title) }}</h4>
                    </a>
                </div>
                <div class="list-group-item-text small">
                    {!! str_limit($bug->details) !!}
                </div>
                <p>
                    <strong>Feature</strong>

                    <span class="text-muted">{{ bug_feature($bug) }}</span>
                </p>
                <p>
                    <strong>Reported on</strong>
                    <small>{{ $bug->created_at->toDayDateTimeString() }}</small>
                </p>
                <div class="list-group-item-heading">
                    <strong>Solved</strong> <small>{{ bug_solved_date($bug->solved_at) }}</small>
                    <span class="{{ bug_label($bug->solved_at) }}">{{ bug_text($bug->solved_at) }}</span>
                    <div class="pull-right">
                        <div class="btn-group btn-group-sm">
                            <a href="{{ route('bugs.show', ['bug' => $bug->id]) }}" class="btn btn-primary">
                                View <i class="fa fa-file-o"></i>
                            </a>
                            <a href="{{ route('bugs.status', ['bug' => $bug->id]) }}"
                               class="btn {{ bug_button_state($bug->solved_at) }}">
                                {{ bug_button_text($bug->solved_at) }} <i class="fa fa-check-square-o"></i>
                            </a>
                        </div>
                    </div><!-- /.pull-right -->
                </div><!-- /.list-group-item-heading -->
            </div>
        @empty
            <div class="list-group-item">
                <div class="list-group-heading">
                    No bugs reported so far.
                </div>
            </div>
        @endforelse
    </div>

    <p><strong>Showing</strong>
        '{{ $rep_bugs->firstItem() }}' <strong>to</strong> '{{ $rep_bugs->lastItem() }}'
         <strong>out of</strong>{{ $rep_bugs->total() }}
    </p>

    {{ $rep_bugs->hasMorePages() ? '<hr>' : '' }}

    <p>{{ $rep_bugs->links() }}</p>
@endsection
