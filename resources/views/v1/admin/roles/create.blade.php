@extends('layouts.admin')

@section('title')
    Add New App
@endsection

@section('page-header')
    Add New App
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Fill in the fields below
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <form role="form">

                                <div class="form-group">
                                    <label>Text Input with Placeholder</label>
                                    <input class="form-control" placeholder="Enter text">
                                </div>

                                <div class="form-group">
                                    <label>Text Input with Placeholder</label>
                                    <input class="form-control" placeholder="Enter text">
                                </div>

                                <div class="form-group">
                                    <label>Text Input with Placeholder</label>
                                    <input class="form-control" placeholder="Enter text">
                                </div>

                                <div class="form-group">
                                    <label>Text Input with Placeholder</label>
                                    <input class="form-control" placeholder="Enter text">
                                </div>

                                <div class="form-group">
                                    <label>Text Input with Placeholder</label>
                                    <input class="form-control" placeholder="Enter text">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

@endsection