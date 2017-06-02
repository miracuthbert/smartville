<li class="sidebar-search hidden">
    <div class="input-group custom-search-form">
        <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
    </div>
    <!-- /input-group -->
</li><!-- /.sidebar-search -->
<li class="visible-xs">
    <a href="#">
        <i class="fa fa-user fa-fw"></i> {{ Auth::user()->username != null ? Auth::user()->username : Auth::user()->firstname  }}
        <span class="badge">{{ count($unread_notifications) > 0 ? count($unread_notifications) : '' }}</span>
        <i class="fa arrow"></i>
    </a>
    <ul class="nav nav-second-level">
        <li>
            <a href="{{ route('user.dashboard') }}">
                <i class="fa fa-dashboard fa-fw"></i> My Dashboard
            </a>
        </li>
        <!-- user dashboard -->
        <li>
            <a href="{{ route('user.dashboard', ['section' => 'apps']) }}">
                <i class="fa fa-laptop fa-fw"></i> My Apps
            </a>
        </li>
        <!-- user apps -->
        <li>
            <a href="{{ route('user.notifications') }}">
                <i class="fa fa-bell fa-fw"></i> Notifications <span
                        class="badge pull-right">{{ count($unread_notifications) > 0 ? count($unread_notifications) : '' }}</span>
            </a>
        </li>
        <!-- user notifications -->
        <li>
            <a href="{{ route('user.profile') }}"><i class="fa fa-user fa-fw"></i> Profile</a>
        </li>
        <!-- user profile -->
        {{--<li>--}}
        {{--<a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>--}}
        {{--</li>--}}
        <li class="divider"></li>
        <li>
            <a href="{{ route('logout') }}"
               onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                <i class="fa fa-sign-out fa-fw"></i>
                Logout
            </a>
        </li>
    </ul>
    <!-- /.dropdown-user -->
</li><!-- /.dropdown-user -->
<li>
    <a href="{{ route('estate.rental.dashboard', ['id' => $app->id]) }}">
        <i class="fa fa-dashboard fa-fw"></i> Dashboard
    </a>
</li><!-- /dashboard -->
<li class="visible-xs">
    <a href="#">
        <i class="fa fa-envelope fa-fw"></i>
        Messages
        <i class="fa arrow"></i>
    </a>
    <ul class="nav nav-second-level">
        <li>
            <a href="#">
                <strong>Coming soon</strong>
            </a>
        </li>
    </ul>
    <!-- /.dropdown-messages -->
</li><!-- /.dropdown-messages -->
<li class="visible-xs">
    <a href="#">
        <i class="fa fa-tasks fa-fw"></i>
        Tasks
        <i class="fa arrow"></i>
    </a>
    <ul class="nav nav-second-level">
        <li>
            <a href="#">
                <strong>Coming soon</strong>
            </a>
        </li>
    </ul>
    <!-- /.dropdown-tasks -->
</li><!-- /.dropdown-tasks -->
<li>
    <a href="{{ route('estate.rental.notifications', ['id' => $app->id]) }}">
        <i class="fa fa-bell fa-fw"></i>
        Notifications
        <span class="badge pull-right">{{ count($app->unreadNotifications)> 0 ? count($app->unreadNotifications) : '' }}</span>
    </a>
</li><!-- /notifications -->
<li>
    <a href="{{ route('estate.rental.profile', ['id' => $app->id]) }}" title="App Profile">
        <i class="fa fa-product-hunt fa-fw"></i>
        Profile
    </a>
</li><!-- /app profile -->
<li>
    <a href="{{ route('estate.rental.settings', ['id' => $app->id]) }}" title="App Settings">
        <i class="fa fa-cog fa-fw"></i>
        Settings
    </a>
