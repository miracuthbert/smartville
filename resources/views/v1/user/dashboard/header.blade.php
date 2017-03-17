<div class="row">
    <div class="col-md-12">
        <strong class="lead">
            @yield('dashboard-title')
        </strong>

        <div class="pull-right">
            <div class="btn-group btn-group-sm">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    <strong>
                        Switch to
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
                    <li class="{{ $section == "apps-new" ? 'disabled' : '' }}">
                        <a href="{{ route('user.dashboard', ['section' => 'apps-new']) }}">
                            Create New App
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <hr>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <!-- include alerts -->
        @include('includes.alerts.default')
    </div>
</div>