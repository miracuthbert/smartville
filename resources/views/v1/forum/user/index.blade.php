@extends('layouts.company')

@section('title')
    Knowledge Base | My Posts
@endsection

@section('styles')
    <style>
        #forumWrapper .jumbotron {
            background-color: #2C3E50;
            color: #EEEEEE;
        }

        #forumWrapper #topics {
            padding: 20px;
        }

        #forumWrapper #topics .topicWrapper {
            background-color: #f8f8f8;
            padding: 15px;
            margin-bottom: 30px;
            border: 1px solid #ECF0F1;
            -webkit-border-radius: 3px;
            -moz-border-radius: 3px;
            border-radius: 3px;
        }

        #topics .topicWrapper .levelWrapper span {
            margin-right: 15px;
        }

        #forumWrapper #forumFooter {
            padding: 15px;
            margin-top: 30px;
            margin-bottom: 30px;
            border-top: 1px solid #cccccc;
        }

    </style>
@endsection

@section('content')
    @include('includes.headers.home.primary')

    <div id="forumWrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="breadcrumb">
                        <li>{{ config('app.name') }}</li>
                        <li>Knowledge Base</li>
                        <li class="active">My Posts</li>
                    </ul>
                </div>
            </div>
            <div class="box" id="topics">
                <div class="row">
                    <div class="col-lg-9 col-sm-8">
                        <h1 class="page-header">Posts</h1>
                        <!-- /.page-header -->

                        <!-- alert -->
                        @include('includes.alerts.default')

                        <div class="row">
                            @forelse($topics as $topic)
                                <div class="col-lg-12">
                                    <div class="topicWrapper">
                                        <header class="topicHeader">
                                            <h4>
                                                <a role="button"
                                                   href="{{ route('forum.show', ['forum' => $topic->id]) }}"
                                                   class="btn-link">
                                                    {{ str_limit($topic->title, 50) }}
                                                </a>
                                                <div class="pull-right small">
                                                    <strong>By</strong>
                                                    <a href="{{ route('forum.index', ['forum' => $topic->user_id, 'sort' => 'user']) }}">
                                                        {{ $topic->user->lastname . ' ' . $topic->user->firstname }}
                                                    </a>
                                                </div>
                                            </h4>
                                            <!-- /h4 -->
                                            <hr>
                                            <div class="lead {{ count_chars($topic->title) < 50 ? 'hidden' : '' }}"
                                                 id="#topic-title">
                                                {{ $topic->title }}
                                                <hr>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-3 col-xs-6 text-muted small">
                                                    <p class="text-center-xs">
                                                        {{ $topic->created_at->diffForHumans() }}
                                                    </p>
                                                </div>
                                                <!-- /.col-sm-3 -->
                                                <div class="col-lg-3 col-xs-6">
                                                    <p class="text-right-xs small">
                                                        <a href="{{ route('forum.show', ['forum' => $topic->id, '#commentWrapper']) }}">
                                                            <i class="fa fa-comments"></i> {{ $topic->comments_count }}
                                                            comments
                                                        </a>
                                                    </p>
                                                </div>
                                                <!-- /.col-sm-3 -->
                                                <div class="col-lg-4">
                                                    <p class="levelWrapper">
                                                        @foreach($topic->data['level'] as $level)
                                                            <span class="label label-default">
                                                                {{ $level }}
                                                        </span>
                                                        @endforeach
                                                    </p>
                                                </div>
                                                <!-- /.col-sm-3 -->
                                                <div class="col-lg-2">
                                                    <p>
                                            <span class="{{ TopicStatusLabel($topic->status) }} topic-status  pull-right">
                                            {{ TopicStatusText($topic->status) }}
                                        </span>
                                                    </p>
                                                </div>
                                                <!-- /.col-sm-3 -->
                                            </div>
                                            <!-- /.row -->
                                        </header>
                                        <!-- /header.topicHeader -->

                                        <section class="topicBody">
                                            <div class="row">
                                                <div class="col-md-12">
                                                </div>
                                            </div>
                                        </section>
                                        <!-- /.topicBody -->

                                        <footer class="topicFooter">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <strong><i class="fa fa-tags"></i></strong>
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
                                        <!-- /.topicFooter -->
                                    </div>
                                    <!-- /.topicWrapper -->
                                </div>
                                <!-- /.col-lg-12 -->
                            @empty
                                <p class="text-muted">Sorry, no questions found.
                                    <a class="btn btn-primary btn-lg" href="{{ route('forum.create') }}" role="button">
                                        Be the first!
                                    </a>
                                </p>
                                <!-- /p -->
                            @endforelse
                        </div>
                        <!-- /.row -->

                        <footer id="forumFooter">
                            {{ $topics->links() }}
                            <span class="pull-right">
                                Showing {{ $topics->firstItem() }} to {{ $topics->lastItem() }}
                                of {{ $topics->total() }}
                            </span>
                        </footer>
                        <!-- /footer#forumFooter -->
                    </div>
                    <!-- /.col-lg-9 -->
                    <!-- support sidebar -->
                    @include('includes.sidebars.knowbase-v1')
                </div>
                <!-- /.row -->
            </div>
            <!-- /#topics -->
        </div>
        <!-- /.container -->
    </div>
    <!-- /#forumWrapper -->

    <!-- footer -->
    @include('includes.footers.default')
@endsection
