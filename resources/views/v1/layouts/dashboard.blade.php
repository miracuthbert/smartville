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


    <title>{{ config('app.name') }} - @yield('title')</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ url('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Custom CSS SB Admin -->
    <link href="{{ url('css/sb-admin-2.min.css') }}" rel="stylesheet">

    <!-- Bootstrap Social CSS -->
    <link href="{{ url('css/bootstrap-social.css') }}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{ url('css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">

    <link href="{{ url('css/icomoon.css') }}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ url('css/v1/main.css') }}" rel="stylesheet">

    <link href="{{ url('css/v1/dashboard.css') }}" rel="stylesheet">

    <link href="{{ url('css/colors.css') }}" rel="stylesheet">
    @yield('styles')

            <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="{{ url('css/ie10-viewport-bug-workaround.css') }}" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
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
        @include('v1.includes.headers.home.dashboard-static')
    </nav>

    <!-- Page Content -->
    <div id="page-wrapper" style="min-height: 611px;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">@yield('page-header')</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    @yield('content')
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
</div>

@include('v1.includes.footers.dashboard-default')
        <!-- /.footer -->

@include('includes.modals.success-modal')
@include('includes.modals.error-modal')

@include('includes.forms.logout')
        <!-- Bootstrap core JavaScript
================================================== -->
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
<!--<script src="{{ url('js/morris-data.js') }}"></script>-->

<!-- Custom Theme JavaScript -->
<script src="{{ url('js/sb-admin-2.min.js') }}"></script>

<!-- Custom Text Editor -->
<script src="{{ url('js/ckbasic/ckeditor.js') }}"></script>

<!-- Custom Js -->
<script src="{{ url('js/app.js') }}"></script>

@yield('scripts')

</body>
</html>