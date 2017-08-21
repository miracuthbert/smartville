<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<link rel="icon" href="{{ url('images/site/cropped-sv_00-32x32.png') }}">

<title>{{ ($app->unreadNotifications->count()) > 0 ? '(' . $app->unreadNotifications->count() . ')' : '' }} @yield('title')
    - {{ $app->product->title }} | {{ config('app.name') }}</title>

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

<!-- Custom CSS -->
<link href="{{ url('css/v1/main.css') }}" rel="stylesheet">

<link href="{{ url('css/estate.css') }}" rel="stylesheet">

<!-- Bootstrap Social CSS -->
<link href="{{ url('css/bootstrap-social.css') }}" rel="stylesheet">

<!-- Morris Charts CSS -->
<link href="{{ url('css/morris.css') }}" rel="stylesheet">

<!-- jQuery UI CSS -->
<link href="{{ url('css/vendor/jquery-ui.min.css') }}" rel="stylesheet">

<!-- Floating Button CSS -->
<link href="{{ url('css/vendor/mfb.css') }}" rel="stylesheet">

<link href="{{ url('css/colors.css') }}" rel="stylesheet">

@yield('styles')

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

<!-- Scripts -->
<script>
    window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
    ]); ?>
</script>