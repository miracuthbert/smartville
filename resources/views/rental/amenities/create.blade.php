@extends('layouts.rental.master')

@section('title', 'Add Amenity')

@section('breadcrumb')
    <li>Amenities</li>
    <li class="active">Add</li>
@endsection

@section('page-header')
    Add Amenity
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <form name="add-amenity-form" method="post" action="{{ route('rental.amenities.store', [$app]) }}"
                  enctype="application/x-www-form-urlencoded"
                  autocomplete="off">
                {{ csrf_field() }}

                @include('partials.alerts.validation')


                <div class="form-group{{ $errors->has('title') ? 'has-error' : '' }}">
                    <label for="title">Amenity title:</label>
                    <input type="text" name="title" class="form-control" placeholder="amenity title"
                           id="title" maxlength="50" value="{{ old('title') }}" required autofocus/>
                </div>

                <div class="form-group{{ $errors->has('description') ? 'has-error' : '' }}">
                    <label for="description">Amenity description:</label>
                    <textarea name="description" class="form-control" rows="3" cols="5" id="desc"
                              placeholder="description">{{ old('description') }}</textarea>
                </div>

                <div class="form-group">
                    <label>Amenity status:</label>
                    <div class="radio">
                        <label class="radio-inline">
                            <input type="radio" name="status" id="disable" value="0"> Disabled
                        </label>

                        <label class="radio-inline">
                            <input type="radio" name="status" id="active" value="1" checked> Active
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" name="btnAddAmenity" role="button" class="btn btn-success btn-sm">Save
                    </button>
                </div>
            </form>

        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <script>
        CKEDITOR.replace('ckeditor');
    </script>
@endsection
