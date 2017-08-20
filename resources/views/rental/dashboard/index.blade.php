@extends('layouts.rental.master')

@section('title')
    Dashboard
@endsection

@section('breadcrumb')
    <li class="active">Dashboard</li>
@endsection

@section('page-header')
    Dashboard
@endsection

@section('content')
    @include('partials.alerts.default')

    <div class="row">
        <div class="col-lg-6">
            @include('rental.dashboard.partials._stats')
        </div>
        <div class="col-lg-6">
            @include('rental.dashboard.partials._notifications')
        </div><!-- /.col-lg-6 -->
    </div>
    <div class="row">
        <div class="col-lg-6">
            @include('rental.dashboard.partials._pending_bills')
        </div><!-- /.col-lg-6 -->
        <div class="col-lg-6">
            @include('rental.dashboard.partials._pending_rents')
        </div><!-- /.col-lg-6 -->
    </div>

    @include('partials.modals.delete')

@endsection