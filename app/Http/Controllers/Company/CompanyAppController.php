<?php

namespace App\Http\Controllers\Company;

use App\Models\v1\Company\AppTrial;
use App\Models\v1\Company\CompanyApp;
use App\Models\v1\Estate\Paypal;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CompanyAppController extends Controller
{
    /**
     * CompanyAppController constructor.
     */
    public function __construct()
    {
        $this->middleware('company.app.admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //moved dashboard functionality to corresponding app
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
    public function store(Request $request)
    {
        //
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
        $app = CompanyApp::find($id);

        //check app
        if ($app == null)
            abort(404);

        //authorize
        $this->authorize('view', $app);

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

        return view('v1.estates.profile')
            ->with('trial', $trial)
            ->with('paypal', $paypal)
            ->with('subsClass', $subscribedClass)
            ->with('subscription', $subscribed)
            ->with('app', $app);
    }

    /**
     * Soft Delete the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        //find
        $app = CompanyApp::findOrFail($id);

        //authorize
        $this->authorize('delete', $app);

        //title
        $title = $app->title;

        //update status
        if ($app->update(['status' => 0, 'deleted_at' => Carbon::now()])) {
            return redirect()->back()
                ->with('success', $title . ' ' . $app->product->title . ' moved to trash successfully.');
        }

        return redirect()->back()
            ->with('error', 'Failed moving ' . $title . ' ' . $app->product->title . ' to trash. Try again!');
    }

    /**
     * Restore the specified resource in storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        //find
        $app = CompanyApp::findOrFail($id);

        //authorize
        $this->authorize('update', $app);

        if ($app->update(['status' => 1, 'deleted_at' => null])) {
            return redirect()->back()
                ->with('success', $app->title . ' ' . $app->product->title . ' restored successfully.');
        }

        return redirect()->back()
            ->with('error', 'Failed restoring ' . $app->title . ' ' . $app->product->title . '. Try again!');
    }

    /**
     * Update status of the specified resource in storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @internal param Request $request
     */
    public function toggleStatus($id)
    {
        $app = CompanyApp::findOrFail($id);

        //authorize
        $this->authorize('update', $app);

        $new_status = $app->status === 1 ? 0 : 1;

        if ($app->update(['status' => $new_status]))
            return redirect()->back()
                ->with('success', $app->company->title . ' ' . $app->product->title . ' status updated successfully!');
        else
            return redirect()->back()
                ->with('success', $app->company->title . ' ' . $app->product->title . ' status update failed. Try again!');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //find
        $app = CompanyApp::findOrFail($id);

        //authorize
        $this->authorize('delete', $app);

        //title
        $title = $app->title;

        //delete
        if ($app->delete()) {
            return redirect()->back()
                ->with('success', 'App deletion successful. ' . $title . ' ' . $app->product->title . ' is removed completely!');
        }

        return redirect()->back()
            ->with('error', 'Failed deleting app. ' . $title . ' ' . $app->product->title . '. Try again!');
    }
}
