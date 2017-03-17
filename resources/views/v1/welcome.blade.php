@extends('v1.layouts.landing')

@section('title')
    Welcome
    @endsection

    @section('content')

    @include('v1.includes.headers.home.default')
            <!-- /header -->

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div id="content">
                    <h1>{{ config('app.name') }}</h1>
                    <h3>User Friendly Real Estate Apps</h3>
                    <hr>
                    <a href="{{ route('services') }}" class="btn btn-primary btn-lg">
                        <i class="fa fa-home"></i>
                        Get Me Started!
                    </a>
                </div>
                <!-- /#content -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
@endsection