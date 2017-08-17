@extends('layouts.admin')

@section('title')
    Edit Category
@endsection

@section('breadcrumb')
    <li>Categories</li>
    <li>Category</li>
    <li class="active">Edit</li>
@endsection

@section('page-header')
    Edit Category
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <form method="post" action="{{ route('category.update', ['id' => $cat->id]) }}"
                  enctype="application/x-www-form-urlencoded"
                  id="create-category-form">

                @include('partials.alerts.default')
                @include('partials.alerts.validation')

                {{ csrf_field() }}
                {{ method_field('put') }}

                <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                    <label for="title" class="control-label">Title</label>
                    <input type="text" name="title" class="form-control" id="title" max="255"
                           value="{{ old('title') == null ? $cat->title : old('title') }}"
                           autofocus>
                    <strong class="text-danger">
                        {{ $errors->has('title') ? $errors->first('title') : '' }}
                    </strong>
                </div>

                <div class="form-group {{ $errors->has('details') ? 'has-error' : '' }}">
                    <label for="details" class="control-label">Details</label>
                    <textarea name="details" class="form-control" id="details" cols="30"
                              rows="5">{{ old('details') == null ? $cat->desc : old('details') }}</textarea>
                    <strong class="text-danger">
                        {{ $errors->has('details') ? $errors->first('details') : '' }}
                    </strong>
                </div>

                <div class="form-group {{ $errors->has('level') ? 'has-error' : '' }}">
                    <label class="control-label">Level</label>
                    <label class="radio-inline">
                        <input type="radio" name="level" id="child"
                               value="0" {{  old('level') == 0 ? 'checked' : $cat->parent == 0 ? 'checked' : '' }}>
                        Child
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="level" id="parent"
                               value="1" {{  old('level') == 1 ? 'checked' : $cat->parent == 1 ? 'checked' : '' }}>
                        Parent
                    </label>
                    <strong class="text-danger">
                        {{ $errors->has('level') ? $errors->first('level') : '' }}
                    </strong>
                </div>

                <div class="form-group {{ $errors->has('parent') ? 'has-error' : '' }}"
                     style="display:{{ $cat->parent == 0 ? '' : 'none' }}" id="cat-parent-wrapper">
                    <label for="cat_parent" class="control-label">Child of</label>
                    <select name="parent" class="form-control" id="cat_parent">
                        <option value="none">------- Select a parent -------</option>
                        @forelse($parents as $parent)
                            <option value="{{ $parent->id }}" {{ $cat->categorable && $cat->categorable->id == $parent->id ? 'selected' : '' }}>
                                {{ $parent->title }}
                            </option>
                        @empty
                        @endforelse
                    </select>
                    <strong class="text-danger">
                        {{ $errors->has('type') ? $errors->first('type') : '' }}
                    </strong>
                </div>

                <div class="form-group">
                    <label class="control-label">Features</label>

                    <div id="features-wrapper">
                        @if(!empty(old('feature')))
                            @for($i = 0; $i < count(old('feature')); $i++)
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group {{ $errors->has('feature.'.$i.'') ? 'has-error' : '' }}">
                                                <input name="feature[]" class="form-control cat-feature"
                                                       placeholder="feature name" value="{{ old('feature')[$i] }}"
                                                       required/>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group {{ $errors->has('feature_value.'.$i.'') ? 'has-error' : '' }}">
                                                <select name="feature_value[]" class="form-control">
                                                    <option>Select expected value</option>
                                                    <option {{ strtolower(array_flatten(old('feature_value'))[$i]) == "text" ? 'selected' : '' }}>
                                                        Text
                                                    </option>
                                                    <option {{ strtolower(old('feature_value')[$i]) == "number" ? 'selected' : '' }}>
                                                        Number
                                                    </option>
                                                    <option {{ strtolower(array_flatten(old('feature_value'))[$i]) == "file" ? 'selected' : '' }}>
                                                        File
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <button type="button" class="btn btn-warning btn-sm btnRmvCatFeature">
                                                    <span class="visible-xs-inline">Remove</span>
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        @elseif(!empty($cat->features))
                            @foreach($cat->features as $feature)
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <input name="feature[]" class="form-control cat-feature"
                                                       placeholder="feature name" value="{{ $feature['name'] }}"
                                                       required/>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <select name="feature_value[]" class="form-control">
                                                    <option>Select expected value</option>
                                                    <option {{ $feature['type'] == "text" ? 'selected' : '' }}>Text
                                                    </option>
                                                    <option {{ $feature['type'] == "number" ? 'selected' : '' }}>Number
                                                    </option>
                                                    <option {{ $feature['type'] == "file" ? 'selected' : '' }}>File
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <button type="button" class="btn btn-warning btn-sm btnRmvCatFeature">
                                                    <span class="visible-xs-inline">Remove</span>
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <em class="help-block">No features defined for this category</em>
                        @endif
                    </div><!-- /#features-wrapper -->

                    <p class="help-block">Features field will be auto generated whenever this category is
                        selected</p>

                    <button type="button" class="btn btn-default" id="btnNewCatFeature"
                            data-target="#features-wrapper">
                        Add new feature <i class="fa fa-plus"></i>
                    </button>
                </div>

                <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                    <label for="status" class="control-label">Status</label>
                    <label class="radio-inline">
                        <input type="radio" name="status" id="disabled"
                               value="0" {{  old('status') == 0 ? 'checked' : $cat->status == 0 ? 'checked' : '' }}>
                        Disabled
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="status" id="active"
                               value="1" {{  old('status') == 1 ? 'checked' : $cat->status == 1 ? 'checked' : '' }}>
                        Active
                    </label>
                    <strong class="text-danger">
                        {{ $errors->has('status') ? $errors->first('status') : '' }}
                    </strong>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary" id="btnCreateCategory">
                        Update <i class="fa fa-check-square-o"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
    <!-- /.row -->
@endsection