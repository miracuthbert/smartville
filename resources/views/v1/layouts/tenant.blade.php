<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="favicon.ico">


    <title>{{ config('app.name') }} | {{ $app->company->title }} | Tenant Panel - @yield('title')</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ url('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Bootstrap Social CSS -->
    <link href="{{ url('css/bootstrap-social.css') }}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{ url('css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ url('css/icomoon.css') }}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ url('css/v1/main.css') }}" rel="stylesheet">

    <link href="{{ url('css/v1/tenant.style.css') }}" rel="stylesheet">

    <link href="{{ url('css/colors.css') }}" rel="stylesheet">
    @yield('styles')

            <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="{{ url('css/ie10-viewport-bug-workaround.css') }}" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
@include('includes.headers.tenant.default')

<div class="box" id="content">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ul class="breadcrumb">
                    <li>{{ config('app.name') }}</li>
                    <li>{{ $app->company->title }}</li>
                    <li>Tenant Panel</li>
                    @yield('breadcrumb')
                </ul>
            </div>
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-lg-3 col-sm-4 hidden-xs">
                <div class="list-group">
                    <a href="#" class="list-group-item active">
                        <h2 class="list-group-heading">
                            <i class="fa fa-th-large"></i> Tenant Panel
                        </h2>
                    </a>
                    @include('includes.sidebars.tpanel-v1')
                </div>
            </div>
            <!-- /.col-lg-3 -->
            <div class="col-lg-9 col-sm-8">
                <div id="content-wrapper">
                    @yield('page-header')
                    @yield('content')
                </div>
            </div>
            <!-- /.col-lg-9 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#content -->

@include('includes.modals.success-modal')
@include('includes.modals.error-modal')

@include('includes.forms.logout')
        <!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
{{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>--}}
<script>window.jQuery || document.write('<script src="{{ url('js/jquery-2.2.1.min.js') }}"><\/script>')</script>

<script src="{{ url('js/jquery-ui.min.js') }}"></script>
<script src="{{ url('js/bootstrap.min.js') }}"></script>
<script src="{{ url('js/app.js') }}"></script>
@yield('scripts')

        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="{{ url('js/ie10-viewport-bug-workaround.js') }}"></script>
</body>
</html>