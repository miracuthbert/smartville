@extends('layouts.estates')

@section('title')
    {{ $property->title }} Features
@endsection

@section('breadcrumb')
    <li><a href="{{ route('estate.properties', ['id' => $app->id, 'sort' => 'all']) }}">Properties</a></li>
    <li><a href="{{ route('estate.property.edit', ['id' => $property->id]) }}">{{ $property->title }}</a></li>
    <li class="active">Features</li>
@endsection

@section('page-header')
    {{ $property->title }} Features
@endsection

@section('content')

    <div class="row">

        <div class="col-lg-12">

            <form name="add-property-form" method="post" action="{{ route('estate.property.features.add') }}"
                  enctype="application/x-www-form-urlencoded"
                  autocomplete="off">

                @include('includes.alerts.default')

                @include('includes.alerts.validation')

                <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">

                <input type="hidden" name="id" id="id" value="{{ $property->id }}">

                <h4>Add new feature(s):</h4>
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
                            <div class="row" id="default">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Feature:</label>
                                        <input type="text" name="feature[]" class="form-control _add_feature" required
                                               autofocus>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Details:</label>
                                        <input type="text" name="details[]" class="form-control _add_details" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>No.:</label>
                                        <input type="text" name="value[]" class="form-control _add_value" required>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <label class="hidden-xs"><span class="text-warning">Remove</span></label>
                                    <button type="button" name="btnFeatureGen"
                                            class="btn btn-warning btnRemoveFeature"
                                            data-toggle="tooltip" title="Remove feature">
                                        <span class="fa fa-remove"></span>
                                    </button>
                                </div>


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
                            </div>
                            <button type="button" name="btnFeatureGen" id="btnFeatureGen"
                                    class="btn btn-default"
                                    data-toggle="tooltip" title="Add new feature">
                                <span class="fa fa-plus"></span>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="box">
                            <button type="submit" name="btnAddFeature" role="button"
                                    class="btn btn-success" {{ $app->subscribed != 1 ? 'disabled' : '' }}>Add
                            </button>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>

    <hr>

    <div class="row">
        <div class="col-lg-12">
            <div class="table-responsive">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 for="feature">Existing property features:</h4>
                    </div>
                    <div class="panel-body" id="features-body">
                        @if(count($property->features) > 0)
                            @foreach($property->features as $feature)
                                <blockquote>
                                    <input type="hidden" name="_fId" class="_id" value="{{ $feature->id }}">
                                    <input type="hidden" name="_feat" class="_feat" value="{{ $feature->title }}">
                                    <input type="hidden" name="_details" class="_details"
                                           value="{{ $feature->details }}">
                                    <input type="hidden" name="_value" class="_value" value="{{ $feature->total_no }}">
                                    <!-- / end of hidden feature values -->

                                    <div class="clearfix">
                                        <!-- title -->
                                        <strong class="pull-left feature-heading">
                                            {{ $feature->title }}
                                            <span class="badge">{{ $feature->total_no }}</span>
                                        </strong>

                                        <!-- options -->
                                        <div class="btn-group btn-group-xs pull-right">
                                            <a href="{{ route('estate.property.feature.status', ['id' => $feature->id]) }}"
                                               role="button" class="btn btn-default"
                                               data-toggle="tooltip"
                                               title="{{ AppStatusToggleText($feature->status) }}">
                                                <span class="{{ AppStatusIcon($feature->status) }}"></span>
                                            </a>
                                            <button type="button" name="btnEditProperty"
                                                    class="btn btn-primary btnEditPropertyFeature"
                                                    data-toggle="modal" data-target="#featureEdit">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <a role="button"
                                               href="{{ route('estate.property.feature.delete', ['id' => $feature->id]) }}"
                                               name="btnFeatureGen"
                                               class="btn btn-warning btnRemoveFeature"
                                               data-toggle="tooltip" title="move to trash">
                                                <span class="fa fa-remove"></span>
                                            </a>
                                        </div>
                                    </div>

                                    <p class="_feature_details">{{ $feature->details }}</p>

                                    <footer>
                                        Added
                                        <cite>{{ $feature->created_at->diffForHumans() }}</cite>
                                    </footer>
                                </blockquote>
                            @endforeach
                        @else
                            <p class="lead text-muted">This property has no features yet.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--modal snippet -->
    <div class="modal fade" id="featureEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit property feature:</h4>
                </div>
                <div class="modal-body">
                    <form action="" id="feature-edit">
                        <div class="row">
                            <div class="col-lg-12">
                                <input type="hidden" name="_fid" id="_fid" value="-1">
                                <div class="form-group @if($errors->has('feature')||$errors->has('details')||$errors->has('value')) has-error @endif">
                                    <div class="form-group">
                                        <label>Feature:</label>
                                        <input type="text" name="_feature" class="form-control _add_feature"
                                               id="_feature"
                                               required
                                               autofocus>
                                    </div>
                                    <div class="form-group">
                                        <label>Details:</label>
                                    <textarea name="_details" rows="3" class="form-control _add_details" id="_details"
                                              placeholder="feature details"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Total no. of feature:</label>
                                        <input type="text" name="_value" class="form-control _add_value" id="_value"
                                               required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary"
                            id="btnUpdatePropertyFeature" {{ $app->subscribed != 1 ? 'disabled' : '' }}>Save changes
                    </button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    </div>

    @include('includes.modals.delete')

    <script>
        $urlFeatureUpdate = '{{ route('estate.property.features.update') }}'
        CKEDITOR.replace('property_desc');
    </script>
@endsection
