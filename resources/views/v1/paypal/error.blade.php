@extends('layouts.master')

@section('title')
    Subscription Error
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
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <h3>Subscription Error</h3>
                        </div>
                        <div class="panel-body lead">
                            <strong>Something went wrong!</strong>
                            <ul>
                                <li>Subscription failed.</li>
                                @if(Session::has('error'))
                                    <li>{{ Session::get('error') }}</li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('includes.footers.default')
@endsection