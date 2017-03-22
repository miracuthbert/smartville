@extends('layouts.admin')

@section('title')
    Create Plan For {{ $app->title }}
@endsection

@section('breadcrumb')
    <li>App</li>
    <li>
        <a href="{{ route('admin.app.view', ['id' => $app->id]) }}">{{ $app->title }}</a>
    </li>
    <li>Plans</li>
    <li class="active">Create Plan</li>
@endsection

@section('page-header')
    Create Plan For {{ $app->title }}
@endsection

@section('content')
    <div class="row">

        @include('includes.alerts.default')
        @include('includes.alerts.validation')

        <div class="col-lg-12">
            <div class="panel panel-green" id="AppPlans">

                <div class="panel-heading hidden">
                    <h4 class="panel-title">
                        App New Plan
                    </h4>
                </div>

                <div class="panel-body">
                    <form method="post" action="{{ route('admin.app.plan.store') }}"
                          enctype="application/x-www-form-urlencoded" id="AddPlan" autocomplete="on">

                        <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">

                        <input type="hidden" name="_app" id="_app" value="{{ $app->id }}">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title">Title:</label>
                                    <input type="text" name="title" class="form-control" id="title"
                                           placeholder="plan title" value="{{ Request::old('title') }}" required autofocus>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="price">Price:</label>
                                <div class="form-group input-group">
                                    <span class="input-group-addon">$</span>
                                    <input type="text" name="price" class="form-control" id="price"
                                           placeholder="plan price" value="{{ Request::old('price') }}" required>
                                </div>
                            </div>
                        </div>
                        <!-- /.row title & price -->

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="summary">Summary:</label>
                                    <textarea name="summary" id="summary" cols="30" rows="3" class="form-control"
                                              placeholder="plan summary...">{{ Request::old('summary') }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="description">Description:</label>
                                    <textarea name="description" id="description" cols="60" rows="5"
                                              class="form-control ckeditor"
                                              placeholder="plan details...">{{ Request::old('description') }}</textarea>
                                </div>
                            </div>
                        </div>
                        <!-- /.row summary & description -->

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="minimum">Minimum:</label>
                                    <input type="number" name="minimum" id="minimum" class="form-control"
                                           min="10" placeholder="minimum records" value="{{ Request::old('minimum') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="limit">Maximum limit:</label>
                                    <input type="number" name="limit" id="limit" class="form-control"
                                           min="10" placeholder="maximum records" value="{{ Request::old('limit') }}">
                                </div>
                            </div>
                        </div>
                        <!-- /.row min & limit -->

                        <div class="row">
                            <div class="col-md-6">
                                <label>Trial:</label>
                                <div class="form-group">
                                    <label class="radio-inline">
                                        <input type="radio" name="trial" id="_off" value="0">
                                        Disabled
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="trial" id="_on" value="1" checked>
                                        Enabled
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="trial_days">Trial days:</label>
                                    <input type="number" name="trial_days" id="trial_days"
                                           class="form-control" value="14">
                                </div>
                            </div>
                        </div>
                        <!-- /.row trial & trial_days -->

                        <div class="row">
                            <div class="col-md-6">
                                <label>Status:</label>
                                <div class="form-group">
                                    <label class="radio-inline">
                                        <input type="radio" name="status" id="disabled" value="0">
                                        Disabled
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="status" id="active" value="1" checked>
                                        Active
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                </div>
                            </div>
                        </div>
                        <!-- /.row status -->

                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" id="btnCreatePlan" class="btn btn-success">Add plan</button>
                            </div>
                        </div>
                        <!-- /.row button -->

                    </form>
                    <!-- /#AddPlan -->
                </div>
            </div>
            <!-- /.panel#AppPlans -->
        </div>
    </div>
    <!-- /.row -->

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

    <script>
        $urlFeatureStore = '{{ route('admin.app.feature.store') }}';
        $urlFeatureUpdate = '{{ route('admin.app.feature.update') }}';
    </script>

@endsection