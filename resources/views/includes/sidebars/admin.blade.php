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
        <span class="badge pull-right">{{ count($unread_notifications) > 0 ? count($unread_notifications) : '' }}</span>
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
    <a href="#"><i class="fa fa-universal-access fa-fw"></i> Roles
        <span class="fa arrow"></span>
    </a>
    <ul class="nav nav-second-level">
        <li>
            <a href="{{ route('roles.create') }}">Add New</a>
        </li>
        <li>
            <a href="{{ route('roles.index', ['role' => "site-admin"]) }}">Site Admins</a>
        </li>
        <li>
            <a href="{{ route('roles.index') }}">Roles</a>
        </li>
    </ul>
    <!-- /.nav-second-level -->
</li><!-- /roles -->
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
</li><!-- /users -->
<li>
    <a href="#"><i class="fa fa-sort-alpha-asc fa-fw"></i> Categories
        <span class="fa arrow"></span>
    </a>
    <ul class="nav nav-second-level">
        <li>
            <a href="{{ route('category.create') }}">Create New</a>
        </li>
        <li>
            <a href="{{ route('category.index') }}">All</a>
        </li>
    </ul><!-- /.nav-second-level -->
</li><!-- /categories -->
<li>
    <a href="#"><i class="fa fa-credit-card fa-fw"></i> Subscriptions
        <span class="fa arrow"></span>
    </a>
    <ul class="nav nav-second-level">
        <li>
            <a href="{{ route('admin_company_app.index', ['sort' => 'subscriptions']) }}">
                Paid Subscriptions
            </a>
        </li>
        <li>
            <a href="{{ route('admin_company_app.index', ['sort' => 'trials']) }}">
                Trial Subscriptions
            </a>
        </li>
    </ul>
    <!-- /.nav-second-level -->
</li><!-- /subscriptions -->
<li>
    <a href="#"><i class="fa fa-globe fa-fw"></i> Companies
        <span class="fa arrow"></span>
    </a>
    <ul class="nav nav-second-level">
        <li>
            <a href="{{ route('admin_company.index') }}">All</a>
        </li>
    </ul><!-- /.nav-second-level -->
</li><!-- /companies -->
<li>
    <a href="#"><i class="fa fa-laptop fa-fw"></i> Company Apps
        <span class="fa arrow"></span>
    </a>
    <ul class="nav nav-second-level">
        <li>
            <a href="{{ route('admin_company_app.index', ['sort' => 'subscribed', 'on_trial' => 1]) }}">
                On Trial
            </a>
        </li>
        <li>
            <a href="{{ route('admin_company_app.index', ['sort' => 'subscribed', 'on_trial' => 0]) }}">
                Normal Subscriptions
            </a>
        </li>
        <li>
            <a href="{{ route('admin_company_app.index') }}">All</a>
        </li>
    </ul>
    <!-- /.nav-second-level -->
</li><!-- /company apps -->
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
</li><!-- /apps -->
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
</li><!-- /docs -->
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
</li><!-- /.nav-first-level -->
