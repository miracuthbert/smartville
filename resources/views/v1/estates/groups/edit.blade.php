@extends('layouts.estates')

@section('title')
    Property Group
@endsection

@section('breadcrumb')
    <li class="active">Property Group</li>
@endsection

@section('page-header')
    Property Group
@endsection

@section('content')

    {{--<div class="container">--}}
    <div class="row">
        <div class="col-lg-12">
            <form name="add-group-form" method="post" action="{{ route('estate.rental.group.update') }}"
                  enctype="application/x-www-form-urlencoded" autocomplete="off">

                <div class="form-group">
                    <p class="help-block">Property groups helps grouping of properties according to location,blocks or
                        units</p>
                </div>

                @include('includes.alerts.default')

                @include('includes.alerts.validation')

                <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">

                <input type="hidden" name="id" id="id" value="{{ $group->id }}">

                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group{{ $errors->has('title') ? 'has-error' : '' }}">
                            <label for="title">Amenity title:</label>
                            <input type="text" name="title" class="form-control" placeholder="group title"
                                   id="title" maxlength="50"
                                   value="{{ Request::old('title') != null ? Request::old('title') : $group->title }}"
                                   required autofocus/>
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
                            <input type="text" name="location" class="form-control" placeholder="group location"
                                   value="{{ Request::old('location') != null ? Request::old('location') : $group->location }}">
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
                                      placeholder="description">{{ Request::old('description') != null ? Request::old('description') : $group->description }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <p><label>Group status:</label></p>
                        <label class="radio-inline">
                            <input type="radio" name="status" id="disable"
                                   value="0" {{ $group->status == 0 ? 'checked' : '' }}> Disabled
                        </label>

                        <label class="radio-inline">
                            <input type="radio" name="status" id="active"
                                   value="1" {{ $group->status == 1 ? 'checked' : '' }}> Active
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <div class="box">
                        <button type="submit" name="btnAddGroup" role="button"
                                class="btn btn-primary btn-lg" {{ $app->subscribed != 1 ? 'disabled' : '' }}>Update
                        </button>
                    </div>
                </div>
            </form>

        </div>
    </div>
    {{--</div>--}}


    <script>
        CKEDITOR.replace('property_desc');
    </script>
@endsection
