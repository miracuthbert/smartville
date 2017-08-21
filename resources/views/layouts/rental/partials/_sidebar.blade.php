<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
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
            <li>
                <a href="{{ route('rental.dashboard', [$app]) }}">
                    <i class="fa fa-dashboard fa-fw"></i> Dashboard
                </a>
            </li><!-- /dashboard -->
            <li>
                <a href="{{ route('rental.notifications.index', [$app]) }}">
                    <i class="fa fa-bell fa-fw"></i>
                    Notifications
                    <sup class="badge">{{ count($app->unreadNotifications)> 0 ? count($app->unreadNotifications) : '' }}</sup>
                </a>
            </li><!-- /notifications -->
            <li>
                <a href="{{ route('rental.profile', [$app]) }}" title="App Profile">
                    <i class="fa fa-laptop fa-fw"></i>
                    Profile
                </a>
            </li><!-- /app profile -->
            <li>
                <a href="{{ route('rental.settings', [$app]) }}" title="App Settings">
                    <i class="fa fa-cogs fa-fw"></i>
                    Settings
                </a>
            </li><!-- /settings -->
            <li>
                <a href="#">
                    <i class="fa fa-th-large fa-fw"></i> Amenities
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ route('rental.amenities.create', [$app]) }}">Add amenity</a>
                    </li>
                    <li>
                        <a href="{{ route('rental.amenities.index', [$app]) }}">Amenities</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li><!-- /quick-settings -->
            <li>
                <a href="#">
                    <i class="fa fa-cubes fa-fw"></i> Billing Services
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ route('rental.billings.create', [$app]) }}">Add billing
                            service</a>
                    </li>
                    <li>
                        <a href="{{ route('rental.billings', [$app, 'sort' => 'all']) }}">Billing Services</a>
                    </li>
                </ul><!-- /.nav-second-level -->
            </li><!-- /billing -->
            <li>
                <a href="#">
                    <i class="fa fa-home fa-fw"></i> Properties Manager
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ route('rental.groups.create', [$app]) }}">Add property group</a>
                    </li>
                    <li>
                        <a href="{{ route('rental.groups.index', [$app, 'sort' => 'all']) }}">Groups</a>
                    </li>
                    <li>
                        <a href="{{ route('rental.property.create', [$app]) }}">Add property</a>
                    </li>
                    <li>
                        <a href="{{ route('rental.properties.index', [$app, 'sort' => 'all']) }}">Properties</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li><!-- /properties -->
            <li>
                <a href="#">
                    <i class="fa fa-users fa-fw"></i> Tenants Manager
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ route('rental.tenant.create', [$app]) }}">Add tenant</a>
                    </li>
                    <li>
                        <a href="{{ route('rental.tenants.index', [$app, 'sort' => 'all']) }}">Tenants</a>
                    </li>
                    <li>
                        <a href="{{ route('rental.tenants.index', [$app, 'sort' => 'all', 'leases' => 1]) }}">Tenant
                            Leases</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li><!-- /tenants -->
            <li>
                <a href="#">
                    <i class="fa fa-credit-card-alt fa-fw"></i> Rent Manager
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ route('rental.rents.create', [$app]) }}">Create rent invoices</a>
                    </li>
                    <li>
                        <a href="{{ route('rental.rents.index', [$app, 'sort' => 'all']) }}">Rent Invoices</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li><!-- /rent -->
            <li>
                <a href="#">
                    <i class="fa fa-credit-card-alt fa-fw"></i> Bills Manager
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ route('rental.bills.generate', [$app]) }}">Create bill invoices</a>
                    </li>
                    <li>
                        <a href="{{ route('rental.bills.index', [$app, 'sort' => 'all']) }}">Bill Invoices</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li><!-- /bills -->
        </ul>
    </div><!-- /.sidebar-collapse -->
</div><!-- /.navbar-static-side -->