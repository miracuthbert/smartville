<li class="sidebar-search">
    <div class="input-group custom-search-form">
        <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
    </div>
    <!-- /input-group -->
</li>
<li>
    <a href="{{ route('admin.dashboard') }}">
        <i class="fa fa-dashboard fa-fw"></i> Dashboard
    </a>
</li>
<!-- /.nav-first-level/dashboard -->
<li>
    <a href="{{ route('admin.notifications') }}">
        <i class="fa fa-bell fa-fw"></i> Notifications
        <span class="badge pull-right">{{ count($unread_notifications) }}</span>
    </a>
</li>
<!-- /.nav-first-level/notifications -->
<li>
    <a href="{{ route('bugs.index') }}">
        <i class="fa fa-bug fa-fw"></i> Bugs
    </a>
</li>
<!-- /.nav-first-level/bugs -->
<li>
    <a href="#">
        <i class="fa fa-comment-o fa-fw"></i> Chat
    </a>
</li>
<!-- /.nav-first-level/chat -->
<li>
    <a href="#">
        <i class="fa fa-inbox fa-fw"></i> Personal Inbox
    </a>
</li>
<!-- /.nav-first-level/Personal Inbox -->
<li>
    <a href="#"><i class="fa fa-envelope-square"></i> Contact
        <span class="fa arrow"></span>
    </a>
    <ul class="nav nav-second-level">
        <li>
            <a href="{{ route('admin.contact.messages', ['sort' => 'unread']) }}">
                Unread
            </a>
        </li>
        <li>
            <a href="{{ route('admin.contact.messages', ['sort' => 'read']) }}">
                Read
            </a>
        </li>
        <li>
            <a href="{{ route('admin.contact.messages', ['sort' => 'trashed']) }}">
                Trashed
            </a>
        </li>
        <li>
            <a href="{{ route('admin.contact.messages', ['sort' => 'all']) }}">
                All
            </a>
        </li>
    </ul>
    <!-- /.nav-second-level -->
</li>
<!-- /.nav-first-level/Emails -->
<li>
    <a href="#"><i class="fa fa-book fa-fw"></i> Manuals
        <span class="fa arrow"></span>
    </a>
    <ul class="nav nav-second-level">
        <li>
            <a href="{{ route('manual.create') }}">Create New</a>
        </li>
        <li>
            <a href="{{ route('manual.index') }}">All</a>
        </li>
    </ul>
    <!-- /.nav-second-level -->
</li>
<li>
    <a href="#"><i class="fa fa-users fa-fw"></i> Users
        <span class="fa arrow"></span>
    </a>
    <ul class="nav nav-second-level">
        <li>
            <a href="#new">Add New</a>
        </li>
        <li>
            <a href="{{ route('admin.users') }}">All Users</a>
        </li>
    </ul>
    <!-- /.nav-second-level -->
</li>
<li>
    <a href="#"><i class="fa fa-product-hunt fa-fw"></i> Apps<span class="fa arrow"></span></a>
    <ul class="nav nav-second-level">
        <li>
            <a href="{{ route('admin.app.create') }}">Add new</a>
        </li>
        <li>
            <a href="{{ route('admin.apps', ['sort' => 'active']) }}">Active</a>
        </li>
        <li>
            <a href="{{ route('admin.apps', ['sort' => 'disabled']) }}">Disabled</a>
        </li>
        <li>
            <a href="{{ route('admin.apps', ['sort' => 'trashed']) }}">Trashed</a>
        </li>
        <li>
            <a href="{{ route('admin.apps', ['sort' => 'all']) }}">View all</a>
        </li>
    </ul>
    <!-- /.nav-second-level -->
</li>
<!-- /.nav-first-level -->
<li class="hidden">
    <a href="#"><i class="fa fa-sitemap fa-fw"></i> Multi-Level Dropdown<span
                class="fa arrow"></span></a>
    <ul class="nav nav-second-level">
        <li>
            <a href="#">Second Level Item</a>
        </li>
        <li>
            <a href="#">Second Level Item</a>
        </li>
        <li>
            <a href="#">Third Level <span class="fa arrow"></span></a>
            <ul class="nav nav-third-level">
                <li>
                    <a href="#">Third Level Item</a>
                </li>
                <li>
                    <a href="#">Third Level Item</a>
                </li>
                <li>
                    <a href="#">Third Level Item</a>
                </li>
                <li>
                    <a href="#">Third Level Item</a>
                </li>
            </ul>
            <!-- /.nav-third-level -->
        </li>
    </ul>
    <!-- /.nav-second-level -->
</li>
<!-- /.nav-first-level -->
