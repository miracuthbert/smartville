@extends('layouts.rental.master')

@section('title')
    {{ $property->title }} - Edit photo
@endsection

@section('breadcrumb')
    <li>Properties</li>
    <li>{{ $property->title }}</li>
    <li>{{ $gallery->title }}</li>
    <li>Photo</li>
    <li class="active">Edit</li>
@endsection

@section('page-header')
    <i class="fa fa-photo fa-fw"></i> Edit photo
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <p class="lead">You can change different details about the photo here</p>

            <form role="form" method="post"
                  action="{{ route('estate.rental.property.image.update', ['id' => $photo->id]) }}"
                  enctype="multipart/form-data" id="property-photo-create-form">

                {{ method_field('put') }}
                {{ csrf_field() }}

                @include('partials.alerts.default')
                @include('partials.alerts.validation')

                <div class="row">
                    <div class="col-lg-12">
                        <div class="thumbnail">
                            <img src="{{ url($photo->photo) }}" class="img-responsive"
                                 alt="{{ $photo->caption }}">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Property <span class="text-danger">*</span></label>
                            <span class="form-control-static">{{ $property->title }}</span>
                            <div class="pull-right">
                                <div class="btn-group btn-group-xs">
                                    <a href="{{ route('estate.rental.property.edit', ['id' => $property->id]) }}"
                                       class="btn btn-primary btn-xs pull-right">
                                        Edit Property <i class="fa fa-edit"></i>
                                    </a>
                                </div>
                            </div>
                            <input type="hidden" name="property" id="property" value="{{ $property->id }}">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Gallery <span class="text-danger">*</span></label>
                            <span class="form-control-static">{{ $gallery->title }}</span>
                            <div class="pull-right">
                                <div class="btn-group btn-group-xs">
                                    <a href="{{ route('estate.rental.property.gallery.show', ['id' => $gallery->id]) }}"
                                       class="btn btn-default">
                                        View Gallery <i class="fa fa-camera-retro"></i>
                                    </a>
                                    <a href="{{ route('estate.rental.property.gallery.edit', ['id' => $gallery->id]) }}"
                                       class="btn btn-primary">
                                        Edit Gallery <i class="fa fa-edit"></i>
                                    </a>
                                </div>
                            </div>
                            <input type="hidden" name="gallery" id="gallery" value="{{ $gallery->id }}">
                        </div>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group {{ $errors->has('caption') ? 'has-error' : '' }}">
                            <label>Caption <span class="text-danger">*</span></label>
                            <input name="caption" class="form-control" placeholder="enter the caption of the photo"
                                   id="caption"
                                   value="{{ Request::old('caption') != null ? Request::old('caption') : $photo->caption }}"
                                   required autofocus>
                            <span class="help-block">Something unique about the photo</span>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group {{ $errors->has('audience') ? 'has-error' : '' }}">
                            <label>Share with (audience) <span class="text-danger">*</span></label>
                            <select name="audience" class="form-control">
                                <option>Choose audience...</option>
                                @forelse($post_audiences as $audience)
                                    <option value="{{ $audience->id }}" {{ Request::old('audience') == $audience->id ? 'selected' : $photo->audience->id == $audience->id ? 'selected' : '' }}>
                                        {{ $audience->title }}
                                    </option>
                                @empty
                                    <option>Some error occurred</option>
                                @endforelse
                            </select>
                            <span class="help-block">Choose who can see this collection</span>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Location</label>
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                <input type="text" name="location" class="form-control" id="location"
                                       placeholder="location"
                                       value="{{ Request::old('location') != null ? Request::old('location') : $photo->location }}">
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-default btnReset" title="remove">
                            <i class="fa fa-times"></i>
                        </button>
                    </span>
                            </div>
                            <span class="help-block">Attach photo location</span>
                        </div>
                    </div>
                    <div class="col-lg-6"></div>
                </div>
                <!-- /.row -->

                {{--.row>.col-lg-6*2--}}
                        <!-- /.row -->

                <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                    <label>Short description</label>
                    <textarea name="description" class="form-control" rows="3" id="description"
                              placeholder="Something short and leading about the photo. Make it short and sweet, but not too short so folks don't simply skip over it entirely.">{{ Request::old('description') != null ? Request::old('description') : $photo->description }}</textarea>
                </div>

                <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                    <label>Status<span class="text-danger">*</span></label>
                    <label class="radio-inline">
                        <input type="radio" name="status" id="draft"
                               value="0" {{ Request::old('status') == 0 ? 'checked' : $photo->status == 0 ? 'checked' : '' }}>Draft
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="status" id="show"
                               value="1" {{ Request::old('status') == 1 ? 'checked' : $photo->status == 1 ? 'checked' : '' }}>Final
                    </label>
                </div>

                <button type="submit" class="btn btn-primary">Update <i class="fa fa-upload"></i></button>
                <button type="reset" class="btn btn-default">Reset
                    <i class="fa fa-times-circle-o"></i>
                </button>
            </form>
            <!-- /form -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
@endsection