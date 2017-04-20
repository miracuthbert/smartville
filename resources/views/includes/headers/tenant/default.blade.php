<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('tenant.dashboard', ['id' => $tenant->id]) }}">
                <span class="hidden-xs">
                {{ $app->company->title }} | Tenant Panel
                </span>
                <small class="visible-xs">
                {{ $app->company->title }} | Tenant Panel
                </small>
            </a>
        </div>
        <!-- /.navbar-header -->
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
            </ul>
            <!-- /.navbar-nav -->
            <ul class="nav navbar-nav navbar-right">
                <li class="{{ ActivePage('tenant.dashboard') }}">
                    <a href="{{ route('tenant.dashboard', ['id' => $tenant->id]) }}">
                        <i class="fa fa-dashboard fa-fw"></i> Dashboard
                    </a>
                </li>
                <li class="{{ ActivePage('tenant.leases') }}">
                    <a href="{{ route('tenant.leases', ['id' => $tenant->id]) }}">
                        <i class="fa fa-pencil-square"></i> Leases
                    </a>
                </li>
                <li class="{{ ActivePage('tenant.rents') }} visible-xs">
                    <a href="{{ route('tenant.rents', ['id' => $tenant->id]) }}">
                        <i class="fa fa-credit-card-alt fa-fw"></i> Rent Invoices
                    </a>
                </li>
                <li class="{{ ActivePage('tenant.bills') }} visible-xs">
                    <a href="{{ route('tenant.bills', ['id' => $tenant->id]) }}">
                        <i class="fa fa-credit-card fa-fw"></i> Bill Invoices
                    </a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false">
                        <span class="badge">{{ count($unread_notifications) > 0 ? count($unread_notifications) : '' }}</span>
                        {{ Auth::user()->username != null ? Auth::user()->username : Auth::user()->firstname  }}
                        <i class="fa fa-user fa-fw"></i> <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="{{ route('user.dashboard') }}"><i class="fa fa-dashboard fa-fw"></i> My Dashboard</a>
                        </li>
                        <li>
                            <a href="{{ route('user.notifications') }}">
                                <i class="fa fa-bell fa-fw"></i> Notifications
                                <span class="badge pull-right">{{ count($unread_notifications) > 0 ? count($unread_notifications) : '' }}</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('user.profile') }}"><i class="fa fa-user fa-fw"></i> My Profile</a>
                        </li>
                        <li class="hidden">
                            <a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li role="separator" class="divider"></li>
                        <li>
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                <i class="fa fa-sign-out fa-fw"></i>
                                Logout
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- /.navbar-right  -->
        </div><!--/.nav-collapse -->
    </div>
</nav>
