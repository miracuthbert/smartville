<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<meta name="description" content="">
<meta name="author" content="">
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="icon" href="favicon.ico">


<title>@yield('title') - {{ config('app.name') }}</title>

<!-- Main Fonts -->
<link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Roboto:400italic,700italic,700,400'>

<!-- Font Awesome Icon Fonts -->
<link href="{{ url('css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">

<!-- Bootstrap core CSS -->
<link href="{{ url('css/bootstrap.min.css') }}" rel="stylesheet">

<!-- Bootstrap Social CSS -->
<link href="{{ url('css/bootstrap-social.css') }}" rel="stylesheet">

<!-- jQuery UI Styles -->
<script src="{{ url('js/vendor/jquery-ui.min.css') }}"></script>

<!-- Custom CSS -->
<link href="{{ url('css/v1/main.css') }}" rel="stylesheet">

<link href="{{ url('css/v1/home.css') }}" rel="stylesheet">
<link href="{{ url('css/v1/home.ext.css') }}" rel="stylesheet">

@yield('styles')

<link href="{{ url('css/colors.css') }}" rel="stylesheet">

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