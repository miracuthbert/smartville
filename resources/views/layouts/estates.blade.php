<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{ url('images/site/cropped-sv_00-32x32.png') }}">

    <title>({{ count($app->unreadNotifications) > 0 ? count($app->unreadNotifications) : '' }}) @yield('title')
        | {{ $app->product->title }} - {{ config('app.name') }}</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{ url('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="{{ url('css/metisMenu.min.css') }}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ url('css/sb-admin-2.min.css') }}" rel="stylesheet">

    <link href="{{ url('css/estate.css') }}" rel="stylesheet">

    <link href="{{ url('css/v1/main.css') }}" rel="stylesheet">

    <!-- Bootstrap Social CSS -->
    <link href="{{ url('css/bootstrap-social.css') }}" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="{{ url('css/morris.css') }}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{ url('css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">

    <!-- jQuery UI CSS -->
    <link href="{{ url('css/jquery-ui.min.css') }}" rel="stylesheet">

    <link href="{{ url('css/jquery-ui.theme.min.css') }}" rel="stylesheet">

    @yield('styles')

            <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Scripts -->
    <script>
        var $token = '{{ csrf_token() }}';
    </script>

</head>

<body>

<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('estate.rental.dashboard', ['id' => $app->id]) }}">
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
                        <a class="text-center" href="{{ route('estate.rental.notifications', ['id' => $app->id]) }}">
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
                    {{--<li>--}}
                    {{--<a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>--}}
                    {{--</li>--}}
                    <li class="divider"></li>
                    <li>
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            <i class="fa fa-sign-out fa-fw"></i>
                            Logout
                        </a>
                    </li>
                </ul>
                <!-- /.dropdown-user -->
            </li>
            <!-- /.dropdown/user -->
        </ul>
        <!-- /.navbar-top-links -->

        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">
                    @include('includes.sidebars.estates')
                </ul>
            </div>
            <!-- /.sidebar-collapse -->
        </div>
        <!-- /.navbar-static-side -->

    </nav>
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <div class="top-header">
                    <nav id="breadcrumb">
                        <ul class="breadcrumb">
                            <li>{{ config('app.name') }}</li>
                            <li>{{ $app->product->title }}</li>
                            <li>{{ $app->company->title }}</li>
                            @yield('breadcrumb')
                        </ul>
                    </nav>

                    @include('includes.alerts.subscription')

                    <h1 class="page-header">@yield('page-header')</h1>
                </div>

            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        @yield('stats')
                <!-- /.stats -->
        @yield('content')
                <!-- /.content -->

        @include('includes.modals.success-modal')
        @include('includes.modals.error-modal')
        @include('includes.forms.logout')
    </div>
    <!-- /#page-wrapper -->

    @include('includes.footers.estates')
            <!-- /footer -->
</div>
<!-- /#wrapper -->

<!-- jQuery -->
<!-- Placed at the end of the document so the pages load faster -->
{{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>--}}
<script>window.jQuery || document.write('<script src="{{ url('js/jquery-2.2.1.min.js') }}"><\/script>')</script>

<!-- jQuery UI JavaScript -->
<script src="{{ url('js/jquery-ui.min.js') }}"></script>

<!-- Bootstrap Core JavaScript -->
<script src="{{ url('js/bootstrap.min.js') }}"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="{{ url('js/metisMenu.min.js') }}"></script>

<!-- Morris Charts JavaScript -->
<script src="{{ url('js/raphael.min.js') }}"></script>

<script src="{{ url('js/morris.min.js') }}"></script>
{{--<script src="{{ url('js/morris-data.js') }}"></script>--}}

        <!-- Custom Theme JavaScript -->
<script src="{{ url('js/sb-admin-2.min.js') }}"></script>

<!-- Custom Text Editor -->
<script src="{{ url('js/ckbasic/ckeditor.js') }}"></script>

<!-- Custom Js -->
<script src="{{ url('js/app.js') }}"></script>

@yield('scripts')

</body>

</html>