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

            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h1>
                        Page currently under construction
                    </h1>
                </div>
            </div>
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
