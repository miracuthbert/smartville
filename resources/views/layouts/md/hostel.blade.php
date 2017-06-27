<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="Hostel Management App is designed to provide more flexibility to manage hostels">
    <meta name="author" content="SmartVille, <support@smartville.com>">

    <title>@yield('title') - Hostels | {{ config('app.name') }}</title>

    <!-- Main Fonts -->
    <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Roboto:400italic,700italic,700,400'>

    <!-- Font Awesome -->
    <link href="{{ url('css/font-awesome.min.css') }}" rel="stylesheet">
    {{--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css">--}}
            <!-- Bootstrap core CSS -->
    <link href="{{ url('css/vendor/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="{{ url('css/vendor/mdb.min.css') }}" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="{{ url('css/hostel/style.css') }}" rel="stylesheet">
</head>

<body>

<!--Navbar-->
<nav class="navbar navbar-toggleable-md navbar-light scrolling-navbar fixed-top bg-faded">
    <div class="container">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                data-target="#navbarNav1" aria-controls="navbarNav1" aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="#">
            <img src="{{ url('images/site/cropped-sv_00-32x32.png') }}" class="d-inline-block align-top z-depth-0"
                 alt="MDBootstrap">
        </a>
        <div class="collapse navbar-collapse" id="navbarNav1">
            <!--Links-->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item {{ ActivePage('hostel.dashboard') }}">
                    <a class="nav-link" href="{{ route('hostel.dashboard') }}">
                        <i class="fa fa-dashboard"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#best-features">
                        <i class="fa fa-th-large"></i> Amenities</a>
                </li>
                <li class="nav-item dropdown btn-group">
                    <a class="nav-link dropdown-toggle" id="properties-dropdown" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-building"></i> Properties <i class="fa fa-angle-down"></i></a>
                    </a>
                    <div class="dropdown-menu dropdown" aria-labelledby="dropdownProperties">
                        <a href="{{ route('hostel.property.create') }}" class="dropdown-item">
                            <i class="fa fa-plus"></i> Add new property
                        </a>
                        <a href="{{ route('hostel.property.index', ['sort' => 'reservations']) }}"
                           class="dropdown-item">
                            <i class="fa fa-calendar"></i> Reservations
                        </a>
                        <a href="{{ route('hostel.property.index', ['sort' => 'vacant']) }}" class="dropdown-item">
                            <i class="fa fa-unlock-alt"></i> Vacant
                        </a>
                        <a href="{{ route('hostel.property.index', ['sort' => 'occupied']) }}" class="dropdown-item">
                            <i class="fa fa-lock"></i> Occupied
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('hostel.property.index') }}" class="dropdown-item">View All</a>
                    </div>
                </li>
                <li class="nav-item dropdown btn-group">
                    <a class="nav-link dropdown-toggle" id="tenants-dropdown" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-users"></i> Tenants <i class="fa fa-angle-down"></i></a>
                    </a>
                    <div class="dropdown-menu dropdown" aria-labelledby="dropdownTenants">
                        <a class="dropdown-item"><i class="fa fa-user-plus"></i> Add new tenant</a>
                        <a class="dropdown-item"><i class="fa fa-user-times"></i> Pending</a>
                        <a class="dropdown-item"><i class="fa fa-unlock"></i> Vacated</a>
                        <a class="dropdown-item"><i class="fa fa-files-o"></i> Leases</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item">View All</a>
                    </div>
                </li>
            </ul>

            <ul class="navbar-nav">
                <li class="nav-item dropdown btn-group">
                    <a class="nav-link dropdown-toggle" id="user-dropdown" data-toggle="dropdown" aria-haspopup="true"
                       aria-expanded="false">
                        <i class="fa fa-envelope"></i> <i class="fa fa-angle-down"></i>
                    </a>
                    <div class="dropdown-menu dropdown" aria-labelledby="dropdownMenu1">
                        <a class="dropdown-item">Action</a>
                        <a class="dropdown-item">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item">Something else here</a>
                    </div>
                </li>
                <li class="nav-item dropdown btn-group">
                    <a class="nav-link dropdown-toggle" id="user-dropdown" data-toggle="dropdown" aria-haspopup="true"
                       aria-expanded="false">
                        <i class="fa fa-user"></i> miracuthbert <i class="fa fa-angle-down"></i>
                    </a>
                    <div class="dropdown-menu dropdown" aria-labelledby="dropdownMenu1">
                        <a class="dropdown-item"><i class="fa fa-user"></i> My Profile</a>
                        <a class="dropdown-item"><i class="fa fa-cog"></i> Settings</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item"><i class="fa fa-sign-out"></i> Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!--/.Navbar-->

