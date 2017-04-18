<?php

namespace App\Http\Controllers\Estate\Rental\Subscription;

use App\Models\v1\Company\AppTrial;
use App\Models\v1\Company\CompanyApp;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TrialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        //quantity of properties
        $quantity = $request->quantity;

        //no of trial days
        $trialDays = $request->trialDays;
        $trialDays = !empty($trialDays) ? $trialDays : 14;

        //app
        $app = CompanyApp::find($id);

        //check app
        if ($app == null)
            abort(404);

        //authorize
        $this->authorize('update', $app);

        $trial = $app->newTrial($request->user(), $quantity, $trialDays)->create();

        if (!empty($trial->id)) {
            if ($app->update(['subscribed' => 1])) {
                return redirect()->route('estate.rental.dashboard', ['id' => $app->id])
                    ->with('success', 'Your free trial has been activated up to ' . $trial->trial_ends_at);
            }
        }
//        dd($trial);

        //error
        return redirect()->back()->with('error', 'Failed trial subscription. Try again!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @param $subscription
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $subscription)
    {

        switch ($subscription) {
            case 'cancel':
                //app trial
                $app_trial = AppTrial::find($id);

                if ($app_trial != null)
                    $app = $app_trial->app;

                //check app
                if ($app == null)
                    abort(404);

                //authorize
                $this->authorize('update', $app);

                $trial = $app->cancelNow();

                if ($trial)
                    return redirect()->back()
                        ->with('success', 'App trial subscription cancelled successfully. You can still resume your trial before it ends.');
                break;

            case 'resume':
                //app trial
                $app_trial = AppTrial::find($id);

                if ($app_trial != null)
                    $app = $app_trial->app;

                //check app
                if ($app == null)
                    abort(404);

                //authorize
                $this->authorize('update', $app);

                $trial = $app->resume();

                if ($trial)
                    return redirect()->back()
                        ->with('success', 'App trial subscription resumed successfully. You can now keep using the free trial before it ends.');
                break;

            default:
                return redirect()->back()
                    ->with('error', 'Some error occured. Please try again');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
