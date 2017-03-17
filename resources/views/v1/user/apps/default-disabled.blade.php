<div class="col-lg-6 col-sm-6">
    <div class="panel panel-default">
        <div class="panel-heading">
            @if($app->company->avatar != null)
                <img src="{{ url($app->company->avatar->data['thumbUrl']) }}"
                     alt="{{ $app->company->avatar->data['alt'] }}"
                     class="img-thumbnail">
            @else
                <img src="{{ url('images/site/logos/thumbs/default.jpg') }}" alt="default logo" class="img-thumbnail">
            @endif

            <strong>{{ $app->company->title }}</strong>

            <div class="pull-right">
                <span class="badge" data-toggle="tooltip" title="Enable this app to get more options">
                    <i class="fa fa-info"></i>
                </span>
            </div>

            <h4>{{ $app->product->title }}</h4>

            <p>
                <strong>Disabled</strong>
                {{ $app->updated_at->diffForHumans() }}
            </p>

            <div class="clearfix">
                <div class="pull-right">
                    @if($app->company->status)
                        <div class="btn-group btn-group-sm">
                            <button class="btn btn-default dropdown-toggle" data-toggle="dropdown"
                                    aria-expanded="false">
                                <strong>
                                    App ...
                                    <i class="caret"></i>
                                </strong>
                            </button>
                            <ul class="dropdown-menu pull-right">
                                <li>
                                    <a href="{{ route('app.status', ['id' => $app->id]) }}" data-toggle="tooltip"
                                       title="{{ AppStatusToggleText($app->status) }} App">
                                        <i class="{{ AppStatusIcon($app->status) }}"></i>
                                        {{ AppStatusToggleText($app->status) }}
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('app.delete', ['id' => $app->id]) }}" data-toggle="tooltip"
                                       title="Remove App">
                                        <i class="fa fa-remove"></i>
                                        Remove App
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!-- /.btn-group -->
                    @endif
                </div>
                <!-- /.pull-right -->
            </div>
            <!-- /.clearfix -->
        </div>
        <!-- /.panel-heading -->
    </div>
    <!-- /.panel-default -->
</div>
