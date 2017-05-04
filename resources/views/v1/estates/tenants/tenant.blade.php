@extends('layouts.estates')

@section('title')
    {{ $tenant->user->firstname }} {{ $tenant->user->lastname }}
@endsection

@section('breadcrumb')
    <li><a href="{{ route('estate.rental.tenants', ['id' => $app->id, 'sort' => 'all']) }}">Tenants</a></li>
    <li class="active">{{ $tenant->user->firstname }} {{ $tenant->user->lastname }}</li>
@endsection

@section('page-header')
    {{ $tenant->user->firstname }} {{ $tenant->user->lastname }}
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <form name="add-tenant-form" method="post" action="{{ route('estate.rental.tenant.update') }}"
                  enctype="application/x-www-form-urlencoded" autocomplete="off">

                @include('includes.alerts.validation')

                @include('includes.alerts.default')

                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <input type="hidden" name="id" id="id" value="{{ $lease->id }}">

                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <p class="help-block visible-xs">Tenant details:</p>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group{{ $errors->has('first_name') ? 'has-error' : '' }}">
                                    <label class="control-label" for="store">First name:</label>
                                    <p class="form-control-static">{{ $tenant->user->firstname }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group{{ $errors->has('last_name') ? 'has-error' : '' }}">
                                    <label class="control-label" for="store">Last name:</label>
                                    <div class="form-control-static">{{ $tenant->user->lastname }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group{{ $errors->has('email') ? 'has-error' : '' }}">
                                    <label class="control-label" for="email">Email address:</label>
                                    <p class="form-static-control">{{ $tenant->user->email }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="id_no">Id no/ passport no:</label>
                                    <input type="text" name="id_no" class="form-control" placeholder="national id no..."
                                           id="id_no" maxlength="45" value="{{ Request::old('id_no') }}"/>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="country">Country:</label>
                                    <p class="form-control-static">{{ $tenant->user->country != null ? $tenant->user->country : '-' }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="phone">Phone number:</label>
                                    <p class="form-control-static">{{ $tenant->user->phone != null ? $tenant->user->phone : '-' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.col-md-6-->

                    <div class="col-xs-12 col-sm-6">
                        <p class="help-block visible-xs">Tenant property details:</p>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="group">Group:</label>
                                    <select id="group" class="form-control">
                                        <option>Select a group</option>
                                        <option {{ $tenant_group == null ? 'selected' : ''}}></option>
                                        @foreach($groups as $group)
                                            <option value="{{ $group->id }}"
                                                    {{ $tenant_group == $group->id ? 'selected' : ''}}>
                                                {{ $group->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <p class="help-block">Choose blank to get properties with no group.</p>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="property">Property:</label>
                                    <select name="property" id="property" class="form-control">
                                        <option>Select a property first</option>
                                        @foreach($properties as $property)
                                            <option value="{{ $property->id }}"
                                                    {{ $tenant_property == $property->id ? 'selected' : ''}}>
                                                {{ $property->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <label for="move_in">Move in date:</label>
                                <div class="form-group input-group">
                                    <input type="text" name="move_in" class="form-control date-selector"
                                           placeholder="move in date" id="move_in"
                                           value="{{ Request::old('move_in') != null ? Request::old('move_in') : $lease->move_in }}"/>
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar-plus-o"></i>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <label for="lease_duration">Lease duration (in months):</label>
                                <div class="form-group input-group">
                                    <input type="number" name="lease_duration" class="form-control" id="lease_duration"
                                           min="1" range="1" max="270"
                                           value="{{ Request::old('lease_duration') != null ? Request::old('lease_duration') : $lease->lease_duration }}"/>
                                    <span class="input-group-addon">
                                        month(s)
                                    </span>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="tenant_review">Tenant comment:</label>
                                    <textarea name="tenant_review" class="form-control" rows="3" cols="5"
                                              id="tenant_review"
                                              placeholder="tenant review">{{ Request::old('tenant_review') }}</textarea>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Lease status:</label>
                            <br>
                            <label class="radio-inline">
                                <input type="radio" name="status" class="tenant-status" id="off"
                                       value="0"
                                       @if($lease->status == 0 || Request::old('status') == 0) checked @endif>
                                Vacated
                            </label>

                            <label class="radio-inline">
                                <input type="radio" name="status" class="tenant-status" id="on"
                                       value="1"
                                       @if($lease->status == 1 || Request::old('status') == 1) checked @endif>
                                Active
                            </label>
                        </div>
                    </div>
                </div>

                <div class="box" id="moveOut"
                     @if($lease->status == 1 || Request::old('status') == 1)style="display: none;" @endif>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="move_out">Move out date:</label>
                            <div class="form-group input-group">
                                <input type="text" name="move_out" class="form-control date-selector"
                                       placeholder="move in date" id="move_out"
                                       value="{{ Request::old('move_out') != null ? Request::old('move_out') : $lease->move_out }}"/>
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar-plus-o"></i>
                                    </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <button type="submit" name="btnAddAmenity" role="button"
                                class="btn btn-primary btn-sm btn-social" {{ $app->subscribed != 1 ? 'disabled' : '' }}>
                            <i class="fa fa-user"></i>
                            Update
                        </button>
                    </div>
                </div>
            </form>

        </div>
    </div>

    <script>
        $urlGroupProperties = '{{ route('estate.rental.tenant.group.properties') }}';
        $app = '{{ $app->id }}';
        //        CKEDITOR.replace('property_desc');
    </script>
@endsection
