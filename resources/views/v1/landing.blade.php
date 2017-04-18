@extends('v1.layouts.landing')

@section('title')
    Welcome
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ url('css/v1/default.landing.css') }}">
@endsection

@section('content')

    @include('v1.includes.headers.home.default')

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div id="content">
                    <h1>{{ config('app.name') }}</h1>
                    <div id="banner">
                        <div class="row">
                            <div class="col-lg-4 col-sm-4 col-xs-4">
                                <div class="visible-xs">
                                    <span class="fa-stack fa-2x">
                                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                                        <i class="fa fa-user fa-stack-1x text-icon"></i>
                                    </span>
                                </div>
                                <!-- /.visible-xs -->
                                <div class="hidden-xs">
                                    <span class="fa-stack fa-5x">
                                    <i class="fa fa-circle fa-stack-2x text-primary"></i>
                                    <i class="fa fa-user fa-stack-1x text-icon"></i>
                                </span>
                                </div>
                                <!-- /hidden-xs -->
                                <h4 class="service-heading">Property Owner</h4>
                            </div>
                            <div class="col-lg-4 col-sm-4 col-xs-4">
                                <div class="visible-xs">
                                    <span class="fa-stack fa-2x">
                                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                                        <i class="fa fa-laptop fa-stack-1x text-icon"></i>
                                    </span>
                                </div>
                                <!-- /.visible-xs -->
                                <div class="hidden-xs">
                                    <span class="fa-stack fa-5x">
                                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                                        <i class="fa fa-laptop fa-stack-1x text-icon"></i>
                                    </span>
                                </div>
                                <!-- /.hidden-xs -->
                                <h4 class="service-heading">Web</h4>
                            </div>
                            <div class="col-lg-4 col-sm-4 col-xs-4">
                                <div class="visible-xs">
                                    <span class="fa-stack fa-2x">
                                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                                        <i class="fa fa-group fa-stack-1x text-icon"></i>
                                    </span>
                                </div>
                                <!-- /.visible-xs -->
                                <div class="hidden-xs">
                                    <span class="fa-stack fa-5x">
                                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                                        <i class="fa fa-group fa-stack-1x text-icon"></i>
                                    </span>
                                </div>
                                <!-- /.hidden-xs -->
                                <h4 class="service-heading">Tenants</h4>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <h3 id="tag">&quot;Bridging the gap between property owners and tenants&quot;</h3>
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