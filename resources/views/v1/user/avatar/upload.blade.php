@extends('v1.layouts.master')

@section('title')
    User Profile
@endsection

@section('content')
    @include('v1.includes.headers.home.default-static')

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        <h3 class="page-header">
                            <i class="fa fa-camera-retro"></i> User Profile Picture:
                        </h3>

                        <div class="pull-left">
                            <p class="lead">Upload an image to change your profile picture.</p>
                        </div>
                        <div class="pull-right">
                            <div class="btn-group btn-group-sm">
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"
                                        aria-expanded="false">
                                    Actions
                                    <i class="caret"></i>
                                </button>
                                <ul class="dropdown-menu pull-right">
                                    <li>
                                        <a href="{{ route('user.profile') }}">
                                            <i class="fa fa-user"></i>
                                            Return to Profile
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('user.dashboard') }}">
                                            <i class="fa fa-dashboard"></i>
                                            Go To Dashboard
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <form name="user-profile-form" method="post" action="{{ route('user.avatar.store') }}"
                              enctype="multipart/form-data"
                              autocomplete="off">
                            @include('includes.alerts.default')

                            @include('includes.alerts.validation')

                            {{ csrf_field() }}

                            <input type="hidden" name="id" id="id" value="{{ Auth::user()->id }}">

                            <input type="hidden" name="type" id="id" value="profile">

                            <input type="hidden" name="data-alt" id="data-alt"
                                   value="{{ Auth::user()->firstname }} profile picture">

                            <div class="row">
                                <div class="col-md-8">
                                    <label for="image">Choose an image to upload:</label>
                                    <div class="form-group input-group">
                                        <input type="file" name="image" class="form-control"
                                               id="image" required>
                                        <div class="input-group-btn">
                                            <button type="submit" class="btn btn-primary" id="btnAvatarUpload">
                                                Upload
                                                <i class="fa fa-upload"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel-default -->
            </div>
            <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header">
                    <i class="fa fa-image"></i> Profile Pictures
                </h3>
                <p class="text-muted">Pictures you upload will appear here.</p>
            </div>
        </div>
        <!-- /.row -->

        <div class="row">
            @if(count($avatars) > 0)
                @foreach($avatars as $avatar)
                    <div class="col-lg-4 col-sm-6 col-xs-12">
                        <div class="thumbnail">
                            <img src="{{ url($avatar->data['url']) }}" alt="{{ $avatar->data['alt'] }}"/>
                            <div class="caption">
                                <p class="tags">
                                    <strong>Tags:</strong> {{ $avatar->data['tag'] }}
                                </p>
                                <p class="dates">
                                    <strong>Added:</strong> {{ $avatar->created_at->diffForHumans() }}
                                </p>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('user.avatar.update', ['id' =>$avatar->id]) }}" role="button"
                                       class="btn btn-primary {{ $avatar->status == 1 ? 'disabled' : '' }}">
                                        <i class="fa fa-upload"></i> Set as Profile Picture
                                    </a>
                                    <a href="{{ route('user.avatar.delete', ['id' =>$avatar->id]) }}" role="button"
                                       class="btn btn-danger">
                                        <i class="fa fa-trash"></i> Delete
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <p class="lead">You have not uploaded any profile pictures yet.</p>
            @endif
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->

    @include('v1.includes.footers.default')
@endsection