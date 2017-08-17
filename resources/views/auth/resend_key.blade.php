@extends('layouts.master')

@section('title')
    {{ config('app.name') }} - Resend Activation Code
@endsection

@section('content')

    @include('partials.headers.default')

    <div class="container">

        <form name="form-signin" class="form-signin" method="post" action="{{ route('activation.key.resend.post') }}"
              enctype="application/x-www-form-urlencoded" autocomplete="off">

            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="form-signin-heading">
                        Resend Activation Code
                    </h3>
                </div>
                <div class="panel-body">

                    @if(count($errors) > 0)
                        <div class="alert alert-danger">
                            <p><strong>Whoops!</strong> Something went wrong.</p>

                            <ul>
                                @foreach($errors->all() as $error)

                                    <li>{{ $error }}</li>

                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if(Session::has('error'))
                        <div class="alert alert-danger">
                            <p>{{ Session::get('error') }}</p>
                        </div>
                    @elseif(Session::has('success'))
                        <div class="alert alert-success">
                            <p>{{ Session::get('success') }}</p>
                        </div>
                    @endif

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

    </div> <!-- /container -->
    <!--/.End Login Section   -->

    @include('partials.footers.default')

@endsection
