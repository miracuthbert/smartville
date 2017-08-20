<div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="{{ route('rental.dashboard', [$app]) }}">
        <small>
            <span class="hidden-xs">{{ $app->product->title }} | </span>{{ $app->company->title }}
        </small>
    </a>
</div>
<!-- /.navbar-header -->

<ul class="nav navbar-top-links navbar-right">
    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            <i class="fa fa-envelope fa-fw"></i> <i class="fa fa-caret-down"></i>
        </a>
        <ul class="dropdown-menu dropdown-messages">
            <li>
                <a class="text-center" href="#">
                    <strong>Coming soon</strong>
                    <i class="fa fa-hourglass-o"></i>
                </a>
            </li>
        </ul>
        <!-- /.dropdown/messages -->
    </li>
    <!-- /.dropdown -->
    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            <i class="fa fa-tasks fa-fw"></i> <i class="fa fa-caret-down"></i>
        </a>
        <ul class="dropdown-menu dropdown-tasks">
            <li>
                <a class="text-center" href="#">
                    <strong>Coming soon</strong>
                    <i class="fa fa-hourglass-o"></i>
                </a>
            </li>
        </ul>
        <!-- /.dropdown-tasks -->
    </li>
    <!-- /.dropdown/tasks -->
    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            <span class="badge">{{ count($app->unreadNotifications) > 0 ? count($app->unreadNotifications) : '' }}</span>
            <i class="fa fa-bell fa-fw"></i> <i class="fa fa-caret-down"></i>
        </a>
        <ul class="dropdown-menu dropdown-alerts">
            @forelse(collect($app->notifications)->splice(0, 6) as $notification)
                @if(ToggleRead($notification->data['type']))
                    <li class="{{ $notification->read_at == null ? 'active' : '' }}">
                        <a href="{{ NotificationEstateRoute($notification, $app) }}">
                            <div>
                                <i class="fa {{ NotificationIcon($notification->data['type']) }} fa-fw"></i>
                                <strong class="small">
                                    {{ str_limit($notification->data['title'], 35) }}
                                </strong>
                            </div>
                            <div class="clearfix">
                                <div class="pull-right {{ $notification->read_at != null ? 'text-muted' : '' }} small">
                                    {{ $notification->created_at->diffForHumans() }}
                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                @endif
            @empty
                <li class="disabled">
                    <a href="#" class="text-center">No notifications found.</a>
                </li>
                <li class="divider"></li>
            @endforelse
            <li>
                <a class="text-center" href="{{ route('rental.notifications.index', [$app]) }}">
                    <strong>See All Notifications</strong>
                    <i class="fa fa-angle-right"></i>
                </a>
            </li>
        </ul>
        <!-- /.dropdown-alerts -->
    </li>
    <!-- /.dropdown/notifications -->
    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            <span class="badge">{{ count($unread_notifications) > 0 ? count($unread_notifications) : '' }}</span>
            <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
        </a>
        <ul class="dropdown-menu dropdown-user">
            <li>
                <a href="{{ route('user.dashboard') }}">
                    <i class="fa fa-dashboard fa-fw"></i> My Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('user.dashboard', ['section' => 'apps']) }}">
                    <i class="fa fa-laptop"></i> My Apps
                </a>
            </li>
            <li>
                <a href="{{ route('user.notifications') }}">
                    <i class="fa fa-bell fa-fw"></i> Notifications
                </a>
            </li>
            <li>
                <a href="{{ route('user.profile') }}"><i class="fa fa-user fa-fw"></i> Profile</a>
            </li>
            <li class="divider"></li>
            <li>
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    <i class="fa fa-sign-out fa-fw"></i>
                    Logout
                </a>
                @include('partials.forms.logout')
            </li>
        </ul>
        <!-- /.dropdown-user -->
    </li>
    <!-- /.dropdown/user -->
</ul>
<!-- /.navbar-top-links -->