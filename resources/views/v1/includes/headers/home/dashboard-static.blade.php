<div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="{{ route('home') }}">{{ config('app.name') }}</a>
</div>
<!-- /.navbar-header -->

<ul class="nav navbar-top-links navbar-right">
    <li class="{{ ActivePage('home') }}">
        <a href="{{ route('home') }}">Home</a>
    </li>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
           aria-expanded="false">
            Apps &amp; Services
            <span class="caret"></span></a>
        <ul class="dropdown-menu">
            @foreach($app_products as $app)
                <li>
                    <a href="{{ route('service', ['id' => $app->id]) }}">
                        {{ $app->title }}
                    </a>
                </li>
            @endforeach

            <li role="separator" class="divider"></li>

            <li>
                <a href="{{ route('services') }}">
                    View all
                    <i class="fa fa-chevron-right fa-pull-right"></i>
                </a>
            </li>

        </ul>
    </li>
    <li>
        <a href="{{ route('about') }}" class="hidden">About</a>
    </li>
    <li class="{{ ActivePage('contact') }}">
        <a href="{{ route('contact') }}">Contact</a>
    </li>
    @if(Auth::check())
        <li>
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
               aria-expanded="false">
                <span class="badge">{{ count($unread_notifications) > 0 ? count($unread_notifications) : '' }}</span>
                {{ Auth::user()->username != null ? Auth::user()->username : Auth::user()->firstname  }}
                <i class="fa fa-user"></i>
                <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a href="{{ route('user.dashboard') }}" title="my dashboard">
                        <i class="fa fa-dashboard fa-fw"></i>
                        My dashboard
                    </a>
                </li>

                <!-- Admin panel option -->
                @if(Auth::user()->root or Auth::user()->admin)
                    <li>
                        <a href="{{ route('admin.dashboard')  }}" title="admin panel">
                            <i class="fa fa-tachometer fa-fw"></i>
                            Admin panel
                        </a>
                    </li>
                @endif

                <li>
                    <a href="{{ route('user.notifications') }}">
                        <i class="fa fa-bell fa-fw"></i>
                        Notifications <span
                                class="badge pull-right">{{ count($unread_notifications) > 0 ? count($unread_notifications) : '' }}</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('user.profile') }}" title="my profile">
                        <i class="fa fa-user fa-fw"></i>
                        Profile
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="{{ route('logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fa fa-sign-out"></i> Logout
            </a>
        </li>
    @else
        <li class="{{ ActivePage('register') }}">
            <a href="{{ route('register') }}">Sign Up <i class="fa fa-user-plus"></i></a>
        </li>
        <li class="{{ ActivePage('login') }}">
            <a href="{{ route('login') }}">Login <i class="fa fa-sign-in"></i></a>
        </li>
        {{--<li class="{{ ActivePage('password.reset') }}">--}}
        {{--<a href="{{ route('password.reset') }}">--}}
        {{--<small>Forgot password?</small>--}}
        {{--</a>--}}
        {{--</li>--}}
    @endif
</ul>
<!-- /.navbar-top-links -->

<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav in" id="side-menu">
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
                <a href="{{ route('support.index') }}">
                    <i class="fa fa-support fa-fw"></i> Support Center
                </a>
            </li>
            <li>
                <a href="{{ route('bug.create') }}">
                    <i class="fa fa-bug fa-fw"></i> Report a bug
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-book fa-fw"></i> Manuals
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level">
                    @forelse($manuals as $manual)
                        <li>
                            <a href="{{ route('manuals.show', ['manual' => $manual->url]) }}"
                               title="{{ $manual->title }}">
                                {{ str_limit($manual->title, 25) }}
                            </a>
                        </li>
                    @empty
                        <li>No manuals found.</li>
                    @endforelse
                </ul>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-question-circle-o fa-fw"></i> Forum
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ route('forum.create') }}">Post new
                            <span class="fa fa-plus pull-right"></span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('forum.index', ['forum' => Auth::user()->id, 'sort' => 'user']) }}">My posts
                            <span class="fa fa-user pull-right"></span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('forum.index') }}">Go to forum
                            <span class="fa fa-chevron-right pull-right"></span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->
