<div class="col-lg-4 col-sm-4">
    <div class="panel panel-default">
        <div class="panel-body">
            @if($app->app->company->avatar != null)
                <img src="{{ url($app->app->company->avatar->data['thumbUrl']) }}"
                     alt="{{ $app->app->company->avatar->data['alt'] }}"
                     class="img-thumbnail">
            @else
                <img src="{{ url('images/site/logos/thumbs/default.jpg') }}" alt="default logo" class="img-thumbnail">
            @endif

            <strong>{{ $app->app->company->title }}</strong>

            <div class="pull-right">
                <span class="badge" data-toggle="tooltip" title="Restore this app to get more options">
                    <i class="fa fa-info"></i>
                </span>
            </div>

            <h4>{{ $app->app->product->title }}</h4>

            <p>Deleted {{ $app->app->deleted_at->diffForHumans() }}</p>

            @if($app->app->company->status)
                <div class="clearfix">
                    <a href="{{ route('estate.rental.restore', ['id' => $app->app->id]) }}" class="btn btn-success"
                       data-toggle="tooltip"
                       title="Restore App">
                        <i class="fa fa-refresh"></i>
                        Restore App
                    </a>
                    <div class="pull-right">
                        <div class="btn-group btn-group-sm">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"
                                    aria-expanded="false">
                                <strong>
                                    <i class="fa fa-ellipsis-v"></i>
                                </strong>
                            </button>
                            <ul class="dropdown-menu pull-right">
                                <li>
                                    <a href="{{ route('estate.rental.destroy', ['id' => $app->app->id]) }}"
                                       data-toggle="tooltip"
                                       title="Delete completely" class="te">
                                        <i class="fa fa-trash"></i>
                                        Delete Completely
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
