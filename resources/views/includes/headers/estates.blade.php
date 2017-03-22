<nav class="navbar navbar-default navbar-fixed-top" id="header">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('estate.dashboard', ['id' => $app->id]) }}">
                {{ $app->company->title }}
            </a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false"><span class="hidden-xs glyphicon glyphicon-envelope"></span> Messages <span
                                class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">New</a></li>
                        <li><a href="#">Archived</a></li>
                        <li><a href="#">All </a></li>

                    </ul>
                </li>
                <li><a href="../notifications.html"><span class="hidden-xs glyphicon glyphicon-bell"></span>
                        Notifications</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="active"><a href="{{ route('estate.dashboard', ['id' => $app->id]) }}"
                                      title="my dashboard"><span
                                class="hidden-xs glyphicon glyphicon-dashboard"></span> <span class="visible-xs">My Dashboard</span></a>
                </li>

                <li><a href="{{ route('estate.settings') }}" title="settings"><span
                                class="hidden-xs glyphicon glyphicon-cog"></span>
                        <span class="visible-xs">Settings</span></a></li>

                <li>
                    <a href="{{ route('user.dashboard') }}" title="my profile">
                        <span class="hidden-xs glyphicon glyphicon-user"></span>
                        <span class="visible-xs">Profile</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('user.notifications') }}">Notifications
                        <span class="badge">{{ count($unread_notifications) }}</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                       title="my store">Logout
                    </a>
                </li>

            </ul>
            <!-- Search form -->
            <form class="navbar-form navbar-right" role="search">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search">
                </div>
                <button type="submit" class="btn btn-default"><span class="hidden-xs glyphicon glyphicon-search"></span>
                    <span class="visible-xs">Search</span></button>
            </form>
        </div><!--/.nav-collapse -->
    </div>
</nav>

<div class="container-fluid">
    <div class="row row-offcanvas row-offcanvas-left">
        <div class="col-xs-6 col-sm-2 sidebar-offcanvas default-sidebar" id="sidebar">
            <nav class="">
                <ul class="nav nav-sidebar">
                    <li class="active"><a href="{{ route('estate.dashboard', ['id' => $app->id]) }}">Overview <span
                                    class="sr-only">(current)</span></a>
                    </li>
                    <li><a href="#"><span class="hidden-xs glyphicon glyphicon-bell"></span>
                            Notifications</a></li>
                    <li><a href="#"><span class="hidden-xs glyphicon glyphicon-envelope"></span> Messages</a></li>
                    <li><a href="#">Bookings</a></li>
                    <li><a href="#">Appointments</a></li>
                    <li role="separator" class="nav-divider"></li>
                </ul>

                <ul class="nav nav-sidebar">
                    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                            aria-haspopup="true" aria-expanded="false">Quick Settings <span
                                    class="caret pull-right"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="">Add amenities</a></li>
                            <li><a href="">Create bill invoice</a></li>
                            <li><a href="">Amenities</a></li>
                            <li><a href="">Bill settings</a></li>
                        </ul>
                    </li>

                    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                            aria-haspopup="true" aria-expanded="false">Groups <span
                                    class="caret pull-right"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ route('estate.group.add') }}">Add property group</a></li>
                            <li><a href="{{ route('estate.groups.index', ['id' => $app->id]) }}">Groups</a></li>
                        </ul>
                    </li>

                    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                            aria-haspopup="true" aria-expanded="false">Properties <span
                                    class="caret pull-right"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ route('estate.property.add') }}">Add property</a></li>
                            <li><a href="{{ route('estate.properties', ['id' => $app->id]) }}">Properties</a></li>
                        </ul>
                    </li>

                    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                            aria-haspopup="true" aria-expanded="false">Tenants <span
                                    class="caret pull-right"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ route('estate.tenant.add') }}">Add tenant</a></li>
                            <li><a href="{{ route('estate.tenants', ['id' => $app->id]) }}">Tenants</a></li>
                        </ul>
                    </li>

                    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                            aria-haspopup="true" aria-expanded="false">Rent <span
                                    class="caret pull-right"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ route('estate.rent.add') }}">Add tenant rent</a></li>
                            <li><a href="{{ route('estate.rents', ['id' => $app->id]) }}">Rent</a></li>
                        </ul>
                    </li>

                    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                            aria-haspopup="true" aria-expanded="false">Bills <span
                                    class="caret pull-right"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="add-tenant-bill.html">Add tenant bill</a></li>
                            <li><a href="records.html">Bills</a></li>
                        </ul>
                    </li>
                </ul>

                <ul class="nav nav-sidebar">
                    <li><a href="#">Support</a></li>

                    <li><a href="{{ route('estate.profile') }}">Profile</a></li>

                    <li><a href="{{ route('estate.settings') }}">Settings</a></li>
                </ul>
        </div>

        <div class="col-xs-12 col-sm-10 main">
            <p class=" clearfix visible-xs">
                <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
            </p>