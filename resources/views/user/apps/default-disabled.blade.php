<div class="col-lg-4 col-sm-6">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="clearfix">
                @if($app->app->company->avatar != null)
                    <img src="{{ url($app->app->company->avatar->data['thumbUrl']) }}"
                         alt="{{ $app->app->company->avatar->data['alt'] }}"
                         class="img-thumbnail">
                @else
                    <img src="{{ url('images/site/logos/thumbs/default.jpg') }}" alt="default logo"
                         class="img-thumbnail">
                @endif

                <div class="pull-right">
                <span class="badge" data-toggle="tooltip" title="Enable this app to get more options">
                    <i class="fa fa-info"></i>
                </span>
                </div>
            </div>

            <h3>{{ $app->app->company->title }}</h3>
            
            <p class="lead">{{ $app->app->product->title }}</p>

            <p>
                <strong>Disabled</strong>
                {{ $app->app->updated_at->diffForHumans() }}
            </p>

            <div class="clearfix">
                <a href="{{ route('company.app.status', [$app->app]) }}"
                   class="btn btn-success" data-toggle="tooltip"
                   title="{{ AppStatusToggleText($app->app->status) }} App">
                    <i class="{{ AppStatusIcon($app->app->status) }}"></i>
                    {{ AppStatusToggleText($app->app->status) }}
                </a>

                <div class="pull-right">
                    <div class="btn-group btn-group-sm">
                        <button class="btn btn-default dropdown-toggle" data-toggle="dropdown"
                                aria-expanded="false">
                            <strong>
                                <i class="fa fa-ellipsis-v"></i>
                            </strong>
                        </button>
                        <ul class="dropdown-menu pull-right">
                            <li>
                                <a href="{{ route('company.app.delete', ['id' => $app->app]) }}"
                                   data-toggle="tooltip"
                                   title="Remove App">
                                    <i class="fa fa-remove"></i>
                                    Remove App
                                </a>
                            </li>
                        </ul>
                    </div><!-- /.btn-group -->
                </div><!-- /.pull-right -->
            </div><!-- /.clearfix -->
        </div><!-- /.panel-body -->
    </div><!-- /.panel -->
</div>
