@extends('layouts.md.hostel')

@section('title')
    Edit Property
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <form class="" method="post" action="{{ route('hostel.property.store') }}"
                      id="hostel-property-form" role="form">

                    {{ csrf_field() }}

                    <input type="hidden" name="_app" id="_app" value="-1"><!-- App Id -->

                    <input type="hidden" name="_rentable" id="_rentable" value="1"><!-- Property Rentability -->

                    <div class="card">
                        <div class="card-block">
                            <!-- Header -->
                            <div class="card-title">
                                <h1 class="h1-responsive">Edit Property</h1>
                                @include('includes.alerts.default')
                                @include('includes.alerts.validation')
                            </div>
                        </div>
                    </div><!-- /.card -->

                    <div class="row mt-1">
                        <div class="col-lg-9">
                            <div class="card mb-1">
                                <div class="card-block">
                                    <!-- Body -->
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group {{ $errors->has('property-title') ? 'has-error' : '' }}">
                                                <label for="hostel-property-title">Property Title *</label>
                                                <input type="text" name="property-title" id="hostel-property-title"
                                                       class="form-control underlined"
                                                       value="{{ old('property-title') }}"
                                                       autofocus>
                                            </div>
                                            @if($errors->has('property-title'))
                                                <p class="form-text text-danger">
                                                    <strong>{{ $errors->first('property-title') }}</strong>
                                                </p>
                                            @endif
                                        </div>
                                    </div><!-- /.row -->
                                </div>
                            </div><!-- /.card -->

                            <div class="card mt-1">
                                <div class="card-block">
                                    <!-- Body -->
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group {{ $errors->has('price') ? 'has-error' : '' }}">
                                                <label for="hostel-property-price">Price *</label>
                                                <input type="text" name="price" id="hostel-property-price"
                                                       class="form-control underlined" value="{{ old('price') }}">
                                            </div>
                                            @if($errors->has('price'))
                                                <p class="form-text text-danger">
                                                    <strong>{{ $errors->first('price') }}</strong>
                                                </p>
                                            @endif
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group {{ $errors->has('interval') || $errors->has('interval-label') ? 'has-error' : '' }}">
                                                <label for="rent-interval">Rent Interval *</label>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <input type="number" name="interval" class="form-control boxed"
                                                               id="interval"
                                                               min="1"
                                                               value="{{ old('interval') }}" required/>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <select name="interval-label" id="interval-label"
                                                                class="custom-select">
                                                            <option value="per month" {{ old('interval-label') == 'per month' ? 'selected' : '' }}>
                                                                Monthly
                                                            </option>
                                                            <option value="per week" {{ old('interval-label') == 'per week' ? 'selected' : '' }}>
                                                                Weekly
                                                            </option>
                                                            <option value="per semester" {{ old('interval-label') == 'per semester' ? 'selected' : '' }}>
                                                                Semester
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            @if($errors->has('interval'))
                                                <p class="form-text text-danger">
                                                    <strong>{{ $errors->first('interval') }}</strong>
                                                </p>
                                            @endif
                                            @if($errors->has('interval-label'))
                                                <p class="form-text text-danger">
                                                    <strong>{{ $errors->first('interval-label') }}</strong>
                                                </p>
                                            @endif
                                        </div><!-- /.col-lg-6 --><!-- /interval -->
                                    </div><!-- /.row -->
                                </div>
                            </div><!-- /.card -->

                            <div class="card mt-1">
                                <div class="card-block">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group {{ $errors->has('excerpt') ? 'has-error' : '' }}">
                                                <label for="hostel-property-excerpt">Excerpt</label>
                                        <textarea name="excerpt" class="form-control underlined md-textarea"
                                                  id="hostel-property-excerpt" maxlength="255"
                                                  rows="5">{{ old('excerpt') }}</textarea>
                                            </div>
                                            @if($errors->has('excerpt'))
                                                <p class="form-text text-danger">
                                                    <strong>{{ $errors->first('excerpt') }}</strong>
                                                </p>
                                            @endif
                                        </div>
                                    </div><!-- /.row -->
                                </div>
                            </div><!-- /.card -->

                            <div class="card mt-1">
                                <div class="card-block">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                                                <label for="hostel-property-description" class="col-form-label-sm">Description</label>
                                        <textarea name="description" id="hostel-property-description" cols="60"
                                                  rows="8"
                                                  class="form-control underlined ckeditor">{{ old('description') }}</textarea>
                                            </div>
                                            @if($errors->has('description'))
                                                <p class="form-text text-danger">
                                                    <strong>{{ $errors->first('description') }}</strong>
                                                </p>
                                            @endif
                                        </div>
                                    </div><!-- /.row -->
                                </div>
                            </div>

                        </div><!-- /.col-lg-9 -->
                        <div class="col-lg-3">
                            <div class="card">
                                <div class="card-block">
                                    <!-- Body -->
                                    <div class="form-group">
                                        <label for="hostel-property-category" class="col-form-label-sm">Property
                                            Category
                                        </label>
                                        <select name="property-category" id="hostel-property-category"
                                                class="custom-select">
                                            <option value="0">Select a property category</option>
                                            <optgroup label="Common Property Categories">
                                                @foreach($property_types as $type)
                                                    <option value="{{ $type->id }}"
                                                            {{ old('property-category') == $type->id ? 'selected' : ''}}>
                                                        {{ $type->title }}
                                                    </option>
                                                @endforeach
                                            </optgroup>
                                            <optgroup label="Hostel Property Categories">
                                                @foreach($hostel_property_categories as $category)
                                                    <option value="{{ $category->id }}"
                                                            {{ old('property-category') == $category->id ? 'selected' : ''}}>
                                                        {{ $category->title }}
                                                    </option>
                                                @endforeach
                                            </optgroup>
                                        </select>
                                    </div>
                                    @if($errors->has('property-category'))
                                        <p class="form-text text-danger">
                                            <strong>{{ $errors->first('property-category') }}</strong>
                                        </p>
                                    @endif
                                </div>
                            </div>

                            <div class="card mt-1">
                                <div class="card-block">
                                    <label for="hostel-property-size">Property size (Area)</label>
                                    <div class="form-group {{ $errors->has('property-size') ? 'has-error' : '' }}">
                                        <div class="input-group">
                                            <input type="text" name="property-size" id="hostel-property-size"
                                                   class="form-control boxed" value="{{ old('property-size') }}">
                                            <span class="input-group-addon">Sq Ft</span>
                                        </div>
                                    </div>
                                    @if($errors->has('property-size'))
                                        <p class="form-text text-danger">
                                            <strong>{{ $errors->first('property-size') }}</strong>
                                        </p>
                                    @endif
                                </div>
                            </div>

                            <div class="card mt-1">
                                <div class="card-block">
                                    <!-- Body -->
                                    <fieldset class="form-group">
                                        <label class="form-control-label col-form-label-sm">Multiple Tenants</label>
                                        <div>
                                            <label>
                                                <input type="radio" class="radio"
                                                       name="multiple-tenants"
                                                       id="multi_tenant_no"
                                                       value="0" {{ old('multiple-tenants') != null && old('multiple-tenants') == 0 ? 'checked' : 'checked' }}>
                                                <span>No</span>
                                            </label>
                                            <label>
                                                <input type="radio" class="radio"
                                                       name="multiple-tenants"
                                                       id="multi_tenant_yes"
                                                       value="1" {{ old('multiple-tenants') != null && old('multiple-tenants') == 1 ? 'checked' : '' }}>
                                                <span>Yes</span>
                                            </label>
                                        </div>
                                    </fieldset>
                                    @if($errors->has('multiple-tenants'))
                                        <p class="form-text text-danger">
                                            <strong>{{ $errors->first('multiple-tenants') }}</strong>
                                        </p>
                                    @endif
                                </div>
                            </div>

                            <div class="card mt-1">
                                <div class="card-block">
                                    <!-- Body -->
                                    <div class="form-group {{ $errors->has('tenants') ? 'has-error' : '' }}">
                                        <label for="tenants">Tenants</label>
                                        <div class="input-group">
                                            <input type="number" name="tenants" id="tenants" class="form-control boxed"
                                                   min="2"
                                                   placeholder="# of Tenants" disabled
                                                   value="{{ old('tenants') != null ? old('tenants') : 2 }}"
                                                   required>
                                            <span class="input-group-addon">tenants</span>
                                        </div>
                                    </div>
                                    <small class="form-text text-muted">The number of tenants allowed in this
                                        property
                                    </small>
                                    @if($errors->has('tenants'))
                                        <p class="form-text text-danger">
                                            <strong>{{ $errors->first('tenants') }}</strong>
                                        </p>
                                    @endif
                                </div>
                            </div>

                        </div><!-- /.col-lg-3 -->
                    </div><!-- /.row -->

                    <div class="row mt-1">
                        <div class="col-lg-9">
                            <div class="card mt-1">
                                <div class="card-block">
                                    <!-- Body -->
                                    <fieldset>
                                        <legend class="col-form-label-sm"><i class="fa fa-map"></i> Location</legend>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <label for="hostel-property-city">City</label>
                                                <div class="form-group form-group {{ $errors->has('city') ? 'has-error' : '' }}">
                                                    <input type="text" name="city" id="hostel-property-city"
                                                           class="form-control underlined" value="{{ old('city') }}">
                                                </div><!-- /city -->
                                                @if($errors->has('city'))
                                                    <p class="form-text text-danger">
                                                        <strong>{{ $errors->first('city') }}</strong>
                                                    </p>
                                                @endif
                                            </div><!-- /.col-lg-6 -->
                                            <div class="col-lg-6">
                                                <div class="form-group form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                                                    <label for="hostel-property-address">Full Address</label>
                                                    <input type="text" name="address" id="hostel-property-address"
                                                           class="form-control underlined" value="{{ old('address') }}">
                                                </div><!-- /address -->
                                                @if($errors->has('address'))
                                                    <p class="form-text text-danger">
                                                        <strong>{{ $errors->first('address') }}</strong>
                                                    </p>
                                                @endif
                                            </div><!-- /.col-lg-6 -->
                                        </div><!-- /.row -->
                                    </fieldset>
                                </div>
                            </div><!-- /.card -->

                            <div class="card mt-1 mb-1">
                                <div class="card-block">
                                    <!-- Body -->
                                    <fieldset class="form-group">
                                        <legend class="col-form-label-sm"><i class="fa fa-list"></i> Features</legend>

                                        <div class="form-group" id="features-wrapper"></div>

                                        <p class="btn btn-link btn-sm" id="btnPropertyFeatureGen">
                                            Add custom feature
                                        </p>

                                        <small class="form-text text-muted">The auto generated features are required
                                        </small>
                                    </fieldset>
                                </div>
                            </div><!-- /.card -->

                            <div class="card mt-1">
                                <div class="card-block">
                                    <fieldset
                                            class="form-group {{ $errors->get('amenity.*') != null ? 'has-error' : '' }}">
                                        <legend class="col-form-label-sm"><i class="fa fa-th-large"></i> Amenities
                                        </legend>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="checkbox"
                                                           name="amenity[]" id="pool"
                                                           value="1" {{ !empty(old('amenity')) && array_search(1,old('amenity')) == 1 ? 'checked' : '' }}>
                                                    <span>Swimming Pool</span>
                                                </label>
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="checkbox"
                                                           name="amenity[]" id="internet"
                                                           value="2" {{ !empty(old('amenity')) && array_search(2,old('amenity')) == 1 ? 'checked' : '' }}>
                                                    <span>Wifi</span>
                                                </label>
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="checkbox"
                                                           name="amenity[]" id="security"
                                                           value="3" {{ !empty(old('amenity')) && array_search(3,old('amenity')) == 1 ? 'checked' : '' }}>
                                                    <span>Security System</span>
                                                </label>
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="checkbox"
                                                           name="amenity[]" id="tv-cable"
                                                           value="4" {{ !empty(old('amenity')) && array_search(4,old('amenity')) == 1 ? 'checked' : '' }}>
                                                    <span>Cable TV</span>
                                                </label>
                                            </div>
                                        </div>
                                    </fieldset>
                                    @if($errors->get('amenity.*') != null)
                                        <ul class="form-text text-danger mt-1 mb-1">
                                            @foreach($errors->get('amenity.*') as $error)
                                                <li><strong>{{ $error[0] }}</strong></li>
                                            @endforeach
                                        </ul>
                                    @endif
                                    <ul class="mt-1">
                                        @if(old('amenity') != null)
                                            @foreach(old('amenity') as $amenity)
                                                <li>{{ $amenity }}</li>
                                            @endforeach
                                        @endif
                                    </ul>
                                </div>
                            </div><!-- /.row -->

                            <div class="card mt-1">
                                <div class="card-block">
                                    <div class="card-title">
                                        <legend class="col-form-label-sm"><i class="fa fa-camera-retro"></i> Image
                                            gallery
                                        </legend>
                                    </div>
                                    <div class="form-group">
                                        <label class="custom-file">
                                            <input type="file" name="property-gallery" id="hostel-property-gallery"
                                                   class="form-control custom-file-input" multiple>
                                            <span class="custom-file-control"></span>
                                        </label>
                                    </div>
                                    <small class="form-text text-muted">You can select multiple images at once</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-auto"></div>
                    </div>

                    <div class="form-group mt-2">
                        <button type="submit" name="btnSave" class="btn btn-success btn-lg">Save
                            Property
                        </button>
                    </div><!-- /.form-group -->
                </form>
            </div><!-- /.col-lg-12 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
