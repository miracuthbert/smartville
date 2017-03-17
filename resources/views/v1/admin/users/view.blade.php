@extends('layouts.admin')

@section('title')
    User Profile
@endsection

@section('breadcrumb')
    <li>
        <a href="{{ route('admin.users') }}">Users</a>
    </li>
    <li class="active">Profile</li>
@endsection

@section('page-header')
    User Profile
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12">

            <form name="user-profile-form" method="post" action="" enctype="application/x-www-form-urlencoded"
                  autocomplete="off">
                @include('includes.alerts.default')

                @include('includes.alerts.validation')

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">First name:</label>
                            <p class="form-static-control">{{ $user->firstname }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Last name:</label>
                            <p class="form-static-control">{{ $user->lastname }}</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Email:</label>
                            <p class="form-static-control">{{ $user->email }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Phone:</label>
                            <p class="form-static-control">{{ $user->phone }}</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="country">Country:</label>
                            <p class="form-static-control">{{ $user->country }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Joined:</label>
                            <p class="form-static-control">{{ $user->created_at->diffForHumans() }}</p>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Account verified:</label>
                            <p class="form-static-control">
                                {{ $user->activated == 1 ? 'Verified' : 'Not Verified' }}
                            </p>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection