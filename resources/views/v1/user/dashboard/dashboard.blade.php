@extends('layouts.company')

@section('title')
    My Dashboard
@endsection

@section('content')

    @include('includes.headers.home.primary')

    <div class="container">
        <div class="section-top" id="myApps">
            @section('dashboard-title')
                <span class="glyphicon glyphicon-dashboard"></span>
                My Dashboard
            @endsection

            @include('v1.user.dashboard.header')

            <div class="row">
                <div class="col-md-12">
                    @if(count(Auth::user()->tenant) > 0)
                        <h3 class="sub-header">
                            <i class="fa fa-user"></i>
                            Tenancies
                            <span class="badge">{{ count(Auth::user()->tenancies) }}</span>
                        </h3>
                        <div class="row">
                            @if(count(Auth::user()->tenancies) > 0)
                                @foreach(Auth::user()->tenancies as $tenancy)
                                    <div class="col-md-4">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                @if($tenancy->company->company->avatar != null)
                                                    <img src="{{ url($tenancy->company->company->avatar->data['thumbUrl']) }}"
                                                         alt="{{ $tenancy->company->company->avatar->data['alt'] }}"
                                                         class="img-thumbnail">
                                                @else
                                                    <img src="{{ url('images/site/logos/thumbs/default.jpg') }}"
                                                         alt="default logo" class="img-thumbnail">
                                                @endif

                                                <strong>{{ $tenancy->company->company->title }}</strong>
                                            </div>

                                            <a href="{{ route('tenant.dashboard', ['id' => $tenancy->id]) }}">
                                                <div class="panel-footer">
                                                    <div class="clearfix">
                                                        <span class="pull-left">Go to tenant panel</span>
                                                        <div class="pull-right">
                                                            <i class="fa fa-chevron-right"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @include('v1.includes.footers.default')

@endsection