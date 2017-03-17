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
            <a class="navbar-brand" href="{{ route('home') }}">{{ config('app.name') }}</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
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

                            <!-- Estate panel option -->
                            {{--<li><a href="{{ route('estate.dashboard') }}" title="estate dashboard">Estates dashboard</a></li>--}}

                                    <!-- Tenant panel option -->
                            {{--<li><a href="tenants/dashboard.html" title="tenant dashboard">Tenants dashboard</a></li>--}}

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
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                    </li>

                @else
                    <li class="{{ ActivePage('register') }}">
                        <a href="{{ route('register') }}">Sign Up</a>
                    </li>
                    <li class="{{ ActivePage('login') }}">
                        <a href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="{{ ActivePage('password.reset') }}">
                        <a href="{{ route('password.reset') }}">Forgot password?</a>
                    </li>
                @endif

            </ul>
            <ul class="nav navbar-nav navbar-right">
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
