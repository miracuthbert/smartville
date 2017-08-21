@extends('layouts.rental.master')

@section('title', 'Settings')

@section('breadcrumb')
    <li class="active">Settings</li>
@endsection

@section('page-header')
    <i class="fa fa-cog"></i>
    Settings
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-info">
                <h3>Page Under Construction</h3>
                <p>Please bare with us as we work on the settings page.</p>
                <hr>
                <strong><i class="fa fa-info-circle"></i> Default settings will be used.</strong>
            </div>

            {{--<h3 class="sub-header"><i class="fa fa-th-list"></i> Layouts</h3>--}}
            {{--@include('rental.settings.partials.layouts._properties_group')--}}
            {{--@include('rental.settings.partials.layouts._properties')--}}
            {{--@include('rental.settings.partials.layouts._tenants')--}}

            {{--<h3 class="sub-header"><i class="fa fa-bell"></i> Notifications</h3>--}}
            {{--@include('rental.settings.partials._notifications')--}}
        </div>
    </div>
@endsection
