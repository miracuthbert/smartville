<div class="navbar-header">
    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
            aria-expanded="false" aria-controls="navbar">
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
                {{ Auth::user()->username != null ? Auth::user()->username : Auth::user()->firstname  }}
                <span class="fa fa-user"></span>
                <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a href="{{ route('user.dashboard') }}" title="my dashboard">My dashboard</a>
                </li>

                <!-- Admin panel option -->
                @if(Auth::user()->root or Auth::user()->admin)
                    <li>
                        <a href="{{ route('admin.dashboard')  }}" title="admin panel">Admin panel</a>
                    </li>
                @endif

                <li>
                    <a href="{{ route('user.profile') }}" title="my profile">Profile</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="{{ route('logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Logout
                <i class="fa fa-sign-out"></i>
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
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->
