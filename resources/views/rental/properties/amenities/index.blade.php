@extends('layouts.rental.master')

@section('title', "{$property->title} Amenities")

@section('breadcrumb')
    <li><a href="{{ route('rental.properties.index', [$app]) }}">Properties</a></li>
    <li><a href="{{ route('rental.properties.edit', [$app, $property]) }}">{{ $property->title }}</a></li>
    <li class="active">Amenities</li>
@endsection

@section('page-header')
    {{ $property->title }} Amenities
@endsection

@section('content')

    <div class="row">

        <div class="col-lg-12">
            <form name="add-property-form" method="post"
                  action="{{ route('rental.properties.amenities.store', [$app, $property]) }}"
                  enctype="application/x-www-form-urlencoded"
                  autocomplete="off">
                {{ csrf_field() }}

                @include('partials.alerts.validation')

                <div class="row">
                    <div class="col-lg-12">
                        <!-- amenities -->
                        @foreach($amenities as $amenity)
                            <div class="form-group{{ $errors->has('amenity') ? 'has-error' : '' }}">
                                <div class="media">
                                    <div class="media-body">
                                        <label class="checkbox-inline" title="">
                                            <h4>@if(isset($property) and $property->amenable($amenity))
                                                    <input type="checkbox" name="amenity[]"
                                                           id="amenity_{{ $amenity->id }}"
                                                           class="amenity" value="{{ $amenity->id }}" checked>
                                                @else
                                                    <input type="checkbox" name="amenity[]"
                                                           id="amenity_{{ $amenity->id }}"
                                                           class="amenity" value="{{ $amenity->id }}">
                                                @endif
                                                {{ $amenity->title }}</h4>
                                        </label>
                                        <div>{!! $amenity->description !!}</div>
                                        <ul class="list-inline">
                                            @if(isset($property) and $property->amenable($amenity))
                                                <li>Added on:
                                                    <time>{{ $property->amenity($amenity)->pivot->created_at->diffForHumans() }}</time>
                                                </li>

                                                @if(isset($property->amenity($amenity)->pivot->deleted_at))
                                                    <li>Removed on:
                                                        <time>{{ $property->amenity($amenity)->pivot->deleted_at->diffForHumans() }}</time>
                                                    </li>
                                                @endif
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <hr>
                        @endforeach
                        @if($errors->has('amenity'))
                            <p class="text-danger">
                                <strong>{{ $errors->first('amenity') }}</strong>
                            </p>
                        @endif
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="box">
                            <button type="submit" name="btnUpdateProperty" role="button"
                                    class="btn btn-primary" {{ !$app->subscribed != 1 ? 'disabled' : '' }}>Save
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
