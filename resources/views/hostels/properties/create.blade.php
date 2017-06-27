@extends('layouts.md.hostel')

@section('title')
    Add Property
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <form class="" method="post" action="{{ route('hostel.property.create') }}"
                      id="hostel-property-form" role="form">
                    <div class="card">
                        <div class="card-block">
                            <!-- Header -->
                            <div class="card-title">
                                <h1 class="h1-responsive">Add New Property</h1>
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
                                            <div class="md-form">
                                                <input type="text" name="property-title" id="hostel-property-title"
                                                       class="form-control" value="{{ old('property-title') }}"
                                                       autofocus>
                                                <label for="hostel-property-title">Property Title *</label>
                                            </div>
                                        </div>
                                    </div><!-- /.row -->
                                </div>
                            </div><!-- /.card -->

                            <div class="card mt-1">
                                <div class="card-block">
                                    <!-- Body -->
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="md-form ">
                                                <input type="text" name="property-price" id="hostel-property-price"
                                                       class="form-control" value="{{ old('property-price') }}">
                                                <label for="hostel-property-price">Price *</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="md-form {{ $errors->has('interval') ? 'has-error' : '' }} input-group">
                                                <input type="number" name="rent-interval" class="form-control"
                                                       id="interval"
                                                       min="1"
                                                       value="{{ Request::old('interval') }}" required/>
                                                <div class="input-group-addon">
                                                    <select name="interval-label" id="interval-label"
                                                            class="custom-select">
                                                        <option value="per month">Monthly</option>
                                                        <option value="per week">Weekly</option>
                                                        <option value="per week">Semester</option>
                                                    </select>
                                                </div>
                                                <label for="rent-interval">Rent Interval *</label>
                                            </div>
                                            @if($errors->has('interval'))
                                                <p class="form-text text-danger">
                                                    <strong>{{ $errors->first('interval') }}</strong>
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
                                            <div class="md-form">
                                        <textarea name="property-excerpt" class="form-control md-textarea"
                                                  id="hostel-property-excerpt" maxlength="160" rows="5"></textarea>
                                                <label for="hostel-property-excerpt">Excerpt</label>
                                            </div>
                                        </div>
                                    </div><!-- /.row -->
                                </div>
                            </div><!-- /.card -->

                            <div class="card mt-1">
                                <div class="card-block">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="hostel-property-description" class="col-form-label-sm">Description
                                                    or details</label>
                                        <textarea name="property-description" id="hostel-property-description" cols="60"
                                                  rows="8" class="form-control ckeditor"></textarea>
                                            </div>
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
                                        <div for="hostel-property-category" class="col-form-label-sm">Property
                                            category
                                        </div>
                                        <select name="property-category" id="hostel-property-category"
                                                class="custom-select">
                                            <option value="0">Select a property category</option>
                                            <optgroup label="Common Property Categories">
                                                @foreach($property_types as $type)
                                                    <option value="{{ $type->id }}"
                                                            {{ Request::old('property-category') == $type->id ? 'selected' : ''}}>
                                                        {{ $type->title }}
                                                    </option>
                                                @endforeach
                                            </optgroup>
                                            <optgroup label="Hostel Property Categories">
                                                <option value="">Single Room</option>
                                                <option value="">Single Deluxe</option>
                                                <option value="">Shared Room</option>
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="card mt-1">
                                <div class="card-block">
                                    <div class="md-form input-group">
                                        <input type="text" name="property-size" id="hostel-property-size"
                                               class="form-control" value="{{ old('property-size') }}">
                                        <div class="input-group-addon">Sq Ft</div>
                                        <label for="hostel-property-size">Property size (Area)</label>
                                    </div>
                                </div>
                            </div>

                            <div class="card mt-1">
                                <div class="card-block">
                                    <!-- Body -->
                                    <fieldset class="form-group">
                                        <div class="form-control-label col-form-label-sm">Multiple Tenants</div>
                                        <div class="form-check-inline">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input"
                                                       name="multiple_tenants"
                                                       id="multi_tenant_no" value="0" checked>
                                                No
                                            </label>
                                        </div>
                                        <div class="form-check-inline">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input"
                                                       name="multiple_tenants"
                                                       id="multi_tenant_yes" value="1">
                                                Yes
                                            </label>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>

                            <div class="card mt-1">
                                <div class="card-block">
                                    <!-- Body -->
                                    <div class="md-form {{ $errors->has('tenants') ? 'has-error' : '' }} input-group">
                                        <input type="number" name="tenants" id="tenants" class="form-control"
                                               min="2"
                                               placeholder="# of Tenants" disabled
                                               value="{{ Request::old('tenants') != null ? Request::old('tenants') : 2 }}"
                                               required>
                                        <div class="input-group-addon">tenants</div>
                                        <label for="tenants">Tenants</label>
                                    </div>
                                    <small class="form-text text-muted">The number of tenants allowed in this
                                        property
                                    </small>
                                    @if($errors->has('tenants'))
                                        <small class="text-danger">
                                            <strong>{{ $errors->first('tenants') }}</strong>
                                        </small>
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
                                                <div class="md-form">
                                                    <input type="text" name="city" id="hostel-property-city"
                                                           class="form-control" value="{{ old('city') }}">
                                                    <label for="hostel-property-city">City</label>
                                                </div><!-- /city -->
                                            </div><!-- /.col-lg-6 -->
                                            <div class="col-lg-6">
                                                <div class="md-form">
                                                    <input type="text" name="address" id="hostel-property-address"
                                                           class="form-control" value="{{ old('address') }}">
                                                    <label for="hostel-property-address">Full Address</label>
                                                </div><!-- /address -->
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
                                    <fieldset class="form-group">
                                        <legend class="col-form-label-sm"><i class="fa fa-th-large"></i> Amenities
                                        </legend>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input"
                                                           name="property-amenities[]" id="pool">
                                                    Outdoor Pool
                                                </label>
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input"
                                                           name="property-amenities[]" id="internet">
                                                    Internet
                                                </label>
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input"
                                                           name="property-amenities[]" id="security">
                                                    Security System
                                                </label>
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input"
                                                           name="property-amenities[]" id="tv-cable">
                                                    TV Cable
                                                </label>
                                            </div>
                                        </div>
                                    </fieldset>
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

                    <div class="md-form mt-2">
                        <button type="submit" name="btnSave" class="btn btn-success btn-lg">Save
                            Property
                        </button>
                    </div><!-- /.md-form -->
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
        };
    </script>

    <script>
        $(document).on('change', 'form select#hostel-property-category', function () {
            var $this = $(this);

            var $id = $this.val();

            //remove auto generated features
            $('#features-wrapper').find('div.auto-feature').remove();

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
                $output += '<div class="md-form">';
                $output += '<input type="text" name="feature[]" class="form-control _add_feature" value="' + $name + '" readonly required>';
                $output += '<label class="form-control-label">' + $name + ' <span class="text-danger">*</span></label>';
                $output += '</div>';
                $output += '</div>';
                $output += '<div class="col-md-6">';
                $output += '<div class="md-form">';
                $output += '<input type="text" name="details[]" class="form-control _add_details" maxlength="255" required>';
                $output += '<label class="form-control-label">Feature Details</label>';
                $output += '</div>';
                $output += '</div>';
                $output += '<div class="col-md-2">';
                $output += '<div class="md-form">';
                $output += '<input type="' + $type + '" name="value[]" class="form-control _add_value" required>';
                $output += '<label class="form-control-label"># of ' + $name + '</label>';
                $output += '</div>';
                $output += '</div>';
                $output += '</div>';
                $output += '<p class="help-block">* ' + $name + ' is required by default</p>';
                $output += '</fieldset>';

                //append auto-features
                $('#features-wrapper').prepend($output);
            });

        });

        //ckeditor instance
        CKEDITOR.replace('ckeditor');
    </script>
@endsection