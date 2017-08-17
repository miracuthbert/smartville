<h3 class="page-header">Showing search results for tag '{{ $tag }}'</h3>

<!-- alert -->
@include('partials.alerts.default')

<div class="row">
    @forelse($results as $topic)
        <div class="col-lg-12">
            <div class="topicWrapper">
                <header class="topicHeader">
                    <h4>
                        <a role="button"
                           href="{{ route('forum.show', ['forum' => $topic->taggable->id]) }}"
                           class="btn-link">
                            {{ str_limit($topic->taggable->title, 50) }}
                        </a>
                        <div class="pull-right small">
                            <strong>By</strong>
                            <a href="{{ route('forum.index', ['forum' => $topic->taggable->user_id, 'sort' => 'user']) }}">
                                {{ $topic->taggable->user->lastname . ' ' . $topic->taggable->user->firstname }}
                            </a>
                        </div>
                    </h4>
                    <!-- /h4 -->
                    <hr>
                    <div class="lead {{ count_chars($topic->taggable->title) < 50 ? 'hidden' : '' }}"
                         id="#topic-title">
                        {{ $topic->taggable->title }}
                        <hr>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-xs-6 text-muted small">
                            <p class="text-center-xs">
                                {{ $topic->taggable->created_at->diffForHumans() }}
                            </p>
                        </div>
                        <!-- /.col-sm-3 -->
                        <div class="col-lg-3 col-xs-6 small">
                            <p class="text-right-xs">
                                <a href="{{ route('forum.show', ['forum' => $topic->taggable->id, '#commentWrapper']) }}">
                                    <i class="fa fa-comments"></i> {{ $topic->taggable->comments_count }}
                                    comments
                                </a>
                            </p>
                        </div>
                        <!-- /.col-sm-3 -->
                        <div class="col-lg-4">
                            <p class="levelWrapper">
                                <span class="label label-default {{ $topic->taggable->is_support ? '' : 'hidden' }}">
                                    Support
                                </span>
                                <span class="label label-success {{ $topic->taggable->is_community ? '' : 'hidden' }}">
                                    Community
                                </span>
                                <span class="label label-primary {{ $topic->taggable->is_founder ? '' : 'hidden' }}">
                                    Founder
                                </span>
                            </p>
                        </div>
                        <!-- /.col-sm-4 -->
                        <div class="col-lg-2">
                            <p>
                                <span class="{{ TopicStatusLabel($topic->taggable->solved_at) }} topic-status  pull-right">
                                    {{ TopicStatusText($topic->taggable->solved_at) }}
                                </span>
                            </p>
                        </div>
                        <!-- /.col-sm-2 -->
                    </div>
                    <!-- /.row -->
                </header>
                <!-- /header.topicHeader -->
                <footer class="topicFooter">
                    <div class="row">
                        <div class="col-md-8">
                            <strong><i class="fa fa-tags"></i></strong>
                            @forelse($topic->taggable->tags as $tag)
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
                                    @if(Auth::user()->id == $topic->taggable->user_id)
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ route('forum.status', ['forum' => $topic->taggable->id]) }}"
                                               class="btn btn-default" data-toggle="tooltip"
                                               title="Mark as {{ TopicToggleText($topic->taggable->solved_at) }}">
                                                {{ TopicStatusText($topic->taggable->solved_at) }}
                                                <i class="{{ TopicStatusIcon($topic->taggable->solved_at) }}"></i>
                                            </a>
                                            <a href="#" class="btn btn-danger btnDelForum"
                                               data-toggle="tooltip" title="delete"
                                               data-route="{{ route('forum.destroy', ['forum' => $topic->taggable->id]) }}">
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
        <p class="text-muted">Sorry, no posts found with {{ $tag }}
            <a class="btn btn-primary btn-lg" href="{{ route('forum.create') }}" role="button">
                Be the first!
            </a>
        </p>
        <!-- /p -->
    @endforelse
</div>
<!-- /.row -->