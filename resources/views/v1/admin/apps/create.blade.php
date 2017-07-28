@extends('layouts.admin')

@section('title')
    Create App
@endsection

@section('breadcrumb')
    <li>Apps</li>
    <li>App</li>
    <li class="active">Create</li>
@endsection

@section('page-header')
    <i class="fa fa-laptop"></i> Create App
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading hidden">
                    Fill in the fields below
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form role="form" method="post" action="{{ route('admin.app.store') }}"
                                  enctype="multipart/form-data"
                                  autocomplete="on">
                                @include('includes.alerts.default')

                                @include('includes.alerts.validation')

                                <input type="hidden" name="_token" value="{{ Session::token() }}">

                                <input type="hidden" name="app" value="1"><!--/ Set app to true -->

                                <div class="form-group{{ $errors->has('title') ? 'has-error' : '' }}">
                                    <label>App title</label>
                                    <input type="text" name="title" class="form-control" id="title"
                                           placeholder="app title" value="{{ old('title') }}" required autofocus>
                                </div>

                                <div class="form-group {{ $errors->has('slug') ? 'has-error' : '' }}">
                                    <label for="slug">Slug</label>
                                    <input type="text" name="slug" class="form-control" id="slug"
                                           placeholder="slug"
                                           value="{{ old('slug') != null ? old('slug') : $app->title }}"
                                           required autofocus>
                                </div>

                                <div class="form-group{{ $errors->has('summary') ? 'has-error' : '' }}">
                                    <label>Summary</label>
                                    <textarea name="summary" id="summary" cols="30" rows="2" class="form-control"
                                              placeholder="brief details of the app">{{ old('summary') }}</textarea>
                                </div>

                                <div class="form-group{{ $errors->has('description') ? 'has-error' : '' }}">
                                    <label>App details</label>
                                    <textarea name="description" id="description" cols="30" rows="5"
                                              class="form-control ckeditor"
                                              placeholder="full details of the app">{{ old('description') }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label>App logo</label>
                                    <input type="file" name="logo" class="form-control" id="logo">
                                </div>

                                <div class="form-group{{ $errors->has('mode') ? 'has-error' : '' }}">
                                    <label>App Mode</label>
                                    <label class="radio-inline">
                                        <input type="radio" name="mode" id="development" value="0">Development(beta)
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="mode" id="production" value="1" checked>Production
                                    </label>
                                </div>

                                <div class="form-group{{ $errors->has('coming_soon') ? 'has-error' : '' }}">
                                    <label>App coming soon</label>
                                    <label class="radio-inline">
                                        <input type="radio" name="coming_soon" id="development"
                                               value="0">No
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="coming_soon" id="production"
                                               value="1" checked>Yes
                                    </label>
                                </div>

                                <div class="form-group{{ $errors->has('page') ? 'has-error' : '' }}">
                                    <label>Page view</label>
                                    <input type="text" name="page" class="form-control" id="page"
                                           placeholder="app creation page">
                                </div>

                                <div class="form-group{{ $errors->has('version_name') ? 'has-error' : '' }}">
                                    <label>Version name</label>
                                    <input type="text" name="version_name" class="form-control" id="version_name"
                                           placeholder="version name">
                                </div>

                                <div class="form-group{{ $errors->has('version_no') ? 'has-error' : '' }}">
                                    <label>Version no</label>
                                    <input type="text" name="version_no" class="form-control" id="version_no"
                                           placeholder="version no">
                                </div>

                                <div class="form-group{{ $errors->has('status') ? 'has-error' : '' }}">
                                    <label>Status</label>
                                    <label class="radio-inline">
                                        <input type="radio" name="status" id="disabled" value="0" checked>Disable
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="status" id="active" value="1">Active
                                    </label>
                                </div>

                                <div class="form-group{{ $errors->has('category') ? 'has-error' : '' }}">
                                    <label>App category</label>
                                    <select name="category" class="form-control" id="category">
                                        <option>-------- Select a category --------</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->title }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group{{ $errors->has('payment_model') ? 'has-error' : '' }}">
                                    <label>Payment model</label>
                                    <select name="payment_model" class="form-control" id="payment_model">
                                        <option>-------- Select a payment model --------</option>
                                        @foreach($payments as $payment)
                                            <option value="{{ $payment->id }}">{{ $payment->title }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group{{ $errors->has('features') ? 'has-error' : '' }}">
                                    <label class="control-label">App features</label>

                                    <p class="help-block">App features define different parts of an app</p>

                                    <button type="button" name="btnFeatureGen" id="btnFeatureGen"
                                            class="btn btn-default btn-sm"
                                            data-toggle="tooltip" title="Add new feature">
                                        Add new feature <span class="fa fa-plus"></span>
                                    </button>
                                </div>

                                <div class="form-group">
                                    <button type="submit" name="btnCreateApp" class="btn btn-success btn-lg"
                                            id="btnCreateApp">
                                        Save
                                    </button>
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