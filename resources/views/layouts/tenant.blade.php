<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{{ config('app.name') }} | {{ $app->company->title }} | Tenant Panel - @yield('title')</title>

    <!-- Main Fonts -->
    <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Roboto:400italic,700italic,700,400'>

    <!-- Font Awesome Icon Fonts -->
    <link href="{{ url('css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core CSS -->
    <link href="{{ url('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="{{ url('css/metisMenu.min.css') }}" rel="stylesheet">

    <!-- SB Admin Theme CSS -->
    <link href="{{ url('css/sb-admin-2.min.css') }}" rel="stylesheet">

    <link href="{{ url('css/tenant-light.css') }}" rel="stylesheet">

    <link href="{{ url('css/v1/main.css') }}" rel="stylesheet">

    <!-- Bootstrap Social CSS -->
    <link href="{{ url('css/bootstrap-social.css') }}" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="{{ url('css/morris.css') }}" rel="stylesheet">

    <!-- jQuery UI CSS -->
    <link href="{{ url('css/vendor/jquery-ui.min.css') }}" rel="stylesheet">

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
            <a class="navbar-brand" href="{{ route('tenant.dashboard', ['id' => $tenant->id]) }}">
                {{ $app->company->title }} | Tenant Panel
                <small>
                    <em>powered by {{ config('app.name') }}</em>
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
                <!-- /.dropdown-messages -->
            </li>
            <!-- /.dropdown -->
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <span class="badge">{{ count($unread_notifications) > 0 ? count($unread_notifications) : '' }}</span>
                    <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li>
                        <a href="{{ route('user.dashboard') }}"><i class="fa fa-dashboard fa-fw"></i> User Dashboard</a>
                    </li>
                    <li>
                        <a href="{{ route('user.notifications') }}">
                            <i class="fa fa-bell fa-fw"></i> Notifications
                            <span class="badge pull-right">{{ count($unread_notifications) > 0 ? count($unread_notifications) : '' }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('user.profile') }}"><i class="fa fa-user fa-fw"></i> User Profile</a>
                    </li>
                    <li class="hidden">
                        <a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                    </li>
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
            <!-- /.dropdown -->
        </ul>
        <!-- /.navbar-top-links -->

        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">
                    <li class="sidebar-search hidden">
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
                        <a href="{{ route('tenant.dashboard', ['id' => $tenant->id]) }}">
                            <i class="fa fa-dashboard fa-fw"></i> Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('tenant.rents', ['id' => $tenant->id]) }}">
                            <i class="fa fa-credit-card-alt fa-fw"></i> Rent Invoices
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('tenant.bills', ['id' => $tenant->id]) }}">
                            <i class="fa fa-credit-card fa-fw"></i> Bill Invoices
                        </a>
                    </li>
                </ul>
            </div>
            <!-- /.sidebar-collapse -->
        </div>
        <!-- /.navbar-static-side -->

    </nav>
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <p></p>
                <nav id="breadcrumb">
                    <ul class="breadcrumb">
                        <li>{{ config('app.name') }}</li>
                        <li>{{ $app->company->title }}</li>
                        <li>Tenant Panel</li>
                        @yield('breadcrumb')
                    </ul>
                </nav>

                <h1 class="page-header">@yield('page-header')</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->

        <!-- /.stats -->
        @yield('stats')

        @yield('content')
                <!-- /.content -->

        @include('includes.forms.logout')
    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

@include('includes.footers.estates')
        <!-- /footer -->

<!-- jQuery -->
<!-- Placed at the end of the document so the pages load faster -->
{{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>--}}
<script>window.jQuery || document.write('<script src="{{ url('js/jquery-3.3.1.min.js') }}"><\/script>')</script>

<!-- jQuery UI JavaScript -->
<script src="{{ url('js/vendor/jquery-ui.min.js') }}"></script>

<!-- Bootstrap Core JavaScript -->
<script src="{{ url('js/bootstrap.min.js') }}"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="{{ url('js/metisMenu.min.js') }}"></script>

<!-- Morris Charts JavaScript -->
<script src="{{ url('js/raphael.min.js') }}"></script>

<script src="{{ url('js/morris.min.js') }}"></script>

<!-- Custom Theme JavaScript -->
<script src="{{ url('js/sb-admin-2.min.js') }}"></script>

<!-- Custom Js -->
<script src="{{ url('js/app.js') }}"></script>

</body>

</html>