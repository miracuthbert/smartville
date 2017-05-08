@extends('layouts.estates')

@section('title')
    {{ $property->title }} - Add new image
@endsection

@section('breadcrumb')
    <li>Properties</li>
    <li>{{ $property->title }}</li>
    <li>{{ $gallery->title }}</li>
    <li>Photo</li>
    <li class="active">Add</li>
@endsection

@section('page-header')
    <i class="fa fa-camera fa-fw"></i> Add new
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <form role="form" method="post" action="{{ route('estate.rental.property.image.store') }}"
                  enctype="multipart/form-data" id="property-gallery-create-form">

                {{ csrf_field() }}

                @include('includes.alerts.default')
                @include('includes.alerts.validation')

                <div class="form-group">
                    <label>Property <span class="text-danger">*</span></label>
                    <p class="form-control-static">{{ $property->title }}</p>
                    <a href="{{ route('estate.rental.property.edit', ['id' => $property->id]) }}"
                       class="btn btn-primary">
                        Edit Property <i class="fa fa-edit"></i>
                    </a>
                    <input type="hidden" name="property" id="property" value="{{ $property->id }}">
                </div>

                <div class="form-group">
                    <label>Gallery <span class="text-danger">*</span></label>
                    <p class="form-control-static">{{ $gallery->title }}</p>
                    <a href="{{ route('estate.rental.property.gallery.show', ['id' => $gallery->id]) }}"
                       class="btn btn-info">View Gallery <i class="fa fa-camera-retro"></i>
                    </a>
                    <input type="hidden" name="gallery" id="gallery" value="{{ $gallery->id }}">
                </div>

                <div class="form-group {{ $errors->has('caption') ? 'has-error' : '' }}">
                    <label>Caption <span class="text-danger">*</span></label>
                    <input name="caption" class="form-control" placeholder="enter the caption of the photo" id="caption"
                           value="{{ Request::old('caption') }}" required autofocus>
                </div>

                <div class="form-group {{ $errors->has('audience') ? 'has-error' : '' }}">
                    <label>Share with (audience) <span class="text-danger">*</span></label>
                    <select name="audience" class="form-control">
                        <option>Choose audience...</option>
                        @forelse($post_audiences as $audience)
                            <option value="{{ $audience->id }}" {{ Request::old('audience') == $audience->id ? 'selected' : '' }}>
                                {{ $audience->title }}
                            </option>
                        @empty
                            <option>Some error occurred</option>
                        @endforelse
                    </select>
                    <span class="help-block">Choose who can see this collection</span>
                </div>

                <div class="form-group {{ $errors->has('photo') ? 'has-error' : '' }}">
                    <label>Photo</label>
                    <input type="file" name="photo" class="form-control" id="photo" placeholder="upload a photo">
                </div>

                <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                    <label>Short description</label>
                    <textarea name="description" class="form-control" rows="3" id="description"
                              placeholder="Something short and leading about the collection. Make it short and sweet, but not too short so folks don't simply skip over it entirely.">{{ Request::old('description') }}</textarea>
                </div>

                <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                    <label>Status<span class="text-danger">*</span></label>
                    <label class="radio-inline">
                        <input type="radio" name="status" id="draft" value="0" checked>Draft
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="status" id="show" value="1">Final
                    </label>
                </div>

                <button type="submit" class="btn btn-success">Create <i class="fa fa-check-square-o"></i></button>
                <button type="reset" class="btn btn-default">Reset Button <i class="fa fa-times-square-o"></i></button>
            </form>
            <!-- /form -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
@endsection