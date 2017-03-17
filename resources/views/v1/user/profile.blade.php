@extends('v1.layouts.master')

@section('title')
    User Profile
@endsection

@section('content')
    @include('v1.includes.headers.home.default-static')

    <div class="container">
        <div class="section-pad section-top section-bottom">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="page-header">User Profile:</h1>

                    <p class="lead">Change your personal details or your password here.</p>

                    <form name="user-profile-form" method="post" action="{{ route('user.profile.update') }}" enctype="application/x-www-form-urlencoded"
                          autocomplete="off">
                        @include('includes.alerts.default')

                        @include('includes.alerts.validation')

                        {{ csrf_field() }}

                        <input type="hidden" name="id" id="id" value="{{ Auth::user()->id }}">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">First name:</label>
                                    <input type="text" name="first_name" class="form-control"
                                           value="{{ Auth::user()->firstname }}" autofocus>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Last name:</label>
                                    <input type="text" name="last_name" class="form-control"
                                           value="{{ Auth::user()->lastname }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Email:</label>
                                    <input type="text" name="email" class="form-control"
                                           value="{{ Auth::user()->email }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Phone:</label>
                                    <input type="text" name="phone" class="form-control"
                                           value="{{ Auth::user()->phone }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="country">Country:</label>
                                    <input type="text" name="country" class="form-control" id="country"
                                           value="{{ Auth::user()->country }}">
                                </div>
                            </div>
                            <div class="col-md-6">

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Joined:</label>
                                    <p class="form-static-control">{{ Auth::user()->created_at->diffForHumans() }}</p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Account verified:</label>
                                    <p class="form-static-control">
                                        {{ Auth::user()->activated == 1 ? 'Verified' : '' }}
                                        @if(Auth::user()->activated == 0)
                                            <a href="{{ route('activation.key.resend') }}" class="btn btn-primary btn-sm">
                                                Get verified
                                            </a>
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password">Password:</label>
                                    <input type="password" name="password" class="form-control"
                                           placeholder="password">

                                    <span class="help-block">Enter password to save changes</span>
                                </div>
                            </div>
                            <div class="col-md-6">

                            </div>
                        </div>

                        <button type="submit" name="btnUpdProfile" class="btn btn-primary" id="btnUpdProfile">
                            Update
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('v1.includes.footers.default')

@endsection