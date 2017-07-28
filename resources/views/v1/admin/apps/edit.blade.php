@extends('layouts.admin')

@section('title')
    Edit App
@endsection

@section('breadcrumb')
    <li><a href="{{ route('admin.apps', ['sort' => 'all']) }}">Apps</a></li>
    <li class="active">Edit App</li>

@endsection

@section('page-header')
    <i class="fa fa-edit"></i> Edit App
@endsection

@section('form-nav')
    <li>
        <a href="{{ route('admin.app.view', ['id' => $app->id]) }}">Features & Plans</a>
    </li>
    <li>
        <a href="{{ route('admin.app.plan.create', ['id' => $app->id]) }}">Add a plan</a>
    </li>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            @include('includes.alerts.default')

            <form role="form" method="post" action="{{ route('admin.app.update', ['id' => $app->id]) }}"
                  enctype="multipart/form-data"
                  autocomplete="on">
                @include('includes.alerts.validation')

                {{ csrf_field() }}
                {{ method_field('put') }}

                <input type="hidden" name="app" value="1"><!--/ Set app to true -->

                <input type="hidden" name="id" value="{{ $app->id }}">

                <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                    <label for="title">App title</label>
                    <input type="text" name="title" class="form-control" id="title"
                           placeholder="app title"
                           value="{{ old('title') != null ? old('title') : $app->title }}"
                           required autofocus>
                </div>

                <div class="form-group {{ $errors->has('slug') ? 'has-error' : '' }}">
                    <label for="slug">Slug</label>
                    <input type="text" name="slug" class="form-control" id="slug"
                           placeholder="slug"
                           value="{{ old('slug') != null ? old('slug') : $app->slug }}"
                           required autofocus>
                </div>

                <div class="form-group {{ $errors->has('summary') ? 'has-error' : '' }}">
                    <label for="summary">Summary</label>
                    <textarea name="summary" id="summary" cols="30" rows="3" class="form-control"
                              placeholder="brief details of the app">{{ old('summary') != null ? old('summary') : $app->summary }}</textarea>
                </div>

                <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                    <label for="description">App Description</label>
                    <textarea name="description" id="description" cols="30" rows="5" class="form-control ckeditor"
                              placeholder="full details of the app">{{ old('description') != null ? old('description') : $app->desc }}</textarea>
                </div>

                <div class="form-group">
                    <label for="logo">App logo</label>
                    <input type="file" name="logo" class="form-control" id="logo">
                </div>

                <div class="form-group {{ $errors->has('mode') ? 'has-error' : '' }}">
                    <label>App Mode</label>
                    <label class="radio-inline">
                        <input type="radio" name="mode" id="development"
                               value="0" {{ $app->status == 0 ? 'checked' : '' }}>Development(beta)
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="mode" id="production"
                               value="1" {{ $app->status == 1 ? 'checked' : '' }}>Production
                    </label>
                </div>

                <div class="form-group {{ $errors->has('coming_soon') ? 'has-error' : '' }}">
                    <label>App coming soon</label>
                    <label class="radio-inline">
                        <input type="radio" name="coming_soon" id="development"
                               value="0" {{ $app->coming_soon == 0 ? 'checked' : '' }}>No
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="coming_soon" id="production"
                               value="1" {{ $app->coming_soon == 1 ? 'checked' : '' }}>Yes
                    </label>
                </div>

                <div class="form-group {{ $errors->has('page') ? 'has-error' : '' }}">
                    <label class="page">Page view</label>
                    <input type="text" name="page" class="form-control" id="page"
                           placeholder="app creation page" value="{{ $app->page }}">
                </div>

                <div class="form-group {{ $errors->has('version_name') ? 'has-error' : '' }}">
                    <label>Version name</label>
                    <input type="text" name="version_name" class="form-control"
                           id="version_name"
                           placeholder="version name" value="{{ $app->version_name }}">
                </div>

                <div class="form-group {{ $errors->has('version_no') ? 'has-error' : '' }}">
                    <label>Version no</label>
                    <input type="text" name="version_no" class="form-control"
                           id="version_no"
                           placeholder="version no" value="{{ $app->version_no }}">
                </div>

                <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                    <label>Status</label>
                    <label class="radio-inline">
                        <input type="radio" name="status" id="disabled"
                               value="0" {{ $app->status == 0 ? 'checked' : '' }}>Disable
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="status" id="active"
                               value="1" {{ $app->status == 1 ? 'checked' : '' }}>Active
                    </label>
                </div>

                <div class="form-group {{ $errors->has('category') ? 'has-error' : '' }}">
                    <label>App category</label>
                    <select name="category" class="form-control" id="category">
                        <option>-------- Select a category --------</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $app->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->title }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group {{ $errors->has('payment_model') ? 'has-error' : '' }}">
                    <label>Payment model</label>
                    <select name="payment_model" class="form-control" id="payment_model">
                        <option>-------- Select a payment model --------</option>
                        @foreach($payments as $payment)
                            <option value="{{ $payment->id }}" {{ $app->monetization_id == $payment->id ? 'selected' : '' }}>
                                {{ $payment->title }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <button type="submit" name="btnUpdateApp" class="btn btn-primary btn-lg"
                            id="btnUpdateApp">
                        Update
                    </button>
                </div>
            </form>
        </div><!-- /.col-lg-12 -->
    </div><!-- /.row -->

    <div class="modal fade" id="featureEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header panel-heading">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit Feature</h4>
                </div>
                <div class="modal-body panel-body">
                    <form action="" id="feature-edit">
                        <input type="hidden" name="_fid" id="_fid" value="-1">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="feature">Feature</label>
                                    <input type="text" name="_feature" class="form-control newdata"
                                           id="_feature"
                                           placeholder="feature">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="feature_details">Details</label>
                                        <textarea name="_details" rows="3" class="form-control newdata"
                                                  id="_details" placeholder="feature details"></textarea>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer panel-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="btnFeatureUpdate">Save changes</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

@endsection

@section('scripts')
    <script>
        $urlFeatureStore = '{{ route('admin.app.feature.store') }}';
        $urlFeatureUpdate = '{{ route('admin.app.feature.update') }}';
    </script>
@endsection