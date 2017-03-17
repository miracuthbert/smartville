<!DOCTYPE html>
<html>
<head>
    <title>{{ config('app.name') }} - Page Not Found.</title>

    <link href="{{ url('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

    <style>
        html, body {
            height: 100%;
        }

        body {
            margin: 0;
            padding: 0;
            width: 100%;
            color: #1c1c1c;
            display: table;
            font-weight: 100;
            font-family: 'Lato', sans-serif;
        }

        .container {
            text-align: center;
            display: table-cell;
            vertical-align: middle;
        }

        .content {
            text-align: center;
            display: inline-block;
        }

        .title {
            font-size: 72px;
            margin-bottom: 40px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="content">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="title">
                    404 Error - Page Not Found
                </div>
            </div>
            <div class="panel-body">
                <h3 class="text-info">Sorry, seems like the page you are looking for does not exist.</h3>

                <p class="lead">You can resume where you were by clicking the button below.</p>

                <p class="text-center">
                    <a href="{{ url(url()->previous()) }}" class="btn btn-primary btn-lg">Resume Now!</a>
                </p>

            </div>
            <div class="panel-footer">
                <div class="lead">
                    &copy; {{ date('Y') }} {{ config('app.name') }}, Inc.
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
