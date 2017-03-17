@extends('layouts.estates')

@section('title')
    Company App Profile
@endsection

@section('breadcrumb')
    <li class="active">Profile</li>
@endsection

@section('content')


    <section class="section-pad">
        <h1 class="page-header">Company App Profile</h1>

        <p class="text-muted">Change and update your company app profile here.</p>

        <div class="row">
            <div class="col-lg-12">
                <form action="">
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
    </section>

@endsection
