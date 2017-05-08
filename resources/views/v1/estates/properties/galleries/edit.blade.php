@extends('layouts.estates')

@section('title')
    {{ $property->title }} - Create a new gallery
@endsection

@section('breadcrumb')
    <li>Properties</li>
    <li>{{ $property->title }}</li>
    <li>Galleries</li>
    <li class="active">Edit</li>
@endsection

@section('page-header')
    <i class="fa fa-camera fa-fw"></i> Edit gallery
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <form role="form" method="post"
                  action="{{ route('estate.rental.property.gallery.update', ['id' => $gallery->id]) }}"
                  enctype="multipart/form-data" id="property-gallery-create-form">

                {{ csrf_field() }}
                {{ method_field('put') }}

                @include('includes.alerts.default')
                @include('includes.alerts.validation')

                <div class="form-group">
                    <label>Property <span class="text-danger">*</span></label>
                    <p class="form-control-static">{{ $property->title }}</p>
                    <input type="hidden" name="property" id="property" value="{{ $property->id }}">
                </div>

                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                    <label>Name <span class="text-danger">*</span></label>
                    <input name="name" class="form-control" placeholder="enter the name of the collection" id="name"
                           value="{{ Request::old('name') != null ? Request::old('name') : $gallery->title }}" required
                           autofocus>
                </div>

                <div class="form-group {{ $errors->has('audience') ? 'has-error' : '' }}">
                    <label>Share with (audience) <span class="text-danger">*</span></label>
                    <select name="audience" class="form-control">
                        <option>Choose audience...</option>
                        @forelse($post_audiences as $audience)
                            <option value="{{ $audience->id }}" {{ Request::old('audience') == $audience->id ? 'selected' : $gallery->audience_id == $audience->id ? 'selected' : '' }}>
                                {{ $audience->title }}
                            </option>
                        @empty
                            <option>Some error occurred</option>
                        @endforelse
                    </select>
                    <span class="help-block">Choose who can see this collection</span>
                </div>

                <div class="form-group {{ $errors->has('cover') ? 'has-error' : '' }}">
                    <label>Cover</label>
                    <input type="file" name="cover" class="form-control" id="cover" placeholder="upload a cover image">
                </div>

                <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                    <label>Short description</label>
                    <textarea name="description" class="form-control" rows="3" id="description"
                              placeholder="Something short and leading about the collection. Make it short and sweet, but not too short so folks don't simply skip over it entirely.">{{ Request::old('description') != null ? Request::old('description') : $gallery->summary }}</textarea>
                </div>

                <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                    <label>Status<span class="text-danger">*</span></label>
                    <label class="radio-inline">
                        <input type="radio" name="status" id="draft"
                               value="0" {{ Request::old('status') == 0 ? 'checked' : $gallery->status == 0 ? 'checked' : '' }}>Draft
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="status" id="show"
                               value="1" {{ Request::old('status') == 1 ? 'checked' : $gallery->status == 1 ? 'checked' : '' }}>Final
                    </label>
                </div>

                <button type="submit" class="btn btn-primary">Update <i class="fa fa-check-square-o"></i></button>
                <button type="reset" class="btn btn-default">Reset <i class="fa fa-times-square-o"></i></button>
            </form>
            <!-- /form -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
@endsection