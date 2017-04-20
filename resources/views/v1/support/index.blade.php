@extends('layouts.company')

@section('title')
    Support Center
@endsection

@section('styles')
    <style>
        #support-wrapper .jumbotron {
            background-color: #2C3E50;
            color: #EEEEEE;
        }
    </style>
@endsection

@section('content')
    @include('includes.headers.home.primary')

    <section id="support-wrapper">
        <div class="container">
            <div class="jumbotron">
                <h1 class="page-header">
                    <i class="fa fa-support"></i>
                    Support Center
                    <span class="pull-right small" data-toggle="tooltip"
                          title="This feature is currently under development. Please bare with us if there are any problems(bugs).">
                        <span class="label label-warning pull-right">Beta</span>
                    </span>
                </h1>
                <p class="lead">Welcome, to our support center. Here you can find different resources to help you use
                    different apps and services. <br> <i class="fa fa-info-circle"></i> This feature is still in
                    development. Some errors may occur, please bare with us.</p>
            </div>
            <div class="row">
                <div class="col-lg-9 col-sm-8">
                    <ul class="list-group">
                        <div class="list-group-item">
                            <a href="{{ route('manuals.index') }}" class="list-group-item">
                                <i class="glyphicon glyphicon-book"></i> Documentation
                            </a>
                            <a href="{{ route('forum.create') }}" class="list-group-item">
                                <i class="fa fa-question-circle-o fa-fw"></i> Have a question? Ask here...
                            </a>
                            <a href="{{ route('bug.create') }}" class="list-group-item">
                                <i class="fa fa-bug fa-fw"></i> Report a problem (bug)
                            </a>
                        </div>
                    </ul>
                </div>
                <!-- /.col-lg-9 -->
                <!-- support sidebar -->
                @include('includes.sidebars.support-v1')
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>
    <!-- /#support-wrapper -->

    <!-- footer -->
    @include('includes.footers.default')
@endsection