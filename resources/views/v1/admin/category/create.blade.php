@extends('layouts.admin')

@section('title')
    Create Category
@endsection

@section('breadcrumb')
    <li>Categories</li>
    <li class="active">Create</li>
@endsection

@section('page-header')
    Create Category
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <form method="post" action="{{ route('category.store') }}" enctype="application/x-www-form-urlencoded"
                  id="create-category-form">

                @include('includes.alerts.default')
                @include('includes.alerts.validation')

                {{ csrf_field() }}

                <div class="form-group {{ $errors->has('title' ? 'has-error' : '') }}">
                    <label for="title" class="control-label">Title</label>
                    <input type="text" name="title" class="form-control" id="title" max="255" value="{{ Request::old('title') }}"
                           autofocus>
                    <strong class="text-danger">
                        {{ $errors->has('title') ? $errors->first('title') : '' }}
                    </strong>
                </div>
                <div class="form-group {{ $errors->has('details' ? 'has-error' : '') }}">
                    <label for="details" class="control-label">Details</label>
                    <textarea name="details" class="form-control" id="details" cols="30"
                              rows="5">{{ Request::old('details') }}</textarea>
                    <strong class="text-danger">
                        {{ $errors->has('details') ? $errors->first('details') : '' }}
                    </strong>
                </div>
                <div class="form-group {{ $errors->has('type' ? 'has-error' : '') }}">
                    <label for="type" class="control-label">Type</label>
                    <select name="type" class="form-control" id="type">
                        <option value="none">Select category type</option>
                        <option value="product_categories" {{ Request::old('type') == "product_categories" ? 'selected' : '' }}>
                            Product Category
                        </option>
                        <option value="monetizations" {{ Request::old('type') == "monetizations" ? 'selected' : '' }}>
                            Monetization
                        </option>
                        <option value="property_types" {{ Request::old('type') == "property_types" ? 'selected' : '' }}>
                            Property Type
                        </option>
                        <option value="post_audiences" {{ Request::old('type') == "post_audiences" ? 'selected' : '' }}>
                            Post Audience
                        </option>
                        <optgroup label="Product Categories">
                            @forelse($app_categories as $category)
                                <option value="{{ $category->id }}">{{ $category->title }}</option>
                            @empty
                            @endforelse
                        </optgroup>
                        <optgroup label="Payment Categories">
                            @forelse($app_payments as $category)
                                <option value="{{ $category->id }}">{{ $category->title }}</option>
                            @empty
                            @endforelse
                        </optgroup>
                        <optgroup label="Product Categories">
                            @forelse($property_types as $category)
                                <option value="{{ $category->id }}">{{ $category->title }}</option>
                            @empty
                            @endforelse
                        </optgroup>
                    </select>
                    <strong class="text-danger">
                        {{ $errors->has('type') ? $errors->first('type') : '' }}
                    </strong>
                </div>
                <div class="form-group {{ $errors->has('parent' ? 'has-error' : '') }}">
                    <label class="control-label">Level</label>
                    <label class="radio-inline">
                        <input type="radio" name="level" id="child" value="0"> Child
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="level" id="parent" value="1" checked> Parent
                    </label>
                    <strong class="text-danger">
                        {{ $errors->has('level') ? $errors->first('level') : '' }}
                    </strong>
                </div>
                <div class="form-group {{ $errors->has('status' ? 'has-error' : '') }}">
                    <label for="status" class="control-label">Status</label>
                    <label class="radio-inline">
                        <input type="radio" name="status" id="disabled" value="0" checked> Disabled
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="status" id="active" value="1"> Active
                    </label>
                    <strong class="text-danger">
                        {{ $errors->has('status') ? $errors->first('status') : '' }}
                    </strong>
                </div>

                <button type="submit" class="btn btn-success" id="btnCreateCategory">
                    Save <i class="fa fa-check-square-o"></i>
                </button>
            </form>
        </div>
    </div>
    <!-- /.row -->
@endsection