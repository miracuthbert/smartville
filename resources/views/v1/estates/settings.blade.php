@extends('layouts.estates')

@section('title')
    Company App Settings
@endsection

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

            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3>
                        <i class="fa fa-wrench"></i> Page Under Construction
                    </h3>
                </div>
                <div class="panel-body">
                    <div class="lead">
                        <p>Please bare with us as we work on the settings page.</p>
                        <strong class="text-info">
                            <i class="fa fa-info-circle"></i> Default settings will be used.
                        </strong>
                    </div>
                </div>
            </div>

            <h3 class="sub-header"><i class="fa fa-th-list"></i> Layouts</h3>
            @include('v1.estates.settings.properties_group_layout')
            @include('v1.estates.settings.properties_layout')
            @include('v1.estates.settings.tenants_layout')

            <h3 class="sub-header"><i class="fa fa-bell"></i> Notifications</h3>
            @include('v1.estates.settings.notifications')
        </div>
    </div>

    <!--modal snippet -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit record:</h4>
                </div>
                <div class="modal-body">
                    <p>Record details here&hellip;</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="">Save changes</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

@endsection
