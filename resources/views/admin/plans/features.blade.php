@extends('layouts.admin')

@section('title')
    {{ $plan->title }} plan
@endsection

@section('breadcrumb')
    <li>
        <a href="{{ route('admin.apps', ['sort' => 'all']) }}">
            Apps
        </a>
    </li>
    <li>
        <a href="{{ route('admin.app.view', ['id' => $plan->app->id]) }}">
            {{ $plan->app->title }}
        </a>
    </li>
    <li>
        <a href="{{ route('admin.app.plan.view', ['id' => $plan->id]) }}">
            {{ $plan->title }} plan
        </a>
    </li>
    <li class="active">Features</li>
@endsection

@section('page-header')
    {{ $plan->title }} plan
@endsection

@section('content')
    <div class="row">

        <div class="col-lg-12">
            <div class="panel panel-default" id="AppPlans">

                <div class="panel-heading">
                    <h4 class="panel-title">
                        Choose which features to add:
                    </h4>
                </div>

                <div class="panel-body">
                    <form method="post" action="{{ route('admin.plan.feature.store') }}"
                          enctype="application/x-www-form-urlencoded" id="AddPlan" autocomplete="off">

                        <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">

                        <input type="hidden" name="plan" id="plan" value="{{ $plan->id }}">
                        @include('partials.alerts.default')

                        @include('partials.alerts.validation')

                        @for($i = 0; $i < count($features); $i++)
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>&nbsp;</label>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="feature[]" id="{{ $features[$i]->id }}"
                                                       value="{{ $features[$i]->id }}">
                                                {{ $features[$i]->feature }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="control-label">Limit</label>
                                        <input type="text" name="limit[]" class="form-control" placeholder="limit"
                                               value="{{ Request::old('limit') != null ? Request::old('limit')[$i] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="control-label">Price</label>
                                        <input type="text" name="price[]" class="form-control"
                                               value="{{ Request::old('price') != null ? Request::old('price')[$i] : '0.00' }}">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="control-label">Allow trial</label>
                                        <select name="trial[]" class="form-control" id="trial">
                                            <option value="0"
                                                    {{ Request::old('trial') != null && Request::old('trial')[$i] == 0 ? 'selected' : '' }}>
                                                No
                                            </option>
                                            <option value="1"
                                                    {{ Request::old('trial')[$i] != null && Request::old('trial')[$i] == 1 ? 'selected' : '' }}>
                                                Yes
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Status</label>
                                        <select name="status[]" class="form-control" id="status">
                                            <option value="0" {{ Request::old('status') != null && Request::old('status')[$i] == 0 ? 'selected' : '' }}>
                                                Disabled
                                            </option>
                                            <option value="1" {{ Request::old('status') != null && Request::old('status')[$i] == 1 ? 'selected' : '' }}>
                                                Active
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        @endfor

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success btn-lg">Save</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- /#AddPlan -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel#AppPlans -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

@endsection