</li><!-- /settings -->
<li>
    <a href="#">
        <i class="fa fa-cogs fa-fw"></i> Quick Settings
        <span class="fa arrow"></span>
    </a>
    <ul class="nav nav-second-level">
        <li>
            <a href="{{ route('estate.rental.amenity.create', ['id' => $app->id]) }}">Add amenity</a>
        </li>
        <li>
            <a href="{{ route('estate.rental.bills.service.add', ['id' => $app->id]) }}">Add billing
                service</a>
        </li>
        <li>
            <a href="{{ route('estate.rental.amenities', ['id' => $app->id]) }}">Amenities</a>
        </li>
        <li>
            <a href="{{ route('estate.rental.bills.services', ['id' => $app->id, 'sort' => 'all']) }}">Billing
                services</a>
        </li>
    </ul>
    <!-- /.nav-second-level -->
</li><!-- /quick-settings -->
<li>
    <a href="#">
        <i class="fa fa-building fa-fw"></i> Property Groups
        <span class="fa arrow"></span>
    </a>
    <ul class="nav nav-second-level">
        <li>
            <a href="{{ route('estate.rental.group.add', ['id' => $app->id]) }}">Add property group</a>
        </li>
        <li>
            <a href="{{ route('estate.rental.groups.index', ['id' => $app->id, 'sort' => 'all']) }}">Groups</a>
        </li>
    </ul>
    <!-- /.nav-second-level -->
</li><!-- /property-groups -->
<li>
    <a href="#">
        <i class="fa fa-home fa-fw"></i> Properties
        <span class="fa arrow"></span>
    </a>
    <ul class="nav nav-second-level">
        <li>
            <a href="{{ route('estate.rental.property.add', ['id' => $app->id]) }}">Add property</a>
        </li>
        <li>
            <a href="{{ route('estate.rental.properties', ['id' => $app->id, 'sort' => 'all']) }}">Properties</a>
        </li>
    </ul>
    <!-- /.nav-second-level -->
</li><!-- /properties -->
<li>
    <a href="#">
        <i class="fa fa-users fa-fw"></i> Tenants
        <span class="fa arrow"></span>
    </a>
    <ul class="nav nav-second-level">
        <li>
            <a href="{{ route('estate.rental.tenant.add', ['id' => $app->id]) }}">Add tenant</a>
        </li>
        <li>
            <a href="{{ route('estate.rental.tenants', ['id' => $app->id, 'sort' => 'all']) }}">Tenants</a>
        </li>
        <li>
            <a href="{{ route('estate.rental.tenants', ['id' => $app->id, 'sort' => 'all', 'leases' => 1]) }}">
                Tenant Leases
            </a>
        </li>
    </ul>
    <!-- /.nav-second-level -->
</li><!-- /tenants -->
<li>
    <a href="#">
        <i class="fa fa-credit-card fa-fw"></i> Rent
        <span class="fa arrow"></span>
    </a>
    <ul class="nav nav-second-level">
        <li>
            <a href="{{ route('estate.rental.rent.add', ['id' => $app->id]) }}">Create rent invoices</a>
        </li>
        <li>
            <a href="{{ route('estate.rental.rents', ['id' => $app->id, 'sort' => 'all']) }}">Rent
                Invoices</a>
        </li>
    </ul>
    <!-- /.nav-second-level -->
</li><!-- /rent -->
<li>
    <a href="#">
        <i class="fa fa-credit-card-alt fa-fw"></i> Bills
        <span class="fa arrow"></span>
    </a>
    <ul class="nav nav-second-level">
        <li>
            <a href="{{ route('estate.rental.bills.generate', ['id' => $app->id]) }}">Create bill invoices</a>
        </li>
        <li>
            <a href="{{ route('estate.rental.bills.tenants', ['id' => $app->id, 'sort' => 'all']) }}">Bill
                Invoices</a>
        </li>
    </ul>
    <!-- /.nav-second-level -->
</li><!-- /bills -->
{{--<li>--}}
{{--<a href="#"><i class="fa fa-link fa-fw"></i> Quick Links<span class="fa arrow"></span></a>--}}
{{--<ul class="nav nav-second-level">--}}
{{--<li>--}}
{{--<a href="#">Support</a>--}}
{{--</li>--}}

{{--<li>--}}
{{--<a href="{{ route('estate.rental.settings', ['id' => $app->id]) }}">Settings</a>--}}
{{--</li>--}}
{{--</ul>--}}
{{--<!-- /.nav-second-level -->--}}
{{--</li>--}}
