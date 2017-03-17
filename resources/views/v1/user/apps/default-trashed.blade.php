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
                <span class="badge" data-toggle="tooltip" title="Restore this app to get more options">
                    <i class="fa fa-info"></i>
                </span>
            </div>

            <h4>{{ $app->product->title }}</h4>

            <p>Deleted {{ $app->deleted_at->diffForHumans() }}</p>

            @if($app->company->status)
                <div class="clearfix">
                    <div class="pull-right">
                        <div class="btn-group btn-group-sm">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <strong>
                                    App...
                                    <i class="caret"></i>
                                </strong>
                            </button>
                            <ul class="dropdown-menu pull-right">
                                <li>
                                    <a href="{{ route('app.restore', ['id' => $app->id]) }}" data-toggle="tooltip"
                                       title="Restore App">
                                        <i class="fa fa-refresh"></i>
                                        Restore App
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('app.destroy', ['id' => $app->id]) }}" data-toggle="tooltip"
                                       title="Delete completely">
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
