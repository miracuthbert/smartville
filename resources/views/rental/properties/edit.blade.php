@extends('layouts.estates')

@section('title')
    Property - {{ $property->title }}
@endsection

@section('breadcrumb')
    <li>
        <a href="{{ route('estate.rental.properties', ['id' => $app->id, 'sort' => 'all']) }}">Properties</a>
    </li>
    <li>Edit</li>
    <li class="active">{{ $property->title }}</li>
@endsection

@section('page-header')
    Edit Property
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="clearfix">
                <div class="pull-left">
                    <p class="help-block">
                        Click 'Actions' to access more property options
                    </p>
                </div>
                <div class="pull-right">
                    <a href="{{ route('estate.rental.property.show', ['id' => $property->id]) }}"
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
                                <a href="{{ route('estate.rental.property.amenities', ['id' => $property->id]) }}">
                                    Property Amenities
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('estate.rental.property.features', ['id' => $property->id]) }}">
                                    Property Features
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('estate.rental.property.gallery.index', ['id' => $property->id]) }}">
                                    Property Galleries
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <form name="add-property-form" method="post"
                  action="{{ route('estate.rental.property.update', ['id' => $property->id]) }}"
                  enctype="application/x-www-form-urlencoded"
                  autocomplete="off">

                @include('partials.alerts.default')

                @include('partials.alerts.validation')

                {{ method_field('put') }}
                {{ csrf_field() }}

                <input type="hidden" name="_app" id="_app" value="{{ $app->id }}">

                <input type="hidden" name="id" id="id" value="{{ $property->id }}">

                <input type="hidden" name="_rentable" id="_rentable" value="1">

                <div class="box">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                                <label for="title">Property Title</label>
                                <input type="text" name="title" class="form-control" placeholder="Title" id="title"
                                       maxlength="100"
                                       value="{{ Request::old('title') != null ? Request::old('title') : $property->title }}"
                                       required autofocus/>
                            </div>
                            @if($errors->has('title'))
                                <p class="text-danger">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </p>
                            @endif
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
                        </div><!-- /.col-lg-6 --><!-- /group -->

                        <div class="col-lg-4">
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

                        <div class="col-lg-4">
                            <label for="size">Property Size (Sq Ft) *</label>
                            <div class="form-group {{ $errors->has('size') ? 'has-error' : '' }} input-group">
                                <input type="number" name="size" class="form-control" placeholder="Property Size"
                                       id="size" min="1" maxlength="8"
                                       value="{{ Request::old('size') != null ? Request::old('size') : $property->size }}"
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
                    </div>
                </div><!-- /.box --><!-- /group,type&size -->

                <div class="box">
                    <div class="row">
                        <div class="col-lg-6">
                            <label for="price">Rental price (per rental interval)</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('price') ? 'has-error' : '' }} input-group">
                                        <span class="input-group-addon">
                                            {{ $currency }}.
                                        </span>
                                        <input type="number" name="price" class="form-control"
                                               placeholder="Rental Price"
                                               min="0" maxlength="10" id="price"
                                               value="{{ Request::old('price') != null ? Request::old('price') : $property_price->price }}"
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
                                <div class="col-md-6">
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
                                       value="{{ Request::old('interval') != null ? Request::old('interval') : $property->interval }}"
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
                </div><!-- /.box -->

                <div class="box">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group {{ $errors->has('summary') ? 'has-error' : '' }}">
                                <label for="summary">Property Summary</label>
                            <textarea name="summary" class="form-control" cols="30" rows="3" id="summary"
                                      placeholder="Property Summary here..."
                                      maxlength="255">{{ Request::old('summary') != null ? Request::old('summary') : $property->summary }}</textarea>
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
                            <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                                <label for="description">Property Description</label>
                            <textarea name="description" class="form-control ckeditor" cols="30" rows="3"
                                      id="description"
                                      placeholder="Description">{{ Request::old('description') != null ? Request::old('description') : $property->description }}</textarea>
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
                        </div>
                        <!-- /multiple_tenancy -->

                        <div class="col-lg-6">
                            <label for="tenants">Tenants</label>
                            <div class="form-group {{ $errors->has('tenants') ? 'has-error' : '' }} input-group">
                                <input type="number" name="tenants" id="tenants" class="form-control" min="2"
                                       placeholder="no. of tenants" disabled
                                       value="{{ Request::old('tenants') != null ? Request::old('tenants') : $property->tenants }}"
                                       required>
                                <span class="input-group-addon">tenants</span>
                            </div>
                            <p class="help-block">The number of tenants allowed in this property</p>
                            @if($errors->has('tenants'))
                                <p class="text-danger">
                                    <strong>{{ $errors->first('tenants') }}</strong>
                                </p>
                            @endif
                        </div>
                        <!-- /tenants -->
                    </div>
                </div><!-- /.box --><!-- /multiple_tenancy&tenants -->

                <div class="box">
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
                </div><!-- /.box --><!-- /status -->

                <div class="box">
                    <div class="row">
                        <div class="col-lg-12">
                            <button type="submit" name="btnUpdateProperty"
                                    class="btn btn-primary btn-lg" {{ $app->subscribed != 1 ? 'disabled' : '' }}>
                                Update Property
                            </button><!-- /btnUpddateProperty -->
                        </div><!-- /.col-lg-6 -->
                    </div><!-- /.row -->
                </div><!-- /.box -->

            </form>
        </div>
    </div>

    <script>
        CKEDITOR.replace('ckeditor');
    </script>
@endsection
