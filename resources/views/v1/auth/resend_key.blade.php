@extends('v1.layouts.master')

@section('title')
    Resend Activation Code
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ url('css/v1/login.css') }}">
@endsection

@section('content')

    @include('v1.includes.headers.home.default-static')

    <div class="container">
        <div class="box">
            <form name="form-signin" class="form-signin" method="post"
                  action="{{ route('activation.key.resend.post') }}"
                  enctype="application/x-www-form-urlencoded" autocomplete="off">

                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="form-signin-heading">
                            Resend Activation Code
                        </h3>
                    </div>
                    <div class="panel-body">

                        @include('partials.alerts.default')
                        @include('partials.alerts.validation')

                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? 'has-error' : '' }}">
                            <label for="email" class="sr-only">Email address</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="email address"
                                   value="{{ Request::old('email') != null ? Request::old('email') : '' }}" required
                                   autofocus>

                            @if ($errors->has('email'))
                                <p class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </p>
                            @endif
                        </div>

                        <button name="btnResendCode" id="btnResendCode" class="btn btn-lg btn-primary btn-block"
                                type="submit">
                            Resend Activation Code
                        </button>
                    </div>
                </div>
            </form>
        </div>

    </div> <!-- /container -->
    <!--/.End Login Section   -->

    @include('partials.footers.default')

@endsection
