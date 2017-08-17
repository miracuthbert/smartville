@extends('v1.layouts.master')

@section('title')
    Login
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ url('css/v1/login.css') }}">
@endsection

@section('content')

    @include('partials')

    <div class="container">
        <!-- Login Section   -->
        <form name="form-signin" class="form-signin" method="post" action="{{ route('login.post') }}"
              enctype="application/x-www-form-urlencoded" autocomplete="off">

            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h2 class="form-signin-heading">
                        <span class="glyphicon glyphicon-log-in"></span>
                        Login
                    </h2>
                </div>
                <div class="panel-body">

                    @include('partials.alerts.default')
                    @include('partials.alerts.validation')

                    {{ csrf_field() }}

                    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                        <label for="email" class="sr-only">Email address</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="email address"
                               value="{{ Request::old('email') }}" required autofocus>

                        @if ($errors->has('email'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                        <label for="password" class="sr-only">Password</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Password"
                               required>

                        @if ($errors->has('password'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <div class="checkbox">
                            <label for="remember">
                                <input name="remember" id="remember" type="checkbox" value="1"> Remember me
                            </label>
                        </div>
                    </div>

                    <button name="btnLogin" id="btnLogin" class="btn btn-lg btn-primary btn-block" type="submit">
                        <i class="fa fa-sign-in pull-left"></i>
                        Login
                    </button>
                </div>
                <div class="panel-footer">
                    <div class="row">
                        <div class="col-md-12">
                            <a href="{{ route('register') }}">Sign Up</a>
                            <a href="{{ route('password.reset') }}" class="pull-right">
                                Forgot your password?
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!--/.End Login Section   -->
    </div> <!-- /container -->

    @include('partials.footers.default')

@endsection
