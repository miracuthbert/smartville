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
</li>
<li>
    <a href="{{ route('estate.dashboard', ['id' => $app->id]) }}">
        <i class="fa fa-dashboard fa-fw"></i> Dashboard
    </a>
</li>
<li>
    <a href="{{ route('estate.notifications', ['id' => $app->id]) }}">
        <i class="fa fa-bell fa-fw"></i>
        Notifications
        <span class="badge pull-right">{{ count($app->unreadNotifications) }}</span>
    </a>
</li>
<li>
    <a href="{{ route('estate.profile', ['id' => $app->id]) }}" title="Estate Profile">
        <i class="fa fa-product-hunt fa-fw"></i>
        Profile
    </a>
</li>
<li>
    <a href="{{ route('estate.settings', ['id' => $app->id]) }}">
        <i class="fa fa-cog fa-fw"></i>
        Setting
    </a>
</li>
<li>
    <a href="#">
        <i class="fa fa-cogs fa-fw"></i> Quick Settings
        <span class="fa arrow"></span>
    </a>
    <ul class="nav nav-second-level">
        <li>
            <a href="{{ route('estate.amenities', ['id' => $app->id]) }}">Add amenities</a>
        </li>
        <li>
            <a href="{{ route('estate.bills.service.add', ['id' => $app->id]) }}">Add billing
                service</a>
        </li>
        <li>
            <a href="{{ route('estate.amenities', ['id' => $app->id]) }}">Amenities</a>
        </li>
        <li>
            <a href="{{ route('estate.bills.services', ['id' => $app->id, 'sort' => 'all']) }}">Billing
                services</a>
        </li>
    </ul>
    <!-- /.nav-second-level -->
</li>
<li>
    <a href="#">
        <i class="fa fa-building fa-fw"></i> Property Groups
        <span class="fa arrow"></span>
    </a>
    <ul class="nav nav-second-level">
        <li>
            <a href="{{ route('estate.group.add', ['id' => $app->id]) }}">Add property group</a>
        </li>
        <li>
            <a href="{{ route('estate.groups.index', ['id' => $app->id, 'sort' => 'all']) }}">Groups</a>
        </li>
    </ul>
    <!-- /.nav-second-level -->
</li>
<li>
    <a href="#">
        <i class="fa fa-home fa-fw"></i> Properties
        <span class="fa arrow"></span>
    </a>
    <ul class="nav nav-second-level">
        <li>
            <a href="{{ route('estate.property.add', ['id' => $app->id]) }}">Add property</a>
        </li>
        <li>
            <a href="{{ route('estate.properties', ['id' => $app->id, 'sort' => 'all']) }}">Properties</a>
        </li>
    </ul>
    <!-- /.nav-second-level -->
</li>
<li>
    <a href="#">
        <i class="fa fa-users fa-fw"></i> Tenants
        <span class="fa arrow"></span>
    </a>
    <ul class="nav nav-second-level">
        <li>
            <a href="{{ route('estate.tenant.add', ['id' => $app->id]) }}">Add tenant</a>
        </li>
        <li>
            <a href="{{ route('estate.tenants', ['id' => $app->id, 'sort' => 'all']) }}">Tenants</a>
        </li>
    </ul>
    <!-- /.nav-second-level -->
</li>
<li>
    <a href="#">
        <i class="fa fa-credit-card fa-fw"></i> Rent
        <span class="fa arrow"></span>
    </a>
    <ul class="nav nav-second-level">
        <li>
            <a href="{{ route('estate.rent.add', ['id' => $app->id]) }}">Add rent invoices</a>
        </li>
        <li>
            <a href="{{ route('estate.rents', ['id' => $app->id, 'sort' => 'all']) }}">Rent
                Invoices</a>
        </li>
    </ul>
    <!-- /.nav-second-level -->
</li>
<li>
    <a href="#">
        <i class="fa fa-credit-card-alt fa-fw"></i> Bills
        <span class="fa arrow"></span>
    </a>
    <ul class="nav nav-second-level">
        <li>
            <a href="{{ route('estate.bills.generate', ['id' => $app->id]) }}">Add bill invoices</a>
        </li>
        <li>
            <a href="{{ route('estate.bills.tenants', ['id' => $app->id, 'sort' => 'all']) }}">Bill
                Invoices</a>
        </li>
    </ul>
    <!-- /.nav-second-level -->
</li>
{{--<li>--}}
{{--<a href="#"><i class="fa fa-link fa-fw"></i> Quick Links<span class="fa arrow"></span></a>--}}
{{--<ul class="nav nav-second-level">--}}
{{--<li>--}}
{{--<a href="#">Support</a>--}}
{{--</li>--}}

{{--<li>--}}
{{--<a href="{{ route('estate.settings', ['id' => $app->id]) }}">Settings</a>--}}
{{--</li>--}}
{{--</ul>--}}
{{--<!-- /.nav-second-level -->--}}
{{--</li>--}}