<div id="main-wrapper">
    @yield('content')
</div>

<footer class="page-footer center-on-small-only">

    <!--Footer Links-->
    <div class="container-fluid">
        <div class="row">

            <!--First column-->
            <div class="col-md-3 offset-lg-1 hidden-lg-down">
                <h5 class="title">ABOUT MATERIAL DESIGN</h5>
                <p>Material Design (codenamed Quantum Paper) is a design language developed by Google. </p>

                <p>Material Design for Bootstrap (MDB) is a powerful Material Design UI KIT for most popular HTML, CSS,
                    and JS framework - Bootstrap.</p>
            </div>
            <!--/.First column-->

            <hr class="hidden-md-up">

            <!--Second column-->
            <div class="col-lg-2 col-md-4 offset-lg-1">
                <h5 class="title">First column</h5>
                <ul>
                    <li><a href="#!">Link 1</a></li>
                    <li><a href="#!">Link 2</a></li>
                    <li><a href="#!">Link 3</a></li>
                    <li><a href="#!">Link 4</a></li>
                </ul>
            </div>
            <!--/.Second column-->

            <hr class="hidden-md-up">

            <!--Third column-->
            <div class="col-lg-2 col-md-4">
                <h5 class="title">Second column</h5>
                <ul>
                    <li><a href="#!">Link 1</a></li>
                    <li><a href="#!">Link 2</a></li>
                    <li><a href="#!">Link 3</a></li>
                    <li><a href="#!">Link 4</a></li>
                </ul>
            </div>
            <!--/.Third column-->

            <hr class="hidden-md-up">

            <!--Fourth column-->
            <div class="col-lg-2 col-md-4">
                <h5 class="title">Third column</h5>
                <ul>
                    <li><a href="#!">Link 1</a></li>
                    <li><a href="#!">Link 2</a></li>
                    <li><a href="#!">Link 3</a></li>
                    <li><a href="#!">Link 4</a></li>
                </ul>
            </div>
            <!--/.Fourth column-->

        </div>
    </div>
    <!--/.Footer Links-->

    <hr>

    <!--Call to action-->
    <div class="call-to-action">
        <h4>Material Design for Bootstrap</h4>
        <ul>
            <li>
                <h5>Get our UI KIT for free</h5></li>
            <li><a target="_blank" href="http://mdbootstrap.com/getting-started/" class="btn btn-info" rel="nofollow">Sign
                    up!</a></li>
            <li><a target="_blank" href="http://mdbootstrap.com/material-design-for-bootstrap/" class="btn btn-primary"
                   rel="nofollow">Learn more</a></li>
        </ul>
    </div>
    <!--/.Call to action-->

    <!--Copyright-->
    <div class="footer-copyright">
        <div class="container-fluid">
            © {{ date('Y') }} Copyright: <a href="http://www.smartville.co"> SmartVille.co </a>

        </div>
    </div>
    <!--/.Copyright-->

</footer><!--/footer-->

<!-- SCRIPTS -->
<!-- JQuery -->
<script type="text/javascript" src="{{ url('js/jquery-3.1.1.min.js') }}"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="{{ url('js/vendor/tether.min.js') }}"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="{{ url('js/vendor/bootstrap.min.js') }}"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="{{ url('js/vendor/mdb.min.js') }}"></script>

<script>
    new WOW().init();
</script>

<!-- Custom Text Editor -->
<script src="{{ url('js/ckbasic/ckeditor.js') }}"></script>

<!-- Hostel JS -->
<script src="{{ url('js/hostel/custom.js') }}"></script>

@yield('scripts')
</body>

</html>