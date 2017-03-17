<nav data-spy="affix" data-offset-top="70" class="navbar navbar-default navbar-static-top navbar-custom" id="header">
    <div class="container">
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
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                @if(Auth::check())

                    <li>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                           aria-expanded="false">
                            <span class="small">
                                {{ Auth::user()->username != null ? Auth::user()->username : Auth::user()->firstname  }}
                            </span>
                            <span class="glyphicon glyphicon-user"></span>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('user.dashboard') }}" title="my dashboard">My dashboard</a></li>

                            <!-- Estate panel option -->
                            {{--<li><a href="{{ route('estate.dashboard') }}" title="estate dashboard">Estates dashboard</a></li>--}}

                                    <!-- Tenant panel option -->
                            {{--<li><a href="tenants/dashboard.html" title="tenant dashboard">Tenants dashboard</a></li>--}}

                                    <!-- Admin panel option -->
                            @if(Auth::user()->root or Auth::user()->admin)
                                <li><a href="{{ route('admin.dashboard')  }}" title="admin panel">Admin panel</a></li>
                            @endif

                            <li><a href="{{ route('user.profile') }}" title="my profile">Profile</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                    </li>

                @else
                    <li><a href="{{ route('register') }}">Sign Up</a></li>
                    <li><a href="{{ route('login') }}">Login</a></li>
                    <li><a href="{{ route('password.reset') }}">Forgot password?</a></li>
                @endif

            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>
