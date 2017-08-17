@extends('layouts.admin')

@section('title')
    {{ $plan->title }} plan
@endsection

@section('breadcrumb')
    <li><a href="{{ route('admin.apps', ['sort' => 'all']) }}">Apps</a></li>
    <li><a href="{{ route('admin.app.view', ['id' => $plan->app->id]) }}">{{ $plan->app->title }}</a></li>
    <li class="active">{{ $plan->title }} plan</li>
@endsection

@section('page-header')
    {{ $plan->title }} plan
@endsection

@section('content')
    <div class="row">

        @include('partials.alerts.default')

        <div class="col-lg-12">
            <div class="panel panel-green" id="AppPlans">

                <div class="panel-heading hidden">
                    <h4 class="panel-title">
                        App New Plan
                    </h4>
                </div>

                <div class="panel-body">
                    <form method="post" action="{{ route('admin.app.plan.update') }}"
                          enctype="application/x-www-form-urlencoded" id="AddPlan" autocomplete="off">

                        <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">

                        <input type="hidden" name="_plan" id="_plan" value="{{ $plan->id }}">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title">Title:</label>
                                    <input type="text" name="title" class="form-control" id="title"
                                           value="{{ $plan->title }}" required autofocus>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="price">Price:</label>
                                <div class="form-group input-group">
                                    <span class="input-group-addon">$</span>
                                    <input type="text" name="price" class="form-control" id="price"
                                           value="{{ $plan->price }}" required>
                                </div>
                            </div>
                        </div>
                        <!-- /.row title & price -->

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="summary">Summary:</label>
                                    <textarea name="summary" id="summary" cols="30" rows="3" class="form-control"
                                              placeholder="plan summary...">{{ $plan->summary }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="description">Description:</label>
                                    <textarea name="description" id="description" cols="60" rows="5"
                                              class="form-control ckeditor"
                                              placeholder="plan details...">{{ $plan->description }}</textarea>
                                </div>
                            </div>
                        </div>
                        <!-- /.row summary & description -->

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="minimum">Minimum:</label>
                                    <input type="number" name="minimum" id="minimum" class="form-control"
                                           min="1" placeholder="minimum records"
                                           value="{{ Request::old('minimum') != null ? Request::old('minimum') : $plan->minimum  }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="limit">Maximum limit:</label>
                                    <input type="number" name="limit" id="limit" class="form-control"
                                           min="10" placeholder="maximum records" value="{{ Request::old('limit') != null ? Request::old('limit') : $plan->limit }}">
                                </div>
                            </div>
                        </div>
                        <!-- /.row min & limit -->

                        <div class="row">
                            <div class="col-md-6">
                                <label>Trial:</label>
                                <div class="form-group">
                                    <label class="radio-inline">
                                        <input type="radio" name="trial" id="_off"
                                               value="0" {{ $plan->trial == 0 ? 'checked' : '' }}>
                                        Disabled
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="trial" id="_on"
                                               value="1" {{ $plan->trial == 1 ? 'checked' : '' }}>
                                        Enabled
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="trial_days">Trial days:</label>
                                    <input type="number" name="trial_days" id="trial_days"
                                           class="form-control" value="{{ $plan->trial }}">
                                </div>
                            </div>
                        </div>
                        <!-- /.row trial & trial_days -->

                        <div class="row">
                            <div class="col-md-6">
                                <label>Status:</label>
                                <div class="form-group">
                                    <label class="radio-inline">
                                        <input type="radio" name="status" id="disabled"
                                               value="0" {{ $plan->status == 0 ? 'checked' : '' }}>
                                        Disabled
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="status" id="active"
                                               value="1" {{ $plan->status == 1 ? 'checked' : '' }}>
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
                                <div class="box">
                                    <button type="submit" id="btnUpdatePlan" class="btn btn-success">
                                        Update plan
                                    </button>
                                </div>
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

@endsection