@extends('layouts.estates')

@section('title')
    {{ $property->title }} - Create a new gallery
@endsection

@section('breadcrumb')
    <li>Property</li>
    <li>Galleries</li>
    <li>Create</li>
@endsection

@section('page-header')
    <i class="fa fa-camera fa-fw"></i> Create a new gallery
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <form role="form" method="post" action="{{ route('estate.rental.property.gallery.store') }}"
                  enctype="multipart/form-data" id="property-gallery-create-form">

                {{ csrf_field() }}

                @include('partials.alerts.default')
                @include('partials.alerts.validation')

                <div class="form-group">
                    <label>Property <span class="text-danger">*</span></label>
                    <p class="form-control-static">{{ $property->title }}</p>
                    <input type="hidden" name="property" id="property" value="{{ $property->id }}">
                </div>

                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                    <label>Name <span class="text-danger">*</span></label>
                    <input name="name" class="form-control" placeholder="enter the name of the collection" id="name"
                           value="{{ Request::old('name') }}" required autofocus>
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

                <div class="form-group {{ $errors->has('cover') ? 'has-error' : '' }}">
                    <label>Cover</label>
                    <input type="file" name="cover" class="form-control" id="cover" placeholder="upload a cover image">
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