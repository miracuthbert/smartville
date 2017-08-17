@extends('v1.layouts.dashboard')

@section('title')
    Forum
@endsection

@section('page-header')
    <i class="fa fa-book"></i>
    Forum
    <span class="pull-right small" data-toggle="tooltip"
          title="This feature is currently in development. Please bare with us if there are any bugs.">
        <span class="label label-warning pull-right">Beta</span>
    </span>
@endsection

@section('content')
    <div id="forumWrapper">
        @include('partials.alerts.default')

        <div class="row">
            <div class="col-lg-12">
                <p class="lead">Browse to find answers to existing questions you have or
                    <a href="{{ route('forum.create') }}" class="btn btn-link">Add new post</a>
                </p>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <h3 class="sub-header">{{ ForumSubHeader($sort, $user) }}</h3>
                <ul class="list-group">
                    @foreach($topics as $topic)
                        <li class="list-group-item topicWrapper">
                            <header class="box">
                                <div class="row">
                                    <div class="col-md-12">
                                        <a role="button" href="{{ route('forum.show', ['forum' => $topic->id]) }}"
                                           class="btn-link">
                                            {{ str_limit($topic->title, 50) }}
                                            <span class="badge" data-toggle="tooltip" title="comments">
                                                {{ $topic->comments_count }}
                                            </span>
                                        </a>
                                        <span class="{{ TopicStatusLabel($topic->status) }} topic-status">
                                                    {{ TopicStatusText($topic->status) }}
                                        </span>
                                        <div class="pull-right">
                                            <span class="text-muted small">
                                                {{ $topic->created_at->diffForHumans() }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </header>

                            <section class="box" id="body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="levelWrapper">
                                            <p>
                                                <strong>Open to:</strong>
                                                @foreach($topic->data['level'] as $level)
                                                    <span class="label label-default">
                                                        {{ $level }}
                                                    </span>
                                                @endforeach
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <p>
                                            <strong class="small">Author:</strong>
                                            <a href="{{ route('forum.index', ['forum' => $topic->user_id, 'sort' => 'user']) }}"
                                               class="btn btn-link btn-xs">
                                                {{ $topic->user->lastname . ' ' . $topic->user->firstname }}
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            </section>

                            <footer class="topic-footer">
                                <div class="row">
                                    <div class="col-md-8">
                                        <strong>Tags:</strong>
                                        @if(count($topic->tags) > 0)
                                            @foreach($topic->tags as $tag)
                                                <a href="#{{ $tag->id }}" class="btn btn-link btn-sm">
                                                    {{ $tag->name }}
                                                </a>
                                            @endforeach
                                        @else
                                            No tags found.
                                        @endif
                                    </div>

                                    <div class="col-md-4">
                                        <div class="pull-right">
                                            @if(Auth::check())
                                                @if(Auth::user()->id == $topic->user_id)
                                                    <div class="btn-group btn-group-sm">
                                                        <a href="{{ route('forum.status', ['forum' => $topic->id]) }}"
                                                           class="btn btn-default" data-toggle="tooltip"
                                                           title="Mark as {{ TopicToggleText($topic->status) }}">
                                                            {{ TopicStatusText($topic->status) }}
                                                            <i class="{{ TopicStatusIcon($topic->status) }}"></i>
                                                        </a>
                                                        <a href="#" class="btn btn-danger btnDelForum"
                                                           data-toggle="tooltip" title="delete"
                                                           data-route="{{ route('forum.destroy', ['forum' => $topic->id]) }}">
                                                            <i class="fa fa-trash"></i>
                                                            Delete
                                                        </a>
                                                    </div>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </footer>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12"></div>
        </div>
    </div>

    @include('partials.modals.forum-delete');

@endsection

@section('scripts')
    <script>
    </script>
@endsection