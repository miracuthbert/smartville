@extends('layouts.admin')

@section('title')
    {{ $app->title }}
@endsection

@section('breadcrumb')
    <li><a href="{{ route('admin.apps', ['sort' => 'all']) }}">Apps</a></li>
    <li class="active">{{ $app->title }}</li>

@endsection

@section('page-header')
    {{ $app->title }}
@endsection

@section('content')
    <div class="row">

        @include('includes.alerts.default')

        @include('includes.alerts.validation')

        <div class="col-lg-7">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>App profile and plans</h3>
                    Edit and save changes of the app and its plans or
                    <a href="{{ route('admin.app.plan.create', ['id' => $app->id]) }}" class="btn btn-link">
                        Add Plan
                    </a>
                </div>
                <div class="panel-body">
                    <div class="panel-group" id="accordionApp">
                        <div class="panel panel-primary" id="EditApp">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordionApp" href="#collapseEditApp">
                                        Edit App
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseEditApp" class="panel-collapse collapse" aria-expanded="false">
                                <div class="panel-body">
                                    <form role="form" method="post" action="{{ route('admin.app.update') }}"
                                          enctype="multipart/form-data"
                                          autocomplete="on">
                                        @include('includes.alerts.validation')

                                        <input type="hidden" name="_token" value="{{ Session::token() }}">

                                        <input type="hidden" name="app" value="1"><!--/ Set app to true -->

                                        <input type="hidden" name="id" value="{{ $app->id }}">

                                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                            <label>App name:</label>
                                            <input type="text" name="name" class="form-control" id="name"
                                                   placeholder="app name"
                                                   value="{{ Request::old('name') != null ? Request::old('name') : $app->title }}"
                                                   required autofocus>
                                        </div>

                                        <div class="form-group {{ $errors->has('summary') ? 'has-error' : '' }}">
                                            <label>Summary:</label>
                                    <textarea name="summary" id="summary" cols="30" rows="3" class="form-control ckeditor"
                                              placeholder="brief details of the app">{{ Request::old('summary') != null ? Request::old('summary') : $app->summary }}</textarea>
                                        </div>

                                        <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                                            <label>App details:</label>
                                    <textarea name="description" id="description" cols="30" rows="5"
                                              class="form-control ckeditor"
                                              placeholder="full details of the app">{{ Request::old('description') != null ? Request::old('description') : $app->desc }}</textarea>
                                        </div>

                                        <div class="form-group">
                                            <label>App logo:</label>
                                            <input type="file" name="logo" class="form-control" id="logo">
                                        </div>

                                        <div class="form-group {{ $errors->has('mode') ? 'has-error' : '' }}">
                                            <label>App Mode:</label>
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
                                            <label>App coming soon:</label>
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
                                            <label>Page view:</label>
                                            <input type="text" name="page" class="form-control" id="page"
                                                   placeholder="app creation page" value="{{ $app->page }}">
                                        </div>

                                        <div class="form-group {{ $errors->has('version_name') ? 'has-error' : '' }}">
                                            <label>Version name:</label>
                                            <input type="text" name="version_name" class="form-control"
                                                   id="version_name"
                                                   placeholder="version name" value="{{ $app->version_name }}">
                                        </div>

                                        <div class="form-group {{ $errors->has('version_no') ? 'has-error' : '' }}">
                                            <label>Version no:</label>
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
                                            <label>App category:</label>
                                            <select name="category" class="form-control" id="category">
                                                <option>Select a category</option>
                                                @foreach($app_categories as $category)
                                                    <option value="{{ $category->id }}" {{ $app->category_id == $category->id ? 'selected' : '' }}>
                                                        {{ $category->title }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group {{ $errors->has('payment_model') ? 'has-error' : '' }}">
                                            <label>Payment model:</label>
                                            <select name="payment_model" class="form-control" id="payment_model">
                                                <option>Select a payment model</option>
                                                @foreach($app_payments as $payment)
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
                                </div>
                            </div>
                        </div>
                        <!-- /.panel#EditApp -->
                        <div class="panel panel-success" id="AppPlans">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordionApp" href="#collapseAppPlans">
                                        App monetization plans
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseAppPlans" class="panel-collapse collapse in" aria-expanded="true">
                                <div class="panel-body">
                                    @if(count($app->plans) > 0)
                                        <div class="table-responsive">
                                            <table width="100%" class="table table-striped table-bordered table-hover"
                                                   id="dataTable-apps">
                                                <thead>
                                                <tr>
                                                    <th>#.</th>
                                                    <th>Title</th>
                                                    <th>Price</th>
                                                    <th>Limit</th>
                                                    <th>Features</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($app->plans as $plan)
                                                    <tr>
                                                        <td>{{ $plan->id }}</td>
                                                        <td>{{ $plan->title }}</td>
                                                        <td>$.{{ $plan->price }}</td>
                                                        <td>{{ $plan->limit }}</td>
                                                        <td>
                                                            <a href="{{ route('admin.app.plan.features', ['id' => $plan->id]) }}"
                                                               class="btn btn-link btn-xs">
                                                                Features
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('admin.app.plan.status', ['id' => $plan->id]) }}"
                                                               class="btn btn-default btn-xs" data-toggle="tooltip"
                                                               title="{{ AppStatusToggleText($plan->status) }}">
                                                                <span class="{{ AppStatusIcon($plan->status) }}"></span>
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <div class="btn-group btn-group-xs">
                                                                <a href="{{ route('admin.app.plan.view', ['id' => $plan->id]) }}"
                                                                   class="btn btn-primary" data-toggle="tooltip"
                                                                   title="edit plan">
                                                                    <span class="fa fa-edit"></span>
                                                                </a>
                                                                <a href="{{ route('admin.app.plan.delete', ['id' => $plan->id]) }}"
                                                                   class="btn btn-warning" data-toggle="tooltip"
                                                                   title="move plan to trash">
                                                                    <span class="fa fa-remove"></span>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @else
                                        <p class="text-success">No plans added or active for this app.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- /.panel#AppPlans -->
                        <div class="panel panel-red" id="PlansTrashed">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordionApp" href="#collapsePlansTrashed">
                                        Trashed App monetization plans
                                    </a>
                                </h4>
                            </div>
                            <div id="collapsePlansTrashed" class="panel-collapse collapse in" aria-expanded="true">
                                <div class="panel-body">
                                    @if(count($app->plansTrashed) > 0)
                                        <div class="table-responsive">
                                            <table width="100%" class="table table-striped table-bordered table-hover"
                                                   id="dataTable-apps">
                                                <thead>
                                                <tr>
                                                    <th>#.</th>
                                                    <th>Title</th>
                                                    <th>Price</th>
                                                    <th>Limit</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($app->plansTrashed as $plan)
                                                    <tr>
                                                        <td>{{ $plan->id }}</td>
                                                        <td>{{ $plan->title }}</td>
                                                        <td>$.{{ $plan->price }}</td>
                                                        <td>{{ $plan->limit }}</td>
                                                        <td>
                                                            <a href="{{ route('admin.app.plan.status', ['id' => $plan->id]) }}"
                                                               class="btn btn-default btn-xs" data-toggle="tooltip"
                                                               title="{{ AppStatusToggleText($plan->status) }}">
                                                                <span class="{{ AppStatusIcon($plan->status) }}"></span>
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <div class="btn-group btn-group-xs">
                                                                <a href="{{ route('admin.app.plan.restore', ['id' => $plan->id]) }}"
                                                                   class="btn btn-success" data-toggle="tooltip"
                                                                   title="edit plan">
                                                                    <span class="fa fa-refresh"></span>
                                                                </a>
                                                                <a href="{{ route('admin.app.plan.destroy', ['id' => $plan->id]) }}"
                                                                   class="btn btn-danger" data-toggle="tooltip"
                                                                   title="move plan to trash">
                                                                    <span class="fa fa-remove"></span>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @else
                                        <p class="text-success">No plans in trash.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- /.panel#PlansTrashed -->
                    </div>
                    <!-- /#accordionApp -->
                </div>
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->

        <div class="col-lg-5">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>App features:</h3>
                    You can add a new app feature below
                </div>
                <div class="panel-body">
                    <div class="panel-group" id="accordion">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion"
                                       href="#collapseAddNew">Add new feature</a>
                                </h4>
                            </div>
                            <div id="collapseAddNew" class="panel-collapse collapse in"
                                 aria-expanded="true">
                                <div class="panel-body">
                                    <form action="" id="feature-add">
                                        <input type="hidden" name="_app" id="_app" value="{{ $app->id }}">

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="feature">Feature</label>
                                                    <input type="text" name="feature"
                                                           class="form-control newdata" id="feature"
                                                           placeholder="feature">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="feature_details">Details</label>
                                        <textarea name="feature_details" rows="3" class="form-control newdata"
                                                  id="feature_details" placeholder="feature details"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <button type="button" class="btn btn-success btn-social"
                                                            id="btnFeatureAdd">
                                                        <i class="fa fa-plus"></i> Add
                                                    </button>
                                                    <button type="reset" class="btn btn-default">
                                                        <span class="fa fa-refresh"></span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- /.panel#collapseAddNew -->

                        @if(count($app->features) > 0)
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion"
                                           href="#collapseAll">Features all</a>
                                    </h4>
                                </div>
                                <div id="collapseAll" class="panel-collapse collapse"
                                     aria-expanded="false">
                                    <div class="panel-body" id="app-features">
                                        @foreach($app->features as $feature)
                                            <blockquote>
                                                <input type="hidden" name="_fId" class="_id"
                                                       value="{{ $feature->id }}">
                                                <input type="hidden" name="_feat" class="_feat"
                                                       value="{{ $feature->feature }}">
                                                <input type="hidden" name="_details"
                                                       class="_details"
                                                       value="{{ $feature->details }}">
                                                <!-- / end of hidden feature values -->

                                                <div class="clearfix">
                                                    <strong class="pull-left feature-heading">{{ $feature->feature }}</strong>
                                                    <div class="btn-group-xs pull-right">
                                                        <a href="{{ route('admin.app.feature.status', ['id' => $feature->id]) }}"
                                                           role="button" class="btn btn-default"
                                                           data-toggle="tooltip"
                                                           title="{{ AppStatusToggleText($feature->status) }}">
                                                            <span class="{{ AppStatusIcon($feature->status) }}"></span>
                                                        </a>
                                                        <button type="button"
                                                                class="btn btn-primary btnFeatureEdit"
                                                                data-toggle="modal"
                                                                data-target="#featureEdit"
                                                                title="edit feature">
                                                            <span class="fa fa-edit"></span>
                                                        </button>
                                                        <a href="{{ route('admin.app.feature.delete', ['id' => $feature->id]) }}"
                                                           role="button"
                                                           class="btn btn-warning btnFeatureRemove"
                                                           title="move to trash">
                                                            <span class="fa fa-remove"></span>
                                                        </a>
                                                    </div>
                                                </div>

                                                <footer>
                                                    Added
                                                    <cite>{{ $feature->created_at->diffForHumans() }}</cite>
                                                </footer>
                                            </blockquote>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <!-- /.panel#collapseAll -->
                            <div class="panel panel-red">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion"
                                           href="#collapseTrashed">Features Trashed</a>
                                    </h4>
                                </div>
                                <div id="collapseTrashed" class="panel-collapse collapse"
                                     aria-expanded="false">
                                    <div class="panel-body" id="app-features">
                                        @foreach($app->featuresTrashed as $feature)
                                            <blockquote>
                                                <input type="hidden" name="_fId" class="_id"
                                                       value="{{ $feature->id }}">
                                                <input type="hidden" name="_feat" class="_feat"
                                                       value="{{ $feature->feature }}">
                                                <input type="hidden" name="_details"
                                                       class="_details"
                                                       value="{{ $feature->details }}">
                                                <!-- / end of hidden feature values -->

                                                <div class="clearfix">
                                                    <strong class="pull-left feature-heading">{{ $feature->feature }}</strong>
                                                    <div class="btn-group-xs pull-right">
                                                        <a href="{{ route('admin.app.feature.restore', ['id' => $feature->id]) }}"
                                                           role="button" class="btn btn-success"
                                                           data-toggle="tooltip"
                                                           title="restore feature">
                                                            <span class="fa fa-refresh"></span>
                                                        </a>
                                                        <a href="{{ route('admin.app.feature.destroy', ['id' => $feature->id]) }}"
                                                           role="button"
                                                           class="btn btn-danger btnFeatureDelete"
                                                           title="move to trash">
                                                            <span class="fa fa-trash"></span>
                                                        </a>
                                                    </div>
                                                </div>

                                                <footer>
                                                    Added
                                                    <cite>{{ $feature->created_at->diffForHumans() }}</cite>
                                                </footer>
                                            </blockquote>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <!-- /.panel#collapseTrashed -->
                        @else
                            <p class="text-warning">No app features added yet.</p>
                        @endif
                    </div>
                </div>
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-5 -->
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
        CKEDITOR.replace('ckeditor');
    </script>

@endsection