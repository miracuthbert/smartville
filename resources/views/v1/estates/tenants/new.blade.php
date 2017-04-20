@extends('layouts.estates')

@section('title')
    Add Tenant
@endsection

@section('breadcrumb')
    <li class="active">Add Tenant</li>
@endsection

@section('page-header')
    Add Tenant
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12">

            <form name="add-tenant-form" method="post" action="{{ route('estate.rental.tenant.store') }}"
                  enctype="application/x-www-form-urlencoded" autocomplete="off">

                @include('includes.alerts.validation')

                @include('includes.alerts.default')

                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <input type="hidden" name="_app" id="_app" value="{{ $app->id }}">

                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <p class="help-block visible-xs">Tenant details:</p>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group{{ $errors->has('first_name') ? 'has-error' : '' }}">
                                    <label class="control-label" for="store">First name:</label>
                                    <input type="text" name="first_name" class="form-control" id="first_name"
                                           placeholder="first name"
                                           value="{{ Request::old('first_name') }}" required autofocus/>

                                    @if ($errors->has('first_name'))
                                        <p class="help-block">
                                            <strong>{{ $errors->first('first_name') }}</strong>
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group{{ $errors->has('last_name') ? 'has-error' : '' }}">
                                    <label class="control-label" for="store">Last name:</label>
                                    <input type="text" name="last_name" class="form-control" id="last_name"
                                           placeholder="last name"
                                           value="{{ Request::old('last_name') }}" required/>

                                    @if ($errors->has('last_name'))
                                        <p class="help-block">
                                            <strong>{{ $errors->first('last_name') }}</strong>
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group{{ $errors->has('email') ? 'has-error' : '' }}">
                                    <label class="control-label" for="email">Email address:</label>
                                    <input type="email" name="email" class="form-control" id="email"
                                           placeholder="email address" value="{{ Request::old('email') }}" required/>

                                    @if ($errors->has('email'))
                                        <p class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </p>
                                    @endif
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
                                    <input type="text" name="country" class="form-control" placeholder="country..."
                                           id="country" maxlength="255" value="{{ Request::old('country') }}" required/>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="phone">Phone number:</label>
                                    <input type="text" name="phone" class="form-control" placeholder="000-000-0000"
                                           id="phone" maxlength="20" value="{{ Request::old('phone') }}"/>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <label class="control-label" for="password">Password:</label>
                                <div class="form-group{{ $errors->has('password') ? 'has-error' : '' }} input-group">
                                    <input type="password" name="password" class="form-control" required id="password"
                                           placeholder="password" value="{{ Request::old('password') }}"/>
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-default" id="btnGenPassword">
                                            <i class="fa fa-refresh"></i>
                                        </button>
                                    </span>
                                </div>

                                @if ($errors->has('password'))
                                    <p class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </p>
                                @endif
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
                                        <option></option>
                                        @foreach($groups as $group)
                                            <option value="{{ $group->id }}"
                                                    {{ Request::old('group') == $group->id ? 'selected' : ''}}>
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
                                        <option>Select a group first</option>
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
                                           value="{{ Request::old('move_in') }}"/>
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
                                           value="{{ Request::old('lease_duration') != null ? Request::old('lease_duration') : 3 }}"/>
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
                        <div class="col-xs-12 col-sm-12 hidden">
                            <div class="form-group">
                                <p><label>Tenant status:</label></p>
                                <label class="radio-inline">
                                    <input type="radio" name="status" id="off" value="0"> Checked Out
                                </label>

                                <label class="radio-inline">
                                    <input type="radio" name="status" checked id="on" value="1"> Active
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="box">
                            <button type="submit" name="btnAddAmenity" role="button"
                                    class="btn btn-success btn-sm btn-social" {{ $app->subscribed != 1 ? 'disabled' : '' }}>
                                <i class="fa fa-user-plus"></i>
                                Save
                            </button>
                        </div>
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
