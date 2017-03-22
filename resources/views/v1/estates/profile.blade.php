@extends('layouts.estates')

@section('title')
    Company App Profile
@endsection

@section('breadcrumb')
    <li class="active">Profile</li>
@endsection

@section('page-header')
    Company App Profile
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <form action="">
                <p class="lead">Change and update your company app profile here.</p>
                @include('includes.alerts.default')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Company name</label>
                            <p class="form-static-control">
                                {{ $app->company->title }}
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
                                @if($subsClass == $trial && $app->onTrial() && !$subscription->is_cancelled)
                                    <a href="{{ route('estate.trial.update', ['id' => $subscription->id, 'subscription' => 'cancel']) }}"
                                       class="btn btn-default">
                                        Cancel Subscription <i class="fa fa-times-circle-o"></i>
                                    </a>
                                @elseif($subsClass == $trial && $app->onTrial() && $subscription->is_cancelled)
                                    <a href="{{ route('estate.trial.update', ['id' => $subscription->id, 'subscription' => 'resume']) }}"
                                       class="btn btn-default">
                                        Resume Subscription <i class="fa fa-check-square-o"></i>
                                    </a>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label></label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label></label>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
