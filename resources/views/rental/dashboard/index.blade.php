@extends('layouts.estates')

@section('title')
    Dashboard
@endsection

@section('breadcrumb')
    <li class="active">Dashboard</li>
@endsection

@section('page-header')
    Dashboard
@endsection

@section('stats')
    @include('partials.alerts.default')

    @include('rental.dashboard.partials._stats')
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-4">
            @include('rental.dashboard.partials._pending_bills')
        </div><!-- /.col-lg-4 -->
        <div class="col-lg-4">
            @include('rental.dashboard.partials._pending_rents')
        </div><!-- /.col-lg-4 -->
        <div class="col-lg-4">
            @include('rental.dashboard.partials._notifications')
        </div><!-- /.col-lg-4 -->
    </div>

    @include('partials.modals.delete')

@endsection