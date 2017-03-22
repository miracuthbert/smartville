@extends('v1.layouts.tenant')

@section('title')
    {{ $tenant->user->firstname }} {{ $tenant->user->lastname }}
@endsection

@section('breadcrumb')
    <li><a href="{{ route('tenant.leases', ['id' => $tenant->id]) }}">Leases</a></li>
    <li class="active">{{ $tenant->user->firstname }} {{ $tenant->user->lastname }}</li>
@endsection

@section('page-header')
    <h2><i class="fa fa-pencil-square"></i> Lease For {{ $property->title }}</h2>
    <hr>
@endsection

@section('content')
    <div id="lease-wrapper">
        <div class="row">
            <div class="col-lg-6">
                <h3>Lease property details</h3>
                <hr>

                <div class="row">
                    <div class="col-sm-12">
                        <p class="lead">Property:</p>
                        <p class="lead text-muted">{{ $property->title }}</p>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-sm-12">
                        <p class="lead">Group:</p>
                        <p class="lead text-muted">
                            {{ $group != null ? $group->title : '-' }}
                        </p>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-sm-12">
                        <p class="lead">Move in date:</p>
                        <p class="lead text-muted">
                            {{ $lease->move_in }}
                        </p>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-sm-12">
                        <p class="lead">Lease duration:</p>
                        <p class="lead text-muted">
                            {{ $lease->lease_duration }} month(s)
                        </p>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-sm-12">
                        @if($lease->move_out != null)
                            <p>Move out date: {{ $lease->move_out }}</p>
                        @endif

                        <p class="lead">Lease status:</p>
                        <p class="lead text-muted">
                            <span class="{{ PropertyStatusLabel($lease->status) }}">
                                         {{ LeaseStatusText($lease->status) }}
                             </span>
                        </p>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.col-lg-6 -->
            <div class="col-lg-6">
                <h3>Personal details:</h3>
                <hr>
                <div class="row">
                    <div class="col-sm-12">
                        <p class="lead">First name:</p>
                        <p class="lead text-muted">{{ $tenant->user->firstname }}</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <p class="lead">Last name:</p>
                        <p class="lead text-muted">{{ $tenant->user->lastname }}</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <p class="lead">Country:</p>
                        <p class="lead text-muted">
                            {{ $tenant->user->country != null ? $tenant->user->country : '-' }}
                        </p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <p class="lead">Phone number:</p>
                        <p class="lead text-muted">
                            {{ $tenant->user->phone != null ? $tenant->user->phone : '-' }}
                        </p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <p class="lead">Email address:</p>
                        <p class="lead text-muted">
                            {{ $tenant->user->email }}
                        </p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <p class="lead">Id no/ passport no:</p>
                        <p class="lead text-muted">
                            {{ $tenant->user->id_no != null ? $tenant->user->id_no : '-' }}
                        </p>
                    </div>
                </div>
            </div>
            <!-- /.col-lg-6 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /#lease-wrapper -->
@endsection
