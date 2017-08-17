@extends('layouts.admin')

@section('title')
    {{ $app->company->title }} | {{ $app->product->title }} | Profile
@endsection

@section('breadcrumb')
    <li>{{ $app->company->title }}</li>
    <li>{{ $app->product->title }}</li>
    <li class="active">Profile</li>
@endsection

@section('page-header')
    {{ $app->company->title }} <span class="small text-muted">{{ $app->product->title }}</span> Profile
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <form action="">
                <p class="lead">You can view the company's app details and stats below.</p>
                @include('partials.alerts.default')
                <div class="row">
                    <div class="col-sm-6">
                        <h3>Profile</h3>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Company name</label>
                                    <p class="form-static-control">
                                        {{ $app->company->title }}
                                        <a href="{{ route('admin_company.show', ['admin_company' => $app->company->id]) }}"
                                           class="btn btn-primary btn-xs">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>App name</label>
                                    <p class="form-static-control">
                                        {{ $app->product->title }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- /.row -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Created</label>
                                    <p class="form-static-control">
                                        {{ $app->created_at->diffForHumans() }}
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Last changes made</label>
                                    <p class="form-static-control">
                                        {{ $app->updated_at->diffForHumans() }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- /.row -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>App status</label>
                                    <p class="form-static-control">
                                        {{ $app->status == 1 ? 'Active' : 'Disabled' }}
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Subscription</label>
                                    <p class="form-static-control">
                                        {{ $app->subscribed == 1 ? 'Subscribed' : 'No active subscription found' }}
                                        -
                                        @if($app->is_trial && !$subscription->is_cancelled)
                                            On Trial Subscription
                                        @else
                                            Normal Subscription
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.col-sm-6 -->
                    <div class="col-sm-6">
                        <h3>Stats</h3>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><i class="fa fa-building-o"></i> Property Groups</label>
                                    <p class="form-control-static">{{ $app->groups_count }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><i class="fa fa-home"></i> Properties</label>
                                    <p class="form-control-static">{{ $app->properties_count }}</p>
                                </div>
                            </div>
                        </div>
                        <!-- /.row -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><i class="fa fa-users"></i> Tenants</label>
                                    <p class="form-control-static">{{ $app->tenants_count }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><i class="fa fa-paperclip"></i> Leases</label>
                                    <p class="form-control-static">{{ $app->leases_count }}</p>
                                </div>
                            </div>
                        </div>
                        <!-- /.row -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><i class="fa fa-credit-card"></i> Rents</label>
                                    <p class="form-control-static">{{ $app->rents_count }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><i class="fa fa-credit-card-alt"></i> Bills</label>
                                    <p class="form-control-static">{{ $app->bills_count }}</p>
                                </div>
                            </div>
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.col-sm-6 -->
                </div>
                <!-- /.row -->
            </form>
        </div>
    </div>

@endsection
