@extends('layouts.rental.master')

@section('title', 'Edit Property')

@section('breadcrumb')
    <li><a href="{{ route('rental.properties.index', [$app]) }}">Properties</a></li>
    <li>Edit</li>
    <li class="active">{{ $property->title }}</li>
@endsection

@section('page-header')
    Edit Property
    <div class="pull-right">
        <a href="{{ route('rental.properties.show', [$app, $property]) }}"
           class="btn btn-default btn-sm" title="Preview">
            Preview <i class="fa fa-eye"></i>
        </a>
        <div class="btn-group btn-group-sm">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"
                    aria-expanded="false">
                Actions
                <i class="caret"></i>
            </button>
            <ul class="dropdown-menu pull-right">
                <li>
                    <a href="{{ route('rental.properties.amenities.index', [$app, $property]) }}">
                        Property Amenities
                    </a>
                </li>
                <li>
                    <a href="{{ route('rental.properties.features.index', [$app, $property]) }}">
                        Property Features
                    </a>
                </li>
                <li>
                    <a href="{{ route('rental.properties.gallery.index', [$app, $property]) }}">
                        Property Galleries
                    </a>
                </li>
            </ul>
        </div>
    </div>
@endsection

@section('content')
    <form name="add-property-form" method="post" action="{{ route('rental.properties.update', [$app, $property]) }}"
          enctype="application/x-www-form-urlencoded" autocomplete="off">

        @include('partials.alerts.validation')

        {{ method_field('PUT') }}
        {{ csrf_field() }}

        <input type="hidden" name="_app" id="_app" value="{{ $app->id }}">

        <input type="hidden" name="id" id="id" value="{{ $property->id }}">

        <input type="hidden" name="_rentable" id="_rentable" value="1">

        <div class="form-group row {{ $errors->has('title') ? 'has-error' : '' }}">
            <div class="col-lg-12">
                <label for="title">Property Title</label>
                <input type="text" name="title" class="form-control" placeholder="Title" id="title"
                       maxlength="100"
                       value="{{ old('title') != null ? old('title') : $property->title }}"
                       required autofocus/>
                @if($errors->has('title'))
                    <p class="text-danger">
                        <strong>{{ $errors->first('title') }}</strong>
                    </p>
                @endif
            </div><!-- /.col-lg-12 -->
        </div><!-- /.form-group --><!-- /title -->

        <div class="row">
            <div class="col-lg-6">
                <div class="form-group {{ $errors->has('group') ? 'has-error' : '' }}">
                    <label for="group">Property Group</label>
                    <select name="group" class="form-control" id="group">
                        <option></option>
                        @foreach($groups as $group)
                            <option value="{{ $group->id }}"
                                    {{ $property->property_group == $group->id ? 'selected' : ''}}>
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
            </div><!-- /.col-lg-12 --><!-- /group -->
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">
                    <label for="type">Property Type *</label>
                    <select name="type" class="form-control" id="type" required>
                        <option>Set property type</option>
                        @foreach($property_types as $type)
                            <option value="{{ $type->id }}"
                                    {{ $property->property_type == $type->id ? 'selected' : ''}}>
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

            <div class="col-lg-6">
                <label for="size">Property Size (Sq Ft) *</label>
                <div class="form-group {{ $errors->has('size') ? 'has-error' : '' }} input-group">
                    <input type="number" name="size" class="form-control" placeholder="Property Size"
                           id="size" min="1" maxlength="8"
                           value="{{ old('size') != null ? old('size') : $property->size }}"
                           required/>
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

        <div class="row">
            <div class="col-lg-6">
                <label for="price">Rental price (per rental interval)</label>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group {{ $errors->has('price') ? 'has-error' : '' }} input-group">
                                        <span class="input-group-addon">
                                            {{ $currency }}.
                                        </span>
                            <input type="number" name="price" class="form-control"
                                   placeholder="Rental Price"
                                   min="0" maxlength="10" id="price"
                                   value="{{ old('price') != null ? old('price') : isset($property_price) ? $property_price->price : 0 }}"
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
                    <div class="col-sm-6">
                        <div class="form-group">
                            <select name="oldPrices" class="form-control" id="oldPrices">
                                <option>Select from previous prices</option>
                                @foreach($old_prices as $price)
                                    <option value="{{ $price->price }}">{{ $price->price }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div><!-- /price -->

            <div class="col-lg-6">
                <label for="interval">Rent Interval (months)</label>
                <div class="form-group {{ $errors->has('interval') ? 'has-error' : '' }} input-group">
                    <input type="number" name="interval" class="form-control" id="interval" min="1"
                           value="{{ old('interval') != null ? old('interval') : $property->interval }}"
                           required/>
                            <span class="input-group-addon">
                                month(s)
                            </span>
                    @if($errors->has('interval'))
                        <p class="text-danger">
                            <strong>{{ $errors->first('interval') }}</strong>
                        </p>
                    @endif
                </div>
            </div><!-- /interval -->
        </div><!-- /.row -->

        <div class="row">
            <div class="col-lg-12">
                <div class="form-group {{ $errors->has('summary') ? 'has-error' : '' }}">
                    <label for="summary">Property Summary</label>
                            <textarea name="summary" class="form-control" cols="30" rows="3" id="summary"
                                      placeholder="Property Summary here..."
                                      maxlength="255">{{ old('summary') != null ? old('summary') : $property->summary }}</textarea>
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

        <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
            <label for="description">Property Description</label>
                            <textarea name="description" class="form-control ckeditor" cols="30" rows="3"
                                      id="description"
                                      placeholder="Description">{{ old('description') != null ? old('description') : $property->description }}</textarea>
            @if($errors->has('description'))
                <p class="text-danger">
                    <strong>{{ $errors->first('description') }}</strong>
                </p>
            @endif
        </div><!-- /.form-group --><!-- /description -->

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
            </div><!-- /multiple_tenancy -->

            <div class="col-lg-6">
                <label for="tenants">Tenants</label>
                <div class="form-group {{ $errors->has('tenants') ? 'has-error' : '' }} input-group">
                    <input type="number" name="tenants" id="tenants" class="form-control" min="2"
                           placeholder="no. of tenants" disabled
                           value="{{ old('tenants') != null ? old('tenants') : $property->tenants }}"
                           required>
                    <span class="input-group-addon">tenants</span>
                </div>
                <p class="help-block">The number of tenants allowed in this property</p>
                @if($errors->has('tenants'))
                    <p class="text-danger">
                        <strong>{{ $errors->first('tenants') }}</strong>
                    </p>
                @endif
            </div><!-- /tenants -->
        </div>

        <div class="row hidden">
            <div class="col-lg-12">
                <label>Property Status</label>
                <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                    <label class="radio-inline">
                        <input type="radio" name="status" id="disable" value="0"> Vacated
                    </label>

                    <label class="radio-inline">
                        <input type="radio" name="status" id="active" value="1" checked> Occupited
                    </label>
                    @if($errors->has('status'))
                        <p class="text-danger">
                            <strong>{{ $errors->first('status') }}</strong>
                        </p>
                    @endif
                </div>
            </div>
        </div><!-- /.row -->

        <div class="form-group">
            <button type="submit" name="btnUpdateProperty" class="btn btn-primary"
                    {{ $app->subscribed != 1 ? 'disabled' : '' }} value="1">Update
            </button><!-- /btnUpddateProperty -->
        </div>
    </form>

    <script>
        CKEDITOR.replace('ckeditor');
    </script>
@endsection
