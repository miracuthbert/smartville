<table class="table table-bordered table-hover">
    <caption>
        <h3>
            <i class="fa fa-credit-card"></i>
            Paid Subscriptions
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
    @forelse($apps as $app_subscriber)
        <tr>
            <td>
                <h5 class="lead">
                    {{ $loop->first ? $apps->firstItem() : ($apps->firstItem() + $loop->index) }}.
                    {{ $app_subscriber->app->company->title }}
                    <span class="badge" data-toggle="tooltip" title="properties"
                          role="button">
                        {{ $app_subscriber->app->properties_count }}
                    </span>
                </h5>
                <p class="small">{{ $app_subscriber->app->product->title }}</p>
            </td>
            <td>
                <p class="text-muted small">
                    {{ $app_subscriber->ends_at->toDateTimeString() }}
                </p>
            </td>
            <td>
                <p class="{{ SubscriptionStatusLabel($app_subscriber->ends_at) }}">
                    <span data-toggle="tooltip"
                          title="{{ SubscriptionStatusText($app_subscriber->ends_at) }}">
                        {{ SubscriptionStatusText($app_subscriber->ends_at) }}
                        <i class="{{ SubscriptionStatusIcon($app_subscriber->ends_at) }}"></i>
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
                                <a href="{{ route('admin_company_app.show', ['admin_company_app' => $app_subscriber->app->id]) }}">
                                    View <i class="fa fa-eye"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="4">
                <h4 class="list-group-text">
                    No subscribed apps.
                </h4>
            </td>
        </tr>
    @endforelse
    </tbody><!-- /tbody -->
</table><!-- /.table -->
