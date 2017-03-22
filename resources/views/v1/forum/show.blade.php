@extends('layouts.company')

@section('title')
    Knowledge Base - {{ str_limit($topic->title, 50) }}
@endsection

@section('page-header')
    {{ $topic->title }}
@endsection

@section('styles')
    <style>
        #forumTopicWrapper {
            padding: 20px;
        }

        #forumTopicWrapper #topicWrap {
            background-color: #fefefe;
            padding: 0 15px 15px;
            margin-bottom: 30px;
            border: 1px solid #f7f7f7;
        }

        #forumWrapper #forumFooter {
            padding: 15px;
            margin-top: 30px;
            margin-bottom: 30px;
            border-top: 1px solid #cccccc;
        }

        #topicWrap .levelWrapper span {
            margin-right: 15px;
        }

        #forumTopicWrapper #topicWrap #commentWrapper .comment {
            margin: 25px;
        }

    </style>
@endsection

@section('content')
    @include('includes.headers.home.primary')

    <section class="box" id="forumTopicWrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-sm-8">
                    <div id="topicWrap">
                        <div class="row">
                            <div class="col-lg-8">
                                <h1>
                                    {{ str_limit($topic->title, 50) }}
                                </h1>
                            </div>
                            <div class="col-lg-4">
                                <h1>
                                    <small class="pull-right">
                                        <strong>By</strong>
                                        <a href="{{ route('forum.index', ['forum' => $topic->user_id, 'sort' => 'user']) }}">
                                            {{ $topic->user->lastname . ' ' . $topic->user->firstname }}
                                        </a>
                                    </small>
                                </h1>
                            </div>
                        </div>
                        <hr>
                        <section id="topicWrapper">
                            <header>
                                <p class="lead" id="#topic-title">
                                    <strong>Full topic title</strong><br>
                                    {{ $topic->title }}
                                </p>
                                <hr>
                                <!-- /#topic-title -->
                                <div class="row">
                                    <div class="col-lg-3 col-xs-6 text-muted small">
                                        <p class="text-center-xs">
                                            {{ $topic->created_at->diffForHumans() }}
                                        </p>
                                    </div>
                                    <!-- /.col-sm-3 -->
                                    <div class="col-lg-3 col-xs-6 small">
                                        <p class="text-right-xs">
                                            <a href="{{ route('forum.show', ['forum' => $topic->id, '#commentWrapper']) }}">
                                                <i class="fa fa-comments"></i> {{ $topic->comments_count }}
                                                comments
                                            </a>
                                        </p>
                                    </div>
                                    <!-- /.col-sm-3 -->
                                    <div class="col-lg-4">
                                        <p class="levelWrapper">
                                            <span class="label label-default {{ $topic->is_support ? '' : 'hidden' }}">
                                                Support
                                            </span>
                                            <span class="label label-success {{ $topic->is_community ? '' : 'hidden' }}">
                                                Community
                                            </span>
                                            <span class="label label-primary {{ $topic->is_founder ? '' : 'hidden' }}">
                                                Founder
                                            </span>
                                        </p>
                                    </div>
                                    <!-- /.col-sm-4 -->
                                    <div class="col-lg-2">
                                        <p>
                                        <span class="{{ TopicStatusLabel($topic->solved_at) }} topic-status  pull-right">
                                            {{ TopicStatusText($topic->solved_at) }}
                                        </span>
                                        </p>
                                    </div>
                                    <!-- /.col-sm-2 -->
                                </div>
                                <!-- /.row -->
                            </header>

                            <section class="box" id="body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="box" id="details">
                                            <div class="well">
                                                {!! $topic->details !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>

                            <footer>
                                <div class="row">
                                    <div class="col-md-8">
                                        <strong><i class="fa fa-tags"></i></strong>
                                        @forelse($_tags as $tag)
                                            <a href="#{{ $tag->id }}" class="btn btn-link btn-sm">
                                                {{ $tag->name }}
                                            </a>
                                        @empty
                                            No tags found.
                                        @endforelse
                                    </div>

                                    <div class="col-md-4">
                                        <div class="pull-right">
                                            @if(Auth::check())
                                                @if(Auth::user()->id == $topic->user_id)
                                                    <div class="btn-group btn-group-sm">
                                                        <a href="{{ route('forum.status', ['forum' => $topic->id]) }}"
                                                           class="btn btn-default" data-toggle="tooltip"
                                                           title="Mark as {{ TopicToggleText($topic->solved_at) }}">
                                                            {{ TopicStatusText($topic->solved_at) }}
                                                            <i class="{{ TopicStatusIcon($topic->solved_at) }}"></i>
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
                        </section>
                        <!-- /#topicWrapper -->
                        <section class="box" id="topicComments">
                            <div class="row">
                                <div class="col-lg-12">
                                    <h3 class="page-header">
                                        <i class="fa fa-comments"></i>
                                        Comments
                                        <span class="badge" data-toggle="tooltip" title="comments">
                                            {{ $topic->comments_count }}
                                        </span>
                                    </h3>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <section class="box" id="commentWrapper">
                                        @forelse($comments as $comment)
                                            <section class="comment" id="comment{{ $comment->id }}">
                                                <div class="row">
                                                    <div class="col-lg-3 col-sm-3 text-center-xs">
                                                        <p>
                                                            <img src="{{ url('images/site/logos/thumbs/default.jpg') }}"
                                                                 alt="username avatar"
                                                                 class="img-responsive img-circle">
                                                        </p>
                                                    </div>
                                                    <div class="col-lg-9 col-sm-9">
                                                        <header>
                                                            <p class="small text-muted">
                                                                {{ $comment->user->username or $comment->user->firstname . ' ' . $comment->user->lastname }}
                                                            </p>
                                                            <p class="small text-muted">
                                                                <i class="fa fa-clock-o"></i>
                                                                {{ $comment->created_at->diffForHumans() }}
                                                            </p>
                                                        </header>
                                                        <!-- /header -->
                                                        <article class="body">
                                                            {!! $comment->body !!}
                                                        </article>
                                                        <!-- /article -->
                                                        @if(!$topic->status)
                                                            <section class="clearfix box vote-wrapper">
                                                                <div class="row">
                                                                    <div class="col-lg-7">
                                                                        <p class="text-muted message">
                                                                            {{ $comment->votes()->where('user_id', Auth::user()->id)->first() ? $comment->votes()->where('user_id', Auth::user()->id)->first()->vote == 1 ? 'You marked this comment as helpful' : '' : '' }}
                                                                            {{ $comment->votes()->where('user_id', Auth::user()->id)->first() ? $comment->votes()->where('user_id', Auth::user()->id)->first()->vote == 0 ? 'You marked this comment as not helpful' : '' : '' }}
                                                                        </p>
                                                                    </div>
                                                                    <div class="col-lg-5">
                                                                        <div class="pull-right">
                                                                            <div class="btn-group btn-group-sm">
                                                                                <a href="#"
                                                                                   class="btn btn-default btnVoteForumComment"
                                                                                   data-toggle="tooltip"
                                                                                   data-route="{{ route('forum.comment.vote', ['id'=> $comment->id]) }}"
                                                                                   data-vote="1" title="helpful">
                                                                                    <i class="fa fa-thumbs-up"></i>
                                                        <span class="total">
                                                            {{ $comment->votesLike->count() }}
                                                        </span>
                                                                                </a>
                                                                                <a href="#"
                                                                                   class="btn btn-default btnVoteForumComment"
                                                                                   data-toggle="tooltip"
                                                                                   data-route="{{ route('forum.comment.vote', ['id'=> $comment->id]) }}"
                                                                                   data-vote="0"
                                                                                   title="not helpful">
                                                                                    <i class="fa fa-thumbs-down"></i>
                                                        <span class="total">
                                                            {{ $comment->votesDislike->count() }}
                                                        </span>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </section>
                                                            <!-- /.vote-wrapper -->
                                                        @endif
                                                    </div>
                                                    <!-- /.col-lg-9 -->
                                                </div>
                                                <!-- /.row -->
                                            </section>
                                            <!-- /.comment -->
                                        @empty
                                            <p class="lead {{ $topic->is_community && $topic->solved_at == null ? '' : 'hidden' }}">
                                                No comments found.
                                                @if(Auth::check())
                                                    Be the first to add <a href="#commentBox" class="btn btn-link">
                                                        Post comment <i class="fa fa-comment-o"></i>
                                                    </a>
                                                @endif
                                            </p>
                                            @if(Auth::check())
                                                <p class="lead {{ $topic->is_support && $topic->solved_at == null ? '' : 'hidden' }}">
                                                    <i class="fa fa-lock"></i>
                                                    Only a selected group can respond to this post. You can only read
                                                    through the comments.
                                                </p>
                                            @endif
                                        @endforelse
                                    </section>
                                    <!-- /#commentWrapper -->
                                </div>
                                <!-- /.col-lg-12 -->
                            </div>
                            <!-- /.row -->
                            <div class="row">
                                <div class="col-lg-12">
                                    @if(Auth::check())
                                        @if($topic->solved_at == null)
                                            <section class="box {{ $topic->is_community ? '' : 'hidden' }}"
                                                     id="commentBox">
                                                <form role="form" method="post"
                                                      action="{{ route('forum.comment.store') }}"
                                                      enctype="multipart/form-data">

                                                    @include('includes.alerts.default')

                                                    @include('includes.alerts.validation')

                                                    {{ csrf_field() }}

                                                    <input type="hidden" name="topic" id="topic"
                                                           value="{{ $topic->id }}">

                                                    <div class="box">
                                                        <div class="form-group">
                                                            <label>Your comment here</label>
                                                        <textarea name="comment" class="form-control ckeditor"
                                                                  id="comment"
                                                                  rows="3">{{ Request::old('comment') }}</textarea>
                                                        </div>
                                                    </div>

                                                    <div class="box hidden">
                                                        <div class="form-group">
                                                            <label>Attach file</label>
                                                            <input type="file" name="file" class="form-control"
                                                                   id="file">
                                                            <p class="help-block">You can attach a file for more
                                                                details</p>
                                                        </div>
                                                    </div>

                                                    <div class="box pull-right">
                                                        <button type="submit" class="btn btn-primary">
                                                            Post Comment
                                                            <i class="fa fa-comment-o"></i>
                                                        </button>
                                                    </div>
                                                </form>
                                            </section>
                                        @else
                                            <p class="lead">This post is no longer active. You can add a new post
                                                <a href="{{ route('forum.create') }}" class="btn btn-primary">here</a>
                                            </p>
                                        @endif
                                    @else
                                        <p class="text-muted">
                                            <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                                            to post comment
                                        </p>
                                    @endif
                                </div>
                            </div>
                            <!-- /.row -->
                        </section>
                        <!-- /#topicComments -->
                    </div>
                    <!-- /#topicWrap -->
                </div>
                <!-- /.col-lg-9 -->
                <!-- sidebar -->
                @include('includes.sidebars.knowbase-v1')
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>
    <!-- /#forumTopicWrapper -->

    <!-- modals -->
    @include('includes.modals.forum-delete');

    <!-- footer -->
    @include('includes.footers.default')
@endsection

{{-- scripts --}}
@section('scripts')
    <script>
        CKEDITOR.replace('ckeditor')
    </script>
@endsection
