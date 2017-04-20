<h3 class="page-header">Results for {{ $topic }}</h3>
<!-- /.page-header -->

<!-- alert -->
@include('includes.alerts.default')

<div class="row">
    @forelse($results as $topic)
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
                <!-- /.topicFooter -->
            </div>
            <!-- /.topicWrapper -->
        </div>
        <!-- /.col-lg-12 -->
    @empty
        <p class="text-muted">Sorry, no posts found.
            <a class="btn btn-primary btn-lg" href="{{ route('forum.create') }}" role="button">
                Be the first!
            </a>
        </p>
        <!-- /p -->
    @endforelse
</div>
<!-- /.row -->

<footer id="forumFooter">
    {{ $results->links() }}
    <span class="pull-right">
        Showing {{ $results->firstItem() }} to {{ $results->lastItem() }} of {{ $results->total() }}
    </span>
</footer>
<!-- /footer#forumFooter -->
