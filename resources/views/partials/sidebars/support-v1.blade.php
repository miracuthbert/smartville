<div class="col-lg-3 col-sm-4">
    <div class="list-group">
        <div class="list-group-item active">
            <div class="list-group-item-heading">
                <h4>Support Menu</h4>
                <p class="list-group-item-text">Use links below to skip to sections</p>
            </div>
        </div>
        <a href="{{ route('manuals.index') }}" class="list-group-item {{ ActivePage('manuals.index') }}">
            <i class="glyphicon glyphicon-book"></i> Documentation
        </a>
        <a href="{{ route('forum.index') }}" class="list-group-item {{ ActivePage('forum.index') }}">
            <i class="fa fa-question-circle-o fa-fw"></i> Knowledge Base
        </a>
        <a href="{{ route('bug.create') }}" class="list-group-item {{ ActivePage('bug.create') }}">
            <i class="fa fa-bug fa-fw"></i> Report a problem (bug)
        </a>
    </div>
</div>
<!-- /.col-lg-3 -->
