@extends('layouts.rental.master')

@section('title', 'Edit Amenitiy')

@section('breadcrumb')
    <li>
        <a href="{{ route('rental.amenities.index', ['id' => $app->id]) }}">Amenities</a>
    </li>
    <li class="active">Edit</li>
@endsection

@section('page-header')
    Edit Amenity
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">

            <form name="add-amenity-form" method="post" action="{{ route('rental.amenities.update', [$app, $amenity]) }}"
                  enctype="application/x-www-form-urlencoded"
                  autocomplete="off">

                @include('partials.alerts.validation')

                {{ csrf_field() }}
                {{ method_field('PUT') }}

                <input type="hidden" name="id" id="id" value="{{ $amenity->id }}">

                <div class="form-group{{ $errors->has('title') ? 'has-error' : '' }}">
                    <label for="title">Amenity title:</label>
                    <input type="text" name="title" class="form-control" placeholder="amenity title"
                           id="title" maxlength="50" value="{{ $amenity->title }}" required autofocus/>
                </div>

                <div class="form-group{{ $errors->has('description') ? 'has-error' : '' }}">
                    <label for="description">Amenity description:</label>
                    <textarea name="description" class="form-control" rows="3" cols="5" id="desc"
                              placeholder="description">{{ $amenity->description }}</textarea>
                </div>

                <div class="form-group">
                    <p><label>Amenity status:</label></p>
                    <label class="radio-inline">
                        <input type="radio" name="status" id="disable" value="0"> Disable
                    </label>

                    <label class="radio-inline">
                        <input type="radio" name="status" checked id="active" value="1"> Active
                    </label>
                </div>

                <button type="submit" name="btnUpdateAmenity" role="button"
                        class="btn btn-primary" {{ $app->subscribed != 1 ? 'disabled' : '' }}>Update
                </button>
            </form>

        </div>
    </div>
@endsection
