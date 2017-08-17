<div class="row">
    <div class="col-md-12">
        <h2>
            @yield('dashboard-title')

            <div class="pull-right">
                <a href="{{ route('user.dashboard', ['section' => 'apps-new']) }}" class="btn btn-primary btn-sm {{ $section == "apps-new" ? 'disabled' : '' }}">
                    <i class="fa fa-laptop"></i> Create New App
                </a>

                <div class="btn-group btn-group-sm">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                        <strong>
                            Go to...
                            <span class="caret"></span>
                        </strong>
                    </button>
                    <ul class="dropdown-menu pull-right">
                        <li class="{{ $section == null ? 'disabled' : '' }}">
                            <a href="{{ route('user.dashboard') }}">
                                My Dashboard
                            </a>
                        </li>
                        <li class="{{ $section == "apps" ? 'disabled' : '' }}">
                            <a href="{{ route('user.dashboard', ['section' => 'apps']) }}">
                                My Apps
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </h2>
    </div>
</div>

<hr>

<div class="row">
    <div class="col-md-12">
        <!-- include alerts -->
        @include('partials.alerts.default')
    </div>
</div>