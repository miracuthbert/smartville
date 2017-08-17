<div class="row">
    <div class="col-md-12">

        <div class="clearfix">
            @if($logo != null)
                <img src="{{ url($logo->data['thumbUrl']) }}" alt="{{ $logo->data['alt'] }}" class="img-thumbnail">
            @endif

            <span class="lead">Company {{ $section == null ? 'Profile' : $section }}</span>

            <div class="pull-right">
                <div class="btn-group btn-group-sm">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"
                            aria-expanded="false">
                        More Options
                        <div class="caret"></div>
                    </button>
                    <ul class="dropdown-menu pull-right">
                        <li class="{{ $section == null ? 'disabled' : '' }}">
                            <a href="{{ route('company.profile', ['id' => $company->id]) }}">Profile</a>
                        </li>
                        <li class="{{ $section == "logo" ? 'disabled' : '' }}">
                            <a href="{{ route('company.profile', ['id' => $company->id, 'section' => 'logo']) }}">Change
                                Logo</a>
                        </li>
                        <li class="disabled">
                            <a href="#">Add Users</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <hr>

        @include('partials.alerts.default')

        @include('partials.alerts.validation')
    </div>
</div>