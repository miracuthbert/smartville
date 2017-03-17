@extends('layouts.tenant')

@section('title')
    {{ $tenant->user->firstname }} {{ $tenant->user->lastname }}
@endsection

@section('breadcrumb')
    <li><a href="{{ route('tenant.leases', ['id' => $tenant->id]) }}">Leases</a></li>
    <li class="active">{{ $tenant->user->firstname }} {{ $tenant->user->lastname }}</li>
@endsection

@section('page-header')
    Lease For {{ $property->title }}
@endsection

@section('content')

    <div class="box lead">
        <div class="row">
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-lg-6">
                        <p>Group:</p>
                    </div>
                    <div class="col-lg-6 text-right">
                        <p>
                            {{ $group != null ? $group->title : '-' }}
                        </p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <p>Move in date:</p>
                    </div>
                    <div class="col-lg-6 text-right">
                        <p>
                            {{ $lease->move_in }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="row">
                    <div class="col-lg-6">
                        <p>Property:</p>
                    </div>
                    <div class="col-lg-6 text-right">
                        {{ $property->title }}
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <p>Lease duration:</p>
                    </div>
                    <div class="col-md-6 text-right">
                        <p>
                            {{ $lease->lease_duration }} month(s)
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <hr>
        <div class="row">
            <div class="col-lg-6 text-left">
                <div @if($lease->status == 1) style="display: none;" @endif>
                    <p>Move out date: {{ $lease->move_out }}</p>
                </div>
            </div>

            <div class="col-lg-6 text-right">
                <p>Lease status:
                    {{ $lease->status == 0 ? 'Vacated' : '' }} {{ $lease->status == 1 ? 'Active' : '' }}
                </p>
            </div>
        </div>

    </div>

    <div class="box lead">
        <div class="row">
            <div class="col-lg-6">
                <p class="help-block visible-xs">Tenant details:</p>

                <div class="row">
                    <div class="col-md-6">
                        <p>First name:</p>
                    </div>
                    <div class="col-md-6 text-right">
                        <p>{{ $tenant->user->firstname }}</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <p>Last name:</p>
                    </div>
                    <div class="col-md-6 text-right">
                        <p>{{ $tenant->user->lastname }}</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <p>Country:</p>
                    </div>
                    <div class="col-md-6 text-right">
                        <p>{{ $tenant->user->country != null ? $tenant->user->country : '-' }}</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <p>Phone number:</p>
                    </div>
                    <div class="col-md-6 text-right">
                        <p>{{ $tenant->user->phone != null ? $tenant->user->phone : '-' }}</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="row">
                    <div class="col-md-6">
                        <p>Email address:</p>
                    </div>
                    <div class="col-md-6 text-right">
                        <p>{{ $tenant->user->email }}</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <p>Id no/ passport no:</p>
                    </div>
                    <div class="col-md-6 text-right">
                        <p>{{ $tenant->user->id_no != null ? $tenant->user->id_no : '-' }}</p>
                    </div>
                </div>
            </div>
            <!-- /.col-md-6-->
        </div>
    </div>
@endsection
