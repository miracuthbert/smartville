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

@section('form-nav')
    <li>
        <a href="{{ route('admin.app.edit', ['id' => $app->id]) }}">Edit App</a>
    </li>
    <li>
        <a href="{{ route('admin.app.plan.create', ['id' => $app->id]) }}">Add a plan</a>
    </li>
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
        <!-- /.col-lg-7 -->

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
    </script>

@endsection