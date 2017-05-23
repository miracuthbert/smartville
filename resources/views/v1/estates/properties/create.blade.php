@extends('layouts.estates')

@section('title')
    Add Property
@endsection

@section('breadcrumb')
    <li class="active">Add Property</li>
@endsection

@section('page-header')
    Add Property
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-11">
            <form name="add-property-form" method="post" action="{{ route('estate.rental.property.store') }}"
                  enctype="application/x-www-form-urlencoded"
                  autocomplete="off">

                @include('includes.alerts.default')

                @include('includes.alerts.validation')

                {{ csrf_field() }}

                <input type="hidden" name="_app" id="_app" value="{{ $app->id }}">

                <input type="hidden" name="_rentable" id="_rentable" value="1">

                <div class="box">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                                <label for="title">Property Title *</label>
                                <input type="text" name="title" class="form-control" placeholder="Title"
                                       id="title"
                                       maxlength="100" value="{{ Request::old('title') }}" required autofocus/>
                            </div>
                            <strong>{{ $errors->first('title') }}</strong>
                        </div><!-- /.col-lg-12 -->
                    </div><!-- /.row -->
                </div><!-- /.box --><!-- /title -->

                <div class="box">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group {{ $errors->has('group') ? 'has-error' : '' }}">
                                <label for="group">Property Group</label>
                                <select name="group" class="form-control" id="group">
                                    <option></option>
                                    @foreach($groups as $group)
                                        <option value="{{ $group->id }}"
                                                {{ Request::old('group') == $group->id ? 'selected' : ''}}>
                                            {{ $group->title }}
                                        </option>
                                    @endforeach
                                </select>

                                <p class="help-block">* Leave blank; if not in any group</p>

                                @if($errors->has('group'))
                                    <p class="text-danger">
                                        <strong>{{ $errors->first('group') }}</strong>
                                    </p>
                                @endif
                            </div>
                        </div><!-- /.col-lg-6 --><!-- /group -->

                        <div class="col-lg-4">
                            <div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">
                                <label for="type">Property Type *</label>
                                <select name="type" class="form-control" id="type" required>
                                    <option>Set property type</option>
                                    @foreach($property_types as $type)
                                        <option value="{{ $type->id }}"
                                                {{ Request::old('type') == $type->id ? 'selected' : ''}}>
                                            {{ $type->title }}
                                        </option>
                                    @endforeach
                                </select>
                                @if($errors->has('type'))
                                    <p class="text-danger">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </p>
                                @endif
                            </div>
                        </div><!-- /.col-lg-6 --><!-- /type -->

                        <div class="col-lg-4">
                            <label for="size">Property Size (Sq Ft) *</label>
                            <div class="form-group {{ $errors->has('size') ? 'has-error' : '' }} input-group">
                                <input type="number" name="size" class="form-control" placeholder="Property Size"
                                       id="size" min="1" maxlength="8" value="{{ Request::old('size') }}" required/>
                            <span class="input-group-addon">
                                Sq Ft
                            </span>
                                @if($errors->has('size'))
                                    <p class="text-danger">
                                        <strong>{{ $errors->first('size') }}</strong>
                                    </p>
                                @endif
                            </div>
                        </div><!-- /.col-lg-6 --><!-- /size -->
                    </div><!-- /.row -->
                </div><!-- /.box --><!-- /group&type&size -->

                <div class="box">
                    <div class="row">
                        <div class="col-lg-6">
                            <label for="price">Rental Price (per rental interval) *</label>
                            <div class="form-group {{ $errors->has('price') ? 'has-error' : '' }} input-group">
                                <span class="input-group-addon">
                                    {{ $currency }}.
                                </span>
                                <input type="number" name="price" class="form-control" placeholder="Rental Price"
                                       min="0"
                                       step="50" maxlength="10" id="price" value="{{ Request::old('price') }}"
                                       required/>
                                <span class="input-group-addon">
                                    .00
                                </span>
                                @if($errors->has('price'))
                                    <p class="text-danger">
                                        <strong>{{ $errors->first('price') }}</strong>
                                    </p>
                                @endif
                            </div>
                        </div><!-- /.col-lg-6 --><!-- /price -->

                        <div class="col-lg-6">
                            <label for="interval">Rent Interval (months) *</label>
                            <div class="form-group {{ $errors->has('interval') ? 'has-error' : '' }} input-group">
                                <input type="number" name="interval" class="form-control" id="interval" min="1"
                                       value="{{ Request::old('interval') }}" required/>
                            <span class="input-group-addon">
                                month(s)
                            </span>
                                @if($errors->has('interval'))
                                    <p class="text-danger">
                                        <strong>{{ $errors->first('interval') }}</strong>
                                    </p>
                                @endif
                            </div>
                        </div><!-- /.col-lg-6 --><!-- /interval -->
                    </div><!-- /.row -->
                </div><!-- /.box --><!-- /rent-interval&rent-price -->

                <div class="box">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group {{ $errors->has('summary') ? 'has-error' : '' }}">
                                <label for="summary">Property Summary *</label>
                            <textarea name="summary" class="form-control" cols="30" rows="3" id="summary"
                                      placeholder="Property Summary here..."
                                      maxlength="255">{{ Request::old('summary') }}</textarea>
                            </div>

                            <p class="help-block">
                                Summary should be eye catching and short, but not too short to be ignored
                            </p>

                            @if($errors->has('summary'))
                                <p class="text-danger">
                                    <strong>{{ $errors->first('summary') }}</strong>
                                </p>
                            @endif
                        </div><!-- /.col-lg-12 -->
                    </div><!-- /.row -->
                </div><!-- /.box --><!-- /summary -->

                <div class="box">
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="description">Property Description</label>
                            <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                            <textarea name="description" class="form-control ckeditor" cols="30" rows="3"
                                      id="description"
                                      placeholder="Property Description">{{ Request::old('description') }}</textarea>
                            </div>
                            @if($errors->has('description'))
                                <p class="text-danger">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </p>
                            @endif
                        </div><!-- /.col-lg-12 -->
                    </div><!-- /.row -->
                </div><!-- /.box --><!-- /description -->

                <div class="box">
                    <div class="row">
                        <div class="col-lg-6">
                            <label for="multiple_tenancy">Multiple Tenancy</label>
                            <div class="form-group {{ $errors->has('multiple_tenancy') ? 'has-error' : '' }}">
                                <label class="radio-inline">
                                    <input type="radio" name="multiple_tenancy" id="no" value="0" checked> No
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="multiple_tenancy" id="yes" value="1"> Yes
                                </label>
                            </div>
                            <p class="help-block">Choose 'Yes' to allow more than one tenants in this property</p>
                            @if($errors->has('multiple_tenancy'))
                                <p class="text-danger">
                                    <strong>{{ $errors->first('multiple_tenancy') }}</strong>
                                </p>
                            @endif
                        </div><!-- /.col-lg-6 --><!-- /multiple_tenancy -->

                        <div class="col-lg-6">
                            <label for="tenants">Tenants</label>
                            <div class="form-group {{ $errors->has('tenants') ? 'has-error' : '' }} input-group">
                                <input type="number" name="tenants" id="tenants" class="form-control" min="2"
                                       placeholder="# of Tenants" disabled
                                       value="{{ Request::old('tenants') != null ? Request::old('tenants') : 2 }}"
                                       required>
                                <span class="input-group-addon">tenants</span>
                            </div>
                            <p class="help-block">The number of tenants allowed in this property</p>
                            @if($errors->has('tenants'))
                                <p class="text-danger">
                                    <strong>{{ $errors->first('tenants') }}</strong>
                                </p>
                            @endif
                        </div><!-- /.col-lg-6 --><!-- /tenants -->
                    </div><!-- /.row -->
                </div><!-- /.box --><!-- /multiple_tenancy&tenants -->

                <div class="box">
                    <div class="row">
                        <div class="col-lg-12">
                            <label>Property Amenities</label>
                            <div class="form-group {{ $errors->has('amenity') ? 'has-error' : '' }}">

                                @foreach($amenities->chunk(4) as $row)
                                    <div class="row">
                                        @foreach($row as $amenity)
                                            <div class="col-md-3">
                                                <label class="checkbox-inline" title="{{ $amenity->description }}">
                                                    <input type="checkbox" name="amenity[]"
                                                           id="amenity_{{ $amenity->id }}"
                                                           class="amenity" value="{{ $amenity->id }}"
                                                    @for($i = 0; $i < count(Request::old('amenity')); $i++)
                                                        {{ Request::old('amenity')[$i] == $amenity->id ? 'checked' : '' }}
                                                            @endfor>
                                                    {{ $amenity->title }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                @endforeach
                                @if($errors->has('amenity'))
                                    <p class="text-danger">
                                        <strong>{{ $errors->first('amenity') }}</strong>
                                    </p>
                                @endif
                            </div>
                        </div><!-- /.col-lg-12 -->
                    </div><!-- /.row -->
                </div><!-- /.box --><!-- /amenities -->

                <div class="box">
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="feature">Property Features</label>
                            <div class="form-group
                        @if($errors->has('feature')||$errors->has('details')||$errors->has('value')) has-error @endif">
                                @if(count(Request::old('feature')) <= 0)
                                    <div class="row" id="default">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="sr-only">Feature</label>
                                                <input type="text" name="feature[]" class="form-control _add_feature"
                                                       placeholder="Feature">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="sr-only">Feature Details</label>
                                                <input type="text" name="details[]" class="form-control _add_details"
                                                       placeholder="Feature Details" maxlength="255">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label class="sr-only">#</label>
                                                <input type="text" name="value[]" class="form-control _add_value"
                                                       placeholder="# of feature" required>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <button type="button" name="btnFeatureGen"
                                                    class="btn btn-warning btn-sm btnRemoveFeature pull-right"
                                                    data-toggle="tooltip" title="Remove feature">
                                                <span class="text-warning visible-xs-inline">Remove</span>
                                                <span class="fa fa-remove"></span>
                                            </button>
                                        </div>
                                    </div><!-- /.row#default -->
                                @else
                                    @for($i = 0; $i < count(Request::old('feature')); $i++)
                                        @if(!empty(Request::old('feature')[$i]))
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class="sr-only">Feature</label>
                                                        <input type="text" name="feature[]"
                                                               class="form-control _add_feature"
                                                               value="{{ Request::old('feature')[$i] }}"
                                                               placeholder="Feature">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="sr-only">Feature Details</label>
                                                        <input type="text" name="details[]"
                                                               class="form-control _add_details"
                                                               placeholder="Feature Details" maxlength="255"
                                                               value="{{ Request::old('details')[$i] }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label class="sr-only">#</label>
                                                        <input type="text" name="value[]"
                                                               class="form-control _add_value"
                                                               placeholder="# of feature"
                                                               value="{{ Request::old('value')[$i] }}" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-1">
                                                    <button type="button" name="btnFeatureGen"
                                                            class="btn btn-warning btn-sm btnRemoveFeature pull-right"
                                                            data-toggle="tooltip" title="Remove feature">
                                                        <span class="text-warning visible-xs-inline">Remove</span>
                                                        <span class="fa fa-remove"></span>
                                                    </button>
                                                </div>
                                            </div>
                                        @endif
                                    @endfor
                                @endif

                                <p>
                                    <button type="button" name="btnFeatureGen" id="btnFeatureGen"
                                            class="btn btn-link btn-sm"
                                            data-toggle="tooltip" title="Add new feature">
                                        Add custom feature
                                    </button>
                                </p>

                                @if($errors->has('feature')or$errors->has('details')or$errors->has('value'))
                                    <p class="text-danger">
                                        @if($errors->has('feature'))
                                            <strong>{{ $errors->first('feature') }}</strong> <br>
                                        @endif
                                        @if($errors->has('details'))
                                            <strong>{{ $errors->first('details') }}</strong> <br>
                                        @endif
                                        @if($errors->has('value'))
                                            <strong>{{ $errors->first('value') }}</strong>
                                        @endif
                                    </p>
                                @endif
                            </div>
                        </div><!-- /.col-lg-12 -->
                    </div><!-- /.box -->
                </div><!-- /.box --><!-- /features -->

                <div class="box">
                    <div class="row">
                        <div class="col-lg-12">
                            <label>Property Status</label>
                            <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                                <label class="radio-inline">
                                    <input type="radio" name="status" id="disable" value="0" checked> Vacant
                                </label>

                                <label class="radio-inline">
                                    <input type="radio" name="status" id="active" value="1" disabled> Occupied
                                </label>
                                @if($errors->has('status'))
                                    <p class="text-danger">
                                        <strong>{{ $errors->first('status') }}</strong>
                                    </p>
                                @endif
                            </div>
                            <p class="help-block">Property status will be updated when you add a tenant.</p>
                        </div><!-- /.col-lg-12 -->
                    </div><!-- /.row -->
                </div><!-- /.box --><!-- /status -->

                <div class="box">
                    <div class="row">
                        <div class="col-lg-12">
                            <button type="submit" name="btnAddProperty" role="button"
                                    class="btn btn-success btn-lg" {{ $app->subscribed != 1 ? 'disabled' : '' }}>
                                Add Property
                            </button>
                        </div><!-- /.col-lg-12 -->
                    </div><!-- /.row -->
                </div><!-- /.box -->

            </form><!-- /#add-property-form -->
        </div><!-- /.col-lg-11 -->
        <div class="col-lg-1">
            <div class="walkthrough" data-spy="affix" data-offset-top="0px">
                <div class="pull-right">
                    <div class="btn-group btn-group-vertical"></div>
                    <button class="btn btn-info btn-sm" title="How to create a new property">
                        <i class="fa fa-info"></i>
                    </button>
                </div><!-- /.walkthrough -->
            </div><!-- /.col-lg-1 -->
        </div>
    </div><!-- /.row -->
    <script>
        CKEDITOR.replace('ckeditor');
    </script>
@endsection
