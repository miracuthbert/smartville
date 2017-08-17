@extends('v1.layouts.master')

@section('title')
    SignUp
@endsection

@section('content')
    @include('partials')

    <section class="section"><!--SignUp Section-->
        <div class="container"><!-- container -->
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="form-group">
                                <h2><span class="icon icon-user-plus"></span> SignUp</h2>

                                <p class="lead">Fill in the fields below to get started</p>
                            </div>
                        </div>
                        <div class="panel-body">
                            <form name="form-sign-up" method="post" action="{{ route('register.post') }}"
                                  enctype="application/x-www-form-urlencoded"
                                  autocomplete="off">

                                @include('partials.alerts.validation')

                                @include('partials.alerts.error')

                                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                <div class="form-group {{ $errors->has('first_name') ? 'has-error' : '' }}">
                                    <label class="control-label" for="store">First name</label>
                                    <input type="text" name="first_name" class="form-control" id="first_name"
                                           placeholder="first name"
                                           value="{{ Request::old('first_name') }}" required autofocus/>

                                    @if ($errors->has('first_name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="form-group {{ $errors->has('last_name') ? 'has-error' : '' }}">
                                    <label class="control-label" for="store">Last name</label>
                                    <input type="text" name="last_name" class="form-control" id="last_name"
                                           placeholder="last name"
                                           value="{{ Request::old('last_name') }}" required/>

                                    @if ($errors->has('last_name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                    <label class="control-label" for="email">Email address</label>
                                    <input type="email" name="email" class="form-control" required id="email"
                                           placeholder="email address"
                                           value="{{ Request::old('email') }}" autofocus/>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                                    <label class="control-label" for="password">Password</label>
                                    <input type="password" name="password" class="form-control" required id="password"
                                           placeholder="password"/>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                                    <label class="control-label" for="password_confirmation">Confirm Password</label>
                                    <input type="password" name="password_confirmation" class="form-control" required
                                           id="password_confirmation"
                                           placeholder="confirm password"/>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <p class="help-block">By signing up you agree to our
                                        <a href="#" title="terms of use">Terms of use</a> and
                                        <a href="#" title="privacy policy">Privacy policy</a></p>

                                    <button type="submit" class="btn btn-success btn-lg">Sign Up</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /container -->
    </section><!--/.End SignUp Section   -->

    @include('v1.includes.footers.default')
@endsection

