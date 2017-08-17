@extends('layouts.admin')

@section('title')
    {{ $company->title }} Profile
@endsection

@section('breadcrumb')
    <li>Companies</li>
    <li>{{ $company->title }}</li>
    <li class="active">Profile</li>
@endsection

@section('page-header')
    <i class="fa fa-globe"></i> Companies
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <p class="lead">Below are the company's profile, apps and its stats</p>
            <div class="box">
                <form>
                    <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">

                    <input type="hidden" name="id" id="_app" value="{{ $company->id }}">

                    <input type="hidden" name="_role" id="_role" value="3">

                    <p class="help-block">
                        Fields with an asterisk (<span class="text-danger">*</span>) are required.
                    </p>

                    <div class="row">
                        <div class="col-lg-6">
                            <h3>Profile</h3>
                            <hr>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group{{ $errors->has('company') ? 'has-error' : '' }}">
                                        <label for="company">Company name: <span class="text-danger">*</span></label>
                                        <p class="form-static-control">{{ $company->title }}</p>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group{{ $errors->has('country') ? 'has-error' : '' }}">
                                        <label for="name">Country: <span class="text-danger">*</span></label>
                                        <p class="form-static-control">{{ $company->country }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group{{ $errors->has('city') ? 'has-error' : '' }}">
                                        <label for="name">City:</label>
                                        <p class="form-static-control">{{ $company->city }}</p>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group{{ $errors->has('zipcode') ? 'has-error' : '' }}">
                                        <label for="name">Zipcode:</label>
                                        <p class="form-static-control">{{ $company->zipcode }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group{{ $errors->has('state') ? 'has-error' : '' }}">
                                        <label for="state">State:</label>
                                        <p class="form-static-control">{{ $company->state }}</p>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group{{ $errors->has('address') ? 'has-error' : '' }}">
                                        <label for="address">Street (or address):</label>
                                        <p class="form-static-control">{{ $company->address }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group{{ $errors->has('phone') ? 'has-error' : '' }}">
                                        <label for="phone">Phone: <span class="text-danger">*</span></label>
                                        <p class="form-static-control">{{ $company->phone }}</p>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group{{ $errors->has('email') ? 'has-error' : '' }}">
                                        <label for="email">Email: <span class="text-danger">*</span></label>
                                        <p class="form-static-control">{{ $company->email }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Status:<span class="text-danger">*</span></label>
                                        <p class="form-static-control">{{ AppStatusText($company->status) }}</p>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <h3>
                                <i class="fa fa-laptop"></i> Apps
                                <div class="badge">{{ $company->apps_count }}</div>
                            </h3>
                            <hr>
                            <div class="list-group">
                                @forelse($company->apps as $app)
                                    <div class="list-group-item">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label>App</label>
                                                <p class="form-static-control">
                                                    <i class="fa {{ $app->product->icon }}"></i>
                                                    {{ $app->product->title }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label>Created on</label>
                                                <p class="form-static-control">
                                                    {{ $app->created_at->toDateTimeString() }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label>Status</label>
                                                <p class="form-static-control">{{ AppStatusText($app->status) }}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label>Subscription</label>
                                                <p class="form-static-control">
                                                    {{ $app->subscribed == 1 ? 'Subscribed' : 'No active subscription found' }}
                                                    -
                                                    @if($app->is_trial && !$app->trials()->first()->is_cancelled)
                                                        On Trial Subscription
                                                    @else
                                                        Normal Subscription
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="pull-right">
                                                    <div class="btn-group btn-group-sm">
                                                        <a href="{{ route('admin_company_app.show', ['admin_company_app' => $app->id]) }}"
                                                           class="btn btn-primary">
                                                            <i class="fa fa-eye"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="list-group-item">
                                        <h4>No apps found.</h4>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>

                </form>
                <!-- / form -->
            </div>
        </div>
        <!-- / .col-lg-12 -->
    </div>
    <!-- / .row -->
@endsection