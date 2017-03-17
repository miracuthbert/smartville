@extends('layouts.master')

@section('title')
    Subscription Cancelled
@endsection

@section('styles')
    <link href="{{ url('css/sb-admin-2.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    @include('includes.headers.plain')

    <div class="section-blank">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-lg-offset-3">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3>
                                Subscription Cancelled
                            </h3>
                        </div>
                        <div class="panel-body lead">
                            <p>Subscription cancelled.</p>

                            <a href="#" class="btn btn-primary btn-lg hidden">
                                Resume Subscription
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection