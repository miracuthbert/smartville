@extends('layouts.md.hostel')

@section('title')
    Add Amenity
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <form class="" method="post" action="{{ route('hostel.amenity.store') }}"
                      id="hostel-property-form" role="form">

                    {{ csrf_field() }}

                    <input type="hidden" name="_app" id="_app" value="-1"><!-- App Id -->

                    <div class="card">
                        <div class="card-block">
                            <!-- Header -->
                            <div class="card-title">
                                <h1 class="h1-responsive">Add New Amenity</h1>
                                @include('includes.alerts.default')
                                @include('includes.alerts.validation')
                            </div>
                        </div>
                    </div><!-- /.card -->

                    <div class="row mt-1">
                        <div class="col-lg-12">
                            <div class="card mb-1">
                                <div class="card-block">
                                    <!-- Body -->
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group {{ $errors->has('property-title') ? 'has-error' : '' }}">
                                                <label for="hostel-property-title">Amenity Title *</label>
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

                        </div><!-- /.col-lg-12 -->
                    </div><!-- /.row -->

                    <div class="row mt-1">
                        <div class="col-lg-12">

                            <div class="card mt-1">
                                <div class="card-block">
                                    <fieldset
                                            class="form-group {{ $errors->get('amenity.*') != null ? 'has-error' : '' }}">
                                        <label class="col-form-label-sm"><i class="fa fa-building-o"></i> Properties
                                        </label>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="checkbox"
                                                           name="amenity[]" id="pool"
                                                           value="1" {{ !empty(old('amenity')) && array_search(1,old('amenity')) == 1 ? 'checked' : '' }}>
                                                    <span>Room 1</span>
                                                </label>
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="checkbox"
                                                           name="amenity[]" id="internet"
                                                           value="2" {{ !empty(old('amenity')) && array_search(2,old('amenity')) == 1 ? 'checked' : '' }}>
                                                    <span>Room 2</span>
                                                </label>
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="checkbox"
                                                           name="amenity[]" id="security"
                                                           value="3" {{ !empty(old('amenity')) && array_search(3,old('amenity')) == 1 ? 'checked' : '' }}>
                                                    <span>Room 3</span>
                                                </label>
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="checkbox"
                                                           name="amenity[]" id="tv-cable"
                                                           value="4" {{ !empty(old('amenity')) && array_search(4,old('amenity')) == 1 ? 'checked' : '' }}>
                                                    <span>Room 4</span>
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
                            </div><!-- /.card -->

                            <div class="card mt-1">
                                <div class="card-block">
                                    <!-- Body -->
                                    <fieldset class="form-group">
                                        <label class="form-control-label col-form-label-sm">Status</label>
                                        <div>
                                            <label>
                                                <input type="radio" class="radio"
                                                       name="status"
                                                       id="draft"
                                                       value="0" {{ old('status') != null && old('status') == 0 ? 'checked' : 'checked' }}>
                                                <span>Draft</span>
                                            </label>
                                            <label>
                                                <input type="radio" class="radio"
                                                       name="status"
                                                       id="available"
                                                       value="1" {{ old('status') != null && old('status') == 1 ? 'checked' : '' }}>
                                                <span>Available</span>
                                            </label>
                                        </div>
                                    </fieldset>
                                    @if($errors->has('status'))
                                        <p class="form-text text-danger">
                                            <strong>{{ $errors->first('status') }}</strong>
                                        </p>
                                    @endif
                                </div>
                            </div><!-- /.card -->
                        </div>
                    </div>

                    <div class="form-group mt-2">
                        <button type="submit" name="btnSave" class="btn btn-success btn-lg">Save
                            Amenity
                        </button>
                    </div><!-- /.form-group -->
                </form>
            </div><!-- /.col-lg-12 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
@endsection
@section('scripts')
@endsection