<div class="col-lg-3 col-sm-4">
    <form method="get" action="{{ route('forum.search') }}">
        <input type="hidden" name="keyword" id="keyword" value="simple">
        <div class="input-group">
            <input type="search" name="topic" class="form-control" placeholder="search knowledge base">
            <span class="input-group-btn">
			    <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
			</span>
        </div>
        <!-- /input-group -->
    </form>

    @if(Auth::check())
        @if(checkPage('forum.edit'))
            <div class="list-group">
                <h1 class="list-group-item list-group-item-text">Post options</h1>
                <a href="{{ route('forum.show', ['forum' => $topic->id]) }}" class="list-group-item" title="view">
                    View
                    <i class="fa fa-eye pull-right"></i>
                </a>
                <a href="#" class="list-group-item list-group-item-danger btnDelForum" title="delete"
                   data-route="{{ route('forum.destroy', ['forum' => $topic->id]) }}">
                    Delete
                    <i class="fa fa-trash pull-right"></i>
                </a>
            </div>
            <hr>
        @endif
        @if(checkPage('forum.show'))
            <div class="list-group">
                <h1 class="list-group-item list-group-item-text">Post options</h1>
                <a href="{{ route('forum.edit', ['forum' => $topic->id]) }}" class="list-group-item" title="edit">
                    Edit
                    <i class="fa fa-edit pull-right"></i>
                </a>
                <a href="#" class="list-group-item list-group-item-danger btnDelForum" title="delete"
                   data-route="{{ route('forum.destroy', ['forum' => $topic->id]) }}">
                    Delete
                    <i class="fa fa-trash pull-right"></i>
                </a>
            </div>
            <hr>
        @endif
    @endif
    <div class="list-group">
        <h1 class="list-group-item list-group-item-text">Go to</h1>
        <a href="{{ route('forum.index') }}" class="list-group-item {{ ActivePage('forum.index') }}">Knowledge
            Base</a>
        <a class="list-group-item {{ ActivePage('forum.create') }}" href="{{ route('forum.create') }}"
           role="button">
            I have a question
            <i class="fa fa-plus pull-right"></i>
        </a>
        @if(Auth::check())
            <a href="{{ route('forum.author.index', ['author' => Auth::user()->id]) }}"
               class="list-group-item {{ ActivePage('forum.author.index') }}">
                My posts
                <span class="fa fa-user pull-right"></span>
            </a>
        @endif
    </div>
    <hr>
    <div class="list-group">
        <h1 class="list-group-item list-group-item-text"><i class="fa fa-tags"></i> Tags</h1>
        @forelse($tags as $tag)
            <a href="{{ route('forum.search', ['keyword' => 'tags', 'tag' => $tag->name]) }}" class="list-group-item">
                {{ $tag->name }}
            </a>
        @empty
            <span class="list-group-item">No tags found.</span>
        @endforelse
    </div>
</div>
<!-- /.col-lg-3 -->
