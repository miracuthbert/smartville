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
                    <div class="btn-group btn-group-sm">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"
                                aria-expanded="false">
                            Company
                            <div class="caret"></div>
                        </button>
                        <ul class="dropdown-menu pull-right">
                            <li class="">
                                <a href="{{ route('company.profile', ['id' => $app->app->company->id]) }}"
                                   data-toggle="tooltip"
                                   title="Company Profile">
                                    Profile
                                </a>
                            </li>
                            <li class="">
                                <a href="{{ route('company.profile', ['id' => $app->app->company->id, 'section' => 'logo']) }}"
                                   data-toggle="tooltip" title="Change logo">
                                    Change Logo
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('company.status', ['id' => $app->app->company->id]) }}"
                                   data-toggle="tooltip"
                                   title="{{ AppStatusToggleText($app->app->company->status) }} Company">
                                    {{ AppStatusToggleText($app->app->company->status) }}
                                </a>
                            </li>
                            @if($app->app->company->status)
                                <li class="disabled">
                                    <a href="#">Add Users</a>
                                </li>
                            @else
                                <li>Enable Company For More</li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div><!-- /header -->

            <h3>{{ $app->app->company->title }}</h3>

            <p class="lead">{{ $app->app->product->title }}</p>

            <p>
                <strong>Created</strong> {{ $app->app->created_at->diffForHumans() }}
            </p>

            <p>
                @if($app->app->subscribed)
                    Subscribed <i class="fa fa-check-square-o"></i>
                @else
                    <a href="{{ route('estate.trial.activate', ['id' => $app->app->id]) }}" class="alert-link">
                        Activate unlimited 14 day free trial
                    </a>
                @endif
            </p>

            <div class="clearfix">
                {{-- dashboard link --}}
                <a href="{{ route('estate.rental.dashboard', ['id' => $app->app->id]) }}"
                   class="btn btn-default {{ $app->app->company->status === 1 ? '' : 'disabled' }}"
                   data-toggle="tooltip"
                   title="App Dashboard">
                    <i class="fa fa-dashboard"></i> Dashboard
                </a>
                <!-- sm links -->
                <div class="pull-right">
                    <div class="btn-group btn-group-sm">
                        <button class="btn btn-default dropdown-toggle" data-toggle="dropdown"
                                aria-expanded="false">
                            <strong>

                                <i class="fa fa-ellipsis-v"></i>
                            </strong>
                        </button>
                        <ul class="dropdown-menu pull-right">
                            @if($app->app->status)

                                    <!-- subscription details link -->
                            {{--<li class="">--}}
                            {{--@if($app->app->subscribed)--}}
                            {{--<a href="" class="" data-toggle="tooltip"--}}
                            {{--title="Subscription info">--}}
                            {{--<i class="fa fa-info-circle"></i>--}}
                            {{--Subscription--}}
                            {{--</a>--}}
                            {{--@else--}}
                            {{--<a href="{{ route('estate.subscription.add', ['id' => $app->app->id]) }}"--}}
                            {{--class="{{ $app->app->company->status === 1 ? '' : 'disabled' }}"--}}
                            {{--data-toggle="tooltip" title="Subscribe">--}}
                            {{--<i class="fa fa-credit-card-alt"></i>--}}
                            {{--Subscribe--}}
                            {{--</a>--}}
                            {{--@endif--}}
                            {{--</li>--}}
                            @endif

                                    <!-- app status toggle link -->
                            <li class="">
                                <a href="{{ route('estate.rental.status', ['id' => $app->app->id]) }}"
                                   class="{{ $app->app->company->status === 1 ? '' : 'disabled' }}"
                                   data-toggle="tooltip"
                                   title="{{ AppStatusToggleText($app->app->status) }} App">
                                    <i class="{{ AppStatusIcon($app->app->status) }}"></i>
                                    {{ AppStatusToggleText($app->app->status) }}
                                </a>
                            </li>

                            <!-- delete app link -->
                            <li class="">
                                <a href="{{ route('estate.rental.delete', ['id' => $app->app->id]) }}"
                                   data-toggle="tooltip"
                                   title="Remove app">
                                    <i class="fa fa-remove"></i>
                                    Remove App
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.btn-group -->
                </div>
            </div>

            <!-- lg links -->
            <div class="clearfix">
                <div class="pull-right">
                    <div class="btn-group btn-group-sm hidden">
                        @if($app->app->status)
                            {{-- dashboard link --}}
                            <a href="{{ route('estate.rental.dashboard', ['id' => $app->app->company_id]) }}"
                               class="btn btn-primary {{ $app->app->company->status === 1 ? '' : 'disabled' }}"
                               data-toggle="tooltip"
                               title="App Dashboard">
                                <i class="fa fa-dashboard"></i> Dashboard
                            </a>

                            {{-- subscription details link --}}
                            @if($app->app->subscribed)
                                <a href="" class="btn btn-default"
                                   data-toggle="tooltip"
                                   title="Subscription info">
                                    <i class="fa fa-info-circle"></i>
                                    Subscription
                                </a>
                            @else
                                {{--<a href="{{ route('estate.subscription.add', ['id' => $app->app->id]) }}"--}}
                                {{--class="btn btn-default {{ $app->app->company->status === 1 ? '' : 'disabled' }}"--}}
                                {{--data-toggle="tooltip"--}}
                                {{--title="Subscribe">--}}
                                {{--<i class="fa fa-credit-card-alt"></i>--}}
                                {{--Subscribe--}}
                                {{--</a>--}}
                            @endif

                            {{-- app status toggle link --}}
                            <a href="{{ route('estate.rental.status', ['id' => $app->app->id]) }}"
                               class="btn btn-default {{ $app->app->company->status === 1 ? '' : 'disabled' }}"
                               data-toggle="tooltip"
                               title="{{ AppStatusToggleText($app->app->status) }} App">
                                <i class="{{ AppStatusIcon($app->app->status) }}"></i>
                                {{ AppStatusToggleText($app->app->status) }}
                            </a>
                            {{-- delete app link --}}
                            <a href="{{ route('estate.rental.delete', ['id' => $app->app->id]) }}"
                               class="btn btn-warning">
                                <i class="fa fa-remove"></i>
                                Remove
                            </a>
                        @endif
                    </div>
                </div>
            </div>
            <!-- /lg links -->
        </div>
    </div>
</div><!-- /.panel -->