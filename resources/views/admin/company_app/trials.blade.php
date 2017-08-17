<table class="table table-bordered table-hover">
    <caption>
        <h3>
            <i class="fa fa-credit-card"></i>
            Trial Subscriptions
        </h3>
    </caption>
    <thead>
    <tr>
        <td>Company</td>
        <td>Ends At</td>
        <td>Status</td>
        <td>Actions</td>
    </tr>
    </thead><!-- /thead -->
    <tbody>
    @forelse($apps as $app_trial)
        <tr>
            <td>
                <h5 class="lead">
                    {{ $loop->first ? $apps->firstItem() : ($apps->firstItem() + $loop->index) }}
                    .
                    {{ $app_trial->app->company->title }}
                    <span class="badge" data-toggle="tooltip" title="properties">
                        {{ $app_trial->app->properties_count }}
                    </span>
                </h5>
                <p class="small">{{ $app_trial->app->product->title }}</p>
            </td>
            <td>
                <strong class="text-muted small">
                    {{ $app_trial->trial_ends_at->toDateTimeString() }}
                </strong>
            </td>
            <td>
                <p class="{{ SubscriptionStatusLabel($app_trial->trial_ends_at) }}">
                    <span data-toggle="tooltip" title="{{ SubscriptionStatusText($app_trial->trial_ends_at) }}">
                        {{ SubscriptionStatusText($app_trial->trial_ends_at) }}
                        <i class="{{ SubscriptionStatusIcon($app_trial->trial_ends_at) }}"></i>
                    </span>
                </p>
            </td>
            <td>
                <div class="pull-right">
                    <div class="btn-group btn-group-sm">
                        <button type="button" class="btn btn-default dropdown-toggle"
                                data-toggle="dropdown">
                            Actions <i class="fa fa-angle-down"></i>
                        </button>
                        <ul class="dropdown-menu pull-right">
                            <li>
                                <a href="{{ route('admin_company_app.show', ['admin_company_app' => $app_trial->app->id]) }}">
                                    View <i class="fa fa-eye"></i>
                                </a>
                            </li>
                        </ul>
                        </li>
                    </div>
                </div>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="4">
                <h4 class="list-group-text">
                    No apps on trial found.
                </h4>
            </td>
        </tr>
    @endforelse
    </tbody><!-- /tbody -->
</table><!-- /.table -->
