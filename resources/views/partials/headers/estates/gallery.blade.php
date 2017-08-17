<nav class="navbar navbar-default navbar-fixed-top navbar-custom-light" id="header-light">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('home') }}">
                {{ config('app.name') }} | {{ $app->company->title }}
            </a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                @if(Auth::check())
                    <li>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                           aria-expanded="false">
                            <span class="badge">{{ count($unread_notifications) > 0 ? count($unread_notifications) : '' }}</span>
                            <span class="sr-only">
                                {{ Auth::user()->username != null ? Auth::user()->username : Auth::user()->firstname  }}</span>
                            <span class="fa fa-user"></span>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="{{ route('user.dashboard') }}" title="my dashboard">
                                    <i class="fa fa-dashboard fa-fw"></i> My dashboard</a>
                            </li>
                            <!-- user dashboard -->

                            <li>
                                <a href="{{ route('user.dashboard', ['section' => 'apps']) }}">
                                    <i class="fa fa-laptop"></i> My Apps
                                </a>
                            </li>
                            <!-- user apps -->

                            <li>
                                <a href="{{ route('user.notifications') }}" title="notifications">
                                    <i class="fa fa-bell fa-fw"></i> Notifications <span
                                            class="badge">{{ count($unread_notifications) > 0 ? count($unread_notifications) : '' }}</span>
                                </a>
                            </li>
                            <!-- notifications -->

                            @if(Auth::user()->root or Auth::user()->admin)
                                <li>
                                    <a href="{{ route('admin.dashboard')  }}" title="admin panel">
                                        <i class="fa fa-tachometer fa-fw"></i> Admin panel
                                    </a>
                                </li>
                                <!-- Admin panel option -->
                            @endif

                            <li>
                                <a href="{{ route('user.profile') }}" title="my profile">
                                    <i class="fa fa-user fa-fw"></i> Profile
                                </a>
                            </li>
                            <!-- profile -->
                            <li role="separator" class="divider"></li>
                            <li>
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fa fa-sign-out fa-fw"></i> Logout
                                </a>
                            </li>
                        </ul>
                    </li>

                @else
                    <li class="{{ ActivePage('register') }}">
                        <a href="{{ route('register') }}">Sign Up <i class="fa fa-user-plus"></i></a>
                    </li>
                    <li class="{{ ActivePage('login') }}">
                        <a href="{{ route('login') }}">Login <i class="fa fa-sign-in"></i></a>
                    </li>
                    {{--<li class="{{ ActivePage('password.reset') }}">--}}
                    {{--<a href="{{ route('password.reset') }}">Forgot password?</a>--}}
                    {{--</li>--}}
                @endif

            </ul>
            <!-- user & login options -->

            <ul class="nav navbar-nav navbar-right">
                @can('view', $app)
                <li>
                    <a href="{{ route('estate.rental.property.edit', ['id' => $property->id]) }}"
                       title="Return to property">
                        <i class="fa fa-home fa-fw"></i>
                    </a>
                </li>
                <!-- go to property -->

                <li>
                    <a href="{{ route('estate.rental.dashboard', ['id' => $app->id]) }}">
                        <i class="fa fa-dashboard fa-fw"></i>
                    </a>
                </li>
                <!-- estate dashboard -->

                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <span class="badge">{{ count($app->unreadNotifications) > 0 ? count($app->unreadNotifications) : '' }}</span>
                        <i class="fa fa-bell fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        @forelse(collect($app->notifications)->splice(0, 10) as $notification)
                            @if(ToggleRead($notification->data['type']))
                                <li class="{{ $notification->read_at == null ? 'active' : '' }}">
                                    <a href="{{ NotificationEstateRoute($notification, $app) }}">
                                        <div>
                                            <i class="fa {{ NotificationIcon($notification->data['type']) }} fa-fw"></i>
                                        <span class="small">
                                            {{ str_limit($notification->data['title'], 30) }}
                                        </span>
                                        <span class="pull-right {{ $notification->read_at != null ? 'text-muted' : '' }} small">
                                            {{ $notification->created_at->diffForHumans() }}
                                        </span>
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
                            <a class="text-center"
                               href="{{ route('estate.rental.notifications', ['id' => $app->id]) }}">
                                <strong>See All Notifications</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-alerts -->
                </li>
                <!-- /.dropdown/notifications -->
                @endcan
            </ul>

            <!-- Search form -->
            <form class="navbar-form navbar-right hidden" role="search">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search">
                </div>
                <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
            </form>
        </div><!--/.nav-collapse -->
    </div>
</nav>
