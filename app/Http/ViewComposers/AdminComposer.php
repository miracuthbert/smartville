<?php

namespace App\Http\ViewComposers;

use App\Models\Support\BugReport;
use App\Models\v1\Company\AppTrial;
use App\Models\v1\Company\Company;
use App\Models\v1\Company\CompanyApp;
use App\User;
use Carbon\Carbon;
use Illuminate\View\View;

class AdminComposer
{

    /**
     * AdminComposer constructor.
     */
    public function __construct()
    {
    }

    /**
     * Bind data to the view.
     *
     * @param View $view
     * @return void
     */
    public function compose(View $view)
    {
        $logged_users = User::whereDate('last_login_at', Carbon::today())->paginate();
        $bugs = BugReport::whereNull('solved_at')->orderBy('created_at', 'DESC')->paginate();
        $trials = AppTrial::with('app')->where('trial_ends_at', '>', Carbon::now())->orderBy('trial_ends_at', 'ASC')->paginate();
        $subscribers = CompanyApp::withCount('properties')->where('subscribed', 1)->where('is_trial', 0)->paginate();
        $companies = Company::withCount('apps')->orderBy('status', 'DESC')->latest()->paginate();

        $view->with('app_trials', $trials)
            ->with('app_subscribers', $subscribers)
            ->with('companies', $companies)
            ->with('logged_users', $logged_users)
            ->with('bugs', $bugs);

    }
}