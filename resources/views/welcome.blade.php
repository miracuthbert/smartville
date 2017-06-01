<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            display: table;
            width: 100%;
            height: 100%;
            min-height: 100%;
        }

        .full-height-inner {
            display: table-cell;
            vertical-align: middle;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            padding: 20px;
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links a, .nav > li > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .nav > li > a {
            padding: 15px 25px;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

        .masthead, .mastfoot, .cover-container {
            width: 100%;
        }

        .masthead {
            position: fixed;
            top: 0;
        }

        .masthead {
            margin-bottom: 2rem;
        }

        .navbar-default {
            border-bottom: 0;
        }
    </style>
</head>
<body>
<div class="full-height">
    <div class="full-height-inner">
        <nav class="navbar navbar-default navbar-static-top masthead">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                            data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Smart Diary') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    @if (Route::has('login'))
                        <ul class="nav navbar-nav navbar-right">
                            @if (Auth::guest())
                                <li class="{{ ActivePage('login') }}">
                                    <a href="{{ route('login') }}">Login <i class="fa fa-sign-in"></i></a>
                                </li>
                                <li class="{{ ActivePage('register') }}">
                                    <a href="{{ route('register') }}">Sign Up <i class="fa fa-user-plus"></i></a>
                                </li>
                            @else
                                <li>
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                       aria-haspopup="true"
                                       aria-expanded="false">
                                        <span class="badge">{{ count($unread_notifications) > 0 ? count($unread_notifications) : '' }}</span>
                                        {{ Auth::user()->username != null ? Auth::user()->username : Auth::user()->firstname  }}
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
                            @endif
                        </ul>
                    @endif
                </div>
            </div>
        </nav><!-- /.navbar-default.masthead -->
        <div class="position-ref">
            <div class="content">
                <div class="title m-b-md">
                    {{ config('app.name') }}
                </div>

                <div class="nav nav-justified links">
                    <li>
                        <a href="{{ route('manuals.index') }}">Documentation</a>
                    </li>
                    <li>
                        <a href="{{ route('services') }}">Apps & Services</a>
                    </li>
                    <li>
                        <a href="{{ route('forum.index') }}">Knowledge Base</a>
                    </li>
                    <li>
                        <a href="{{ route('contact') }}">Contact Us</a>
                    </li>
                    <li>
                        <a href="{{ route('support.index') }}">Support Center</a>
                    </li>
                </div>
            </div><!-- /.content -->
        </div><!-- /.position-ref -->
    </div><!-- /.full-height-inner -->
</div><!-- /.full-height -->

<!-- Scripts -->
<script src="/js/demo_app.js"></script>

</body><!-- /body -->
</html>