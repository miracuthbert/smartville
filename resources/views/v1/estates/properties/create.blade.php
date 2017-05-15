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

        <div class="col-lg-12">

            <form name="add-property-form" method="post" action="{{ route('estate.rental.property.store') }}"
                  enctype="application/x-www-form-urlencoded"
                  autocomplete="off">

                @include('includes.alerts.default')

                @include('includes.alerts.validation')

                <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">

                <input type="hidden" name="_app" id="_app" value="{{ $app->id }}">

                <input type="hidden" name="_rentable" id="_rentable" value="1">

                <div class="box">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group{{ $errors->has('title') ? 'has-error' : '' }}">
                                <label for="title">Property title*</label>
                                <input type="text" name="title" class="form-control" placeholder="title"
                                       id="title"
                                       maxlength="100" value="{{ Request::old('title') }}" required autofocus/>
                            </div>
                            <strong>{{ $errors->first('title') }}</strong>
                        </div>
                        <!-- /title -->

                        <div class="col-lg-6">
                            <div class="form-group{{ $errors->has('type') ? 'has-error' : '' }}">
                                <label for="type">Property type*</label>
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
                        </div>
                        <!-- /type -->
                    </div>
                </div>
                <!-- /title&type -->

                <div class="box">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group{{ $errors->has('group') ? 'has-error' : '' }}">
                                <label for="group">Property group</label>
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
                        </div>
                        <!-- /group -->

                        <div class="col-lg-6">
                            <label for="size">Property size (sq. feet)*</label>
                            <div class="form-group{{ $errors->has('size') ? 'has-error' : '' }} input-group">
                                <input type="number" name="size" class="form-control" placeholder="1500, 2500..."
                                       id="size" min="1" maxlength="8" value="{{ Request::old('size') }}" required/>
                            <span class="input-group-addon">
                                sq. feet
                            </span>
                                @if($errors->has('size'))
                                    <p class="text-danger">
                                        <strong>{{ $errors->first('size') }}</strong>
                                    </p>
                                @endif
                            </div>
                        </div>
                        <!-- /size -->
                    </div>
                </div>
                <!-- /group&size -->

                <div class="box">
                    <div class="row">
                        <div class="col-lg-6">
                            <label for="interval">Rent interval (months)*</label>
                            <div class="form-group{{ $errors->has('interval') ? 'has-error' : '' }} input-group">
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
                        </div>
                        <!-- /interval -->

                        <div class="col-lg-6">
                            <label for="price">Rental price (per rental interval)*</label>
                            <div class="form-group{{ $errors->has('price') ? 'has-error' : '' }} input-group">
                                <span class="input-group-addon">
                                    {{ $currency }}.
                                </span>
                                <input type="number" name="price" class="form-control" placeholder="rental price"
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
                        </div>
                        <!-- /price -->
                    </div>
                </div>
                <!-- /rent-interval&rent-price -->

                <div class="box">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group{{ $errors->has('summary') ? 'has-error' : '' }}">
                                <label for="summary">Property summary*</label>
                            <textarea name="summary" class="form-control" cols="30" rows="3" id="summary"
                                      placeholder="summary details" maxlength="255">{{ Request::old('summary') }}</textarea>
                            </div>

                            <p class="help-block">
                                Summary defines the properties unique features and details in brief
                            </p>

                            @if($errors->has('summary'))
                                <p class="text-danger">
                                    <strong>{{ $errors->first('summary') }}</strong>
                                </p>
                            @endif
                        </div>
                    </div>
                    <!-- /summary -->

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group{{ $errors->has('description') ? 'has-error' : '' }}">
                                <label for="description">Property description</label>
                            <textarea name="description" class="form-control ckeditor" cols="30" rows="3"
                                      id="description"
                                      placeholder="detailed description">{{ Request::old('description') }}</textarea>
                            </div>
                            @if($errors->has('description'))
                                <p class="text-danger">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </p>
                            @endif
                        </div>
                        <!-- /description -->
                    </div>
                </div>

                <div class="box">
                    <div class="row">
                        <div class="col-lg-6">
                            <label for="multiple_tenancy">Multiple tenancy</label>
                            <div class="form-group{{ $errors->has('multiple_tenancy') ? 'has-error' : '' }}">
                                <label class="radio-inline">
                                    <input type="radio" name="multiple_tenancy" id="no" value="0" checked> No
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="multiple_tenancy" id="yes" value="1"> Yes
                                </label>
                            </div>
                            @if($errors->has('multiple_tenancy'))
                                <p class="text-danger">
                                    <strong>{{ $errors->first('multiple_tenancy') }}</strong>
                                </p>
                            @endif
                        </div>
                        <!-- /multiple_tenancy -->

                        <div class="col-lg-6">
                            <label for="tenants">Tenants</label>
                            <div class="form-group{{ $errors->has('tenants') ? 'has-error' : '' }} input-group">
                                <input type="number" name="tenants" id="tenants" class="form-control" min="2"
                                       placeholder="no. of tenants" disabled
                                       value="{{ Request::old('tenants') != null ? Request::old('tenants') : 2 }}"
                                       required>
                                <span class="input-group-addon">tenants</span>
                            </div>
                            @if($errors->has('tenants'))
                                <p class="text-danger">
                                    <strong>{{ $errors->first('tenants') }}</strong>
                                </p>
                            @endif
                        </div>
                        <!-- /tenants -->
                    </div>
                </div>
                <!-- /multiple_tenancy&tenants -->

                <div class="box">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group{{ $errors->has('amenity') ? 'has-error' : '' }}">
                                <p><label>Property amenities</label></p>

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
                        </div>
                    </div>
                </div>
                <!-- /amenities -->

                <div class="box">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group
                        @if($errors->has('feature')||$errors->has('details')||$errors->has('value')) has-error @endif">
                                <label for="feature">Property features</label>
                                @if(count(Request::old('feature')) <= 0)
                                    <div class="row" id="default">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Feature</label>
                                                <input type="text" name="feature[]" class="form-control _add_feature">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Details</label>
                                                <input type="text" name="details[]"
                                                       class="form-control _add_details">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Feature total</label>
                                                <input type="text" name="value[]" class="form-control _add_value">
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <label class="hidden-xs"><span class="text-warning">Remove</span></label>
                                            <button type="button" name="btnFeatureGen"
                                                    class="btn btn-warning btnRemoveFeature"
                                                    data-toggle="tooltip" title="Remove feature">
                                                <span class="fa fa-remove"></span>
                                            </button>
                                        </div>
                                        <hr>
                                    </div>
                                    <!-- /.row#default -->
                                @else
                                    @for($i = 0; $i < count(Request::old('feature')); $i++)
                                        @if(!empty(Request::old('feature')[$i]))
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Feature</label>
                                                        <input type="text" name="feature[]"
                                                               class="form-control _add_feature"
                                                               value="{{ Request::old('feature')[$i] }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Details</label>
                                                        <input type="text" name="details[]"
                                                               class="form-control _add_details"
                                                               value="{{ Request::old('details')[$i] }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label>Value</label>
                                                        <input type="text" name="value[]"
                                                               class="form-control _add_value"
                                                               value="{{ Request::old('value')[$i] }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-1">
                                                    <label class="hidden-xs"><span
                                                                class="text-warning">Remove</span></label>
                                                    <button type="button" name="btnFeatureGen"
                                                            class="btn btn-warning btnRemoveFeature"
                                                            data-toggle="tooltip" title="Remove feature">
                                                        <span class="fa fa-remove"></span>
                                                    </button>
                                                </div>
                                                <hr>
                                            </div>
                                        @endif
                                    @endfor
                                @endif

                                <p>
                                    <button type="button" name="btnFeatureGen" id="btnFeatureGen"
                                            class="btn btn-default"
                                            data-toggle="tooltip" title="Add new feature">
                                        New Feature
                                        <i class="fa fa-plus"></i>
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
                        </div>
                    </div>
                </div>
                <!-- /featues -->

                <div class="box">
                    <div class="row">
                        <div class="col-lg-12">
                            <label>Property status</label>
                            <div class="form-group{{ $errors->has('status') ? 'has-error' : '' }}">
                                <label class="radio-inline">
                                    <input type="radio" name="status" id="disable" value="0" checked> Disabled
                                </label>

                                <label class="radio-inline">
                                    <input type="radio" name="status" id="active" value="1" disabled> Active
                                </label>
                                @if($errors->has('status'))
                                    <p class="text-danger">
                                        <strong>{{ $errors->first('status') }}</strong>
                                    </p>
                                @endif
                            </div>
                            <p class="help-block">Property status will be updated when you add a tenant.</p>
                        </div>
                        <div class="col-lg-12"></div>
                    </div>
                </div>
                <!-- /status -->

                <div class="box">
                    <div class="row">
                        <div class="col-lg-12">
                            <button type="submit" name="btnAddProperty" role="button"
                                    class="btn btn-success btn-lg" {{ $app->subscribed != 1 ? 'disabled' : '' }}>
                                Add Property
                            </button>
                        </div>
                    </div>
                </div>

            </form>

        </div>

    </div>

    <p></p>

    <script>
        CKEDITOR.replace('ckeditor');
    </script>
@endsection