@endsection
@section('scripts')
    <script>
        var $i = 0;
        var $property_types = {
            @foreach($property_types as $type)
            '{{ $type->id }}': {
                'title': '{{ $type->title }}',
                'total': '{{ count($type->features) }}',
                'features': {
                    @if(count($type->features) > 0)
                            @foreach($type->features as $feature)
                    '{{ $loop->index }}': {
                        'name': '{{ $feature['name'] }}',
                        'type': '{{ $feature['type'] }}',
                    },
                    @endforeach
                    @endif
                },
            },
            @endforeach
                    @foreach($hostel_property_categories as $category)
            '{{ $category->id }}': {
                'title': '{{ $category->title }}',
                'total': '{{ count($category->features) }}',
                'features': {
                    @if(count($type->features) > 0)
                            @foreach($category->features as $feature)
                    '{{ $loop->index }}': {
                        'name': '{{ $feature['name'] }}',
                        'type': '{{ $feature['type'] }}',
                    },
                    @endforeach
                    @endif
                },
            },
            @endforeach
        };
    </script>

    <script>
        $(document).on('change', 'form select#hostel-property-category', function () {
            var $this = $(this);

            var $id = $this.val();

            //remove auto generated features
            $('#features-wrapper').empty();

            //check if empty
            if ($property_types[$id]['total'] <= 0)
                return;

            var features = $property_types[$id]['features'];

            $.each(features, function (i, item) {

                //get feature properties
                var $name = item.name;
                var $type = item.type;

                //markup
                var $output;
                $output = '<fieldset class="form-group auto-feature" id="' + $name + '">';
                $output += '<div class="row">';
                $output += '<div class="col-md-3">';
                $output += '<div class="form-group">';
                $output += '<label class="form-control-label">' + $name + ' <span class="text-danger">*</span></label>';
                $output += '<input type="text" name="feature[]" class="form-control underlined _add_feature" value="' + $name + '" readonly required>';
                $output += '</div>';
                $output += '</div>';
                $output += '<div class="col-md-6">';
                $output += '<div class="form-group">';
                $output += '<label class="form-control-label">Feature Details</label>';
                $output += '<input type="text" name="details[]" class="form-control underlined _add_details" maxlength="255" required>';
                $output += '</div>';
                $output += '</div>';
                $output += '<div class="col-md-2">';
                $output += '<div class="form-group">';
                $output += '<label class="form-control-label"># of ' + $name + '</label>';
                $output += '<input type="' + $type + '" name="value[]" class="form-control underlined _add_value" required>';
                $output += '</div>';
                $output += '</div>';
                $output += '</div>';
                $output += '<p class="help-block">* ' + $name + ' is required by default</p>';
                $output += '</fieldset>';

                //find
                var $exists = $('#features-wrapper').find('div.auto-feature#' + $name);

                if (!$exists)
                //append auto-feature
                    $('#features-wrapper').prepend($output);
            });

        });

        //ckeditor instance
        CKEDITOR.replace('ckeditor');
    </script>
@endsection