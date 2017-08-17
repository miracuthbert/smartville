@extends('layouts.md.hostel')

@section('title')
    Add Tenant
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <form class="" method="post" action="{{ route('hostel.property.store') }}"
                      id="hostel-property-form" role="form">

                    {{ csrf_field() }}

                    <input type="hidden" name="_app" id="_app" value="-1"><!-- App Id -->

                    <input type="hidden" name="_rentable" id="_rentable" value="1"><!-- Tenant Rentability -->

                    <div class="card">
                        <div class="card-block">
                            <!-- Header -->
                            <div class="card-title">
                                <h1 class="h1-responsive">Add New Tenant</h1>
                                @include('partials.alerts.default')
                                @include('partials.alerts.validation')
                            </div>
                        </div>
                    </div><!-- /.card -->

                    <div class="row mt-1">
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-block">
                                    <div class="card-title">
                                        <h3>Tenant Details</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="card mt-1">
                                <div class="card-block">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control underlined" name="email" id="email"
                                               placeholder="Enter Email" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="firstname">First Name</label>
                                        <input type="text" class="form-control underlined" name="firstname"
                                               id="firstname" placeholder="Enter Firstname" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="lastname">Last Name</label>
                                        <input type="text" class="form-control underlined" name="lastname"
                                               id="lastname" placeholder="Enter Lastname" required>
                                    </div>
                                    <div class="form-group {{ $errors->has('country') ? 'has-error' : '' }}">
                                        <label for="name">Country <span class="text-danger">*</span></label>
                                        <select name="country" class="custom-select form-control" id="country" required>
                                            <option>Pick a country</option>
                                            @foreach($countries as $country)
                                                <option value="{{ $country }}">
                                                    {{ $country }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="id_no">ID No./ Passport No.</label>
                                        <input type="text" name="id_no" class="form-control underlined" id="id_no"
                                               maxlength="45" placeholder="ID or Passport No."
                                               value="{{ old('id_no') }}"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Phone</label>
                                        <input type="text" class="form-control underlined" name="phone" id="phone"
                                               placeholder="Enter Phone No." required>
                                    </div>
                                </div>
                            </div>

                        </div><!-- /.col-lg-6 -->
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-block">
                                    <div class="card-title">
                                        <h3>Property</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-block">
                                    <!-- Body -->
                                    <div class="form-group">
                                        <label for="hostel-property_group" class="col-form-label-sm">
                                            Property Group
                                        </label>
                                        <select name="property_group" id="hostel-property_group"
                                                class="form-control custom-select">
                                            <option value="0">Select a property group</option>
                                            <optgroup label="Common Tenant Categories">
                                                @foreach($property_types as $type)
                                                    <option value="{{ $type->id }}"
                                                            {{ old('property_group') == $type->id ? 'selected' : ''}}>
                                                        {{ $type->title }}
                                                    </option>
                                                @endforeach
                                            </optgroup>
                                            <optgroup label="Hostel Tenant Categories">
                                                @foreach($hostel_property_categories as $category)
                                                    <option value="{{ $category->id }}"
                                                            {{ old('property_group') == $category->id ? 'selected' : ''}}>
                                                        {{ $category->title }}
                                                    </option>
                                                @endforeach
                                            </optgroup>
                                        </select>
                                    </div>
                                    @if($errors->has('property_group'))
                                        <p class="form-text text-danger">
                                            <strong>{{ $errors->first('property_group') }}</strong>
                                        </p>
                                    @endif
                                </div>
                            </div>

                            <div class="card mt-1">
                                <div class="card-block">
                                    <div class="form-group">
                                        <label for="property">Property *</label>
                                        <select name="property" id="property" class="form-control custom-select">
                                            <option>Select a group first</option>
                                        </select>
                                    </div>
                                </div>
                            </div><!-- /.row -->

                            <div class="card mt-1">
                                <div class="card-block">
                                    <label for="lease_duration">Lease duration *</label>
                                    <div class="form-group input-group">
                                        <input type="number" name="lease_duration" class="form-control"
                                               id="lease_duration" min="1" range="1" max="270"
                                               value="{{ old('lease_duration') != null ? old('lease_duration') : 3 }}"/>
                                        <div class="input-group-addon">
                                            month(s)
                                        </div>
                                    </div>
                                    @if($errors->has('lease_duration'))
                                        <p class="form-text text-danger">
                                            <strong>{{ $errors->first('lease_duration') }}</strong>
                                        </p>
                                    @endif
                                </div>
                            </div>

                            <div class="card mt-1">
                                <div class="card-block">
                                    <!-- Body -->
                                    <label for="move_in">Move in date *</label>
                                    <div class="form-group input-group">
                                        <input type="text" name="move_in" class="form-control date-selector"
                                               placeholder="move in date" id="move_in"
                                               value="{{ old('move_in') }}"/>
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar-plus-o"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div><!-- /.col-lg-6 -->
                    </div><!-- /.row -->

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card mt-1">
                                <div class="card-block">
                                    <!-- Body -->
                                    <div class="form-group">
                                        <label for="tenant_review">Tenant review</label>
                                        <textarea name="tenant_review" class="form-control" rows="3" cols="5"
                                                  id="tenant_review"
                                                  placeholder="tenant review">{{ Request::old('tenant_review') }}</textarea>
                                    </div>

                                    @if($errors->has('tenant_review'))
                                        <p class="form-text text-danger">
                                            <strong>{{ $errors->first('tenant_review') }}</strong>
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mt-2">
                        <button type="submit" name="btnSave" class="btn btn-success btn-lg">Save
                            Tenant
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
        $(document).on('change', 'form select#hostel-property_group', function () {
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