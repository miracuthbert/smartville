@extends('layouts.estates')

@section('title')
    {{ $property->title }} Amenities
@endsection

@section('breadcrumb')
    <li><a href="{{ route('estate.rental.properties', ['id' => $app->id, 'sort' => 'all']) }}">Properties</a></li>
    <li><a href="{{ route('estate.rental.property.edit', ['id' => $property->id]) }}">{{ $property->title }}</a></li>
    <li class="active">Amenities</li>
@endsection

@section('page-header')
    {{ $property->title }} Amenities
@endsection

@section('content')

    <div class="row">

        <div class="col-lg-12">
            <form name="add-property-form" method="post" action="{{ route('estate.rental.property.amenities.update') }}"
                  enctype="application/x-www-form-urlencoded"
                  autocomplete="off">

                @include('includes.alerts.default')

                @include('includes.alerts.validation')

                <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">

                <input type="hidden" name="id" id="id" value="{{ $property->id }}">


                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group{{ $errors->has('amenity') ? 'has-error' : '' }}">
                            <p><label>Property amenities:</label></p>

                            @foreach($amenities->chunk(4) as $row)
                                <div class="row">
                                    @foreach($row as $amenity)
                                        <div class="col-md-3">
                                            <label class="checkbox-inline" title="{{ $amenity->description }}">
                                                <input type="checkbox" name="amenity[]" id="amenity_{{ $amenity->id }}"
                                                       class="amenity"
                                                       value="{{ $amenity->id }}"
                                                @foreach($property->amenities as $added)
                                                    @if($added->status == 1)
                                                        {{ $added->amenity_id == $amenity->id ? 'checked' : '' }}
                                                            @endif
                                                        @endforeach
                                                >
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
                <!-- /amenities -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="box">
                            <button type="submit" name="btnUpdateProperty" role="button"
                                    class="btn btn-primary" {{ $app->subscribed != 1 ? 'disabled' : '' }}>Save
                            </button>
                        </div>
                    </div>
                </div>

            </form>
        </div>

    </div>

    <p></p>

    <script>
        CKEDITOR.replace('property_desc');
    </script>
@endsection
