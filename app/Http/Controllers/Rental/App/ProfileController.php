<?php

namespace App\Http\Controllers\Rental\App;

use App\Models\v1\Company\AppTrial;
use App\Models\v1\Company\CompanyApp;
use App\Models\v1\Estate\Paypal;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    /**
     * ProfileController constructor.
     */
    public function __construct()
    {
        $this->middleware('company.app.admin');
    }

    /**
     *
     */
    function __invoke(CompanyApp $app)
    {

        //check app
        if ($app == null)
            abort(404);

        //authorize
        $this->authorize('update', $app);

        if ($app->subscribed) {

        }

        $subscribed = $app->paypal()->where('completed', 1)->where('ends_at', '>', Carbon::now())->first();

        if ($subscribed == null)
            $subscribed = $app->trials()->where('is_ended', 0)->where('trial_ends_at', '>', Carbon::now())->first();

        //get subscription class
        $subscribedClass = get_class($subscribed);

        //subscriptions classes
        $trial = AppTrial::class;
        $paypal = Paypal::class;

        return view('rental.profile.index')
            ->with('trial', $trial)
            ->with('paypal', $paypal)
            ->with('subsClass', $subscribedClass)
            ->with('subscription', $subscribed)
            ->with('app', $app);
    }
}
