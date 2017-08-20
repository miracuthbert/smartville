<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.rental.partials._head')
</head>

<body>
<div id="wrapper">
    <!-- Floating Button Backdrop -->
    <div class="backdrop"></div>

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">

        @include('layouts.rental.partials._header')

        @include('layouts.rental.partials._sidebar')

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

                    @include('partials.alerts.default')

                    @include('partials.alerts.subscription')

                    <h1 class="page-header">@yield('page-header')</h1>
                </div>
            </div><!-- /.col-lg-12 -->
        </div><!-- /.row -->

        <!-- stats -->
        @yield('stats')

        <!-- content -->
        @yield('content')

        @include('partials.modals.success-modal')
        @include('partials.modals.error-modal')

    </div><!-- /#page-wrapper -->
</div><!-- /#wrapper -->

@include('layouts.rental.partials._scripts')

</body>

</html>