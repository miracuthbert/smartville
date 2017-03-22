@extends('v1.layouts.dashboard')

@section('title')
    Support
@endsection

@section('page-header')
    <i class="fa fa-support"></i>
    Support Center
    <span class="pull-right small" data-toggle="tooltip"
          title="This feature is currently in development. Please bare with us if there are any bugs.">
        <span class="label label-warning pull-right">Beta</span>
    </span>
@endsection

@section('content')

    <div id="supportWrapper">
        <div class="row">
            <div class="col-lg-12">
                <p class="lead">Welcome, tell us what we can help you with?</p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-group">
                    <div class="list-group-item">
                        <a href="{{ route('manuals.index') }}" class="list-group-item">
                            <i class="glyphicon glyphicon-book"></i> Read manuals
                        </a>
                        <a href="{{ route('forum.create') }}" class="list-group-item">
                            <i class="fa fa-book fa-fw"></i> Have a question? Ask here...
                        </a>
                        <a href="{{ route('bug.create') }}" class="list-group-item">
                            <i class="fa fa-bug fa-fw"></i> Report a bug
                        </a>
                    </div>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12"></div>
        </div>
    </div>

@endsection