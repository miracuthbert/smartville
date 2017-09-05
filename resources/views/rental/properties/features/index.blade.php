@extends('layouts.rental.master')

@section('title', "{$property->title} Features")

@section('breadcrumb')
    <li><a href="{{ route('rental.properties.index', [$app]) }}">Properties</a></li>
    <li><a href="{{ route('rental.properties.edit', [$app, $property]) }}">{{ $property->title }}</a></li>
    <li class="active">Features</li>
@endsection

@section('page-header')
    {{ $property->title }} Features
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <form name="add-property-form" method="post"
                  action="{{ route('rental.properties.features.store', [$app, $property]) }}"
                  enctype="application/x-www-form-urlencoded"
                  autocomplete="off">
                {{ csrf_field() }}

                @include('partials.alerts.validation')

                <h3>Add new feature(s):</h3>

                @if($errors->has('feature')or$errors->has('details')or$errors->has('value'))
                    <p class="text-danger">
                        @if($errors->has('feature'))
                            <strong>{{ $errors->first('feature') }}</strong> <br>
                        @endif
                        @if($errors->has('details'))
                            <strong>{{ $errors->first('details') }}</strong> <br>
                        @endif
                        @if($errors->has('value'))
                            <strong>{{ $errors->first('value') }}</strong>
                        @endif
                    </p>
                @endif

                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group @if($errors->has('feature')||$errors->has('details')||$errors->has('value')) has-error @endif">
                            @if(count(Request::old('feature')) <= 0)
                                @forelse($results as $result)
                                    @if($result == null)
                                        <div class="form-group auto-feature"
                                             id="{{ $type->features[$loop->index]['name'] }}">
                                            <div class="row" id="auto">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class="sr-only">Feature</label>
                                                        <input type="text" name="feature[]"
                                                               class="form-control _add_feature"
                                                               value="{{ $type->features[$loop->index]['name'] }}"
                                                               readonly>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="sr-only">Feature Details</label>
                                                        <input type="text" name="details[]"
                                                               class="form-control _add_details"
                                                               placeholder="Feature Details" maxlength="255">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label class="sr-only">#</label>
                                                        <input type="{{ $type->features[$loop->index]['type'] }}"
                                                               name="value[]"
                                                               class="form-control _add_value"
                                                               placeholder="# of {{ $type->features[$loop->index]['name'] }}"
                                                               required>
                                                    </div>
                                                </div>
                                            </div><!-- /.row#auto -->
                                            <p class="help-block">* {{ $type->features[$loop->index]['name'] }} is
                                                required by default</p>
                                        </div>
                                    @endif
                                @empty
                                @endforelse

                                <div class="row" id="default">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="sr-only">Feature</label>
                                            <input type="text" name="feature[]" class="form-control _add_feature"
                                                   placeholder="Feature">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="sr-only">Feature Details</label>
                                            <input type="text" name="details[]" class="form-control _add_details"
                                                   placeholder="Feature Details" maxlength="255">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="sr-only">#</label>
                                            <input type="text" name="value[]" class="form-control _add_value"
                                                   placeholder="# of feature" required>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <button type="button" name="btnFeatureGen"
                                                class="btn btn-warning btn-sm btnRemoveFeature pull-right"
                                                data-toggle="tooltip" title="Remove feature">
                                            <span class="text-warning visible-xs-inline">Remove</span>
                                            <span class="fa fa-remove"></span>
                                        </button>
                                    </div>
                                </div><!-- /.row#default -->
                            @else
                                @for($i = 0; $i < count(Request::old('feature')); $i++)
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="sr-only">Feature</label>
                                                <input type="text" name="feature[]"
                                                       class="form-control _add_feature"
                                                       value="{{ Request::old('feature')[$i] }}"
                                                       placeholder="Feature">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="sr-only">Feature Details</label>
                                                <input type="text" name="details[]"
                                                       class="form-control _add_details"
                                                       placeholder="Feature Details" maxlength="255"
                                                       value="{{ Request::old('details')[$i] }}">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label class="sr-only">#</label>
                                                <input type="text" name="value[]"
                                                       class="form-control _add_value"
                                                       placeholder="# of feature"
                                                       value="{{ Request::old('value')[$i] }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <button type="button" name="btnFeatureGen"
                                                    class="btn btn-warning btn-sm btnRemoveFeature pull-right"
                                                    data-toggle="tooltip" title="Remove feature">
                                                <span class="text-warning visible-xs-inline">Remove</span>
                                                <span class="fa fa-remove"></span>
                                            </button>
                                        </div>
                                        <hr>
                                    </div><!-- /.row - loop through old request -->
                                @endfor
                            @endif
                            <p>
                                <button type="button" name="btnFeatureGen" id="btnFeatureGen"
                                        class="btn btn-link btn-sm"
                                        data-toggle="tooltip" title="Add new feature">
                                    Add custom feature
                                </button>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" name="btnAddFeature" role="button"
                            class="btn btn-success" {{ !$app->subscribed != 1 ? 'disabled' : '' }}>Add
                    </button>
                </div>
            </form>
        </div>
    </div>
    <hr>

    <div class="row">
        <div class="col-lg-12">
            <div class="media">
                <h3>Existing Features ({{ isset($sort) ? title_case($sort) : 'All' }})
                    <hr class="hidden-lg visible-md visible-sm">
                    <div class="pull-right">
                        <div class="btn-group btn-group-sm">
                            <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">Options <i
                                        class="fa fa-angle-down"></i></button>
                            <ul class="dropdown-menu pull-right">
                                <li class="dropdown-header">Sort</li>
                                <li><a href="{{ route('rental.properties.features.index', [$app, $property]) }}">All</a>
                                </li>
                                <li>
                                    <a href="{{ route('rental.properties.features.index', [$app, $property, 'sort' => "active"]) }}">Active</a>
                                </li>
                                <li>
                                    <a href="{{ route('rental.properties.features.index', [$app, $property, 'sort' => "disabled"]) }}">Disabled</a>
                                </li>
                                <li>
                                    <a href="{{ route('rental.properties.features.index', [$app, $property, 'sort' => "trash"]) }}">In
                                        Trash</a></li>
                            </ul>
                        </div>
                    </div>
                </h3>
                <div class="media-body" id="features-body">
                    @forelse($features as $feature)
                        <div class="media">
                            <div class="media-body">
                                <input type="hidden" name="_fId" class="_id" value="{{ $feature->id }}">
                                <input type="hidden" name="_feat" class="_feat" value="{{ $feature->title }}">
                                <input type="hidden" name="_details" class="_details"
                                       value="{{ $feature->details }}">
                                <input type="hidden" name="_value" class="_value" value="{{ $feature->total_no }}">
                                <!-- / end of hidden feature values -->

                                <!-- title -->
                                <h4 class="feature-heading">{{ $feature->title }} <sup
                                            class="badge">{{ $feature->total_no }}</sup></h4>

                                <!-- details -->
                                <div class="_feature_details">{!! $feature->details !!}</div>
                                <br>

                                <!-- links -->
                                <ul class="list-inline">
                                    @if(isset($sort) && $sort = "trash")
                                        <li><a role="button" class="btn btn-success" data-toggle="modal"
                                               data-target="#property-feature-restore-modal-{{ $feature->id }}"
                                               title="move to trash"><span class="fa fa-refresh"></span></a></li>
                                        @include('rental.properties.features.partials.forms._restore_modal')

                                        <li><a role="button" class="btn btn-danger" data-toggle="modal"
                                               data-target="#property-feature-destroy-modal-{{ $feature->id }}"
                                               title="move to trash"><span class="fa fa-trash-o"></span></a></li>
                                        <li>Deleted <em>{{ $feature->deleted_at->diffForHumans() }}</em></li>
                                        @include('rental.properties.features.partials.forms._destroy_modal')
                                    @else
                                        <li>
                                            <a href="{{ route('rental.properties.features.status', [$app, $property, $feature]) }}"
                                               role="button" class="btn btn-default" data-toggle="tooltip"
                                               title="{{ AppStatusToggleText($feature->status) }}"><i
                                                        class="{{ AppStatusIcon($feature->status) }}"></i> {{ AppStatusText($feature->status) }}
                                            </a></li>
                                        <li><a role="button" name="btnEditProperty"
                                               class="btn btn-primary" data-toggle="modal"
                                               data-target="#feature-edit-modal-{{ $feature->id }}"><i
                                                        class="fa fa-edit"></i> Edit</a></li>
                                        <li><a role="button" class="btn btn-warning" data-toggle="modal"
                                               data-target="#property-feature-delete-modal-{{ $feature->id }}"
                                               title="move to trash"><span class="fa fa-remove"></span></a></li>
                                        @if($feature->updated_at and $sort != "trash")
                                            <li>Last edited <em>{{ $feature->updated_at->diffForHumans() }}</em></li>
                                        @else
                                            <li>Added <em>{{ $feature->created_at->diffForHumans() }}</em></li>
                                        @endif

                                        @include('rental.properties.features.partials.forms._edit_modal')
                                        @include('rental.properties.features.partials.forms._delete_modal')
                                    @endif
                                </ul>
                            </div><!-- /.media-body -->
                        </div><!-- /.media -->
                        <hr>
                    @empty
                        <p class="lead text-muted">This property has no features yet.</p>
                    @endforelse
                </div>
                <div class="media-bottom">
                    {{ $features->appends(['sort' => $sort])->links() }}
                </div>
            </div>
        </div>
    </div>


    <!--modal snippet -->

    @include('partials.modals.delete')

    <script>
        CKEDITOR.replace('ckeditor');
    </script>
@endsection
