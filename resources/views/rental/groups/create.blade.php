@extends('layouts.estates')

@section('title')
    Add Property Group
@endsection

@section('breadcrumb')
    <li class="active">Add Property Group</li>
@endsection

@section('page-header')
    Add Property Group
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <form name="add-group-form" method="post" action="{{ route('estate.rental.group.store') }}"
                  enctype="application/x-www-form-urlencoded" autocomplete="off">

                <div class="form-group">
                    <p class="help-block">Property groups helps grouping of properties according to location,blocks or
                        units</p>
                </div>

                @include('partials.alerts.default')

                @include('partials.alerts.validation')

                <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">

                <input type="hidden" name="_app" id="_app" value="{{ $app->id }}">

                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group{{ $errors->has('title') ? 'has-error' : '' }}">
                            <label for="title">Amenity title:</label>
                            <input type="text" name="title" class="form-control" placeholder="group title"
                                   id="title" maxlength="50" value="{{ Request::old('title') }}" required autofocus/>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <label for="location">Group location:</label>
                        <div class="form-group{{ $errors->has('location') ? 'has-error' : '' }} input-group">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-default" data-toggle="tooltip"
                                        title="add location">
                                    <i class="fa fa-map-pin"></i>
                                </button>
                            </span>
                            <input type="text" name="location" class="form-control" placeholder="group location">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-default btnReset" data-toggle="tooltip"
                                        title="reset location">
                                    <i class="fa fa-remove"></i>
                                </button>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group{{ $errors->has('description') ? 'has-error' : '' }}">
                            <label for="description">Group info:</label>
                            <textarea name="description" class="form-control" rows="3" cols="5" id="desc"
                                      placeholder="description">{{ Request::old('description') }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <p><label>Group status:</label></p>
                        <label class="radio-inline">
                            <input type="radio" name="status" id="disable" value="0"> Disabled
                        </label>

                        <label class="radio-inline">
                            <input type="radio" name="status" id="active" value="1" checked> Active
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <div class="box">
                        <button type="submit" name="btnAddGroup" role="button"
                                class="btn btn-success btn-lg" {{ $app->subscribed != 1 ? 'disabled' : '' }}>Save
                        </button>
                    </div>
                </div>
            </form>

        </div>
    </div>

    <script>
        CKEDITOR.replace('property_desc');
    </script>
@endsection
